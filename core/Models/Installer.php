<?php

namespace Core\Models;

use Core\Models\App;
use Core\Models\App\Resource as AppResource;
use Core\Models\App\Resource\Permission as AppResourcePermission;
use Core\Models\User;
use Core\Models\Role;
use Core\Models\Role\Permission as RolePermission;
use Core\Models\Model;
use Core\Models\System;
use Core\Models\Resource;
use Core\Models\Resource\Permission as ResourcePermission;
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
        $app = (new App($data))->addApp()->data;

        $resources = (new Resource())->getResources()->data;
        $resourcePermissions = (new ResourcePermission())->data;

        return;
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

        $app = (new App())->getApps()->data[0];

        $data['app_id'] = $app->id;

        $role = (new Role($data))->addRole()->data;

        $rolePermission = new RolePermission();

        $appResourcePermissions = (new AppResourcePermission())->getPermissions()->data;

        $rolePermissions = [];

        foreach ($appResourcePermissions as $permission) {

            array_push($rolePermissions, $permission->id);
        }

        $rolePermission->savePermissions($role->id, $role->parent, $rolePermissions);

        return (new Role())->getRole($role->id);
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
        $role = (new Role())->getRoles()->data[0];

        $data['role_id'] = $role->id;

        $data['app_id'] = $role->app_id;

        return (new User($data))->addUser();
    }


    public function install()
    {

        $this->getSystemInformation();

        //  $this->checkDirsPermission();

        //  $this->createDatabase($this->data['db_host'], $this->data['db_username'], $this->data['db_password'], $this->data['db_database']);

        // $this->migrateDatabase();

        $this->data['app'] = [
            'id' => 'eevee',
            'name' => '后台管理'
        ];

        $this->data['role'] = [
            'id' => 'root',
            'name' => '超级管理员',
            'parent' => 'root',
        ];

        $this->data['user'] = [
            'username' => 'admin',
            'password' => 'admin123',
            'email' => 'admin@eevee.io',
        ];

        $this->registerResources();

        return $this->transaction(function () {

            return status('success', [
                'registerResources' => $this->registerResources(),
                'registerInitialApp' => $this->registerInitialApp($this->data['app']),
                'registerInitialRole' => $this->registerInitialRole($this->data['role']),
                'registerInitialUser' => $this->registerInitialUser($this->data['user']),
            ]);

        });


    }

}

