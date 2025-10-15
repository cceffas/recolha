<?php

use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;
use App\models\Notificacoes;

$db = new Db();
$db = $db->getConnection();


const TABLE = "notificacoes";

$_INDEX=1;


// Debuger::dd($_USER);


$_NOTIFICATIONS = [];
$_NOTIFICATIONS = $db->select(TABLE, '*',['id_usuario'=>$_USER['id']]);


// for($n=0;$n<12;$n++){

    
//     $db->insert(TABLE,[
//         'id_usuario'=>$_USER['id'],
//         'sobre'=>"um usuario solicitou um pedido de aprovacao"
//     ]);
// }


Request::post('create', function () {});
Request::post('delete', function ($request) {

    $db = new Db();
    $db = $db->getConnection();

    $id = $request['id'] ?? 0;

    $resp = $db->delete(TABLE, ['id' => $id]);

    if (!$resp) Request::goToPage('notificacoes', ['error', 'não foi possivel executar a operação!']);

    Request::goToPage('notificacoes', ['success', 'operação efetuada com sucesso!']);
});
