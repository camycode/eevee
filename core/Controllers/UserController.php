<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Context;

class UserController extends Controller
{
    /**
     * @api {post} /api/user 添加用户
     *
     * @apiPermission USER_POST
     *
     * @apiGroup USER
     *
     * @apiDescription 添加用户.
     *
     * @apiParam {String}       username        用户名
     * @apiParam {String}       email           邮箱
     * @apiParam {String}       password        密码
     * @apiParam {String/Array} role            用户角色或角色组
     * @apiParam {String}       [avatar]        头像
     * @apiParam {String}       [status]        用户状态
     * @apiParam {String}       [source]        用户来源
     *
     * @apiParamExample {json} 示例:
     * POST /api/user
     *{
     * "username" : "gue2",
     * "password" : "password",
     * "email":"gue2@lehu.io",
     * "role" : "6e29355099495e63847a8424e9f5ab6a"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     * "id": "d3d5ab4a8fcc945c118a7161f97fb745",
     * "username": "gue2",
     * "email": "gue2@lehu.io",
     * "avatar": "/web/images/avatar.png",
     * "source": "eevee",
     * "status": "0",
     * "created_at": "2016-04-15 23:41:35",
     * "updated_at": "2016-04-15 23:41:35",
     * "role": [
     *      {
     *      "id": "6e29355099495e63847a8424e9f5ab6a",
     *      "name": "messages.root",
     *      "description": "",
     *      "parent": "6e29355099495e63847a8424e9f5ab6a",
     *      "source": "EEVEE",
     *      "status": "1",
     *      "created_at": "2016-04-14 14:14:09",
     *      "updated_at": "2016-04-14 14:14:09",
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
     *    ]
     *   }
     * }
     *
     */
    public function postUser(Context $context)
    {
        return $context->response((new User())->setData($context->data())->addUser());
    }

    /**
     * @api {put} /api/user?user_id 编辑用户
     *
     * @apiPermission USER_PUT
     *
     * @apiGroup USER
     *
     * @apiDescription 添加用户.
     *
     * @apiParam {String}       username        用户名
     * @apiParam {String}       email           邮箱
     * @apiParam {String/Array} role            用户角色或角色组
     * @apiParam {String}       [avatar]        头像
     * @apiParam {String}       [status]        用户状态
     *
     * @apiParamExample {json} 示例:
     * PUT /api/user
     * {
     * "username" : "gue3",
     * "email":"gue2@lehu.io",
     * "role" : "6e29355099495e63847a8424e9f5ab6a"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     * "id": "d3d5ab4a8fcc945c118a7161f97fb745",
     * "username": "gue2",
     * "email": "gue2@lehu.io",
     * "avatar": "/web/images/avatar.png",
     * "source": "eevee",
     * "status": "0",
     * "created_at": "2016-04-15 23:41:35",
     * "updated_at": "2016-04-15 23:52:53",
     * "role": [
     *      {
     *      "id": "6e29355099495e63847a8424e9f5ab6a",
     *      "name": "messages.root",
     *      "description": "",
     *      "parent": "6e29355099495e63847a8424e9f5ab6a",
     *      "source": "EEVEE",
     *      "status": "1",
     *      "created_at": "2016-04-14 14:14:09",
     *      "updated_at": "2016-04-14 14:14:09",
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
     *    ]
     *   }
     * }
     *
     */
    public function putUser(Context $context)
    {
        return $context->response((new User())->setData($context->data())->updateUser($context->params('user_id')));
    }

    /**
     * @api {get} /api/user?user_id 获取用户
     *
     * @apiPermission USER_GET
     *
     * @apiGroup USER
     *
     * @apiDescription 添加用户.
     *
     * @apiParamExample {json} 示例:
     * GET /api/user?user_id=3830e554c34b936b9772de4ee28161a2
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     * "id": "3830e554c34b936b9772de4ee28161a2",
     * "username": "root",
     * "email": "root@eevee.io",
     * "avatar": "/web/images/avatar.png",
     * "source": "EEVEE",
     * "status": "1",
     * "created_at": "2016-04-14 14:14:10",
     * "updated_at": "2016-04-14 14:14:10",
     * "role": [
     *          {
     *          "id": "6e29355099495e63847a8424e9f5ab6a",
     *          "name": "messages.root",
     *          "description": "",
     *          "parent": "6e29355099495e63847a8424e9f5ab6a",
     *          "source": "EEVEE",
     *          "status": "1",
     *          "created_at": "2016-04-14 14:14:09",
     *          "updated_at": "2016-04-14 14:14:09",
     *          "permissions": [
     *              "ROLE_DELETE",
     *              "ROLE_GET",
     *              "ROLE_POST",
     *              "ROLE_PUT",
     *              "USER_DELETE",
     *              "USER_GET",
     *              "USER_POST",
     *              "USER_PUT"
     *              ]
     *          }
     *       ]
     *    }
     * }
     *
     */
    public function getUser(Context $context)
    {

        return $context->response((new User())->getUser($context->params('user_id')));
    }

    /**
     * @api {get} /api/users 获取用户组
     *
     * @apiPermission USER_GET
     *
     * @apiGroup USER
     *
     * @apiDescription 添加用户.
     *
     * @apiParamExample {json} 示例:
     * GET /api/users
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": [
     *     {
     *     "id": "3830e554c34b936b9772de4ee28161a2",
     *     "username": "root",
     *     "email": "root@eevee.io",
     *     "avatar": "/web/images/avatar.png",
     *     "source": "EEVEE",
     *     "status": "1",
     *     "created_at": "2016-04-14 14:14:10",
     *     "updated_at": "2016-04-14 14:14:10"
     *     },
     *     {
     *     "id": "77fe63aa9ef5ab2ed0e7eb740deb58b0",
     *     "username": "gue",
     *     "email": "gue@lehu.io",
     *     "avatar": "/web/images/avatar.png",
     *     "source": "eevee",
     *     "status": "0",
     *     "created_at": "2016-04-15 23:41:20",
     *     "updated_at": "2016-04-15 23:41:20"
     *     },
     *     {
     *     "id": "d3d5ab4a8fcc945c118a7161f97fb745",
     *     "username": "gue2",
     *     "email": "gue2@lehu.io",
     *     "avatar": "/web/images/avatar.png",
     *     "source": "eevee",
     *     "status": "0",
     *     "created_at": "2016-04-15 23:41:35",
     *     "updated_at": "2016-04-15 23:52:53"
     *     }
     *   ]
     * }
     *
     */
    public function getUsers(Context $context)
    {
        $model = new User();

        return $context->response($model->getUsers($context->params()));
    }

    /**
     * @api {delete} /api/user?user_id 删除用户
     *
     * @apiPermission USER_DELETE
     *
     * @apiGroup USER
     *
     * @apiDescription 删除用户.
     *
     * @apiParamExample {json} 示例:
     * DELETE /api/user?user_id=77fe63aa9ef5ab2ed0e7eb740deb58b0
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": null
     * }
     *
     */
    public function deleteUser(Context $context)
    {
        return $context->response((new User())->deleteUser($context->params('user_id')));
    }

}
