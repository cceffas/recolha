<?php

use App\controllers\base\Request;
use App\database\Db;

enum Filtro:string
{
    case NOME='nome';
    case PRESIDENTE='presidente';
    case ZONA='zona';
    case BAIRRO='bairro';
}
const TABLE = "comissao_de_moradores";




$db = new Db();
$db = $db->getConnection();
$_INDEX = 0;
$group_action = ["create", "update", "read", "delete"];
$_ID = null;
$_ACTION = "";
$_SELECT = [];
$_BAIRROS = [];
$_RESULTS = [];
$_IS_SEARCH = false;
$_INPUTS = [
    [
        "label" => "Nome da comissão",
        "type" => 'text',
        "name" => "nome",
        "required" => true
    ],
    [
        "label" => "Presidente",
        "type" => 'text',
        "name" => "presidente",
        "required" => true
    ],
    [
        "label" => "contactos telefonico",
        "type" => 'tel',
        "name" => "contactos_telefonicos",
        "required" => false
    ],
    [
        "label" => "Bairro",
        "type" => 'select',
        "name" => "id_bairro",
        'options'=>Db::getTable('bairro'),
        "required" => false
    ],

    [
        "label" => "zona",
        "type" => 'number',
        "name" => "zona",
        "required" => true
    ]
];
$_COMISSOES = $db->select(TABLE, '*') ?? [];

$_ACTION = $group_action[0];


Request::get("", function ($request) {

    global $_INPUTS;
    global $group_action;
    global $_ACTION;
    global $_ID;



    $id = $request['id'] ?? null;

    if ($id) {

        $db = new Db();
        $db = $db->getConnection();
        $comissao = $db->select(TABLE, '*', ["id" => $id]);


        if ($comissao) {
            $count = 0;
            foreach ($_INPUTS as $input) {

                $_INPUTS[$count] = array("value" => $comissao[0][$input["name"]]) + $input;
                $count++;
            }

            $_ID = $id;
        }

        $_ACTION = $group_action[1];
    }
});


Request::post("search", function ($request) {

    global $_RESULTS;
    global $_IS_SEARCH;

    $db = new Db();
    $db = $db->getConnection();





    $filtre = $request['filtre'];
    $keyword = $request['keyword'];
    $_RESULTS = $db->select(TABLE, "*", [$filtre => $keyword]);
    $_IS_SEARCH = true;
});

Request::post("create", function ($request) {

    $db = new Db();
    $db = $db->getConnection();

    $columns = array_filter($request);
    $resp = $db->insert(TABLE, $columns);

    if ($resp) {

        setcookie('success', 'operação foi efectuada com exito!');
        header('location:/recolha/comissao-moradores');
        exit;
    }


    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/comissao-moradores');
    exit;
});

Request::post("delete", function ($request) {


    $db = new Db();
    $db = $db->getConnection();
    $id = $request['id'] ?? 0;


    $resp = $db->delete(TABLE, ['id' => $id]);

    if ($resp) {

        setcookie('success', 'operação foi efectuada com exito!');
        header('location:/recolha/comissao-moradores');
        exit;
    }


    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/comissao-moradores');
    exit;
});
Request::post('update', function ($request) {
    $db = new Db();
    $db = $db->getConnection();
    $id = (int) $request['id'] ?? 0;
    $request['id'] = null;
    $columns = array_filter($request);



    $resp = $db->update(TABLE, $columns, ['id' => $id]);

    if ($resp) {

        setcookie('success', 'operação foi efectuada com exito!');
        header('location:/recolha/comissao-moradores');
        exit;
    }


    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/comissao-moradores');
    exit;
});
