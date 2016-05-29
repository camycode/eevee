<?php 

namespace Core\Controllers\File;

use Core\Models\File;
use Core\Services\Context;
use Core\Controllers\Controller;

class FileController extends Controller
{

    // 获取File
    public function getFile(Context $context)
    {
        return $context->response((new File())->getFile($context->params('id')));
    }

    // 获取File组
    public function getFiles(Context $context)
    {
        return $context->response((new File())->getFiles($context-params()));
    }

    // 添加File
    public function postFile(Context $context)
    {
        return $context->response((new File($context-data))->addFile());
    }

    // 更新File
    public function putFile(Context $context)
    {
        return $context->response((new File($context-data))->updateFile($context->params('id')));
    }

    // 删除File
    public function deleteFile(Context $context)
    {
        return $context->response((new File())->deleteFile($context->params('id')));
    }

}

