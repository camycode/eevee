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

        $model = new Role();

        return $context->response($model->setData($context->data())->addRole());

    }

    public function getRoles(Context $context)
    {
        $model = new Role();

        return $context->response($model->getRoles($context->params()));
    }

    public function getRole(Context $context)
    {
        $model = new Role();

        return $context->response($model->getRole($context->params('role_id')));
    }

}
