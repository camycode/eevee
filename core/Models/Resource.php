<?php

namespace Core\Models;

use Core\Models\Model;
use Core\Exceptions\StatusException;
use Illuminate\Support\Facades\Validator;

class Resource extends Model
{

    protected $fields = [
        'id',
        'app_id',
        'name',
        'description',
        'attribute',
        'type',
        'parent',
        'icon',
        'source',
        'created_at',
        'updated_at'
    ];

    /**
     * 资源数据初始化
     *
     *
     * @return void
     */
    protected function initializeResource()
    {

        $initialized = [
            'id' => $this->id(),
            'app_id' => '',
            'name' => '',
            'description' => text('noDescription'),
            'attribute' => [],
            'type' => 'origin',
            'parent' => 'self',
            'icon' => '/images/resource.png',
            'source' => 'eevee',
        ];

        $this->data = array_merge($initialized, $this->data);

        $this->timestamps($this->data, true);
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

        $table = $this->name();

        $rule = [
            'id' => "required",
            'app_id' => "required",
            'name' => "required",
            'attribute' => "sometimes|required|array",
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        $this->validateResourceID($this->data['id'], $this->data['app_id']);

        $this->validateResourceName($this->data['name'], $this->data['app_id']);

    }

    /**
     * 验证资源ID
     *
     * @param string $id
     * @param string $app_id
     *
     * @throws StatusException
     */
    protected function validateResourceID($id, $app_id)
    {
        if ($this->table()->where('id', $id)->where('app_id', $app_id)->first()) {
            exception('validateFailed', [
                'id' => message('resourceIDIsExist'),
            ]);
        }
    }

    /**
     * 验证资源名称
     *
     * @param string $name
     * @param string $app_id
     *
     * @throws StatusException
     */
    protected function validateResourceName($name, $app_id)
    {
        if ($this->table()->where('name', $name)->where('app_id', $app_id)->first()) {
            exception('validateFailed', [
                'name' => message('resourceNameIsExist'),
            ]);
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

            $this->data['attribute'] = json_encode($this->data['attribute']);

            $this->table()->insert($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    /**
     * 更新资源
     *
     * 更新资源时自动过滤 id 字段,如果 name 字段与原数据一致即过滤.
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

        if (!isset($this->data['name']) || $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validateResource($ignore);

        return $this->transaction(function () use ($id) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields, ['id']);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getResource($id);

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

