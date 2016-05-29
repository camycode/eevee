<?php 

namespace Core\Models\File;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class File extends Model
{

    protected $fields = [];

    // 初始化File记录
    protected function initializeFile()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        return array_merge($initialized, $this->data);
    }

    // File数据校验
    protected function validateFile(array $ignore = [])
    {

        $table = $this->tableName();

        $rule = [

        ];

        $this->ignore($this->data,$ignore);

        $validator = Validator::make($this->data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取File
    protected function getFile($file_id)
    {

        if($data = $this->table()->where('file_id',$file_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('fileDoesNotExist');
    }

    // 获取File组
    protected function getFiles(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加File记录
    protected function addFile()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateFile();

        $data = $this->initializeFile($this->data);

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getFile($this->data['id']);

            return $status;

        });

    }

    // 更新File记录
    protected function updateFile($file_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getFile($file_id)->data;

        $ignore = [

        ];

        $this->validateFile($ignore);

        return $this->transaction(function() use($file_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('file_id','file_id')->update($this->data);

            $status = $this->getFile($this->data['id']);

            return $status;

        });

    }

    // 删除File记录
    protected function deleteFile($file_id)
    {

        $origin = $this->getFile($file_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('file_id')->delete();

        return status('success');
    }
}

