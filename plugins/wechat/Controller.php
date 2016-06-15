<?php

namespace Plugin\Wechat;

use Core\Services\Context;
use Core\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    public function welcome(Context $context)
    {
        return $context->response(status('success','hello, eevee\'s plguin'));
    }

}

