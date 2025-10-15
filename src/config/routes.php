<?php


require_once __DIR__."/config.php";



$separate_url = '/';
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode($separate_url, $url);
$uri = $separate_url . $url[sizeof($url) - 1];




$uri_base='/';
$routes = [

    '/' => 'login.php',


];

$private_routes = [

    '/main' => 'admin/main.php',
    '/perfil' => 'admin/perfil.php',
    '/equipe' => 'admin/equipe.php',
    '/notificacoes'=>'admin/notifications.php',
    '/bairros' => 'admin/bairros.php',
    '/instituicoes-moradores' => "admin/moradores.php",
    '/comissao-moradores' => "admin/comissao.php",
    '/ecopontos' => "admin/ecopontos.php",
    '/pagamentos' => 'admin/pagamentos.php',
    '/export-template'=>"template-export-table.php",
    '/adm-acess'=>"adm-acess.php"

];



if (isset($_SESSION['auth'])) {

    $uri_base='/main';
    $routes=['/sair'=>"pages/logout.php"];
    $routes = array_merge($routes, $private_routes);
}


if (!array_key_exists($uri, $routes)) {

    $uri = $uri_base;
}

$absolute_path = __DIR__ . '/../pages/' . $routes[$uri];

if (file_exists($absolute_path)) require_once $absolute_path;
