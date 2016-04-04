<?php

namespace Core\Models;


use Validator;


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

        if (($result = $this->validateUser()) !== true) {
            return status('validateError', $result);
        }

        $this->initializeUser();

        $status = $this->transaction(function () {

            $this->processPassword();

            $status = $this->updateUserRoleRelationship($this->data['id'], $this->data['role']);

            if ($status->code != 200) exception('updateUserRoleRelationshipError');

            unset($this->data['role']);

            $this->resource('USER')->insert($this->data);

            return $this->getUser($this->data['id']);

        });

        return $status;
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

        if (!isset($this->data['role'])) {
            array_push($ignore, 'role');
        }

        if (($result = $this->validateUser($ignore)) !== true) {
            return status('validateError', $result);
        }


        $this->timestamps($this->data, false);

        $status = $this->transaction(function () use ($resource, $user_id) {

            if (isset($this->data['role'])) {

                $status = $this->updateUserRoleRelationship($user_id, $this->data['role']);

                if ($status->code != 200) {
                    exception('updateUserRoleRelationshipError');
                }

            }
            if (isset($this->data['role'])) unset($this->data['role']);

            $resource->where('id', $user_id)->update($this->data);


            return $this->getUser($user_id);

        });

        return $status;
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
    protected function generateUserRoleRelationshipRows($user_id, $role)
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

        return false;
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

        if (!$password) {
            unset($user->password);
        }

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

        $data = $this->generateUserRoleRelationshipRows($user_id, $role);

        if ($data === false) exception('roleShouldBeStringOrArray');

        $status = $this->transaction(function () use ($resource, $user_id, $data) {

            $resource->where('user_id', $user_id)->delete();

            $resource->insert($data);

            return status('success');
        });

        return $status;
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
    protected function validateUser($ignore = [])
    {
        $table = $this->table('USER');

        $rule = [
            'username' => "required|unique:$table|max:255",
            'password' => 'required|min:6',
            'email' => "required|email|unique:$table|max:255",
            'role' => 'required',
        ];

        foreach ($ignore as $field) {
            if (isset($rule[$field])) unset($rule[$field]);
        }

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
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
