<?php

/**
 * 权限验证中间件.
 *
 * 系统权限验证由当前中间件配合 Core\Models\Permission::guard() 函数执行.
 *
 * 当前中间件验证流程:
 *
 * 1. 获取 "X-App-ID" 请求头, 验证应用ID是否有效.
 * 2. 获取 "X-User-Token" 请求头, 验证用户秘钥是否有效, 并且获取访客信息, 设置相关常量.
 * 3. 获取访客的权限, 放入缓存.
 *
 * @author 古月(2016/03/11)
 */

namespace Core\Middleware;

use Closure;
use Core\Models\Model;


class Authenticate
{

    // 请求对象
    protected $request;

    // 应用ID
    protected $app_id;

    // 访客用户ID
    protected $visitor_id;

    // 访客角色ID
    protected $visitor_role_id;

    /**
     * 设置应用相关常量
     */
    protected function setAppConstants($app_id)
    {
        define('APP_ID', $app_id);
    }

    /**
     * 设置访客相关常量
     *
     * @param string $user_id 用户 ID
     * @param string $role_id 角色 ID
     */
    protected function setVisitorConstants($user_id, $role_id)
    {
        define('VISITOR_USER_ID', $user_id);
        define('VISITOR_ROLE_ID', $role_id);
    }

    /**
     * 设置权限验证动作常量
     *
     * @return void
     */
    protected function setActionConstants()
    {

    }

    /**
     * 用户认证入口,验证请求接口的X-APP-ID.
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function authAppID()
    {

        if (!SYSTEM_IS_INSTALLED) return;

        $this->app_id = $this->request->header('X-App-ID');

        if (!$this->app_id || !(new Model())->table('app')->where('id', $this->app_id)->first()) {

            exception('appIdDoesNotExist');
        }

    }

    /**
     * 验证用户秘钥,获取访客的权限组.
     *
     * @param  $app_id string
     *
     */
    protected function authUserToken($app_id)
    {
        if (!SYSTEM_IS_INSTALLED) return;

        $user_token = $this->request->header('X-User-Token');

        $model = new Model();

        $record = $model->table('user_token')->where('app_id', $app_id)->where('user_token', $user_token)->first();

        if (!$user_token || !$record) {

            $this->visitor_id = null;

            $this->visitor_role_id = 'guest';

        }

        $visitor = $model->table('user')->where('id', $record->user_id);

        if (!$visitor) {

            exception('visitorNotExist');
        }

        $this->request->visitor_id = $this->visitor_id;

        $this->request->visitor_role_id = $this->visitor_role_id;

    }


    /**
     * 权限验证中间件.
     *
     * 如果权限验证成功，则返回接着调用下一中间
     * 如果失败，则会抛出 403 错误。
     */
    public function handle($request, Closure $next)
    {


        $this->request = $request;

        $this->request->visitor = 'root';

        $this->setActionConstants();

        $this->authAppID();

        $this->setAppConstants($this->app_id);

//        $this->authUserToken($this->app_id);

        return $next($this->request);

    }


}
