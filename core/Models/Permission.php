<?php

namespace Core\Models;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Permission extends Model
{

    protected $fields = ['id', 'app_id', 'name', 'description', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializePermission()
    {

        $initialized = [
            'id' => $this->id(),
            'app_id' => APP_ID,
            'name' => '',
            'description' => text('noDescription'),
        ];

        $this->data = array_merge($initialized, $this->data);

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

        $rule = [
            'id' => 'required',
            'app_id' => 'required',
            'name' => 'required',
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);


        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        if (!in_array('id', $ignore) && !in_array('app_id', $ignore)) {

            $this->validatePermissionID($this->data['id'], $this->data['app_id']);
        }

        if (!in_array('id', $ignore) && !in_array('app_id', $ignore)) {

            $this->validatePermissionName($this->data['name'], $this->data['app_id']);
        }
    }

    /**
     * 验证权限ID
     *
     * @param string $id
     * @param string $app_id
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validatePermissionID($id, $app_id)
    {
        if ($this->table()->where('id', $id)->where('app_id', $app_id)->first()) {

            exception('validateFailed', [
                'id' => message('permissionIDHasExist'),
            ]);
        }
    }

    /**
     * 验证权限名称
     *
     * @param string $name
     * @param string $app_id
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validatePermissionName($name, $app_id)
    {
        if ($this->table()->where('name', $name)->where('app_id', $app_id)->first()) {

            exception('validateFailed', [
                'id' => message('permissionNameHasExist'),
            ]);
        }
    }

    /**
     * 获取记录
     *
     * @param  string $id
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
    public function getPermissions(array $params = [])
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

        $ignore = [];

        if (!isset($this->data['id']) || $this->data['id'] == $origin->id) {

            array_push($ignore, 'id');
        }

        if (!isset($this->data['name']) || $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        if (!isset($this->data['app_id']) || $this->data['app_id'] == $origin->app_id) {

            array_push($ignore, 'app_id');
        }

        $this->validatePermission($ignore);

        return $this->transaction(function () use ($id, $ignore) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields, $ignore);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getPermission($id);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param  string $id
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
}

