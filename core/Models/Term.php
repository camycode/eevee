<?php 

namespace Core\Models\Term;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Term extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Term记录
    protected function initializeTerm()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Term数据校验
    protected function validateTerm(array $ignore = [])
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

    // 获取Term
    protected function getTerm($term_id)
    {

        if($data = $this->table()->where('term_id',$term_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('termDoesNotExist');
    }

    // 获取Term组
    protected function getTerms(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Term记录
    protected function addTerm()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateTerm();

        $this->initializeTerm();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getTerm($this->data['id']);

            return $status;

        });

    }

    // 更新Term记录
    protected function updateTerm($term_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getTerm($term_id)->data;

        $ignore = [

        ];

        $this->validateTerm($ignore);

        return $this->transaction(function() use($term_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('term_id','term_id')->update($this->data);

            $status = $this->getTerm($this->data['id']);

            return $status;

        });

    }

    // 删除Term记录
    protected function deleteTerm($term_id)
    {

        $origin = $this->getTerm($term_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('term_id')->delete();

        return status('success');
    }
}

