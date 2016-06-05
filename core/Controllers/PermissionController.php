<?php 

namespace Core\Controllers;

use Core\Models\Permission;
use Core\Services\Context;
use Core\Controllers\Controller;

class PermissionController extends Controller
{

    // 获取Permission
    public function getPermission(Context $context)
    {
        return $context->response((new Permission())->getPermission($context->params('id')));
    }

    // 获取Permission组
    public function getPermissions(Context $context)
    {
        return $context->response((new Permission())->getPermissions($context->params()));
    }

    // 添加Permission
    public function postPermission(Context $context)
    {
        return $context->response((new Permission($context->data()))->addPermission());
    }

    // 更新Permission
    public function putPermission(Context $context)
    {
        return $context->response((new Permission($context->data()))->updatePermission($context->params('id')));
    }

    // 删除Permission
    public function deletePermission(Context $context)
    {
        return $context->response((new Permission())->deletePermission($context->params('id')));
    }

}

