<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Models\Role;
use Core\Models\System;
use Core\Models\Installer;
use Core\Services\Context;


class SystemController extends Controller
{
    /**
     *  系统版本.
     */
    public function version(Context $context)
    {
        User::setData(['username' => 'Helloshic']);

        return response('EEVEE 1.0.0');
    }

    /**
     * 系统安装.
     */
    public function install(Context $context)
    {
        return $context->response(status('success', (new Installer($context->data()))->install()));
    }

    /**
     * @api {get} /api/system/user/menu 获取用户管理菜单
     *
     * @apiGroup USER
     *
     */
    public function getUserMenu(Context $context)
    {


        $user = (new User())->getUser($context->request->visitor)->data;

        $permissions = (new Role())->getRolePermissions($user->role)->data;

        $menus = config('menus', []);

        foreach ($menus as $num => $menu) {

            if (isset($menu['permission']) && $menu['permission']) {

                if (is_array($menu['permission'])) {

                    if (array_diff($menu['permission'], $permissions)) {
                        unset($menus[$num]);
                    }
                } else {

                    if (!in_array($menu['permission'], $permissions)) {
                        unset($menus[$num]);
                    }
                }

            }

        }

        return $context->response(status('success', $menus));

    }

    /**
     * 刷新系统
     */
    public function refresh(Context $context)
    {
        return $context->response((new System())->refreshResourcesAndPermissions());
    }

}
