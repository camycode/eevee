<?php

if (!file_exists('install.lock')) {
    
}


$app = require __DIR__ . '/bootstrap.php';



$app->run();
