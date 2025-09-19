<?php

namespace BananaFramework\Helper;

function yesOrNo($input)
{
    return strtolower($input[0]) == 'y' ? true : false;
}


function dump($args)
{
    if (is_array($args)) {
        var_dump(array_keys($args));
    }
}


class Helper
{


    public static function dump($args)
    {
        if (is_array($args)) {
            var_dump(array_keys($args));
        }



    }
}