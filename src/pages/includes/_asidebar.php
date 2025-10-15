<?php

$screens =
    [
        "indice" => "index.php",
        "formulario" => "form.php"

    ];

$page_base = array_key_first($screens);
$page = $page_base;




if (!empty($_GET)) {

    $page = $_GET['page'] ?? $page_base;

    if (!key_exists($page, $screens)) $page = $page_base;
}



?>

