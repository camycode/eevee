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


$app = require __DIR__.'/bootstrap.php';


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
