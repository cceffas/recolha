<?php

namespace App\config;


class RouteSystem
{

    private array $routes = [];
    private const PATH_VIEW = __DIR__ . '/../pages/';
    private string $base_uri = "";



    public function base(string $uri, string $page)
    {

        $this->base_uri = $uri;
        $mount_router = [$uri => self::PATH_VIEW . $page . ".php"];
        $this->routes += $mount_router;
    }


    public function add(string $uri, string $page)
    {

        $mount_router = [$uri => self::PATH_VIEW . $page . ".php"];
        $this->routes += $mount_router;
        // Debuger::dd($mount_router);
    }

    public function startView()
    {

        $separate_url = '/';
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = explode($separate_url, $url);
        $uri = $separate_url . $url[sizeof($url) - 1];



        if (array_key_exists($uri, $this->routes)) {


            $file_view = $this->routes[$uri];

            if (file_exists($file_view)) {

                require_once $file_view;
            }
        } else {

            $file_view = $this->routes[$this->base_uri];
            if (file_exists($file_view)) {

                require_once $file_view;
            }
        }
    }
}
