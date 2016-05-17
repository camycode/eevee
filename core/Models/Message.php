<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Message extends Model
{

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addMessage($user_id, $key, $value)
    {

    }

    public function updateMessage($user_id, $key, $value)
    {

    }

    public function getMessage($user_id, $config_key)
    {

    }


    public function deleteMessage($user_id, $config_key)
    {

    }

    protected function validateMessage()
    {

    }


}