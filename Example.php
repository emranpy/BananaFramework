<?php

use BananaFramework\Application;

require "vendor/autoload.php";


$app = Application::boot(
    basePath: __DIR__  . '/'
);

$app->run();