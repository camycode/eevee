<?php

/**
 * 应用控制器.
 */

namespace Core\Controllers;

use Core\Models\Config;
use Core\Services\Context;

class ConfigController extends Controller
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
    public function postConfig(Context $context)
    {
        return $context->response((new Config())->addConfig($context->request->visitor, $context->data('config_key'), $context->data('config_value')));
    }

    public function saveConfig(Context $context)
    {
        return $context->response((new Config())->saveConfig($context->request->visitor, $context->data('config_key'), $context->data('config_value')));
    }

    /**
     * @apiGroup App
     *
     * @api {put} /api/app?app_id 编辑应用
     *
     *
     * @apiParam {string} name  应用名称
     * @apiParam {string} [status]   应用状态
     * @apiParam {string} [description]   应用描述
     *
     *
     * @apiParamExample {json} 请求示例:
     * put /api/app?app_id=eevee_admin
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
    public function putConfig(Context $context)
    {
        return $context->response((new Config())->updateConfig($context->request->visitor, $context->params('config_key'), $context->data()));
    }

    /**
     * @apiGroup App
     *
     * @api {get} /api/app?app_id 获取应用
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
    public function getConfig(Context $context)
    {
        return $context->response((new Config())->getConfig($context->request->visitor, $context->params('config_key')));
    }

    /**
     * @apiGroup App
     *
     * @api {delete} /api/app?app_id 删除应用
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
    public function deleteConfig(Context $context)
    {
        return $context->response((new Config())->deleteConfig($context->request->visitor, $context->params('config_key')));
    }

}