{!! $StartTag !!}

namespace Core\Controllers{{  $ControllerNamespacePath }};

use Core\Models{{ $ControllerPath }};
use Core\Services\Context;
use Core\Controllers\Controller;

class {{  $ControllerName }}Controller extends Controller
{

    // 获取{{ $ControllerName  }}
    public function get{{ $ControllerName  }}(Context $context)
    {
        return $context->response((new {{ $ControllerName  }}())->get{{ $ControllerName  }}($context->params('id')));
    }

    // 获取{{ $ControllerName  }}组
    public function get{{ $ControllerName  }}s(Context $context)
    {
        return $context->response((new {{ $ControllerName  }}())->get{{ $ControllerName  }}s($context->params()));
    }

    // 添加{{ $ControllerName  }}
    public function post{{ $ControllerName  }}(Context $context)
    {
        return $context->response((new {{ $ControllerName  }}($context->data())->add{{ $ControllerName  }}());
    }

    // 更新{{ $ControllerName  }}
    public function put{{ $ControllerName  }}(Context $context)
    {
        return $context->response((new {{ $ControllerName  }}($context->data())->update{{ $ControllerName  }}($context->params('id')));
    }

    // 删除{{ $ControllerName  }}
    public function delete{{ $ControllerName  }}(Context $context)
    {
        return $context->response((new {{ $ControllerName  }}())->delete{{ $ControllerName  }}($context->params('id')));
    }

}

