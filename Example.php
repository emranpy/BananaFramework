<?php


require "vendor/autoload.php";

$app = BananaFramework\Application::boot(
    basePath: __DIR__. "/"
);



print_r($app->config()->get(key:'app.name'));