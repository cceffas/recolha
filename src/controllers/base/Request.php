<?php

namespace App\controllers\base;




class Request
{

    public static function get(string $route, callable $function)
    {

        if (!empty($_GET)) {

            $function($_GET);
        }
    }

    public static function post(string $route, callable $function)
    {

        if (!empty($_POST) && isset($_POST['action'])) {


            if ($_POST['action'] === $route) {

                $_POST['action'] = null;
                $function($_POST);
            }
        }
    }

    public static function goToPage(string $route, array $message = [])
    {



        if (!empty($message)) {

            $type = $message[0] ?? "type{success or error}";
            $text = $message[1] ?? "text{lorem....}";
            setcookie($type, $text);
        }

        header('location:' . BASE_URL . $route);
        exit;
    }
}
