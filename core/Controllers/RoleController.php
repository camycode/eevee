<?php

/**
 * 用户认证控制器,提供了用户登录,注册,忘记密码等接口.
 */

namespace Core\Controllers;

use Core\Models\Role;
use Core\Services\Context;

class RoleController extends Controller
{

    public function postRole(Context $context)
    {
        return $context->response((new Role())->setData($context->data())->addRole());
    }

    public function getRoles(Context $context)
    {
        return $context->response((new Role())->getRoles($context->params()));
    }

    public function getRole(Context $context)
    {
        return $context->response((new Role())->getRole($context->params('role_id')));
    }

    public function putRole(Context $context)
    {
        $status = (new Role())->setData($context->data())->updateRole($context->params('role_id'));

        return $context->response($status);
    }
}
