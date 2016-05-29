<?php

namespace Core\Models;

use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class App extends Model
{

    protected $fields = ['id', 'version', 'name', 'description', 'status', 'created_at', 'updated_at'];


    /**
     * 数据初始化
     *
     */
    protected function initializeApp()
    {
        $initialized = [
            'id' => $this->id(),
            'status' => config('site.app.default_status', 0)
        ];

        $this->timestamps($this->data, true);

        $this->data = array_merge($initialized, $this->data);

    }

    /**
     * 验证数据
     *
     * @param array $ignore
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateApp(array $ignore = [])
    {

        $table = $this->tableName();

        $rule = [
            'name' => "required|unique:$table"
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 获取APP
     *
     * @param $id
     *
     * @return Status
     */
    public function getApp($id)
    {

        if ($app = $this->table()->where('id', $id)->first()) {

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

        $this->initializeApp();

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->filter($this->data, $this->fields);

        $this->table()->insert($this->data);

        return $this->getApp($this->data['id']);

    }

    /**
     * 更新APP
     *
     * @param string $id
     *
     * @return Status
     */
    public function updateApp($id)
    {
        $app = $this->getApp($id)->data;

        $this->guard($app, 'update', GUARD_UPDATE);

        $ignore = ['id'];

        if ($app->name == $this->data['name']) {

            array_push($ignore, 'name');
        };

        $this->validateApp($ignore);

        $this->filter($this->data, $this->fields);

        $this->table()->where('id', $id)->update($this->data);

        return $this->getApp($id);
    }


    /**
     * 删除APP
     *
     * @param string $id
     *
     * @return Status
     */
    public function deleteApp($id)
    {
        if ($app = $this->getApp($id)) {

            $this->guard($app, 'update', GUARD_UPDATE);

            $this->table()->where('id', $id)->delete();

            return status('success');
        }

        return status('appDoesNotExist');
    }

}