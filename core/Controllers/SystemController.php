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

    public function postConfig(Context $context)
    {
        $key = $context->data('config_key');

        $value = $context->data('config_value');

        $source = $context->data('source');

        return $context->response((new System())->addConfig($key, $value, $source));
    }

    public function getConfig(Context $context)
    {
        return $context->response((new System())->getConfig($context->params('config_key')));
    }

    public function putConfig(Context $context)
    {
        $key = $context->params('config_key');

        $value = $context->data('config_value');

        return $context->response((new System())->updateConfig($key, $value));
    }

    public function deleteConfig(Context $context)
    {
        $key = $context->params('config_key');

        $source = $context->params('source');

        return $context->response((new System())->deleteConfig($key, $source));
    }

}
