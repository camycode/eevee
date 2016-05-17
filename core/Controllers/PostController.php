<?php

namespace Core\Controllers;

use Core\Models\Post;
use Core\Services\Context;

class PostController extends Controller
{
    public function postPost(Context $context)
    {
        return $context->response((new Post())->setData($context->data())->addPost());
    }

    public function getPost(Context $context)
    {
        return $context->response((new Post())->getPost($context->params('post_id')));
    }
}