<?php

namespace Core\Controllers;

use Core\Services\Context;

class UserController extends Controller
{
    public function getUser(Context $context)
    {
        return 'Hello user controller';
    }

    public function postUser(Context $context)
    {

        $data = $context->data();


        return $context->status($data);
    }
}