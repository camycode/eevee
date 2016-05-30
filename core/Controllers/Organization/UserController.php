<?php 

namespace Core\Controllers\Organization;

use Core\Models\Organization\User;
use Core\Services\Context;
use Core\Controllers\Controller;

class UserController extends Controller
{

    // 获取User
    public function getUser(Context $context)
    {
        return $context->response((new User())->getUser($context->params('id')));
    }

    // 获取User组
    public function getUsers(Context $context)
    {
        return $context->response((new User())->getUsers($context->params()));
    }

    // 添加User
    public function postUser(Context $context)
    {
        return $context->response((new User($context->data()))->addUser());
    }

    // 更新User
    public function putUser(Context $context)
    {
        return $context->response((new User($context->data()))->updateUser($context->params('id')));
    }

    // 删除User
    public function deleteUser(Context $context)
    {
        return $context->response((new User())->deleteUser($context->params('id')));
    }

}

