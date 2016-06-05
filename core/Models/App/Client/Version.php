<?php

namespace Core\Models\App\Client;

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class Version extends Model
{

    protected $fields = ['client_id', 'version', 'description', 'status', 'created_at', 'updated_at'];

    /**
     * 数据初始化
     *
     * @return  void
     */
    protected function initializeVersion()
    {

        $initialized = [
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

        $tableName = $this->name();

        $rule = [
            'client_id' => 'required',
            'version' => 'required',
        ];

        $this->ignore($rule, $ignore);

        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        $this->validateClientVersion($this->data['client_id'], $this->data['version']);
    }

    /**
     * 验证客户端版本是否唯一
     *
     * @param $client_id
     * @param $version
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateClientVersion($client_id, $version)
    {
        if ($this->table()->where('client_id', $client_id)->where('version', $version)->first()) {

            exception('clientVersionIsExist');
        }
    }

    /**
     * 获取记录
     *
     * @param string $version
     * @param string $client_id
     *
     * @return Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getVersion($version, $client_id)
    {

        if ($data = $this->table()->where('version', $version)->where('client_id', $client_id)->first()) {

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

            $status = $this->getVersion($this->data['version'], $this->data['client_id']);

            return $status;

        });

    }

    /**
     * 更新记录
     *
     * @param  string $version
     * @param  string $client_id
     *
     * @return Status
     *
     * @throws \Exception
     */
    public function updateVersion($version, $client_id)
    {

        $origin = $this->getVersion($version, $client_id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = ['version', 'app_id', 'client_id'];

        $this->validateVersion($ignore);


        return $this->transaction(function () use ($version, $client_id, $ignore) {

            $this->timestamps($this->data, false);

            $this->filter($this->data, $this->fields, $ignore);

            $this->table()->where('version', $version)->where('client_id', $client_id)->update($this->data);

            $status = $this->getVersion($version, $client_id);

            return $status;

        });

    }

    /**
     * 删除记录
     *
     * @param string $version
     * @param string $client_id
     *
     * @return Status
     */
    public function deleteVersion($version, $client_id)
    {

        $origin = $this->getVersion($version, $client_id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('version', $version)->where('client_id', $client_id)->delete();

        return status('success');
    }
}

