<?php

namespace Core\Models;

use Core\Models\App;
use Core\Models\User;
use Core\Models\Role;
use Core\Models\Role\Permission as RolePermission;
use Core\Models\Model;
use Core\Models\System;
use Core\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Core\Exceptions\StatusException;


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
     * 测试数据库服务器连接
     *
     * @return Status
     */
    protected function testDatabaseServerConnection()
    {

    }


    /**
     * 检查目标数据库是否存在
     *
     * @return Status
     */
    protected function checkDatabaseIsExist()
    {

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
     * 注册根应用
     *
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialApp(array $data)
    {
        return (new App($data))->addApp()->data;
    }

    /**
     * 注册根应用资源
     *
     * @param string $app_id
     *
     * @return Status
     */
    protected function registerInitialAppResources($app_id)
    {
        $resources = (new System())->getResources()->data;

        $result = ['success' => [], 'failed' => []];

        foreach ($resources as $key => $resource) {

            $attribute = [];

            if (isset($resource['statuses'])) {
                $attribute['statuses'] = $resource['statuses'];
            }

            try {

                $status = (new Resource([
                    'id' => $key,
                    'app_id' => $app_id,
                    'name' => isset($resource['name']) ? $resource['name'] : '',
                    'description' => isset($resource['description']) ? $resource['description'] : text('noDescription'),
                    'type' => 'origin',
                    'parent' => $key,
                    'icon' => isset($resource['icon']) ? $resource['icon'] : '',
                    'source' => isset($resource['source']) ? $resource['source'] : 'eevee',
                    'attribute' => $attribute,
                ]))->addResource()->data;

                array_push($result['success'], $status);

            } catch (StatusException $e) {

                array_push($result['failed'], $status);
            }


        }

        return status('success', $result);

    }

    /**
     * 注册根应用权限
     *
     * @param string $app_id
     *
     * @return Status
     */
    protected function registerInitialAppPermissions($app_id)
    {
        $resources = (new System())->getResources()->data;

        $result = ['success' => [], 'failed' => []];

        foreach ($resources as $key => $resource) {

            if (isset($resource['actions'])) {

                foreach ($resource['actions'] as $action_key => $action_value)


                    try {

                        $status = (new Resource([
                            'id' => strtoupper($key . ':' . $action_key),
                            'app_id' => $app_id,
                            'name' => isset($action_value['name']) ? $action_value['name'] : '',
                            'description' => isset($action_value['description']) ? $action_value['description'] : text('noDescription'),
                            'source' => isset($resource['source']) ? $resource['source'] : 'eevee',
                        ]))->addResource()->data;

                        array_push($result['success'], $status);

                    } catch (StatusException $e) {

                        array_push($result['failed'], $status);
                    }


            }
        }

        return status('success', $result);
    }


    /**
     * 注册根角色
     *
     * @param string $app_id
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialAppRole($app_id, array $data)
    {

        $data['app_id'] = $app_id;

        $data['permissions'] = [];

        $permissions = (new Permission())->getPermissions(['app_id' => $app_id])->$this->data;

        foreach ($permissions as $permission) {

            array_push($data['permissions'], $permission['id']);
        }

        return (new Role($data))->addRole();
    }


    /**
     * 注册根用户
     *
     * @param string $app_id
     * @param string $role_id
     * @param array $data
     *
     * @return Status
     */
    protected function registerInitialAppUser($app_id, $role_id, array $data)
    {

        $data['app_id'] = $app_id;

        $data['role_id'] = $role_id;
        
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

