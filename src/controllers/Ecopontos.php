<?php


use App\controllers\base\Request;
use App\database\Db;

enum Filtro: string
{
    case NOME = 'nome';
    case ENDERECO = 'endereco';
    case CODIGO = "codigo";
    case BAIRRO = 'bairro';
}
const TABLE = "ecoponto";

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
        "label" => "Nome",
        "type" => 'text',
        "name" => "nome",
        "required" => true

    ],
    [
        "label" => "zona",
        "type" => 'number',
        "name" => "zona",
        "required" => true
    ],
    [
        "label" => "codigo",
        "type" => 'text',
        "name" => "codigo",
        "required" => true

    ],
    [
        "label" => "endereço",
        "type" => 'number',
        "name" => "endereco",
        "required" => true

    ]
];
$_ECOPONTOS = $db->select(TABLE, '*') ?? [];


foreach ($db->select('bairro', "*") as $bairro) {

    $_SELECT = array_merge([["name" => "id_bairro", "value" => $bairro['id'], "text" => $bairro['nome']]], $_SELECT);
}

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
        $ecoponto = $db->select(TABLE, '*', ["id" => $id]);


        if ($ecoponto) {
            $count = 0;
            foreach ($_INPUTS as $input) {

                $_INPUTS[$count] = array("value" => $ecoponto[0][$input["name"]]) + $input;
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

        messageSuccess();
    }

    messageError();
});

Request::post("delete", function ($request) {


    $db = new Db();
    $db = $db->getConnection();
    $id = $request['id'] ?? 0;
    $request['id'] = null;
    $columns = array_filter($request);

    $resp = $db->delete(TABLE, ['id' => $id]);

    if ($resp) {

        messageSuccess();
    }


    messageError();
});
Request::post('update', function ($request) {
    $db = new Db();
    $db = $db->getConnection();
    $id = (int) $request['id_comissao'] ?? 0;
    $request['id_comissao'] = null;
    $columns = array_filter($request);



    $resp = $db->update(TABLE, $columns, ['id' => $id]);

    if ($resp) {

        messageSuccess();
    }


    messageError();
});


function messageSuccess()
{
    setcookie('success', 'operação foi efectuada com exito!');
    header('location:/recolha/ecopontos');
    exit;
}

function messageError()
{
    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/ecopontos');
    exit;
}
