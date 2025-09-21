<?php

namespace BananaFramework\Parsers;

use BananaFramework\Parsers\JsonParser;
use BananaFramework\Parsers\YamlParser;
use Exception;


class OpenApiParser
{

    protected static array $verbs = [
        'get',
        'post',
        'put',
        'delete',
        'patch',
        'option',
        'head',
        'trace'
    ];
    public static function parse($file, $keyToReturn)
    {
        $paths = static::getPath($file, $keyToReturn);

        $routes = [];

        foreach ($paths as $key => $path) {

            foreach ($path as $verb => $item) {
                if (in_array($verb, static::$verbs)) {
                    $routes[] = [
                        "methods" => $verb,
                        "route" => $key,
                        "name" => $item['operationId']
                    ];
                }
            }
        }

        return $routes;
    }

    /**
     * Summary of parse
     * @param string $file_path -   full path c/project/openApi.yaml ..
     * @param string $keyToReturn - key needed to retrive from yaml or json file
     * @throws \Exception - throw exception if file not found
     * @return array    - return an array of the json or yaml
     */

    public static function getPath(string $file_path, $keyToReturn): array
    {
        //file infos
        $file = pathinfo($file_path);
        $file_extension = $file['extension'];
        $file_name = $file['basename'];


        // auto detect parsing file eg .. json ... yaml.. yml
        $result = match($file_extension) {
            "json" => fn() => JsonParser::parse($file_path, $keyToReturn),
            "yaml", "yml" => fn() => YamlParser::parse($file_path, $keyToReturn),
            default => fn() => throw new Exception(
                message: "Unsupported file Extension [$file_name]"
            )
        };

        return $result();
    }

}



