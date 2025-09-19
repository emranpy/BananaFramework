<?php


namespace BananaFramework\Contracts;


interface ParserContracts
{
    public static function parse(string $file, string $keyToReturn): array;
}



