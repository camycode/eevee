<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Context;

class UserController extends Controller
{
    public function postUser(Context $context)
    {
        return $context->response((new User())->setData($context->data())->addUser());
    }

    public function putUser(Context $context)
    {
        return $context->response((new User())->setData($context->data())->updateUser($context->params('user_id')));
    }

    public function getUser(Context $context)
    {

        return $context->response((new User())->getUser($context->params('user_id')));
    }

    public function getUsers(Context $context)
    {
        $model = new User();

        return $context->response($model->getUsers($context->params()));
    }


    public function delete()
    {
    }
}
