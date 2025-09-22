<?php

use Minicli\Input;


require "vendor/autoload.php";

$yaml = BananaFramework\Parsers\OpenApiParser::parse(
    file: __DIR__ . '/openapi.yml',
    keyToReturn: 'paths'
);


