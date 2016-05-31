<?php 

namespace Core\Models\App;

use Core\Models\Model;
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
    public function getResource($id)
    {

        if($data = $this->table()->where('id',$id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('resourceDoesNotExist');
    }

    // 获取Resource组
    public function getResources(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加Resource记录
    public function addResource()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

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
    public function updateResource($id)
    {
        $origin = $this->getResource($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateResource($ignore);

        return $this->transaction(function() use($id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getResource($this->data['id']);

            return $status;

        });

    }

    // 删除Resource记录
    public function deleteResource($id)
    {

        $origin = $this->getResource($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

