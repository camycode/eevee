<?php
/**
 * EEVEE 资源模型
 *
 * 每一种可操作的逻辑对象, 都可以定义为资源, 包括且不限于数据表操作, 资源的相关操作以模型定义.
 *
 * @author 古月
 */


use Core\Models\StaticModel as Model;

class Resource
{

    protected static function validateResource()
    {

    }

    public static function getResource($Resource_id)
    {

    }

    public static function getResources(array $params)
    {

    }

    public static function addResource(array $data)
    {
        Permission::guard();

        Model::resource('resource')->add($data);

        return status('success');
    }

    public static function updateResource(array $data)
    {

    }

    public static function deleteResource($Resource_id)
    {

    }


}

