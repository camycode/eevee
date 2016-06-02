<?php 

namespace Core\Models\App;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Version extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Version记录
    protected function initializeVersion()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Version数据校验
    protected function validateVersion(array $ignore = [])
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

    // 获取Version
    public function getVersion($id)
    {

        if($data = $this->table()->where('id',$id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('versionDoesNotExist');
    }

    // 获取Version组
    public function getVersions(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加Version记录
    public function addVersion()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateVersion();

        $this->initializeVersion();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getVersion($this->data['id']);

            return $status;

        });

    }

    // 更新Version记录
    public function updateVersion($id)
    {
        $origin = $this->getVersion($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateVersion($ignore);

        return $this->transaction(function() use($id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getVersion($this->data['id']);

            return $status;

        });

    }

    // 删除Version记录
    public function deleteVersion($id)
    {

        $origin = $this->getVersion($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

