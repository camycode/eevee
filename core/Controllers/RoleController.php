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
     *
     * @apiPermission ROLE.POST
     *
     * @apiGroup Role
     *
     * @apiDescription 添加系统角色.
     *
     * @apiParam {String} name          角色名
     * @apiParam {String} parent        角色父类
     * @apiParam {Array}  [permissions] 角色拥有权限
     * @apiParam {String} [description] 角色描述
     * @apiParam {String} [status]      角色状态
     * @apiParam {String} [source]      角色来源
     *
     * @apiParamExample {json} 示例:
     * POST /api/role
     * {
     * "name":"会员",
     * "parent":"bf1f81737cb8dd7ab55bcc6ddba70139",
     * "permissions":["POST_DELETE","POST_GET","POST_POST","POST_PUT"]
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "8dbdfe18863b070af999dd9ad6cb48a6",
     *      "name": "会员",
     *      "description": "",
     *      "parent": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *      "source": "eevee",
     *      "status": "0",
     *      "created_at": "2016-04-03 13:57:33",
     *      "updated_at": "2016-04-03 13:57:33",
     *      "permissions": [
     *          "POST_DELETE",
     *          "POST_GET",
     *          "POST_POST",
     *          "POST_PUT"
     *          ]
     *      }
     * }
     *
     */
    public function postRole(Context $context)
    {
        return $context->response((new Role($context->data()))->addRole());
    }

    /**
     * @api {get} /api/roles 获取角色组
     *
     * @apiPermission ROLE.GET
     *
     * @apiGroup Role
     *
     * @apiParam {Int} limit    查询数量限制
     * @apiParam {Int} offset   查询偏移
     * @apiParam {String} order 排序
     * @apiParam {String} Count 计数
     *
     *
     * @apiParamExample {json} 示例:
     * GET /api/roles?limit=2
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": [
     *      {
     *          "id": "06d17f9c9627fc3fd6d6b3f555461961",
     *          "name": "运维管理员",
     *          "description": "",
     *          "parent": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *          "source": "EEVEE",
     *          "status": "0",
     *          "created_at": "2016-04-08 13:00:41",
     *          "updated_at": "2016-04-08 13:00:41"
     *      },
     *      {
     *          "id": "1496fec5917ba6765f7b61f6858eba25",
     *          "name": "一般管理员",
     *          "description": "",
     *          "parent": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *          "source": "EEVEE",
     *          "status": "0",
     *          "created_at": "2016-04-05 10:15:06",
     *          "updated_at": "2016-04-05 10:22:24"
     *      }
     *   ]
     * }
     *
     */
    public function getRoles(Context $context)
    {
        return $context->response((new Role())->getRoles($context->params()));
    }

    /**
     * @api {get} /api/role?id  获取角色
     *
     * @apiGroup Role
     *
     * @apiPermission ROLE.GET
     *
     * @apiParam {String} id  角色ID.
     *
     * @apiParamExample {json} 示例:
     * GET /api/role?id=bf1f81737cb8dd7ab55bcc6ddba70139
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *      "name": "messages.root",
     *      "description": "",
     *      "parent": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *      "source": "EEVEE",
     *      "status": "1",
     *      "created_at": "2016-04-05 10:08:17",
     *      "updated_at": "2016-04-05 10:08:17",
     *      "permissions": [
     *          "ROLE_DELETE",
     *          "ROLE_GET",
     *          "ROLE_POST",
     *          "ROLE_PUT",
     *          "USER_DELETE",
     *          "USER_GET",
     *          "USER_POST",
     *          "USER_PUT"
     *          ]
     *      }
     * }
     */
    public function getRole(Context $context)
    {
        return $context->response((new Role())->getRole($context->params('id')));
    }

    /**
     * @api {PUT} /api/role?id 更新角色
     *
     * @apiPermission ROLE.PUT
     *
     * @apiGroup Role
     *
     * @apiDescription 更新系统角色.
     *
     * @apiParam {String} name          角色名
     * @apiParam {String} parent        角色父类
     * @apiParam {Array}  [permissions] 角色拥有权限
     * @apiParam {String} [description] 角色描述
     * @apiParam {String} [status]      角色状态
     * @apiParam {String} [source]      角色来源
     *
     * @apiParamExample {json} 示例:
     * PUT /api/role?id=8dbdfe18863b070af999dd9ad6cb48a6
     * {
     * "name":"超级会员",
     * "parent":"bf1f81737cb8dd7ab55bcc6ddba70139",
     * "permissions":["POST_DELETE","POST_GET","POST_POST"]
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "8dbdfe18863b070af999dd9ad6cb48a6",
     *      "name": "超级会员",
     *      "description": "",
     *      "parent": "bf1f81737cb8dd7ab55bcc6ddba70139",
     *      "source": "eevee",
     *      "status": "0",
     *      "created_at": "2016-04-03 13:57:33",
     *      "updated_at": "2016-04-03 14:10:33",
     *      "permissions": [
     *          "POST_DELETE",
     *          "POST_GET",
     *          "POST_POST"
     *          ]
     *      }
     * }
     */
    public function putRole(Context $context)
    {
        $status = (new Role($context->data()))->updateRole($context->params('id'));

        return $context->response($status);
    }

    /**
     * @api {GET} /api/role/permissions?id  获取角色权限组
     *
     * @apiGroup Role
     *
     * @apiPermission ROLE.GET
     *
     * @apiParam {String} id  角色ID.
     * @apiParam {Bool} archive    是否归档
     *
     * @apiParamExample {json} 示例:
     *
     * GET /role/permissions?id=bf1f81737cb8dd7ab55bcc6ddba70139&archive=true
     *
     */
    public function getPermissions(Context $context)
    {
        return $context->response((new Role())->getRolePermissions($context->params('id'), $context->params('archive')));
    }

    /**
     * @api {DELETE} /api/role?id  删除角色
     *
     * @apiGroup Role
     *
     * @apiPermission ROLE.DELETE
     *
     * @apiParam {String} id  角色ID.
     *
     * @apiParamExample {json} 示例:
     * DELETE /api/role?id=bf1f81737cb8dd7ab55bcc6ddba70139
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": null
     * }
     */
    public function deleteRole(Context $context)
    {
        return $context->response((new Role())->deleteRole($context->params('id')));
    }


}
