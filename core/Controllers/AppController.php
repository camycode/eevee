<?php

/**
 * 应用控制器.
 */

namespace Core\Controllers;

use Core\Models\App;
use Core\Services\Context;

class AppController extends Controller
{

    public function postApp(Context $context)
    {
        return $context->response((new App())->setData($context->data())->addApp());
    }

    public function putApp(Context $context)
    {
        return $context->response((new App())->setData($context->data())->updateApp($context->params('app_id')));
    }

    public function getApp(Context $context)
    {
        return $context->response((new App())->getApp($context->params('app_id')));
    }

    public function getApps(Context $context)
    {
        return $context->response((new App())->getApps($context->params()));
    }

    public function deleteApp(Context $context)
    {
        return $context->response((new App())->deleteApp($context->params('app_id')));
    }
}