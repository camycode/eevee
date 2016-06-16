<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Context;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 注册用户的状态
    const register_user_status = 'common';

    // 注册用户的头像
    const register_user_avatar = '/images/avatar.png';

    // 注册用户的角色
    const register_user_role = 'guest';

    // 注册用户默认来源
    const register_default_source = 'eevee';

    // 登录失败限制次数
    const login_failed_limit_times = [5, 3, 2, 1];

    // 登录失败锁定时间,单位秒
    const login_lock_time = [60, 180, 360, 3600];

    // 默认登录方式, 可选值 (auto | username | email)
    const login_mode = 'username';


    protected function initializeRegisterUser(array $data)
    {
        $initialize = [
            'id' => $this->id(),
            'role' => self::register_user_role,
            'avatar' => self::register_user_avatar,
            'source' => self::register_default_source,
            'status' => self::register_user_status,
        ];

        return array_merge($initialize, $data);
    }

    protected function validateRegisterUser(array $data, array $ignore = [])
    {

        $rule = [
            'id' => 'required|unique:user',
            'username' => 'required|unique:user',
            'email' => 'required|unique:user',
            'role' => 'required',
        ];

        $this->ignore($data, $ignore);

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            exception('ValidateFailed', $validator->errors());
        }

    }

    protected function getUserByEmail($email)
    {
        if ($user = $this->table('user')->where('email', $email)->first()) {

            return $user;
        }

        exception('EmailOrPasswordIsNotCorrect');
    }

    protected function getUserByUsername($username)
    {
        if ($user = $this->table('user')->where('email', $username)->first()) {

            return $user;
        }

        exception('UsernameOrPasswordIsNotCorrect');
    }

    protected function authLoginPassword($user, $mode)
    {
        if ($user->password != User::encryptPassword($mode)) {

            exception(ucwords($mode) . 'OrPasswordIsNotCorrect');
        }
    }

    protected function generateUserToken($user)
    {

    }


    public function login(Context $context)
    {

        $mode = $context->param('mode', self::login_mode);

        $account = $this->data('accoutn');

        if ($mode == 'auto') {

            if (filter_var($account, FILTER_VALIDATE_EMAIL)) {

                $user = $this->getUserByEmail($account);

            } else {

                $user = $this->getUserByUsername($account);
            }

        } elseif ($mode == 'email') {

            $user = $this->getUserByEmail($account);

        } elseif ($mode == 'username') {

            $user = $this->getUserByUsername($account);

        } else {

            throw new \Exception('The login mode is not correct.');
        }

        $this->authLoginPassword($user, $mode);

        $user->user_token = $this->generateUserToken($user);

        unset($user->password);

        return $context->status('success', $user);
    }

    public function register(Context $context)
    {

    }

}