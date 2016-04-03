<?php

/**
 * 用户认证控制器,提供了用户登录,注册,忘记密码等接口.
 */

namespace Core\Controllers;

use Core\Models\Role;
use Core\Services\Context;

class RoleController extends Controller
{
    /**
     * @api {post} /api/role 添加角色
     * @apiPermission ROLE.POST
     * @apiGroup Role
     * @apiDescription 添加角色时以事务处理角色的权限列表.
     *
     *
     *
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "8dbdfe18863b070af999dd9ad6cb48a6",
     *      "name": "超级管理员",
     *      "description": "",
     *      "parent": "__null__",
     *      "source": "eevee",
     *      "status": "0",
     *      "created_at": "2016-04-03 13:57:33",
     *      "updated_at": "2016-04-03 13:57:33",
     *      "permissions": [
     *          "POST.DELETE",
     *          "POST.GET",
     *          "POST.POST",
     *          "POST.PUT"
     *          ]
     *      }
     * }
     */
    public function postRole(Context $context)
    {
        return $context->response((new Role())->setData($context->data())->addRole());
    }

    /**
     * @api {get} /api/roles 获取角色组
     * @apiPermission ROLE.GET
     * @apiGroup Role
     */
    public function getRoles(Context $context)
    {
        return $context->response((new Role())->getRoles($context->params()));
    }

    /**
     * @api {get} /api/role  获取角色
     * @apiGroup Role
     * @apiPermission ROLE.GET
     * @apiParam {String} role_id  角色ID.
     */
    public function getRole(Context $context)
    {
        return $context->response((new Role())->getRole($context->params('role_id')));
    }

    public function putRole(Context $context)
    {
        $status = (new Role())->setData($context->data())->updateRole($context->params('role_id'));

        return $context->response($status);
    }

    public function deleteRole(Context $context)
    {
        return $context->response((new Role())->deleteRole($context->params('role_id')));
    }
}
