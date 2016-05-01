<?php

/**
 * 权限验证中间件.
 *
 * @author 古月(2016/03/11)
 */

namespace Core\Middleware;

use Closure;
use Core\Models\Model;


class Authenticate
{

    protected $user_id;

    protected $permissions;

    protected $request;

    /**
     * 权限验证中间件.
     *
     * 如果权限验证成功，则返回接着调用下一中间
     * 如果失败，则会抛出 403 错误。
     */
    public function handle($request, Closure $next)
    {
        $this->request = $request;
        
        $this->auth();

        return $next($this->request);

    }

    /**
     * 用户认证入口,验证请求接口的X-APP-ID.
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function auth()
    {
        $app_id = $this->request->header('X-APP-ID');

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
        $user_token = $this->request->header('X-USER-TOKEN');

        $record = (new Model())->resource('USERTOKEN')->where('app_id', $app_id)->where('user_token', $user_token)->first();

        if ($user_token && $record) {

            $this->user_id = $record->user_id;

        } else {
            $this->user_id = null;
        }

        $this->request->vistor = $this->user_id;

        $this->permissions = $this->getUserPermissions($this->user_id);

        $this->authPermissions();
    }

    /**
     * 获取用户的权限组
     */
    protected function getUserPermissions($user_id)
    {
        $permissions = [];

        if ($user_id) {

            $roles = (new Model())->resource('L:ROLERELATIONSHIP')->where('user_id', $user_id)->lists('role_id');

            foreach ($roles as $role) {

                $permissions = array_merge($permissions, (new Model())->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role)->lists('permission_id'));

            }

        } else {

            $permissions = array_merge($permissions, $this->getGuestPermissions());

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
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function getRequestPermission()
    {
        $route = strtolower($this->request->method()) . '@' . ltrim($this->request->getPathInfo(), '/api/');

        $routes = config('routes');

        if (isset($routes[$route])) {

            return isset($routes[$route]['permission']) ? $routes[$route]['permission'] : false;
        } else {

            exception('routeDefinedIsInvilad');
        }
    }


}
