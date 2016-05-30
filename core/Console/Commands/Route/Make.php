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

            if (preg_match("/'$newRoute'/", $routesContent)) {

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

        $controllerPath = rtrim($controllerPath, '/') . 'Controller';
        $controllerName = ucfirst($paths[count($paths) - 1]);

        $routes = [
            "get@$name" => ['action' => $controllerPath . '@get' . $controllerName, 'permission' => []],
            "get@$name" . 's' => ['action' => $controllerPath . '@get' . $controllerName . 's', 'permission' => []],
            "post@$name" => ['action' => $controllerPath . '@post' . $controllerName, 'permission' => []],
            "put@$name" => ['action' => $controllerPath . '@put' . $controllerName, 'permission' => []],
            "delete@$name" => ['action' => $controllerPath . '@delete' . $controllerName, 'permission' => []],
        ];

        return $routes;
    }


}
