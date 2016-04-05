<?php

namespace Core\Services;

use Validator;
use Core\Models\User;
use Core\Models\Role;
use Core\Models\Model;

class Installer
{
    public static function install()
    {
        return [
            'register:resources' => self::registerResources(),
            'register:permissions' => self::registerPermissions(),
            'post:role:guest' => '',
            'post:role:root' => '',
            'post:administrator' => '',
        ];
    }

    /**
     * 检查特定文件夹是否有读写权限.
     *
     * @return bool
     */
    protected function checkStorageFolderPermission()
    {
    }

    /**
     * 测试数据库服务器链接.
     *
     * @param string $database .host
     * @param string $database .username
     * @param string $database .password
     * @param string $database .port
     *
     * @return bool
     */
    protected function testDatabaseConnection($database)
    {
    }

    /**
     * 创建数据库，如果目标数据存在，则迁移原有数据表。
     *
     * @param string $database .host
     * @param string $database .username
     * @param string $database .password
     * @param string $database .port
     * @param string $database .database
     *
     * @return bool
     */
    protected function createDatabase($database)
    {
    }

    /**
     * 迁移数据表.
     */
    public function migrate()
    {
    }

    /**
     * 注册系统资源.
     */
    public static function registerResources()
    {
        $status = null;

        $resources = self::getResources();

        $table = with(new Model())->table('RESOURCE');

        $rule = [
            'id' => "required|unique:$table",
            'name' => "required|unique:$table",
        ];

        foreach ($resources as $row) {

            $validator = Validator::make($row, $rule);

            if ($validator->fails()) {

                $status[$row['id']] = $validator->errors();

                continue;
            }

            $resource = with(new Model())->resource('RESOURCE');

            $resource->insert($row);

            $status[$row['id']] = 'success';

        }

        return $status;
    }

    /**
     * 注册权限.
     */
    public static function registerPermissions()
    {
        $status = null;

        $permissions = self::getPermissions();

        $table = with(new Model())->table('PERMISSION');

        $rule = [
            'id' => "required|unique:$table",
            'name' => "required|unique:$table",
        ];

        foreach ($permissions as $row) {

            $validator = Validator::make($row, $rule);

            if ($validator->fails()) {

                $status[$row['id']] = $validator->errors();

                continue;
            }

            $resource = with(new Model())->resource('PERMISSION');

            $resource->insert($row);

            $status[$row['id']] = 'success';

        }

        return $status;
    }

    /**
     * 注册超级管理员角色.
     */
    public static function registerRootRole()
    {
        return 'register root user';
    }

    /**
     * 注册访客角色.
     */
    public static function registerGuestRole()
    {
    }

    /**
     * 注册管理员.
     *
     * @param string $user .username
     * @param string $user .email
     * @param string $user .password
     *
     * @return $user
     */
    protected static function registerAdministrator($user)
    {
    }

    /**
     * 读取资源配置文件.
     */
    protected static function getResources()
    {
        $defaultResources = config('resources');

        return self::generateResourceRows($defaultResources);
    }

    /**
     * 处理资源前缀，生成数据库可插入的记录。
     *
     * @param array $resources
     * @return array
     */
    protected static function generateResourceRows($resources)
    {
        $result = [];

        foreach ($resources as $resource => $table) {
            $resource = trim($resource);

            if (strpos($resource, 'L:') === 0) {
                continue;
            }

            $row['id'] = strtoupper($resource);
            $row['name'] = is_array(trans("resources.$resource")) ? trans("resources.$resource.name") : trans("resources.$resource");
            $row['description'] = is_array(trans("resources.$resource")) ? trans("resources.$resource.description") : '';
            $row['source'] = 'eevee';

            array_push($result, $row);
        }

        return $result;
    }

    /**
     * 获取系统权限列表.
     */
    protected static function getPermissions()
    {
        $defaultPermissions = config('permissions');

        return self::generatePermissionRows($defaultPermissions);
    }

    /**
     * 生成权限可插入的数据库记录.
     */
    protected static function generatePermissionRows($permissions)
    {
        $result = [];

        foreach ($permissions as $permission) {
            $permission = trim($permission);

            if (strpos($permission, 'T:') === 0) {
                $permission = trim(substr($permission, 2));
                $row['type'] = ':type';
            } else {
                $row['type'] = 'single';
            }

            $row['id'] = $permission;
            $row['resource_id'] = self::getPermissionResourceID($permission);
            $row['name'] = is_array(trans("permissions.$permission")) ? trans("permissions.$permission.name") : trans("permissions.$permission");
            $row['description'] = is_array(trans("permissions.$permission")) ? trans("permissions.$permission.description") : '';
            $row['source'] = 'eevee';

            array_push($result, $row);
        }

        return $result;
    }

    protected static function getPermissionResourceID($permission)
    {
        return strtoupper(explode('_', $permission)[0]);
    }
}
