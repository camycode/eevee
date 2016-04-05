<?php

/**
 * 用户认证控制器,提供了用户登录,注册,忘记密码等接口.
 */

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Context;

class AuthController extends Controller
{
    /**
     * @apiGroup Auth
     *
     * @api {post} /api/login?mode 用户登录
     *
     * @apiDescription 用户登录有两种方式,用户名登录或邮箱登录,
     * 通过设置mode值`username`(默认)和`email`实现.
     *
     * @apiParam {string} [username]  用户名
     * @apiParam {string} password  用户密码
     * @apiParam {string} [email]   用户邮箱
     *
     *
     * @apiParamExample {curl} 请求示例:
     *     post /api/login?mode=username
     *     {
     *       "username": "root",
     *       "password": "something"
     *     }
     *
     *
     *
     */
    public function login(Context $context)
    {
        //获取请求信息
        $mode = $context->params('mode', 'username');

        $account = $context->data('account');

        $password = $context->data('password');

        $app_id = 'app_id';

        $model = new User();

        // 判断登录方式
        switch ($mode) {
            case 'email':
                $result = $model->getUserByEmail($account, true);
                break;
            default:
                $result = $model->getUserByUsername($account, true);
                break;
        }

        // 验证密码
        if ($result->code != 200 || !$model->authPassword($password, $result->data->password)) {
            return $context->response(status('invialidAccountOrUsername'));
        }


        $user = $result->data;

        // 生成 Token
        if (!($user->user_token = $model->generateUserToken($user, $app_id))) {
            return $context->response(status('generateUserTokenError'));
        };

        unset($user->password);

        return $context->response(status('success', $user));
    }


    public function register(Context $context)
    {
        $status = (new User())->setData($context->data())->addUser();

        return $context->response($status);
    }

    // 忘记密码
    public function forgot()
    {
    }

    // 重置密码
    public function reset()
    {
    }

    // 发送邮件
    public function sendRegisterMail()
    {
    }

    public function sendRegisterSMS()
    {
    }

    public function sendForgotPasswordMail()
    {
    }

    public function sendForgotPasswordSMS()
    {
    }
}
