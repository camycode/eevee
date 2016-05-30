<?php

/**
 * 资源模型
 *
 * 资源是一个抽象的概念, 由模型组织其逻辑实现, 同时配有相关的控制器和路由信息,
 * 也是权限绑定所依赖的对象. 功能管理按资源划分，超级管理员拥有所有资源的分配权。
 * 超级管理员可以创建不同的应用，并且为应用分配不同的, 资源管理权限。子应用超级
 * 管理员也可递归完成此操作.
 *
 * 资源注册文件 "core/System/local/resources.php", 包含了资源信息和权限信息.
 *
 * @author 古月
 */

namespace Core\Models\Resource;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Resource extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Resource记录
    protected function initializeResource()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Resource数据校验
    protected function validateResource(array $ignore = [])
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

    // 获取Resource
    protected function getResource($resource_id)
    {

        if($data = $this->table()->where('resource_id',$resource_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('resourceDoesNotExist');
    }

    // 获取Resource组
    protected function getResources(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Resource记录
    protected function addResource()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateResource();

        $this->initializeResource();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    // 更新Resource记录
    protected function updateResource($resource_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getResource($resource_id)->data;

        $ignore = [

        ];

        $this->validateResource($ignore);

        return $this->transaction(function() use($resource_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('resource_id','resource_id')->update($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    // 删除Resource记录
    protected function deleteResource($resource_id)
    {

        $origin = $this->getResource($resource_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('resource_id')->delete();

        return status('success');
    }
}

