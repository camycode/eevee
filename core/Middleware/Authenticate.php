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

    // 访客的用户ID
    protected $visitor_id;

    // 记录访客的权限数组
    protected $visitor_permissions;

    // 访客Token
    protected $visitor_user_token;

    // 请求API路径
    protected $request_uri;

    // 请求方法
    protected $request_method;

    // API 接口要求权限数组
    protected $request_permissions;


    /**
     * 用户认证入口,验证请求接口的X-APP-ID.
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function auth()
    {
        if ($this->request->getPathInfo() == '/api/system/install') {
            return true;
        }

        $app_id = $this->request->header('X-App-ID');

        if (!$app_id || !(new Model())->resource('APP')->where('id', $app_id)->first()) {

            exception('AppIdDoesNotExist');
        }

        $this->authUserToken($app_id);
    }

    /**
     * 验证用户秘钥,获取访客的权限组.
     *
     * @param  $app_id string
     *
     */
    protected function authUserToken($app_id)
    {
        $user_token = $this->request->header('X-User-Token');

        $record = (new Model())->resource('USERTOKEN')->where('app_id', $app_id)->where('user_token', $user_token)->first();

        if ($user_token && $record) {

            $this->user_id = $record->user_id;

        } else {
            $this->user_id = null;
        }

        $this->request->visitor = $this->user_id;

        $this->permissions = $this->getUserPermissions($this->user_id);

        $this->authPermissions();
    }

    /**
     * 获取用户的权限组
     */
    protected function getUserPermissions($user_id)
    {

        if ($user_id) {

            $role_id = (new Model())->resource('USER')->where('id', $user_id)->value('role');

            $permissions = (new Model())->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role_id)->lists('permission_id');

        } else {

            $permissions = $this->getGuestPermissions();

        }

        return $permissions;
    }

    /**
     * 获取宾客的权限
     */
    protected function getGuestPermissions()
    {
        return (new Model())->resource('PERMISSIONRELATIONSHIP')->where('role_id', 'guest')->lists('permission_id');
    }


    /**
     * 验证接口访问权限组
     */
    protected function authPermissions()
    {
        $permission = $this->getRequestPermission();

        if (is_string($permission)) {

            if (in_array($permission, $this->permissions)) {

                return true;
            }

        } else if (is_array($permission)) {

            if (!array_diff($permission, $this->permissions)) {

                return true;
            }

        } else {

            return true;
        }

        exception('permissionDenied');

    }

    /**
     * 获取访问接口权限
     *
     * @return array
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function getRequestPermission()
    {

        $route = strtolower($this->request->method()) . '@' . str_replace('/api/', '', $this->request->getPathInfo());

        $routes = config('routes');

        if (isset($routes[$route])) {

            return isset($routes[$route]['permission']) ? $routes[$route]['permission'] : false;
        } else {

            exception('routeDefinedIsInvilad');
        }
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
        define('GUARD_ADD', 1);
        define('GUARD_DELETE', 2);
        define('GUARD_GET', 3);
        define('GUARD_UPDATE', 4);
        define('GUARD_SAVE', 5);
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

//        $this->auth();

        return $next($this->request);

    }


}
