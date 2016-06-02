<?php

/**
 * 应用模型
 *
 * 应用可以抽象为终端或组织结构, 应用之间存在继承关系.
 *
 * @author 古月
 */

namespace Core\Models;

use Core\Models\App\Message;
use Illuminate\Support\Facades\Validator;

class App extends Model
{

    protected $fields = ['id', 'parent', 'name', 'description', 'status', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * 1. 对于根应用, Parent ID 与 ID 相等.
     * 2. 在系统已经安装时, 应用 Parent ID 只能等于创建接口调用者的 APP_ID.
     *
     * @return void
     */
    protected function initializeApp()
    {

        $initialized = [
            'id' => $this->id(),
            'status' => STATUS_NORMAL,
        ];

        $this->timestamps($this->data, true);

        $this->data = array_merge($initialized, $this->data);

    }

    /**
     * 验证数据
     *
     * @param array $ignore
     *
     * @return void
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateApp(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [
            'id' => "sometimes|required|unique:$tableName",
            'name' => "required|unique:$tableName"
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 验证父应用ID
     *
     * @return void
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateAppParent()
    {

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
     * 如果访问者拥有应用父ID转移(app.parent.transfer)权限, 则可以指定不超出其子类范围的应用父ID.
     *
     * @return Status
     */
    public function addApp()
    {
        $this->validateApp();

        $this->initializeApp();

        $this->guard($this->data, ['add' => '*', 'app.parent.transfer' => ['parent' => APP_ID]], GUARD_ADD, function () {

            $this->validateAppParent();
        });

        $this->filter($this->data, $this->fields);

        $this->table()->insert($this->data);

        return $this->getApp($this->data['id']);

    }

    /**
     * 更新 APP
     *
     * 更新操作过滤了掉父类信息.
     *
     * @param string $id
     *
     * @return Status
     */
    public function updateApp($id)
    {
        $app = $this->getApp($id)->data;

        $this->guard($app, ['update' => '*', 'app.parent.transfer' => ['parent' => APP_ID]], GUARD_UPDATE);

        $ignore = ['id'];

        if (!isset($this->data['name']) || $app->name == $this->data['name']) {

            array_push($ignore, 'name');
        };

        $this->validateApp($ignore);

        $this->filter($this->data, $this->fields, ['id', 'parent']);

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