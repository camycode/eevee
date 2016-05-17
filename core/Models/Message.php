<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Message extends Model
{

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 添加用户消息
     *
     * @return Status
     */
    public function addMessage()
    {
        $this->validateMessage();

        $this->initMessage();

        $this->filter($this->data, $this->fields('MESSAGE'));

        $this->resource('MESSAGE')->insert($this->data);

        return $this->getMessage($this->data['id']);

    }

    public function updateMessage($user_id, $key, $value)
    {

    }

    /**
     * 获取用户消息
     *
     * @param $message_id
     *
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getMessage($message_id)
    {
        if ($message = $this->resource('MESSAGE')->where('id', $message_id)->first()) {

            return status('success', $message);
        }

        exception('MessageDoesNotExist');
    }


    public function deleteMessage($user_id, $config_key)
    {

    }

    protected function validateMessage()
    {

    }

    protected function initMessage()
    {

    }


}