<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class System extends Model
{
    /**
     * 添加系统设置
     *
     * @param $key
     * @param $value
     * @param string $source
     *
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function addConfig($key, $value, $source)
    {
        if ($this->resource('SYSTEMCONFIG')->insert(['config_key' => $key, 'config_value' => $value, 'source' => $source])) {

            return $this->getConfig($key);
        }

        exception('addConfigFailed');
    }

    /**
     * 更新系统设置
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function updateConfig($key, $value)
    {
        $this->getConfig($key);

        if ($this->resource('SYSTEMCONFIG')->where('config_key', $key)->update(['config_value' => $value])) {

            return $this->getConfig($key);
        }

        exception('updateConifgFailed');
    }

    /**
     * 获取系统设置
     *
     * @param $key
     *
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getConfig($key)
    {
        if ($config = $this->resource('SYSTEMCONFIG')->where('config_key', $key)->first()) {

            return status('success', $config);
        }

        exception('configDoesNotExist');
    }

    public function getConfigs($params)
    {

    }

    public function deleteConfig($key, $source)
    {
        $resource = $this->resource('SYSTEMCONFIG');

        if ($config = $resource->where('config_key', $key)->first()) {

            if ($config->source = $source) {

                $resource->where('config_key', $key)->delete();

                return status('success');
            }

            return status('configDoesNotMatchTheSource');
        }

        return status('configDoesNotExsit');
    }

    public function getThemes()
    {

    }

    public function getPlugins()
    {

    }

    public function getColorThemes()
    {

    }
    

}