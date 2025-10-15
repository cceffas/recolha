<?php



if (!empty($_POST)) {

    $action = $_POST['action'] ?? null;

    if ($action === 'sair') {

        session_destroy();
        header("location: /recolha");
        exit;
    }
}
