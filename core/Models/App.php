<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class App extends Model
{

    protected $fields = ['id','name','description','status','created_at','updated_at'];

    /**
     * 获取APP
     *
     * @param $app_id
     *
     * @return Status
     */
    public function getApp($app_id)
    {

        if ($app = $this->table()->where('id', $app_id)->first()) {

            return status('success', $app);
        }

        return status('appDoesNotExist');
    }

    /**
     * 获取APP组
     *
     * @param array $params
     *
     * @return Status
     */
    public function getApps(array $params = [])
    {
        return status('success', $this->selector($params));
    }

    /**
     * 添加APP
     *
     * @return Status
     */
    public function addApp()
    {
        $this->validateApp();

        $this->filter($this->data, $this->fields);

        $this->table()->insert($this->data);

        return $this->getApp($this->data['id']);

    }

    /**
     * 更新APP
     *
     * @param string $app_id
     *
     * @return Status
     */
    public function updateApp($app_id)
    {
        $app = $this->getApp($app_id)->data;

        $ignore = ['id'];

        if ($app->name == $this->data['name']) {

            array_push($ignore, 'name');
        };

        $this->validateApp($ignore);

        $this->filter($this->data, $this->fields);

        $this->table()->where('id', $app_id)->update($this->data);

        return $this->getApp($app_id);
    }


    /**
     * 删除APP
     *
     * @param string $app_id
     *
     * @return Status
     */
    public function deleteApp($app_id)
    {
        if ($this->table()->where('id', $app_id)->delete()) {

            return status('success');
        }

        return status('appDoesNotExist');
    }

    /**
     * 验证 APP
     *
     * @param array $ignore
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateApp(array $ignore = [])
    {

        $table = $this->tableName();

        $rule = [
            'id' => "required|unique:$table",
            'name' => "required|unique:$table"
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

}