<?php

/**
 * 应用控制器.
 */

namespace Core\Controllers;

use Core\Models\App;
use Core\Services\Context;

class AppController extends Controller
{

    /**
     * @apiGroup App
     *
     * @api {post} /api/app 添加应用
     *
     *
     * @apiParam {string} id  应用 ID
     * @apiParam {string} name  应用名称
     * @apiParam {string} [status]   应用状态
     * @apiParam {string} [description]   应用描述
     *
     *
     * @apiParamExample {json} 请求示例:
     * post /api/app
     * {
     * "id":"eevee_admin",
     * "name":"后台管理程序"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "eevee_admin",
     *      "name": "后台管理程序",
     *      "description": "",
     *      "status": "",
     *      "created_at": "0000-00-00 00:00:00",
     *      "updated_at": "0000-00-00 00:00:00"
     * }
     * }
     *
     */
    public function postApp(Context $context)
    {
        return $context->response((new App($context->data()))->addApp());
    }

    /**
     * @apiGroup App
     *
     * @api {put} /api/app?id 编辑应用
     *
     *
     * @apiParam {string} name  应用名称
     * @apiParam {string} [status]   应用状态
     * @apiParam {string} [description]   应用描述
     *
     *
     * @apiParamExample {json} 请求示例:
     * put /api/app?id=eevee_admin
     * {
     * "name":"Hello world"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "id": "eevee_admin",
     *      "name": "Hello world",
     *      "description": "",
     *      "status": "",
     *      "created_at": "0000-00-00 00:00:00",
     *      "updated_at": "0000-00-00 00:00:00"
     * }
     * }
     *
     */
    public function putApp(Context $context)
    {
        return $context->response((new App($context->data()))->updateApp($context->params('id')));
    }

    /**
     * @apiGroup App
     *
     * @api {get} /api/app?id 获取应用
     *
     * @apiParamExample {json} 请求示例:
     * get /api/app?app_id=eevee_admin
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *       "id": "eevee_admin",
     *       "name": "Hello world",
     *       "description": "",
     *       "status": "",
     *       "created_at": "0000-00-00 00:00:00",
     *       "updated_at": "0000-00-00 00:00:00"
     *       }
     * }
     *
     */
    public function getApp(Context $context)
    {
        return $context->response((new App())->getApp($context->params('id')));
    }

    /**
     * @apiGroup App
     *
     * @api {get} /api/apps 获取应用组
     *
     * @apiParamExample {json} 请求示例:
     * get /api/apps
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": [
     *      {
     *      "id": "app_id",
     *      "name": "默认",
     *      "description": "",
     *      "status": "",
     *      "created_at": "0000-00-00 00:00:00",
     *      "updated_at": "0000-00-00 00:00:00"
     *      },
     *      {
     *      "id": "eevee_admin",
     *      "name": "Hello world",
     *      "description": "",
     *      "status": "",
     *      "created_at": "0000-00-00 00:00:00",
     *      "updated_at": "0000-00-00 00:00:00"
     *      }
     *      ]
     * }
     *
     */
    public function getApps(Context $context)
    {
        return $context->response((new App())->getApps($context->params()));
    }

    /**
     * @apiGroup App
     *
     * @api {delete} /api/app?id 删除应用
     *
     * @apiParamExample {json} 请求示例:
     * delete /api/app?app_id=eevee_admin
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": null
     * }
     *
     */
    public function deleteApp(Context $context)
    {
        return $context->response((new App())->deleteApp($context->params('id')));
    }
}