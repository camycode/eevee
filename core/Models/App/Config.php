<?php 

namespace Core\Models\App;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Config extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializeConfig()
    {

        $initialized = [
            'id' => $this->id(),
            'app_id' => APP_ID,
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    /**
     * 数据校验
     *
     * @param  array $ignore
     *
     * @return  void
     *
     * @throws  \Core\Exceptions\StatusException
     *
     */
    protected function validateConfig(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($rule,$ignore);

        $validator = Validator::make($this->data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 获取记录
     *
     * @param  $id
     *
     * @return  Status
     *
     * @throws  \Core\Exceptions\StatusException
     */
    public function getConfig($id)
    {

        if($data = $this->table()->where('id',$id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('configDoesNotExist');
    }

    /**
     * 获取记录组
     *
     * @param  array $params
     *
     * @return  Status
     */
    public function getConfigs(array $params = [])
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    /**
     * 添加记录
     *
     * @return  Status
     *
     */
    public function addConfig()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateConfig();

        $this->initializeConfig();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getConfig($this->data['id']);

            return $status;

        });

    }

    /**
     * 更新记录
     *
     * @param  string $id
     *
     * @return  Status
     *
     */
    public function updateConfig($id)
    {
        $origin = $this->getConfig($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateConfig($ignore);

        return $this->transaction(function() use($id){

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getConfig($this->data['id']);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param  $id
     *
     * @return  Status
     */
    public function deleteConfig($id)
    {

        $origin = $this->getConfig($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}
