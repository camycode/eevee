<?php

namespace Core\Models;

use Core\Models\App;
use Core\Models\User;
use Core\Models\Role;
use Core\Models\Model;
use Core\Models\System;
use Core\Models\Resource;
use Core\Services\Status;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class Installer extends Model
{
    protected $system;

    protected $writableDirs = ['/storage'];

    /**
     * 获取系统环境信息
     *
     * @return void
     */
    protected function getSystemInformation()
    {
        $this->system['OS'] = function_exists('php_uname') ? php_uname() : null;
        $this->system['PHP_VERSION'] = PHP_VERSION;
        $this->system['SERVER_NAME'] = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null;
        $this->system['SERVER_SOFTWARE'] = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : null;

    }

    /**
     * 检查目录权限
     *
     * @return void
     */
    protected function checkDirsPermission()
    {
        foreach ($this->writableDirs as $dir) {
            if (!is_writable(base_path($dir))) {

                exception('installFailed', "$dir need write permission, maybe yoe need run : sudo chmod 777 $dir.");
            }
        }
    }


    /**
     * 创建数据库
     *
     * @param $db_host
     * @param $db_username
     * @param $db_password
     * @param $db_database
     *
     * @return void
     */
    protected function createDatabase($db_host, $db_username, $db_password, $db_database)
    {

        $connect = mysqli_connect($db_host, $db_username, $db_password) or die('Unale to connect');

        mysqli_query($connect, "CREATE DATABASE $db_database DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

        mysqli_close($connect);
    }

    /**
     * 迁移数据库
     *
     * @return void
     */
    protected function migrateDatabase()
    {
        Artisan::call('migrate');
    }


    /**
     * 注册资源信息
     *
     * @return Status
     */
    protected function registerResources()
    {
        return (new System())->refreshResourcesAndPermissions();
    }

    /**
     * 注册第一个APP
     *
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialApp(array $data)
    {
        return (new App($data))->addApp();
    }


    /**
     * 注册第一个角色
     *
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialRole(array $data)
    {
        return (new Role($data))->addRole();
    }

    /**
     * 注册第一个用户
     *
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialUser(array $data)
    {
        return (new User($data))->addUser();
    }


    public function install()
    {
        $this->getSystemInformation();

        $this->checkDirsPermission();

        $this->createDatabase($this->data['db_host'], $this->data['db_username'], $this->data['db_password'], $this->data['db_database']);

        $this->migrateDatabase();

        return status('success', [
            'registerResources' => $this->registerResources(),
            'registerInitialApp' => $this->registerInitialApp($this->data['app']),
            'registerInitialRole' => $this->registerInitialRole($this->data['role']),
            'registerInitialUser' => $this->registerInitialUser($this->data['user']),
        ]);
    }

}

