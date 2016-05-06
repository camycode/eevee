<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Post extends Model
{

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addPost($user_id, $key, $value)
    {
        
    }

    public function updatePost($user_id, $key, $value)
    {

    }

    public function getPost($user_id, $config_key)
    {

    }


    public function deletePost($user_id, $config_key)
    {

    }

    protected function validatePost()
    {

    }


}