<?php

namespace Core\Models\App\Client;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Version extends Model
{

    protected $fields = ['app_id', 'client_id', 'version', 'description', 'status', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializeVersion()
    {

        $initialized = [
            'app_id' => APP_ID,
            'client_id' => '',
            'version' => '0.0.1',
            'description' => text('noDescription'),
            'status' => STATUS_ACTIVE,
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ];

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
     * Todo 添加验证
     *
     */
    protected function validateVersion(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

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
     * @param string $version
     * @param string $app_id
     * @param string $client_id
     *
     * @return Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getVersion($version, $app_id, $client_id)
    {

        if ($data = $this->table()->where('version', $version)->where('app_id', $app_id)->where('client_id', $client_id)->first()) {

            $this->guard($data, 'get', GUARD_GET);

            return status('success', $data);
        }

        exception('versionDoesNotExist');

    }

    /**
     * 获取记录组
     *
     * @param  array $params
     *
     * @return  Status
     *
     *
     */
    public function getVersions(array $params = [])
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
    public function addVersion()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validateVersion();

        $this->initializeVersion();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getVersion($this->data['version'], $this->data['app_id'], $this->data['client_id']);

            return $status;

        });

    }

    /**
     * 更新记录
     *
     * @param  string $version
     * @param  string $app_id
     * @param  string $client_id
     *
     * @return Status
     *
     * @throws \Exception
     */
    public function updateVersion($version, $app_id, $client_id)
    {

        $origin = $this->getVersion($version, $app_id, $client_id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = ['version', 'app_id', 'client_id'];

        $this->validateVersion($ignore);


        return $this->transaction(function () use ($version, $app_id, $client_id, $ignore) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields, $ignore);

            $this->table()->where('version', $version)->where('app_id', $app_id)->where('client_id', $client_id)->update($this->data);

            $status = $this->getVersion($version, $app_id, $client_id);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param string $version
     * @param string $app_id
     * @param string $client_id
     *
     * @return Status
     */
    public function deleteVersion($version, $app_id, $client_id)
    {

        $origin = $this->getVersion($version, $app_id, $client_id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('version', $version)->where('app_id', $app_id)->where('client_id', $client_id)->delete();

        return status('success');
    }
}

