<?php 

namespace Core\Models\Role;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class User extends Model
{
    
    protected $fields = ['id','created_at','updated_at'];

    // 初始化User记录
    protected function initializeUser()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // User数据校验
    protected function validateUser(array $ignore = [])
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

    // 获取User
    public function getUser($id)
    {

        if($data = $this->table()->where('id',$id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('userDoesNotExist');
    }

    // 获取User组
    public function getUsers(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加User记录
    public function addUser()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateUser();

        $this->initializeUser();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getUser($this->data['id']);

            return $status;

        });

    }

    // 更新User记录
    public function updateUser($id)
    {
        $origin = $this->getUser($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateUser($ignore);

        return $this->transaction(function() use($id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getUser($this->data['id']);

            return $status;

        });

    }

    // 删除User记录
    public function deleteUser($id)
    {

        $origin = $this->getUser($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

