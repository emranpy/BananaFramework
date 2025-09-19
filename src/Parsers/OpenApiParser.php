<?php

namespace BananaFramework\Parsers;


use BananaFramework\Helper\Helper;
use BananaFramework\Parsers\JsonParser;
use BananaFramework\Parsers\YamlParser;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

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
        //file extensions
        $file = pathinfo($file_path);
        $file_extension = $file['extension'];
        $file_name = $file['basename'];


        switch ($file_extension) {
            case "json":
                return JsonParser::parse($file_path, $keyToReturn);

            case "yml":
                return YamlParser::parse($file_path, $keyToReturn);

            default:
                throw new Exception(
                    message: "Unsupported file Extension [$file_name]"
                );
        }
    }
}

