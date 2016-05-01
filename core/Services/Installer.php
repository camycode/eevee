<?php

namespace Core\Services;


use Core\Models\User;
use Core\Models\Role;
use Core\Models\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Installer
{


    protected $pass;

    protected $params;

    protected $result;


    public function __construct()
    {
        $this->params = array(
            'databse' => array(
                'host' => '',
                'port' => '3306',
                'prefix' => 'eevee_',
                'account' => 'fourever',
                'password' => 'fourever',
            ),
            'root' => array(
                'username' => 'root',
                'password' => 'Helloworld',
                'email' => 'root@eevee.io'
            ),
        );

        $this->pass = true;

        $this->result = array();
    }

    /**
     * 开始安装程序
     */
    public function install()
    {
        if (Storage::has('/storage/install.lock')) {
            return message('systemHasInstalled');
        }

        return $this->testDatabaseConnection();

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
    protected function testDatabaseConnection()
    {
        $this->result['test_database_connection'] = '';

        return $this->createDatabase();
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
    protected function createDatabase()
    {
        $this->result['create_database'] = '';

        return $this->migrate();
    }

    /**
     * 迁移数据表.
     */
    protected function migrate()
    {
        $this->result['migrate'] = '';

        return $this->registerResources();
    }

    /**
     * 注册系统资源.
     */
    protected function registerResources()
    {
        $resources = $this->getResources();

        $table = (new Model())->table('RESOURCE');

        $rule = [
            'id' => "required|unique:$table",
            'name' => "required|unique:$table",
        ];

        foreach ($resources as $row) {

            $validator = Validator::make($row, $rule);

            if ($validator->fails()) continue;

            $resource = (new Model())->resource('RESOURCE');

            $resource->insert($row);

        }

        $this->result['register_resources'] = (new Model())->resource('RESOURCE')->get();


        return $this->registerPermissions();
    }

    /**
     * 注册权限.
     */
    protected function registerPermissions()
    {

        $permissions = $this->getPermissions();

        $table = (new Model())->table('PERMISSION');

        $rule = [
            'id' => "required|unique:$table",
            'name' => "required|unique:$table",
        ];

        foreach ($permissions as $row) {

            $validator = Validator::make($row, $rule);

            if ($validator->fails()) continue;

            $resource = (new Model())->resource('PERMISSION');

            $resource->insert($row);

        }

        $this->result['register_permissions'] = (new Model())->resource('PERMISSION')->get();

        return $this->registerRootRole();

    }

    /**
     * 注册超级管理员角色.
     */
    protected function registerRootRole()
    {
        $permissions = [];

        foreach ($this->result['register_permissions'] as $permission) {
            array_push($permissions, $permission->id);
        }

        $data = array(
            'id' => (new Model())->id(),
            'name' => message('root'),
            'status' => 1,
            'permissions' => $permissions,
        );

        $data['parent'] = $data['id'];

        $status = (new Role())->setData($data)->addRole();

        $this->result['register_root_role'] = $status->data;


        return $this->registerGuestRole();

    }

    /**
     * 注册访客角色.
     */
    protected function registerGuestRole()
    {
        $data = array(
            'id' => 'guest',
            'name' => message('guest')
        );

        $guest = (new Role())->setData($data)->addRole();

        $this->result['register_guest_role'] = $this->guest = $guest;

        return $this->registerAdministrator();
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
    protected function registerAdministrator()
    {


        $this->params['root']['status'] = 1;
        $this->params['root']['role'] = $this->result['register_root_role']->id;
        $this->params['root']['source'] = 'EEVEE';

        $administrator = (new User())->setData($this->params['root'])->addUser();

        $this->result['register_administrator'] = $administrator;

        return $this->installEnd();
    }


    protected function installEnd()
    {

        Storage::put('/storage/install.lock', json_encode($this->result));

        return $this->result;
    }

    /**
     * 读取资源配置文件.
     */
    protected function getResources()
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
    protected function generateResourceRows($resources)
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
            $row['source'] = 'EEVEE';

            array_push($result, $row);
        }

        return $result;
    }

    /**
     * 获取系统预设权限列表.
     */
    protected function getPermissions()
    {
        $permissions = config('permissions');

        return $this->generatePermissionRows($permissions);
    }

    /**
     * 生成权限可插入的数据库记录.
     */
    protected function generatePermissionRows($permissions)
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
            $row['source'] = 'EEVEE';

            array_push($result, $row);
        }

        return $result;
    }

    protected function getPermissionResourceID($permission)
    {
        return strtoupper(explode('_', $permission)[0]);
    }
}
