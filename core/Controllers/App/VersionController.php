<?php 

namespace Core\Controllers\App;

use Core\Models\App\Version;
use Core\Services\Context;
use Core\Controllers\Controller;

class VersionController extends Controller
{

    // 获取Version
    public function getVersion(Context $context)
    {
        return $context->response((new Version())->getVersion($context->params('id')));
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
        return $context->response((new Version($context->data()))->updateVersion($context->params('id')));
    }

    // 删除Version
    public function deleteVersion(Context $context)
    {
        return $context->response((new Version())->deleteVersion($context->params('id')));
    }

}

