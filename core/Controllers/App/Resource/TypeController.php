<?php 

namespace Core\Controllers\App\Resource;

use Core\Models\App\Resource\Type;
use Core\Services\Context;
use Core\Controllers\Controller;

class TypeController extends Controller
{

    // 获取Type
    public function getType(Context $context)
    {
        return $context->response((new Type())->getType($context->params('id')));
    }

    // 获取Type组
    public function getTypes(Context $context)
    {
        return $context->response((new Type())->getTypes($context->params()));
    }

    // 添加Type
    public function postType(Context $context)
    {
        return $context->response((new Type($context->data()))->addType());
    }

    // 更新Type
    public function putType(Context $context)
    {
        return $context->response((new Type($context->data()))->updateType($context->params('id')));
    }

    // 删除Type
    public function deleteType(Context $context)
    {
        return $context->response((new Type())->deleteType($context->params('id')));
    }

}

