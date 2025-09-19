<?php

namespace BananaFramework\Parsers;

use BananaFramework\Contracts\ParserContracts;

class JsonParser implements ParserContracts
{
    public static function parse(string $file, string $keyToReturn): array
    {

        $content = json_decode(file_get_contents($file), true);

        var_dump($content);
        if (!isset($content[$keyToReturn])) {
            throw new \InvalidArgumentException(
                message: "Couldn't find [$keyToReturn] inside [$file]"
            );
        }

        return $content[$keyToReturn];
    }
}
