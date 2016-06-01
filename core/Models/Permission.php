<?php

namespace Core\Models;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;
use Core\Exceptions\StatusException;

class Permission extends Model
{

    protected $fields = ['id', 'resource_id', 'name', 'description', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializePermission()
    {
        $this->timestamps($this->data, true);
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
    protected function validatePermission(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [
            'id' => "required|unique:$tableName",
            'resource_id' => "required",
            'name' => "required|unique:$tableName",
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
     * @param  $id
     *
     * @return  Status
     *
     * @throws  \Core\Exceptions\StatusException
     */
    public function getPermission($id)
    {

        if ($data = $this->table()->where('id', $id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('permissionDoesNotExist');
    }

    /**
     * 获取记录组
     *
     * @param  array $params
     *
     * @return  Status
     */
    public function getPermissions(array $params)
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
    public function addPermission()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validatePermission();

        $this->initializePermission();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getPermission($this->data['id']);

            return $status;

        });

    }

    /**
     * 更新记录
     *
     * @param  string $id
     *
     * @return  Status
     *
     */
    public function updatePermission($id)
    {
        $origin = $this->getPermission($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = ['id'];

        if (isset($this->data['name']) && $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validatePermission($ignore);

        return $this->transaction(function () use ($id) {

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getPermission($this->data['id']);

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
    public function deletePermission($id)
    {

        $origin = $this->getPermission($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }


    /**
     * 保存资源组, 此操作会替换已存在的资源记录.
     *
     * @return Status
     */
    public function savePermissions()
    {

        $data = $this->data;

        $result = [
            'success' => [],
            'failed' => [],
        ];

        foreach ($data as $key => $item) {

            $this->data = $item;

            try {

                if (isset($item['id'])) {
                    
                    array_push($result['success'], $this->updatePermission($item['id']));
                }

                continue;

            } catch (StatusException $e) {

                try {

                    $this->validatePermission();

                } catch (StatusException $e) {

                    $e->status->object = $data[$key];

                    array_push($result['failed'], $e->status);

                    continue;
                }

                $this->initializePermission();

                array_push($result['success'], $this->addPermission());
            }

        }

        return status('success', $result);

    }
}

