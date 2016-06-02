<?php

/**
 * 系统模型
 *
 * 提供系统运行操作接口.
 *
 * @author 古月
 */

namespace Core\Models;

use Core\Models\Model;
use Core\Models\Resource;
use Core\Models\Resource\Permission;
use Illuminate\Support\Facades\Validator;

class System extends Model
{
    /**
     * 依赖数据表
     *
     * @var array
     */
    protected $tables = ['resource', 'permission'];

    /**
     * 系统资源表
     *
     * @var array
     */
    protected $resources = [];

    /**
     * 系统权限表
     *
     * @var array
     */
    protected $permissions = [];


    /**
     * 刷新系统资源表和系统权限表
     *
     * 资源注册文件: core/System/local/resources.php
     *
     * @return Status
     *
     */
    public function refreshResourcesAndPermissions()
    {
        $resources = trans('resources');

        // 解析注册文件
        foreach ($resources as $ident => $options) {

            if (is_string($options)) {

                array_push($this->resources, ['id' => $ident, 'name' => $options]);
            }

            if (is_array($options)) {

                $resource = ['id' => $ident, 'name' => '', 'parent' => '', 'description' => ''];

                $resource = array_merge($resource, $options);

                array_push($this->resources, ['id' => $resource['id'], 'name' => $resource['name'], 'parent' => $resource['parent'], 'description' => $resource['description']]);

                if (isset($options['actions']) && is_array($options['actions'])) {

                    foreach ($options['actions'] as $permissionIdent => $permissionOptions) {

                        $permission = ['id' => strtoupper($permissionIdent), 'resource_id' => $ident, 'name' => '', 'description' => ''];

                        array_push($this->permissions, array_merge($permission, $permissionOptions));

                    }

                }

            }
        }

        return status('success', [
            'refresh_resources' => (new Resource($this->resources))->saveResources(),
            'refresh_permissions' => (new Permission($this->permissions))->savePermissions(),
        ]);
    }

}

