<?php

namespace Core\Console\Commands\Route;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:routes {controller name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bind routes with target controller.';


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('controller name');

        $routeConfigFile = base_path('core/System/config/routes.php');

        $routes = require($routeConfigFile);

        $newRoutes = $this->generateRoutes($name);

        foreach ($newRoutes as $newRoute => $value) {

            if (in_array($newRoute, $routes)) {

                unset($newRoutes[$newRoute]);
            } else {

                $routes[$newRoute] = $value;
            }

        }

        if ($newRoutes) {

            Storage::put(str_replace(base_path(), '', $routeConfigFile), print_r($routes, true));

            $this->info('Bind routes success.');

            var_dump($newRoutes);

        } else {
            $this->info('No route bingd.');
        }


    }


    protected function generateRoutes($name)
    {
        $name = ltrim(strtolower($name), '/');

        $controllerPath = '';

        $paths = explode($name, '/');

        foreach ($paths as $path) {
            $controllerPath .= ucfirst($path) . '/';
        }

        $controllerPath = rtrim($controllerPath, '/');
        $controllerName = ucfirst($paths[count($paths) - 1]);

        return [
            "get@$name" => ['action' => $controllerPath . '@get' . $controllerName, 'permission' => []],
            "get@$name" => ['action' => $controllerPath . '@get' . $controllerName . 's', 'permission' => []],
            "post@$name" => ['action' => $controllerPath . '@post' . $controllerName, 'permission' => []],
            "put@$name" => ['action' => $controllerPath . '@put' . $controllerName, 'permission' => []],
            "delete@$name" => ['action' => $controllerPath . '@delete' . $controllerName, 'permission' => []],
        ];
    }


}
