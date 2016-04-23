<?php

namespace Core\Controllers;

use Core\Models\System;
use Core\Services\Context;
use Core\Services\Installer;
use Illuminate\Support\Facades\Config;


class SystemController extends Controller
{
    /**
     *  系统版本.
     */
    public function version(Context $context)
    {

        return response('EEVEE 1.0');
    }

    /**
     * 获取系统环境信息.
     *
     * @return string $info.host            域名
     * @return string $info.system          操作系统
     * @return string $info.php_version     php版本
     * @return string $info.server_software 服务器引擎
     */
    public function info()
    {
    }

    /**
     * 系统安装.
     */
    public function install(Context $context)
    {
        return $context->response(status('success', (new Installer($context->data()))->install()));
    }

    /**
     * @apiGroup System
     *
     * @api {post} /api/system/config 添加系统设置
     *
     *
     * @apiParam {string} config_key    设置键值
     * @apiParam {string} config_value  设置值
     * @apiParam {string} source        设置来源
     *
     *
     * @apiParamExample {json} 请求示例:
     * post /api/system/config
     * {
     * "config_key":"system_site_title",
     * "config_value":"我的网站",
     * "source":"EEVEE"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "config_key": "system_site_title",
     *      "config_value": "我的网站",
     *      "source": "EEVEE"
     *   }
     * }
     *
     */
    public function postConfig(Context $context)
    {
        $key = $context->data('config_key');

        $value = $context->data('config_value');

        $source = $context->data('source');

        return $context->response((new System())->addConfig($key, $value, $source));
    }

    /**
     * @apiGroup System
     *
     * @api {get} /api/system/config?config_key 获取系统设置
     *
     * @apiParamExample {json} 请求示例:
     * get /api/system/config?config_key=system_site_title
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "config_key": "system_site_title",
     *      "config_value": "网站",
     *      "source": "EEVEE"
     *    }
     * }
     *
     */
    public function getConfig(Context $context)
    {
        return $context->response((new System())->getConfig($context->params('config_key')));
    }

    /**
     * @apiGroup System
     *
     * @api {post} /api/system/config?config_key 编辑系统设置
     *
     *
     * @apiParam {string} config_value  设置值
     * @apiParam {string} source        设置来源
     *
     *
     * @apiParamExample {json} 请求示例:
     * put /api/system/config?config_key=system_site_title
     * {
     * "config_value":"网站"
     * }
     *
     * @apiSuccessExample {json} 操作成功:
     * {
     * "code": 200,
     * "message": "操作成功",
     * "data": {
     *      "config_key": "system_site_title",
     *      "config_value": "网站",
     *      "source": "EEVEE"
     *    }
     * }
     *
     */
    public function putConfig(Context $context)
    {
        $key = $context->params('config_key');

        $value = $context->data('config_value');

        return $context->response((new System())->updateConfig($key, $value));
    }

    /**
     * @apiGroup System
     *
     * @api {delete} /api/system/config?config_key 获取系统设置
     *
     * @apiParamExample {json} 请求示例:
     * delete /api/system/config?config_key=system_site_title
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
        $key = $context->params('config_key');

        $source = $context->params('source');

        return $context->response((new System())->deleteConfig($key, $source));
    }

}
