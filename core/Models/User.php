<?php

/**
 * 用户模型
 * 定义了用户表相关的操作。
 *
 * @author 古月(2016/03)
 */

namespace Core\Models;

use Validator;

class User extends Model
{
    protected $user;

    /**
     * 添加用户
     *
     * 用户创建依赖于角色，采用外键约束,
     * 故在用户创建之前，应对角色信息进行验证。
     *
     * @param array $data 用户信息
     *
     * @return \Core\Models\Status
     */
    public function addUser($data)
    {
        $this->initializeUser($data);

        if (($validateResult = $this->validateUser()) !== true) {
            return status('validateError', $validateResult);
        }

        if ($this->validateRole() === false) {
            return status('roleNotExists');
        }

        $result = $this->transaction(function () {

            $this->processPassword();

            if ($this->resource('USER')->insert($this->user)) {
                return $this->getUser($this->user['id']);
            };

            return status('addUserError');

        });

        return $result;
    }

    public function updateUser($user_id, $data)
    {
    }

    // 删除用户
    // 使用事务删除用户，处理用户与角色的关系，
    // 删除成功返回 True。
    public function deleteUser($params, $remove = false)
    {
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
     * @return \Core\Models\Status
     */
    public function getUserByUsername($username, $password = false)
    {
        return $this->getUserRow('username', $username, $password);
    }

    /**
     * 通过邮箱获取用户.
     *
     * @param sting $email 邮箱
     * @param bool $password 显示密码
     *
     * @return \Core\Models\Status
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
     * @return \Core\Models\Status
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
     * 获取用户记录.
     *
     * @param string $field
     * @param mixed $vlaue
     * @param bool $password
     *
     * @return \Core\Models\Status
     */
    protected function getUserRow($field, $vlaue, $password = false)
    {
        $user = $this->resource('USER')->where($field, $vlaue)->first();

        if (!$user) {
            return status('userDoesNotExist', $user);
        }

        if (!$password) {
            unset($user->password);
        }

        return status('success', $user);
    }

    /**
     * 获取用户组.
     *
     * @param array $params 用户获取条件配置参数
     *
     * @return \Core\Models\Status
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
     * 保存用户Token，如果数据库不存在则添加，否则更新记录。
     *
     * @param string $row .app_id
     * @param stinrg $row .user_id
     * @param string $row .user_token
     *
     * @return mixed
     */
    protected function saveUserToken($row)
    {
        $table = $this->resource('USERTOKEN');

        $where = $table->where('app_id', $row['app_id'])->where('user_id', $row['user_id']);

        if ($where->first()) {
            $result = $table->update($row);
        } else {
            $result = $table->insert($row);
        }

        return $result ? $row['user_token'] : false;
    }

    /**
     * 初始化用户
     * 合并配置文件新用户设置，设置时间戳.
     *
     * @param array $user
     * @param bool $post
     */
    protected function initializeUser($user, $post = true)
    {
        $initialized = [
            'id' => $this->id(),
            'role' => config('site.user.role', 'member'),
            'status' => config('site.user.status', 0),
            'avatar' => config('site.user.avatar', '/web/images/avatar.png'),
            'source' => 'eevee',
        ];

        $this->timestamps($initialized, $post);

        $this->user = array_merge($initialized, $user);
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

        $validator = Validator::make($this->user, $rule);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }

    /**
     * 校验添加的用户所属角色是否存在.
     *
     * @return bool
     */
    protected function validateRole()
    {
        return true;
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
     * 处理用户密码
     */
    protected function processPassword()
    {
        $this->user['password'] = $this->encryptPassword($this->user['password']);
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
