<?php

namespace Core\Models;

use Core\Models\Model;
use Core\Exceptions\StatusException;
use Illuminate\Support\Facades\Validator;

class Resource extends Model
{

    protected $fields = ['id', 'name', 'parent', 'icon', 'description', 'source', 'created_at', 'updated_at'];

    /**
     * 资源数据初始化
     *
     *
     * @return void
     */
    protected function initializeResource()
    {

        $initialized = [
            'source' => 'EEVEE',
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    /**
     * 资源数据校验
     *
     * @param array $ignore
     *
     * @throws \Core\Exceptions\StatusException
     *
     */
    protected function validateResource(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [
            'id' => "required|unique:$tableName",
            'name' => "required|unique:$tableName",
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 获取资源
     *
     * @param $id
     *
     * @return Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getResource($id)
    {

        if ($data = $this->table()->where('id', $id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('resourceDoesNotExist');
    }

    /**
     * 获取资源组
     *
     * @param array $params
     *
     * @return Status
     */
    public function getResources(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    /**
     * 添加资源
     *
     * @return Status
     *
     */
    public function addResource()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateResource();

        $this->initializeResource();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    /**
     * 更新资源
     *
     * @param $id
     *
     * @return Status
     *
     */
    public function updateResource($id)
    {
        $origin = $this->getResource($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = ['id'];

        if (isset($this->data['name']) && $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validateResource($ignore);

        return $this->transaction(function () use ($id) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    /**
     * 删除资源
     *
     * @param $id
     *
     * @return Status
     */
    public function deleteResource($id)
    {

        $origin = $this->getResource($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }

    /**
     * 保存资源组, 此操作会替换已存在的资源记录.
     *
     * @return Status
     */
    public function saveResources()
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

                    array_push($result['success'], $this->updateResource($item['id']));
                }

                continue;

            } catch (StatusException $e) {

                try {

                    $this->validateResource();

                } catch (StatusException $e) {

                    $e->status->object = $data[$key];

                    array_push($result['failed'], $e->status);

                    continue;
                }

                $this->initializeResource();

                array_push($result['success'], $this->addResource());
            }

        }

        return status('success', $result);

    }


}

