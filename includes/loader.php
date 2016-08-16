<?php

/**
 * 遍历
 */
function load_module_routes(&$app)
{

    $dirs = list_dir(__DIR__ . '/../modules');

    foreach ($dirs as $dir) {

        $file = $dir . '/Config/routes.php';

        if (file_exists($file)) {

            include $file;
        }

    }

}

function load_module_locales()
{

}