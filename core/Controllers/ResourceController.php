<?php 

namespace Core\Controllers;

use Core\Models\Resource;
use Core\Services\Context;
use Core\Controllers\Controller;

class ResourceController extends Controller
{

    // 获取Resource
    public function getResource(Context $context)
    {
        return $context->response((new Resource())->getResource($context->params('id')));
    }

    // 获取Resource组
    public function getResources(Context $context)
    {
        return $context->response((new Resource())->getResources($context->params()));
    }

    // 添加Resource
    public function postResource(Context $context)
    {
        return $context->response((new Resource($context->data()))->addResource());
    }

    // 更新Resource
    public function putResource(Context $context)
    {
        return $context->response((new Resource($context->data()))->updateResource($context->params('id')));
    }

    // 删除Resource
    public function deleteResource(Context $context)
    {
        return $context->response((new Resource())->deleteResource($context->params('id')));
    }

}

