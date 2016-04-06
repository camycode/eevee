<?php

namespace Core\Controllers;

use Core\Services\Context;
use Core\Services\Installer;


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
}
