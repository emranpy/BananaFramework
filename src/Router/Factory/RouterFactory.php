<?php

declare(strict_types=1);

namespace BananaFramework\Router\Factory;

use League\Route\Router;

class RouterFactory
{
    public static function build(): Router
    {
        return new Router();
    }
}