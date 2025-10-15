<?php

use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;
use App\kit\FileManeger;

$db = new Db();
$db = $db->getConnection();



enum UserPicture: string
{

    case G1 = 'g1.webp';
    case G2 = 'g2.webp';
    case G3 = 'g3.webp';
    case G4 = 'g4.webp';
}

enum Filtro: string
{

    case NOME = "nome";
    case EXTENSAO = "extensao";
    case HABITANTES = "qtd_habitantes";
}


enum UserAccess
{

    case ROOT;
    case ADM;
    case USER;
}


$_ID=1;

const TABLE = 'usuario';
$_INDEX = 0;
$_USERS = [];
$_INPUTS = [
    [
        'label' => 'Nome',
        'name' => 'nome',
        'type' => 'text',
        'required' => true
    ],
    [
        'label' => 'nome de utilizador',
        'name' => 'utilizador',
        'type' => 'text',
        'required' => true
    ],
    [
        'label' => 'senha',
        'name' => 'senha',
        'type' => 'text',
        'required' => true
    ],
    [
        'label' => 'selecione uma foto',
        'name' => 'foto',
        'type' => 'file',
        'required' => false
    ],
    [
        'label' => 'Tipo de usuario',
        'name' => 'tipo',
        'type' => 'select',
        'required' => true,
        'options' => [
            [
                'value' => UserAccess::ADM->name,
                'text' => 'administrador'
            ],
            [
                'value' => UserAccess::USER->name,
                'text' => 'utilizador'
            ],
            [
                'value' => UserAccess::ROOT->name,
                'text' => 'raiz'
            ]
        ]
    ],


];
$_USERS = $db->select(TABLE, '*');
$extension_picture_accepted = ['png' => 0, 'jpg' => 1];


Request::post("create", function ($request) {

    global $extension_picture_accepted;

    $db = new Db();
    $db = $db->getConnection();
    $resp = null;

    $request['senha'] = password_hash($request['senha'], PASSWORD_BCRYPT);


    if (!isset($request['foto'])) {


        $max_itens = sizeof(UserPicture::cases());
        $random_picture = random_int(0, $max_itens - 1);
        $request += ['foto' => UserPicture::cases()[$random_picture]->value];
    } else {


        $file = new FileManeger($_FILES['foto']);

        if (array_key_exists($file->getExtension(), $extension_picture_accepted)) {

            $file->save('public/uploads/');
            $request['foto']=$file->getName();
        }
    }
    
  

    $columns = array_filter($request);

    // Debuger::dd($columns);

    $verify_user_exist = $db->get(TABLE, 'nome', ['nome' => $request['nome']]);

    if (empty($verify_user_exist)) {

        $resp = $db->insert(TABLE, $columns);
    }

    if ($resp) {

        messageSuccess();
    }

    messageError();
});

Request::post("delete", function ($request) {


    $db = new Db();
    $db = $db->getConnection();
    $id = $request['id'] ?? 0;


    $resp = $db->delete(TABLE, ['id' => $id]);

    if ($resp) {

        messageSuccess();
    }


    messageError();
});




function messageSuccess()
{
    setcookie('success', 'operação foi efectuada com exito!');
    header('location:/recolha/equipe');
    exit;
}

function messageError()
{
    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/equipe');
    exit;
}
