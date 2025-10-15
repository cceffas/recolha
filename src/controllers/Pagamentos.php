<?php


use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;
use App\kit\FileManeger;
use Carbon\Carbon;

enum Filtro: string
{
    case ANO = "ano";
    case MES = "mes";
    case CODIGO = 'codigo_de_transacao';
}
const TABLE = "pagamento";


$db = new Db();
$db = $db->getConnection();
$moths = ['janeiro', 'fevereiro', 'março', 'maio', 'abril', 'junho', 'julho', 'agosto'];
$_INDEX = 1;
$group_action = ["create", "update", "read", "delete"];
$_ID = null;
$_ACTION = "";
$_SELECT = [];
$_BAIRROS = [];
$_RESULTS = [];
$_IS_SEARCH = false;

$_INPUTS = [
    [
        "label" => "Nome do morador	",
        "type" => 'select',
        "name" => "id_morador",
        "options" => Db::getTable('morador'),
        "required" => true


    ],
    [
        "label" => "Valor pago",
        "type" => 'number',
        "name" => "valor_pago",
        "required" => true

    ],
    [
        "label" => "mês referente",
        "type" => 'select',
        "name" => "mes[]",
        'options' => $moths,
        'multiple' => "multiple",
        "required" => true

    ],
    [
        "label" => "Ano Referente",
        "type" => 'text',
        "name" => "ano",
        "value" => Carbon::now()->format("Y"),
        "required" => true

    ],
    [
        "label" => "Data de Pagamento",
        "type" => 'date',
        "name" => "data_de_pagamento",
        "required" => true

    ],
    [
        "label" => "via de pagamento",
        "type" => 'select',
        "name" => "via_de_pagamento",
        "options" => ["transferencia", "deposito"],
        "required" => true

    ],
    [
        "label" => "Código de transação	",
        "type" => 'text',
        "name" => "codigo_de_transacao",
        "required" => true

    ],
    [
        "label" => "Anexo(.pdf)	",
        "type" => 'file',
        "name" => "anexo",
        "required" => true

    ],
    [
        "label" => "Data de Registo",
        "type" => 'date',
        "name" => "data_de_registo",
        "required" => true

    ],
    [
        "label" => "Funcionário em Serviço",
        "type" => 'select',
        "name" => "id_usuario",
        "options" => [["text" => $_USER['nome'], "value" => $_SESSION['auth']]],
        "required" => true

    ],



];
$_PAGAMENTOS = $db->select(TABLE, '*') ?? [];





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
    $enum_mouth = sizeof($request['mes']);
    $resp = null;



    // Debuger::dd($request['mes']);

    $file = new FileManeger($_FILES['anexo']);


    if ($file->getExtension() !== "pdf") Request::goToPage('/pagamentos', ['error', 'o arquivo selecionado não é um documento pdf...']);

    $request['anexo'] = $file->getName();
    $file->save(__DIR__ . "/../../public/uploads/");


    for ($count = 0; $count < $enum_mouth; $count++) {


        $columns = array_filter($request);

        $columns['mes']= $request['mes'][$count];

        // Debuger::dd($columns);

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
    header('location:/recolha/pagamentos');
    exit;
}

function messageError()
{
    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/pagamentos');
    exit;
}

// function Db::getTable($name): array
// {

//     $resp = [];

//     $result = null;
//     $db = new Db();
//     $db = $db->getConnection();
//     $result = $db->select($name, "*");

//     if ($result) {

//         foreach ($result as $item) {

//             $resp += [["text" => $item['nome'], "value" => $item['id']]];
//         }
//     }

//     return $resp;
// }
