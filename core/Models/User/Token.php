<?php 

namespace Core\Models\User\Token;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Token extends Model
{

    protected $fields = ['app_id','user_id','user_token','created_at','updated_at'];

    // 初始化Token记录
    protected function initializeToken()
    {

        $this->timestamps($this->data, true);
    }

    // Token数据校验
    protected function validateToken(array $ignore = [])
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

    // 获取Token
    protected function getToken($token_id)
    {

        if($data = $this->table()->where('token_id',$token_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('tokenDoesNotExist');
    }

    // 获取Token组
    protected function getTokens(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Token记录
    protected function addToken()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateToken();

        $this->initializeToken();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getToken($this->data['id']);

            return $status;

        });

    }

    // 更新Token记录
    protected function updateToken($token_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getToken($token_id)->data;

        $ignore = [

        ];

        $this->validateToken($ignore);

        return $this->transaction(function() use($token_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('token_id','token_id')->update($this->data);

            $status = $this->getToken($this->data['id']);

            return $status;

        });

    }

    // 删除Token记录
    protected function deleteToken($token_id)
    {

        $origin = $this->getToken($token_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('token_id')->delete();

        return status('success');
    }
}

