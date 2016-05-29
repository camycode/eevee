<?php 

namespace Core\Models\Permission\Relationship;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Relationship extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化Relationship记录
    protected function initializeRelationship()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // Relationship数据校验
    protected function validateRelationship(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($this->data,$ignore);

        $validator = Validator::make($this->data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取Relationship
    protected function getRelationship($relationship_id)
    {

        if($data = $this->table()->where('relationship_id',$relationship_id)->first()){

            Permission::guard((array)$data, GUARD_GET, 'get');

            return status('success',$data);
        }

        exception('relationshipDoesNotExist');
    }

    // 获取Relationship组
    protected function getRelationships(array $params)
    {

        $data = $this->selector($params);

        Permission::guard($data, GUARD_GET, 'get');

        return status('success', $data);
    }

    // 添加Relationship记录
    protected function addRelationship()
    {

        Permission::guard($this->data, GUARD_ADD , 'add');

        $this->validateRelationship();

        $this->initializeRelationship();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->getRelationship($this->data['id']);

            return $status;

        });

    }

    // 更新Relationship记录
    protected function updateRelationship($relationship_id)
    {

        Permission::guard($this->data, GUARD_UPDATE, 'update');

        $origin = $this->getRelationship($relationship_id)->data;

        $ignore = [

        ];

        $this->validateRelationship($ignore);

        return $this->transaction(function() use($relationship_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('relationship_id','relationship_id')->update($this->data);

            $status = $this->getRelationship($this->data['id']);

            return $status;

        });

    }

    // 删除Relationship记录
    protected function deleteRelationship($relationship_id)
    {

        $origin = $this->getRelationship($relationship_id)->data;

        Permission::guard((array)$origin, GUARD_DELETE, 'delete');

        $this->table()->where('relationship_id')->delete();

        return status('success');
    }


    /**
     * 以角色被删除的权限更新角色的子角色的权限表
     *
     * @param $id
     * @param array $permissions
     *
     */
    protected function updateRoleChildrenPermissions($id, array $permissions)
    {
        $children = $this->resource('ROLE')->where('id', '<>', $id)->where('parent', $id)->lists('id');

        $permissions = $this->getDeletedPermissions($id, $permissions);

        foreach ($children as $child) {

            foreach ($permissions as $permission) {

                $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $child)->where('permission_id', $permission)->delete();
            }
        }
    }

    /**
     * 获取更新用户权限过程中删除的用户权限
     *
     * @param string $id
     * @param array $permissions
     *
     * @return array
     */
    protected function getDeletedPermissions($id, array $permissions)
    {
        return array_diff($this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $id)->lists('permission_id'), $permissions);
    }

    /**
     * 验证角色的权限是否超出可设定范围
     *
     * @param string $parent_id
     * @param array $permissions
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRolePermissons($parent_id, array $permissions)
    {

        if (array_diff($permissions, $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $parent_id)->lists('permission_id'))) {

            if ($this->resource('L:PERMISSIONRELATIONSHIP')->first()) {

                exception('invalidPermissions');
            }
        }

    }

    /**
     * 生成角色权限关系记录
     *
     * @param $id
     * @param $permissions
     *
     * @return array|bool
     */
    protected function generaRolePermissionRelationships($id, array $permissions)
    {
        $data = [];

        foreach ($permissions as $permission_id) {

            $row = [
                'role_id' => $id,
                'permission_id' => $permission_id,
            ];

            array_push($data, $row);
        }

        return $data;

    }

    /**
     * 更新角色权限数
     *
     * @param string $id
     * @param int $amount
     */
    protected function updateRolePermissionAmount($id, $amount)
    {
        $this->resource('ROLE')->where('id', $id)->update(['permission_amount' => $amount]);
    }

    /**
     * 更新角色权限
     *
     * 更新时会替换角色原有权限.
     *
     * @param array $role
     * @param array $permissions
     * @return Status
     */
    protected function updateRolePermisssions(array $role, array $permissions)
    {

        $permissions = array_unique($permissions);


        $this->transaction(function () use ($role, $permissions) {


            $relationships = $this->generaRolePermissionRelationships($role['id'], $permissions);

            $this->validateRolePermissons($role['parent'], $permissions);

            $this->updateRoleChildrenPermissions($role['id'], $permissions);

            $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role['id'])->delete();

            $this->resource('L:PERMISSIONRELATIONSHIP')->insert($relationships);

            $this->updateRolePermissionAmount($role['id'], count($relationships));

        });

    }

    /**
     * 获取角色权限资源归档
     *
     * @param array $items
     *
     * @return Status
     */
    protected function getRolePermissionsArchive(array $items)
    {

        $permissions = array();

        foreach ($items as $item) {

            if ($permission = $this->resource('PERMISSION')->where('id', $item)->first()) {

                array_push($permissions, $permission);
            }
        }

        $result = array();

        foreach ($permissions as $item) {

            if ($resource = $this->resource('RESOURCE')->where('id', $item->resource_id)->first()) {

                $result[$resource->id]['name'] = $resource->name;
                $result[$resource->id]['parent'] = $resource->parent;
                $result[$resource->id]['description'] = $resource->description;
                $result[$resource->id]['source'] = $resource->source;
                $result[$resource->id]['permissions'] = array();
            }
        }

        foreach ($permissions as $permission) {
            array_push($result[$permission->resource_id]['permissions'], $permission);
        }

        return status('success', $result);
    }

    /**
     * 获取角色权限组
     *
     * @param string $id
     * @param bool $archive
     *
     * @return Status
     */
    public function getRolePermissions($id, $archive = false)
    {
        $items = $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $id)->lists('permission_id');

        return $archive ? $this->getRolePermissionsArchive($items) : status('success', $items);

    }
}

