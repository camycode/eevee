<?php 

namespace Core\Models\Role\Permission;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Permission extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Permission记录
    protected function initializePermission()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Permission数据校验
    protected function validatePermission(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($this->data,$ignore);

        $validator = Validator::make($this->data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取Permission
    protected function getPermission($permission_id)
    {

        if($data = $this->table()->where('permission_id',$permission_id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('permissionDoesNotExist');
    }

    // 获取Permission组
    protected function getPermissions(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加Permission记录
    protected function addPermission()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validatePermission();

        $this->initializePermission();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getPermission($this->data['id']);

            return $status;

        });

    }

    // 更新Permission记录
    protected function updatePermission($permission_id)
    {
        $origin = $this->getPermission($permission_id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validatePermission($ignore);

        return $this->transaction(function() use($permission_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('permission_id','permission_id')->update($this->data);

            $status = $this->getPermission($this->data['id']);

            return $status;

        });

    }

    // 删除Permission记录
    protected function deletePermission($permission_id)
    {

        $origin = $this->getPermission($permission_id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('permission_id')->delete();

        return status('success');
    }
}

