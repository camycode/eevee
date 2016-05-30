<?php 

namespace Core\Models;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Organization extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Organization记录
    protected function initializeOrganization()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Organization数据校验
    protected function validateOrganization(array $ignore = [])
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

    // 获取Organization
    public function getOrganization($id)
    {

        if($data = $this->table()->where('id',$id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('organizationDoesNotExist');
    }

    // 获取Organization组
    public function getOrganizations(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加Organization记录
    public function addOrganization()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateOrganization();

        $this->initializeOrganization();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getOrganization($this->data['id']);

            return $status;

        });

    }

    // 更新Organization记录
    public function updateOrganization($id)
    {
        $origin = $this->getOrganization($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateOrganization($ignore);

        return $this->transaction(function() use($id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getOrganization($this->data['id']);

            return $status;

        });

    }

    // 删除Organization记录
    public function deleteOrganization($id)
    {

        $origin = $this->getOrganization($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

