<?php 

namespace Core\Models\User\Email;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Email extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Email记录
    protected function initializeEmail()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Email数据校验
    protected function validateEmail(array $ignore = [])
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

    // 获取Email
    protected function getEmail($email_id)
    {

        if($data = $this->table()->where('email_id',$email_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('emailDoesNotExist');
    }

    // 获取Email组
    protected function getEmails(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Email记录
    protected function addEmail()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateEmail();

        $this->initializeEmail();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getEmail($this->data['id']);

            return $status;

        });

    }

    // 更新Email记录
    protected function updateEmail($email_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getEmail($email_id)->data;

        $ignore = [

        ];

        $this->validateEmail($ignore);

        return $this->transaction(function() use($email_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('email_id','email_id')->update($this->data);

            $status = $this->getEmail($this->data['id']);

            return $status;

        });

    }

    // 删除Email记录
    protected function deleteEmail($email_id)
    {

        $origin = $this->getEmail($email_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('email_id')->delete();

        return status('success');
    }
}

