<?php

namespace App\kit;




class Kit
{


    public static function gerateToken($user_id): string
    {

        $code = time() . '/' . $_SERVER['HTTP_HOST'] . '/' . $user_id;
        $token = base64_encode($code);
        $time = time() * 24;
        setcookie('token', $token, $time);
        return $token;
    }
    public static function decodeToken($token): string
    {
        $token = '';

        if (isset($_COOKIE['token'])) {

            $code = $_COOKIE['token'];
            $decoded = base64_decode($code);

            $decoded = explode('/', $decoded);
            $token = $decoded[sizeof($decoded) - 1];
        }

        return $token;
    }
    public static function destroyToken():void
    {
        setcookie('token', '', 0);
    }
}
