<?php

namespace Core\Models\App\Resource;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Status extends Model
{

    protected $fields = ['id', 'resource_id', 'name', 'description', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializeStatus()
    {
        $initialized = [
            'id' => $this->id(),
            'resource_id' => '',
            'name' => '',
            'description' => text('noDescription'),
        ];

        $this->data = array_merge($initialized, $this->data);
        $this->data['created_at'] = $this->timestamp();
        $this->data['updated_at'] = $this->timestamp();
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
    protected function validateStatus(array $ignore = [])
    {

        $table = $this->name();

        $rule = [
            'resource_id' => 'required',
            'name' => 'required',
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    /**
     * 获取记录
     *
     * @param  string $id
     *
     * @return  Status
     *
     * @throws  \Core\Exceptions\StatusException
     */
    public function getStatus($id)
    {

        if ($data = $this->table()->where('id', $id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('statusDoesNotExist');
    }

    /**
     * 获取记录组
     *
     * @param  array $params
     *
     * @return  Status
     */
    public function getStatuses(array $params = [])
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
    public function addStatus()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateStatus();

        $this->initializeStatus();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getStatus($this->data['id']);

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
    public function updateStatus($id)
    {
        $origin = $this->getStatus($id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validateStatus($ignore);

        return $this->transaction(function () use ($id) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields);

            $this->table()->where('id', $id)->update($this->data);

            $status = $this->getStatus($id);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param  string $id
     *
     * @return  Status
     */
    public function deleteStatus($id)
    {

        $origin = $this->getStatus($id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('id', $id)->delete();

        return status('success');
    }
}

