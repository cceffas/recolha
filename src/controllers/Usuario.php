<?php

use App\controllers\base\Request;
use App\database\Db;
use App\kit\Kit;
use App\kit\Debuger;


$db = new Db();
$db = $db->getConnection();
$_USER = [];

$_user = [];
$users = $db->select("usuario", "*");

if (empty($users)) {

    $name = "pedro Moises Julieta";
    $user_name = "admin";
    $password = password_hash("123456", PASSWORD_DEFAULT);

    $db->insert("usuario", [
        "nome" => $name,
        "utilizador" => $user_name,
        "senha" => $password
    ]);
}




Request::post('auth', function ($request) {

    $db = new Db();
    $db = $db->getConnection();

    $user_name = $request['name'];
    $user_password = $request['password'];

    $_user = $db->get('usuario', '*', ["nome" => $user_name]);


    if (!empty($_user)) {




        if (password_verify($user_password, $_user['senha'])) {

            $_SESSION['auth'] = $_user['id'];
            $new_token = Kit::gerateToken($_user['id']);
            $db->update('usuario', ['token' => $new_token], ['id' => $_user['id']]);
        } else {

            setcookie("error", "credencias invalidos!");
            header('location: /recolha/main');
            exit;
        }
    } else {

        setcookie("error", "credencias invalidos!");
        header('location: /recolha/main');
        exit;
    }
});





if (!empty($_SESSION['auth'])) {

    $id = $_SESSION['auth'];
    $_USER = $db->get('usuario', ['id', 'nome', 'utilizador', 'tipo', 'foto'], ['id' => $id]);

    if (!empty($_USER)) {

        $_USER = $_USER;
    }
}
