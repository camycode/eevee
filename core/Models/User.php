<?php

namespace Core\Models;

use Core\Events\UserCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;


/**
 * 用户模型,定义了用户资源相关的操作。
 *
 * @author 古月(2016/03)
 */
class User extends Model
{
    protected $data;

    /**
     * 绑定用户资源操作数据
     *
     * @param $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
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

        return $this->transaction(function () {

            $this->processPassword();

            $this->updateUserRoleRelationship($this->data['id'], $this->data['role']);

            $this->filter($this->data, $this->fields('USER'));

            $this->resource('USER')->insert($this->data);

            $status = $this->getUser($this->data['id']);

            event(new UserCreated($status->data));

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
        $resource = $this->resource('USER');

        $origin = $resource->where('id', $user_id)->first();

        if (!$origin) {

            return status('userDoesNotExist');
        }

        $ignore = ['password'];

        if (!isset($this->data['username']) || $this->data['username'] == $origin->username) {

            array_push($ignore, 'username');
        }

        if (!isset($this->data['email']) || $this->data['email'] == $origin->email) {

            array_push($ignore, 'email');
        }

        $this->validateUser($ignore);

        $this->timestamps($this->data, false);

        return $this->transaction(function () use ($resource, $user_id) {

            if (isset($this->data['role'])) {

                $this->updateUserRoleRelationship($user_id, $this->data['role']);
            }

            $this->filter($this->data, $this->fields('ROLE'), ['id']);

            $resource->where('id', $user_id)->update($this->data);

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
        $users = $this->selector('USER', $params);
        if ($users && !isset($params['count'])) {
            foreach ($users as $k => $v) {
                unset($users[$k]->password);
            }
        }

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
            return status('userTokenDoesNotExist');
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
        $resource = $this->resource('USER');


        if (!$resource->where('id', $user_id)->first()) {

            return status('userDoesNotExsit');
        }

        $resource->where('id', $user_id)->delete();

        return status('success');
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
        $user = $this->getUser($user_id)->data;

        if ($this->processPassword($origin_password) != $user->password) {

            exception('TheOriginPasswordIsInvilad');
        }

        $this->resource('USER')->where('id', $user_id)->update(['password' => $new_password]);
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
     * 生成用户Token，存放在数据库中.
     *
     * @param object $user 用户对象
     * @param string $app_id 应用ID
     *
     * @return string
     */
    public function generateUserToken($user, $app_id)
    {
        $row = [
            'app_id' => $app_id,
            'user_id' => $user->id,
            'user_token' => sha1(uniqid($user->password)),
        ];

        return $this->saveUserToken($row);
    }

    /**
     * 生成用户和角色关系数组
     *
     * @param $user_id
     * @param $role
     *
     * @return array|bool
     */
    protected function generateUserRoleRelationships($user_id, $role)
    {
        if (is_string($role)) {

            return array('user_id' => $user_id, 'role_id' => $role);
        }

        if (is_array($role)) {

            $data = array();

            foreach ($role as $item) {

                array_push($data, array('user_id' => $user_id, 'role_id' => $item));
            }

            return $data;
        }

        exception('roleShouldBeStringOrArray');
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
        $user = $this->resource('USER')->where($field, $vlaue)->first();

        if (!$user) {
            return status('userDoesNotExist', $user);
        }

        $items = $this->resource('L:ROLERELATIONSHIP')->where('user_id', $user->id)->get();

        $roles = array();

        foreach ($items as $item) {

            $status = (new Role())->getRole($item->role_id);

            if ($status->code == 200) array_push($roles, $status->data);

        }

        $user->role = $roles;

        if (!$password) unset($user->password);

        return status('success', $user);
    }


    /**
     * 更新用户和角色的关系
     *
     * @param string $user_id
     * @param array /string $role_id
     *
     * @return Status
     */
    protected function updateUserRoleRelationship($user_id, $role)
    {
        $resource = $this->resource('L:ROLERELATIONSHIP');

        $data = $this->generateUserRoleRelationships($user_id, $role);

        return $this->transaction(function () use ($resource, $user_id, $data) {

            $resource->where('user_id', $user_id)->delete();

            $resource->insert($data);

        });

    }

    /**
     * 保存用户Token，如果数据库不存在则添加，否则更新记录。
     *
     * @param string $row .app_id
     * @param string $row .user_id
     * @param string $row .user_token
     *
     * @return mixed
     */
    protected function saveUserToken($row)
    {
        $resource = $this->resource('USERTOKEN');

        $query = $resource->where('app_id', $row['app_id'])->where('user_id', $row['user_id']);

        if ($query->first()) {

            $result = $resource->update($row);
        } else {

            $result = $resource->insert($row);
        }

        return $result ? $row['user_token'] : false;
    }

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
            'avatar' => config('site.user.avatar', '/web/images/avatar.png'),
            'source' => 'eevee',
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    /**
     * 校验用户，校验成功返回true，否则返回错误信息数组.
     *
     * @param array $ignore 忽略的验证的字段
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function validateUser($ignore = [], $password = false)
    {
        $table = $this->table('USER');

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

            return exception('validateFailed', $validator->errors());
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
}
