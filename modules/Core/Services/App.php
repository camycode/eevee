<?php

namespace Core\Services;

use Laravel\Lumen\Application as Lumen;

class App extends Lumen
{
    /**
     * 定义配置文件
     *
     * @var array
     */
    protected static $configures = [
        'app',
        'mail',
        'queue',
        'view',
        'cache',
        'session',
        'database',
        'filesystems',
        'broadcasting',
    ];

    /**
     * 应用构造函数
     *
     * @param null|string $basePath
     */
    public function __construct($basePath)
    {
        date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

        $this->basePath = $basePath;

        $this->bootstrapContainer();

        $this->registerErrorHandling();

        $this->setConfigures();

//        $this->setPermissionRoutes(config('routes'));
    }

    /**
     * 注册系统默认配置文件
     */
    protected function setConfigures()
    {
        foreach (self::$configures as $file) {

            $this->configure($file);
        }
    }

    /**
     * 获取语言文件路径
     *
     * @TODO 需要遍历语言文件
     *
     * @return string
     */
    protected function getLanguagePath()
    {
        return base_path('/modules/Core/Locale');
    }

    /**
     * 获取项目核心文件路径
     *
     * @TODO 需要确定核心文件用法
     *
     * @return string
     */
    public function path()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'modules'. DIRECTORY_SEPARATOR .'Core';
    }

    /**
     * 获取资源存储路径
     *
     * @param null $path
     *
     * @return string
     */
    public function storagePath($path = null)
    {
        if ($this->storagePath) {
            return $this->storagePath . ($path ? '/' . $path : $path);
        }

        return $this->basePath() . '/content/storage' . ($path ? '/' . $path : $path);
    }

    /**
     * 获取数据库迁移文件路径
     *
     * @TODO 需遍历数据迁移文件
     *
     * @return string
     */
    public function databasePath()
    {
        return $this->basePath('modules/Core/Database');
    }

    /**
     * 获取配置文件路径
     *
     * @TODO 需要定制每个模块配置文件
     *
     * @param null $name
     *
     * @return string
     */
    public function getConfigurationPath($name = null)
    {
        if (!$name) {

            $appConfigDir = ($this->configPath ?: $this->basePath('includes/config')) . '/';

            if (file_exists($appConfigDir)) {

                return $appConfigDir;
            }

            return base_path('includes/config/');

        } else {

            $appConfigPath = ($this->configPath ?: $this->basePath('includes/config')) . '/' . $name . '.php';

            if (file_exists($appConfigPath)) {

                return $appConfigPath;
            }

            return base_path("includes/config/$name.php");
        }

    }



//    protected function setPermissionRoutes($routes)
//    {
//        $this->group(['middleware' => 'auth', 'namespace' => 'Core\Controllers'], function () use ($routes) {
//
//            foreach ($routes as $route => $params) {
//
//
//                list($method, $uri) = explode('@', $route);
//
//                if (isset($params['action'])) {
//
//                    $this->addRoute(strtoupper($method), $uri, $params['action']);
//                } else {
//
//                    throw new \Exception("The route $route action is empty", 1);
//                }
//            }
//
//        });
//
//        $this->group(['prefix' => 'api/plugin', 'middleware' => 'auth', 'namespace' => 'Plugin'], function () {
//
////            $this->registerPluginsRoutes();
//
//        });
//
//
//    }


//    protected function registerPluginsRoutes()
//    {
//        $plugins = $this->getDirectories(__DIR__ . "/../../plugins");
//
//        foreach ($plugins as $plugin) {
//
//            $route_file = $plugin['path'] . '/routes.php';
//
//            if (file_exists($route_file)) {
//
//                $prefix = $plugin['name'] . '/';
//
//                $namespace = ucwords($plugin['name']);
//
//                $routes = require($route_file);
//
//                foreach ($routes as $route => $params) {
//
//
//                    list($method, $uri) = explode('@', $route);
//
//
//                    if (isset($params['action'])) {
//
//                        $this->addRoute(strtoupper($method), $prefix . $uri, $namespace . '\\' . $params['action']);
//
//                    } else {
//
//                        throw new \Exception("The plugin $namespace route $route action is empty", 1);
//
//                    }
//
//                }
//            }
//        }
//
//    }
//
//    protected function getDirectories($path)
//    {
//        $result = [];
//
//        $items = scandir($path);
//
//        foreach ($items as $item) {
//
//            if ($item != '.' && $item != '..') {
//
//                if (is_dir($path . '/' . $item)) {
//
//                    array_push($result, ['name' => $item, 'path' => $path . '/' . $item]);
//                }
//            }
//        }
//
//        return $result;
//    }


}
