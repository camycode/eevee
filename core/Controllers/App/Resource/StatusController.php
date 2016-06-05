<?php 

namespace Core\Controllers\App\Resource;

use Core\Models\App\Resource\Status;
use Core\Services\Context;
use Core\Controllers\Controller;

class StatusController extends Controller
{

    // 获取Status
    public function getStatus(Context $context)
    {
        return $context->response((new Status())->getStatus($context->params('id')));
    }

    // 获取Status组
    public function getStatuses(Context $context)
    {
        return $context->response((new Status())->getStatuses($context->params()));
    }

    // 添加Status
    public function postStatus(Context $context)
    {
        return $context->response((new Status($context->data()))->addStatus());
    }

    // 更新Status
    public function putStatus(Context $context)
    {
        return $context->response((new Status($context->data()))->updateStatus($context->params('id')));
    }

    // 删除Status
    public function deleteStatus(Context $context)
    {
        return $context->response((new Status())->deleteStatus($context->params('id')));
    }

}

