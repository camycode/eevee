<?php

namespace Core\Console\Commands\Route;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;
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

        $routesContent = Storage::get(str_replace(base_path(), '', $routeConfigFile));

        $routesContent = str_replace('];', '', $routesContent);

        $newRoutes = $this->generateRoutes($name);

        foreach ($newRoutes as $newRoute => $value) {

            $newRoute = str_replace('/', '\/', $newRoute);

            if (preg_match("/$newRoute/i", $routesContent)) {

                $this->warn('Route ' . $newRoute . ' has existed');

                unset($newRoutes[$newRoute]);
            } else {
                $this->info('Bind route ' . $newRoute . ' => ' . $value['action']);
            }
        }

        config(['view.paths' => []]);

        View::addLocation(base_path('core/Console/Commands/Route'));

        $routesString = View::make('route', ['routes' => $newRoutes]);

        Storage::put(str_replace(base_path(), '', $routeConfigFile), $routesContent . $routesString);

    }


    protected function generateRoutes($name)
    {
        $name = ltrim(strtolower($name), '/');

        $controllerPath = '';

        $paths = explode('/', $name);

        foreach ($paths as $path) {
            $controllerPath .= ucfirst($path) . '/';
        }

        $controllerNamespacePath = str_replace('/', '\\', rtrim($controllerPath, '/')) . 'Controller';
        $controllerName = ucfirst($paths[count($paths) - 1]);

        $routes = [
            "get@$name" => ['action' => $controllerNamespacePath . '@get' . $controllerName, 'permission' => []],
            "get@$name" . 's' => ['action' => $controllerNamespacePath . '@get' . $controllerName . 's', 'permission' => []],
            "post@$name" => ['action' => $controllerNamespacePath . '@post' . $controllerName, 'permission' => []],
            "put@$name" => ['action' => $controllerNamespacePath . '@put' . $controllerName, 'permission' => []],
            "delete@$name" => ['action' => $controllerNamespacePath . '@delete' . $controllerName, 'permission' => []],
        ];

        return $routes;
    }


}
