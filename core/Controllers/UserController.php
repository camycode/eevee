<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Status;
use Core\Services\Context;

class UserController extends Controller
{
    public function postUser(Context $context, Status $status)
    {
        $user = new User();
        $user->data($context->data())->add();
    }

    public function putUser()
    {
    }

    public function getUser(Context $context)
    {
        $model = new User();

        $result = $model->getUser($context->params('user_id'));

        return $context->response($result);
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
