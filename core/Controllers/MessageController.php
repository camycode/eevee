<?php

namespace Core\Controllers;

use Core\Models\Message;
use Core\Services\Context;

class MessageController extends Controller
{
    public function postMessage(Context $context)
    {
        return $context->response((new Message())->setData($context->data())->addMessage());
    }

    public function getMessage(Context $context)
    {
        return $context->response((new Message())->getMessage($context->params('message_id')));
    }
}