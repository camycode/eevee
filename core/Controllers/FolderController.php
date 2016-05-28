<?php 

namespace Core\Controllers\Folder;

use Core\Models\Folder;
use Core\Services\Context;
use Core\Controllers\Controller;

class FolderController extends Controller
{

    // 获取Folder
    public function getFolder(Context $context)
    {
        return $context->response((new Folder())->getFolder($context->params('id')));
    }

    // 获取Folder组
    public function getFolders(Context $context)
    {
        return $context->response((new Folder())->getFolders($context-params()));
    }

    // 添加Folder
    public function postFolder(Context $context)
    {
        return $context->response((new Folder($context-data))->addFolder());
    }

    // 更新Folder
    public function putFolder(Context $context)
    {
        return $context->response((new Folder($context-data))->updateFolder($context->params('id')));
    }

    // 删除Folder
    public function deleteFolder(Context $context)
    {
        return $context->response((new Folder())->deleteFolder($context->params('id')));
    }

}

