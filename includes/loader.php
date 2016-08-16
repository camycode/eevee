<?php


function load_plugins()
{

}

function load_themes()
{

}


/**
 * 注册模块配置文件
 *
 * 模块配置文件存放在每个模块的Config目录下, 注册时以模块名称小写为前缀加点好连接, 如(core.app.key)。
 * 注: 会过滤掉 routes.php 路由注册文件。
 *
 * @param $app          Core\Services\App 应用实例
 * @param $module_path  string            模块路径
 *
 * @return void
 */
function set_modules_configures(&$app, $module_path)
{
    $configs = list_files($module_path . DIRECTORY_SEPARATOR . 'Config');

    $module = strtolower(basename($module_path));

    foreach ($configs as $config) {

        $basename = basename($config);

        if ($basename != 'routes.php') {

            $app->setModuleConfigures($module.'.'.str_replace(strrchr($basename, "."), "", $basename),$config);

        }

    }

}


/**
 * 加载系统模块
 *
 * 为系统添加多模块机制, 为每一个模块注册路由配置、
 * 视图渲染、 配置文件、本地化和数据库迁移能力。
 *
 * @param $app Core\Services\App 应用实例
 *
 * @return void
 */
function load_modules(&$app)
{

    $dirs = list_dirs(__DIR__ . '/../modules');

    foreach ($dirs as $dir) {

        $file = $dir . '/Config/routes.php';

        if (file_exists($file)) {

            include $file;
        }

        set_modules_configures($app, $dir);

    }

}

