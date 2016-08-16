<?php

require_once __DIR__ . '/../vendor/autoload.php';



Dotenv::load(__DIR__ . '/../');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Core\Services\App(
    realpath(__DIR__ . '/../')
);


/*
|--------------------------------------------------------------------------
| Register Facades
|--------------------------------------------------------------------------
*/

//$app->withFacades();


/*
|--------------------------------------------------------------------------
| Register Lumen Eloquent
|--------------------------------------------------------------------------
*/

//$app->withEloquent();
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Core\Exceptions\Handler::class
);


$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Core\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     // Illuminate\Cookie\Middleware\EncryptCookies::class,
//     // Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//     // Illuminate\Session\Middleware\StartSession::class,
//     // Illuminate\View\Middleware\ShareErrorsFromSession::class,
//     // Laravel\Lumen\Http\Middleware\VerifyCsrfToken::class,
//     // App\Http\Middleware\AuthMiddleware::class,
// ]);


$app->routeMiddleware([
    'access' => Core\Middleware\Access::class,
    'auth' => Core\Middleware\Authenticate::class,
]);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

//$app->register(Core\Providers\AppServiceProvider::class);
$app->register(Core\Providers\EventServiceProvider::class);
$app->register(Core\Providers\StatusServiceProvider::class);
$app->register(Core\Providers\ContextServiceProvider::class);
$app->register(Core\Providers\RequestServiceProvider::class);


/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

load_module_routes($app);

//require __DIR__ . '/system/routes.php';


return $app;