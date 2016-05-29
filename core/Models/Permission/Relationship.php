<?php 

namespace Core\Models\Permission\Relationship;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Relationship extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Relationship记录
    protected function initializeRelationship()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Relationship数据校验
    protected function validateRelationship(array $ignore = [])
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

    // 获取Relationship
    protected function getRelationship($relationship_id)
    {

        if($data = $this->table()->where('relationship_id',$relationship_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('relationshipDoesNotExist');
    }

    // 获取Relationship组
    protected function getRelationships(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Relationship记录
    protected function addRelationship()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateRelationship();

        $this->initializeRelationship();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getRelationship($this->data['id']);

            return $status;

        });

    }

    // 更新Relationship记录
    protected function updateRelationship($relationship_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getRelationship($relationship_id)->data;

        $ignore = [

        ];

        $this->validateRelationship($ignore);

        return $this->transaction(function() use($relationship_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('relationship_id','relationship_id')->update($this->data);

            $status = $this->getRelationship($this->data['id']);

            return $status;

        });

    }

    // 删除Relationship记录
    protected function deleteRelationship($relationship_id)
    {

        $origin = $this->getRelationship($relationship_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('relationship_id')->delete();

        return status('success');
    }
}

