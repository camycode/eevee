<?php

namespace Core\Controllers;

use Core\Services\Context;
use Illuminate\Support\Facades\Storage;

class PluginController extends Controller
{


    public function getPlugins(Context $context)
    {

    }

    public function getPlugin(Context $context)
    {

    }

    public function getLocalPlugins(Context $context)
    {
        $plugins = [];

        $directories = Storage::directories('/plugins');

        foreach ($directories as $dir) {
            $configPath = base_path($dir . '/config.php');
            if (file_exists($configPath)) {

                $config = require($configPath);

                if (!is_array($config)) {
                    exception('pluginConfigFileShouldReturnArray', ['path' => $configPath]);
                }

                $config['ident]'] = $dir;

                array_push($plugins, $config);
            }
        }

        return $context->response(status('success', $plugins));
    }


    public function deletePlugin(Context $context)
    {

    }

    public function install(Context $context)
    {

    }

    public function uninstall(Context $context)
    {

    }

}