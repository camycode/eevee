<?php

namespace Core\Controllers\App\Client;

use Core\Models\App\Client\Version;
use Core\Services\Context;
use Core\Controllers\Controller;

class VersionController extends Controller
{

    // 获取Version
    public function getVersion(Context $context)
    {
        return $context->response((new Version())->getVersion($context->params('version'), $context->params('app_id'), $context->params('client_id')));
    }

    // 获取Version组
    public function getVersions(Context $context)
    {
        return $context->response((new Version())->getVersions($context->params()));
    }

    // 添加Version
    public function postVersion(Context $context)
    {
        return $context->response((new Version($context->data()))->addVersion());
    }

    // 更新Version
    public function putVersion(Context $context)
    {
        return $context->response((new Version($context->data()))->updateVersion($context->params('version'), $context->params('app_id'), $context->params('client_id')));
    }

    // 删除Version
    public function deleteVersion(Context $context)
    {
        return $context->response((new Version())->deleteVersion($context->params('version'), $context->params('app_id'), $context->params('client_id')));
    }

}

