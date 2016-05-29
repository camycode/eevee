<?php

namespace Core\Models;

use Core\Models\Permission;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


/**
 * 用户模型,定义了用户资源相关的操作。
 *
 * @author 古月(2016/03)
 */
class User extends Model
{

    protected $fields = ['id', 'username', 'email', 'password', 'role', 'avatar', 'status', 'app_id', 'created_at', 'updated_at'];

    /**
     * 初始化用户
     * 合并配置文件新用户设置，设置时间戳.
     *
     */
    protected function initializeUser()
    {
        $initialized = [
            'id' => $this->id(),
            'role' => config('site.user.role', 'member'),
            'status' => config('site.user.status', 0),
            'avatar' => config('site.user.avatar', 'images/avatar.png'),
            'source' => 'eevee',
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    /**
     * 校验用户，校验成功返回true，否则返回错误信息数组.
     *
     * @param array $ignore 忽略的验证的字段
     * @param bool $password
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateUser($ignore = [], $password = false)
    {
        $table = $this->tableName();

        $rule = [
            'password' => 'required|min:6'
        ];

        if (!$password) {

            array_merge($rule, [
                'username' => "required|unique:$table|max:255",
                'email' => "required|email|unique:$table|max:255",
                'role' => 'required',
            ]);

        }

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        $this->validateRole((array)$this->data['role']);

    }


    /**
     * 验证用户角色是否存在
     *
     * @param array $role
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRole(array $role)
    {

        foreach ($role as $role_id) {

            if ((new Role())->getRole($role_id)->code != 200) {

                exception('roleDoesNotExist');
            }
        }
    }


    /**
     * 处理用户密码
     */
    protected function processPassword()
    {
        $this->data['password'] = $this->encryptPassword($this->data['password']);
    }

    /**
     * 用户密码加密.
     *
     * @param string $password
     *
     * @return string
     */
    protected function encryptPassword($password)
    {
        return md5($password);
    }

    /**
     * 获取用户记录.
     *
     * @param string $field
     * @param mixed $vlaue
     * @param bool $password
     *
     * @return Status
     */
    protected function getUserRow($field, $vlaue, $password = false)
    {
        $user = $this->table()->where($field, $vlaue)->first();

        if (!$user) {
            exception('userDoesNotExist');
        }

        Permission::guard($user, GUARD_GET, 'get');

        if (!$password) unset($user->password);

        return status('success', $user);
    }

    
    /**
     * 验证用户密码
     *
     * @param string $origin 原始密码
     * @param string $password 加密后的用户密码
     *
     * @return bool
     */
    public function authPassword($origin, $password)
    {
        return $this->encryptPassword($origin) == $password;
    }


    /**
     * 添加用户
     *
     * 用户创建依赖于角色，采用外键约束,
     * 故在用户创建之前，应对角色信息进行验证。
     *
     * @return Status
     *
     */
    public function addUser()
    {

        $this->validateUser();

        $this->initializeUser();

        Permission::guard($this->data, GUARD_ADD, 'add');

        return $this->transaction(function () {

            $this->processPassword();

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getUser($this->data['id']);

            return $status;

        });

    }

    /**
     * 更新用户
     *
     * @param $user_id
     * @example
     *
     * @return Status
     */
    public function updateUser($user_id)
    {

        $origin = $this->getUser($user_id)->data;


        if (!$origin) {

            return status('userDoesNotExist');
        }

        Permission::guard($origin, GUARD_UPDATE, 'update');

        $ignore = ['password'];

        if (!isset($this->data['username']) || $this->data['username'] == $origin->username) {

            array_push($ignore, 'username');
        }

        if (!isset($this->data['email']) || $this->data['email'] == $origin->email) {

            array_push($ignore, 'email');
        }

        $this->validateUser($ignore);

        $this->timestamps($this->data, false);

        return $this->transaction(function () use ($user_id) {

            $this->filter($this->data, $this->fields, ['id']);

            $this->table()->where('id', $user_id)->update($this->data);

            return $this->getUser($user_id);

        });

    }


    /**
     * 获取用户组.
     *
     * @param array $params 用户获取条件配置参数
     *
     * @return Status
     */
    public function getUsers($params)
    {
        $users = $this->selector($params);

        if ($users && !isset($params['count'])) {

            foreach ($users as $k => $v) {

                unset($users[$k]->password);
            }
        }

        Permission::guard($users, GUARD_GET, 'get');

        return status('success', $users);
    }

    /**
     * 获取用户.
     *
     * @param string $user_id 用户ID
     * @param bool $password 显示密码
     *
     * @return \Core\Models\Status
     */
    public function getUser($user_id, $password = false)
    {
        return $this->getUserRow('id', $user_id, $password);
    }

    /**
     * 通过用户名获取用户.
     *
     * @param string $username 用户名
     * @param bool $password 显示密码
     *
     * @return Status
     */
    public function getUserByUsername($username, $password = false)
    {
        return $this->getUserRow('username', $username, $password);
    }

    /**
     * 通过邮箱获取用户.
     *
     * @param string $email 邮箱
     * @param bool $password 显示密码
     *
     * @return Status
     */
    public function getUserByEmail($email, $password = false)
    {
        return $this->getUserRow('email', $email, $password);
    }

    /**
     * 通过用户TOKEN获取用户.
     *
     * @param string $token 用户Token
     *
     * @return Status
     */
    public function getUserByToken($token)
    {
        $table = $this->resource('USERTOKEN');

        if (!($row = $table->where('user_token', $token)->first())) {

            exception('userTokenDoesNotExist');
        }

        return $this->getUserRow('id', $row->user_id, true);
    }

    /**
     * 删除用户
     *
     * @param string $user_id 用户ID
     * @return Status
     */
    public function deleteUser($user_id)
    {

        if ($user = $this->table()->where('id', $user_id)->first()) {

            Permission::guard((array)$user, GUARD_DELETE, 'delete');

            $this->table()->where('id', $user_id)->delete();

            return status('success');
        }

        exception('userDoesNotExist');

    }

    /**
     * 更改用户密码
     *
     * @param string $user_id
     * @param string $origin_password
     * @param string $new_password
     */
    public function putUserPassword($user_id, $origin_password, $new_password)
    {
//        $user = $this->getUser($user_id)->data;
//
//        Permission::guard($user, GUARD_UPDATE, 'update_password');
//
//        if ($this->processPassword($origin_password) != $user->password) {
//
//            exception('TheOriginPasswordIsInvilad');
//        }
//
//        $this->table()->where('id', $user_id)->update(['password' => $new_password]);
    }



    /**
     * 发送用户注册成功邮件
     *
     * @param array $user
     */
//    public function sendUserRegisterSuccessMail(array $user)
//    {
//
//        Mail::send('emails.user.new', $user, function ($message) use ($user) {
//
//            $message->from('info@lehu.io', 'EEVEE REGISTER MAIL');
//
//            $message->to($user['email'], $user['username'])->subject('Your Reminder!');
//
//        });
//    }

}
