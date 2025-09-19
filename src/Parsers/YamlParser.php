<?php

namespace BananaFramework\Parsers;

use BananaFramework\Contracts\ParserContracts;
use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;


class YamlParser implements ParserContracts
{

    public static function parse(string $file, string $keyToReturn): array
    {
        $yaml = Yaml::parseFile(filename: $file);

        if (!isset($yaml[$keyToReturn])) {
            throw new InvalidArgumentException(
                message: "Error Invalid Argument [$keyToReturn] isn't existed in [$file]"
            );
        }

        return $yaml[$keyToReturn];
    }
}
