<?php

/*
|--------------------------------------------------------------------------
| Check System Is Installed.
|--------------------------------------------------------------------------
| Installing system may create related database, and set base data, such as
| create root role and user, generate system menu.
|
*/

if (!file_exists('install.lock')) {
}


require_once __DIR__ . '/vendor/autoload.php';


Dotenv::load(__DIR__ . '/');

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

$app = new Core\Services\Application(
    realpath(__DIR__ . '/')
);


/*
|--------------------------------------------------------------------------
| Register Facades
|--------------------------------------------------------------------------
*/

$app->withFacades();


/*
|--------------------------------------------------------------------------
| Register Lumen Eloquent
|--------------------------------------------------------------------------
*/

$app->withEloquent();
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
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();