<?php

namespace Core\Models\App;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Client extends Model
{

    protected $fields = ['id', 'app_id', 'name', 'description', 'status', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializeClient()
    {

        $initialized = [
            'id' => $this->id(),
            'app_id' => APP_ID,
            'name' => '',
            'description' => text('noDescription'),
            'status' => STATUS_PUBLIC,
            'created' => $this->timestamp(),
            'updated' => $this->timestamp(),
        ];

        $this->data = array_merge($initialized, $this->data);
    }

    /**
     * 数据校验
     *
     * @param  array $ignore
     *
     * @return  void
     *
     * @throws  \Core\Exceptions\StatusException
     *
     */
    protected function validateClient(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 获取记录
     *
     * @param $id
     * @param $app_id
     *
     * @return Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getClient($id, $app_id)
    {
        if ($data = $this->table()->where('id', $id)->where('app_id', $app_id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('clientDoesNotExist');
    }

    /**
     * 获取记录组
     *
     * @param  array $params
     *
     * @return  Status
     *
     * TODO 限定 APP ID
     */
    public function getClients(array $params = [])
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    /**
     * 添加记录
     *
     * @return  Status
     *
     */
    public function addClient()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateClient();

        $this->initializeClient();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getClient($this->data['id'], $this->data['app_id']);

            return $status;

        });

    }

    /**
     * 更新记录
     *
     * 默认过滤 id 和 app_id 字段, 如果 name 与原数据相等即忽略验证.
     *
     * @param  string $id
     * @param $app_id
     *
     * @return Status
     *
     * @throws \Exception
     */
    public function updateClient($id, $app_id)
    {
        $origin = $this->getClient($id, $app_id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = ['id', 'app_id'];

        if (!isset($this->data['name']) || $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validateClient($ignore);

        return $this->transaction(function () use ($id, $app_id) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields, ['id', 'app_id']);

            $this->table()->where('id', $id)->where('app_id', $app_id)->update($this->data);

            $status = $this->getClient($id, $app_id);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param  $id
     *
     * @return  Status
     */
    public function deleteClient($id, $app_id)
    {

        $origin = $this->getClient($id, $app_id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->where('app_id', $app_id)->delete();

        return status('success');
    }
}

