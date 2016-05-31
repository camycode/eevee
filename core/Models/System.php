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
     * @return void
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

                $resource = ['id' => $ident, 'name' => '', 'parent' => '', 'description' => '', 'source' => 'EEVEE'];

                array_merge($resource, $options);

                array_push($this->resources, ['id' => $resource['id'], 'name' => $resource['name'], 'parent' => $resource['parent'], 'description' => $resource['description'], 'source' => $resource['source']]);

                if (isset($options['permissions']) && is_array($options['permissions'])) {

                    foreach ($options['permissions'] as $permissionIdent => $permissionOptions) {

                        $permission = ['id' => $permissionIdent, 'resource_id' => $ident, 'name' => '', 'description' => '', 'source' => 'EEVEE'];

                        array_push($this->permissions, array_merge($permission, $options));

                    }

                }

            }
        }


    }

}
