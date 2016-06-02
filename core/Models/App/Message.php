<?php

namespace Core\Models\App;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Message extends Model
{

    protected $fields = ['id', 'app_id', 'message', 'status', 'created_at', 'updated_at'];

    // 初始化Message记录
    protected function initializeMessage()
    {

        $initialized = [
            'id' => $this->id(),
            'app_id' => APP_ID,
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Message数据校验
    protected function validateMessage(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($this->data, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取Message
    public function getMessage($id)
    {

        if ($data = $this->table()->where('id', $id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('messageDoesNotExist');
    }

    // 获取Message组
    public function getMessages(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加Message记录
    public function addMessage()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateMessage();

        $this->initializeMessage();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getMessage($this->data['id']);

            return $status;

        });

    }

    // 更新Message记录
    public function updateMessage($id)
    {
        $origin = $this->getMessage($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateMessage($ignore);

        return $this->transaction(function () use ($id) {

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getMessage($this->data['id']);

            return $status;

        });

    }

    // 删除Message记录
    public function deleteMessage($id)
    {

        $origin = $this->getMessage($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

