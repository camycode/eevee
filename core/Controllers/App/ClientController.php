<?php 

namespace Core\Controllers\App;

use Core\Models\App\Client;
use Core\Services\Context;
use Core\Controllers\Controller;

class ClientController extends Controller
{

    // 获取Client
    public function getClient(Context $context)
    {
        return $context->response((new Client())->getClient($context->params('id')));
    }

    // 获取Client组
    public function getClients(Context $context)
    {
        return $context->response((new Client())->getClients($context->params()));
    }

    // 添加Client
    public function postClient(Context $context)
    {
        return $context->response((new Client($context->data()))->addClient());
    }

    // 更新Client
    public function putClient(Context $context)
    {
        return $context->response((new Client($context->data()))->updateClient($context->params('id')));
    }

    // 删除Client
    public function deleteClient(Context $context)
    {
        return $context->response((new Client())->deleteClient($context->params('id')));
    }

}

