<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Config extends Model
{

    /**
     * 添加配置
     *
     * @param $user_id
     * @param $config_key
     * @param array $config_value
     *
     * @return mixed
     */
    public function addConfig($user_id, $config_key, array $config_value)
    {
        $this->validateConfig($user_id, $config_key);

        $this->resource('CONFIG')->add($this->generateConfig($user_id, $config_key, $config_value));

        return status('success');
    }

    /**
     * 更新配置
     *
     * @param $user_id
     * @param $config_key
     * @param array $config_value
     *
     * @return mixed
     */
    public function updateConfig($user_id, $config_key, array $config_value)
    {
        $config = (array)$this->getConfig($user_id, $config_key)->data;

        $config->config_value = json_decode($config->config_value, true);

        $config->config_value = array_merge($config->config_value, $config_value);

        $this->resource('CONFIG')->where('user_id', $user_id)->where('config_key', $config_key)->update($config);

        return status('success');
    }

    /**
     * 保存配置,配置存在则更新,否则为添加配置
     *
     * @param $user_id
     * @param $config_key
     * @param array $config_value
     */
    public function saveConifg($user_id, $config_key, array $config_value)
    {
        if ($this->getConfig($user_id, $config_key)->code == 200) {
            $this->updateConfig($user_id, $config_key, $config_value);
        } else {
            $this->addConfig($user_id, $config_key, $config_value);
        }
    }

    /**
     * 获取配置
     *
     * @param $user_id
     * @param $config_key
     *
     * @return mixed
     */
    public function getConfig($user_id, $config_key)
    {
        if ($config = $this->resource('CONFIG')->where('user_id', $user_id)->where('config_key', $config_key)->first()) {

            return status('success', $config);
        }

        return status('configDoesNotExist');
    }

    /**
     * 删除配置
     *
     * @param $user_id
     * @param $config_key
     */
    public function deleteConfig($user_id, $config_key)
    {
        if ($this->getConfig($user_id, $config_key)->code == 200) {
            $this->resource('CONFIG')->where('user_id', $user_id)->where('config_key', $config_key)->delete();
        }
    }

    /**
     * 验证配置
     *
     * @param $user_id
     * @param $config_key
     */
    protected function validateConfig($user_id, $config_key)
    {

    }

    /**
     * 生成配置记录
     *
     * @param $user_id
     * @param $config_key
     * @param array $config_value
     *
     * @return array
     */
    protected function generateConfig($user_id, $config_key, array $config_value)
    {
        return [
            'user_id' => $user_id,
            'config_key' => $config_key,
            'config_value' => json_encode($config_value)
        ];
    }
}