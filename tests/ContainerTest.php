<?php

declare(strict_types=1);

use BananaFramework\Container;

beforeAll(
    closure: function() {
        $this->container = Container::getInstance();
    }
);