<?php 

namespace Core\Controllers;

use Core\Models\Organization;
use Core\Services\Context;
use Core\Controllers\Controller;

class OrganizationController extends Controller
{

    // 获取Organization
    public function getOrganization(Context $context)
    {
        return $context->response((new Organization())->getOrganization($context->params('id')));
    }

    // 获取Organization组
    public function getOrganizations(Context $context)
    {
        return $context->response((new Organization())->getOrganizations($context->params()));
    }

    // 添加Organization
    public function postOrganization(Context $context)
    {
        return $context->response((new Organization($context->data()))->addOrganization());
    }

    // 更新Organization
    public function putOrganization(Context $context)
    {
        return $context->response((new Organization($context->data()))->updateOrganization($context->params('id')));
    }

    // 删除Organization
    public function deleteOrganization(Context $context)
    {
        return $context->response((new Organization())->deleteOrganization($context->params('id')));
    }

}

