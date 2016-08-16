<?php

namespace Core\Controllers;

use Core\Services\Context;

class BackendController extends Controller
{

    public function getPlugin(Context $context)
    {

        return response(view('backend.layout'));

    }

    public function getLogin(Context $context)
    {

        return response(view('backend.login'));

    }

}