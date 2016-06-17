<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Models\UserToken;
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

    // 默认登录方式, 可选值 (auto | username | email)
    const login_mode = 'auto';

    // 登录失败限制次数
    protected $login_failed_limit_times = [5, 3, 2, 1];

    // 登录失败锁定时间,单位秒
    protected $login_lock_time = [60, 180, 360, 3600];


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
        if ($user = $this->table('user')->where('username', $username)->first()) {

            return $user;
        }

        exception('UsernameOrPasswordIsNotCorrect');
    }

    protected function authLoginPassword($user, $password, $mode)
    {
        if ($user->password != User::encryptPassword($password)) {

            exception(ucwords($mode) . 'OrPasswordIsNotCorrect');
        }
    }

    protected function saveUserToken(&$user)
    {
        $user->user_token = sha1($user->id . $user->password . time());

        if (UserToken::where('app_id', APP_ID)->where('user_id', $user->id)->first()) {

            UserToken::where('app_id', APP_ID)->where('user_id', $user->id)->update(['app_version' => APP_VERSION, 'user_token' => $user->user_token]);

        } else {

            UserToken::create([
                'app_id' => APP_ID,
                'app_version' => APP_VERSION,
                'user_id' => $user->id,
                'user_token' => $user->user_token,
            ]);

        }

    }

    
    public function login(Context $context)
    {

        $mode = $context->param('mode', self::login_mode);

        $account = $context->data('account');

        $password = $context->data('password');

        if ($mode == 'auto') {

            if (filter_var($account, FILTER_VALIDATE_EMAIL)) {

                $mode = 'email';

                $user = $this->getUserByEmail($account);

            } else {

                $mode = 'username';

                $user = $this->getUserByUsername($account);
            }

        } elseif ($mode == 'email') {

            $user = $this->getUserByEmail($account);

        } elseif ($mode == 'username') {

            $user = $this->getUserByUsername($account);

        } else {

            throw new \Exception('The login mode is not correct.');
        }

        $this->authLoginPassword($user, $password, $mode);

        $this->saveUserToken($user);

        unset($user->password);

        return $context->status('success', $user);
    }

    public function register(Context $context)
    {

    }

}