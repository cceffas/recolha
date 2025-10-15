<?php

use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;

enum Filtro: string
{

    case NOME = "nome";
    case EXTENSAO = "extensao";
    case HABITANTES = "qtd_habitantes";
}


const TABLE = 'bairro';

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
$_BAIRROS = $db->select('bairro', "*") ?? [];


$_INPUTS = [

    [
        'label' => 'nome do bairro',
        'type' => 'text',
        'name' => 'nome',
        'required' => true
    ],
    [
        'label' => 'extensao',
        'type' => 'text',
        'name' => 'extensao',
        'required' => true
    ],
    [
        'label' => 'Nº de habitantes',
        'type' => 'number',
        'name' => 'qtd_habitantes',
        'required' => true
    ],
    [
        'label' => 'Nº de ruas',
        'type' => 'number',
        'name' => 'qtd_ruas',
        'required' => true
    ],
    [
        'label' => 'Descrição',
        'type' => 'textarea',
        'name' => 'descricao',
        'required' => true
    ],
    [
        'label' => 'Area geometrica',
        'type' => 'text',
        'name' => 'area',
        'required' => false
    ]



];



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
        $table = $db->select(TABLE, '*', ["id" => $id]);


        if ($table) {

            $count = 0;
            foreach ($_INPUTS as $input) {

                $_INPUTS[$count] = array("value" => $table[0][$input["name"]]) + $input;
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
    $id = (int) $request['id'] ?? 0;
    $request['id'] = null;
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
    header('location:/recolha/bairros');
    exit;
}

function messageError()
{
    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/bairros');
    exit;
}



// $result=$db->query('describe '.TABLE);

// $thead=$result->fetchAll();

// // Debuger::dd($thead);

// foreach($thead as $th){

//     echo "<h1>{$th[0]}</h1>";
// }
// Debuger::dd();
