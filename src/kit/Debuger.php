<?php


namespace App\kit;



class Debuger
{

    public static function dd(...$variable)
    {
        var_dump($variable);
        exit;
    }
}
