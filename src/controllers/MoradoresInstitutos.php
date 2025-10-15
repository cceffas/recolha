<?php


use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;
use App\kit\FileManeger;


const TABLE = "morador";

enum Filtro: string
{
    case NOME = "nome";
    case EMAIL = "email";
    case BILHETE_DE_IDENTIDADE = "id_documento";
    case COMISSAO_DE_MORADORES = "id_comissao_de_moradores";
    case ECOPONTO = "id_ecoponto";
}


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
        "label" => "Nome Completo",
        "type" => 'text',
        "name" => "nome",
        "required" => true

    ],
    [
        "label" => "Comissão de Moradores Pertencente",
        "type" => 'select',
        "name" => "id_comissao_de_moradores",
        "options" => Db::getTable("comissao_de_moradores"),
        "required" => true

    ],
    [
        "label" => "Designação do Ecoponto Associado	",
        "type" => 'select',
        "name" => "id_ecoponto",
        "options" => Db::getTable('ecoponto'),
        "required" => true

    ],
    [
        "label" => "E-mail",
        "type" => 'email',
        "name" => "email",
        "required" => true

    ],
    [
        "label" => "Nº do Documeneto de Identidade	",
        "type" => 'text',
        "name" => "documento_id",
        "required" => true

    ],
    [
        "label" => "denominação do documento",
        "type" => 'select',
        "name" => "documento_nome",
        "options" => ["Bilhete de identidade", "Passaporte"],
        "required" => true

    ],
    [
        "label" => "ficheiro (.pdf )",
        "type" => 'file',
        "name" => "documento_ficheiro",
        "required" => true

    ],
    [
        "label" => "Número da Casa",
        "type" => 'text',
        "name" => "numero_da_casa",
        "required" => true

    ],
    [
        "label" => "Nome da Rua",
        "type" => 'text',
        "name" => "nome_da_rua",
        "required" => true

    ],
    [
        "label" => "Nivel de Renda do Morador",
        "type" => 'select',
        "name" => "nivel_de_renda",
        'options' => ['baixo', 'medio', 'alto'],
        "required" => true

    ],
    [
        "label" => "Contactos Telefónicos",
        "type" => 'tel',
        "name" => "contactos_telefonicos",
        "required" => true

    ],
    [
        "label" => "Zona de Moradia",
        "type" => 'text',
        "name" => "zona",
        "required" => true

    ],
];
$_MORADORES = $db->select(TABLE, '*') ?? [];


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

    $file = new FileManeger($_FILES['documento_ficheiro']);

    if (!$file->getExtension() === 'pdf') {

        Request::goToPage('/instituicoes-moradores', ["error", 'extensão do documento não é um pdf']);
    }


    $request['documento_ficheiro'] = $file->getName();
    $file->save(__DIR__ . "/../../public/uploads/");

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

    $id = $request['id'] ?? 0;
    $request['id'] = null;


    $new_document_exist = $_FILES['documento_ficheiro']['name'] != null ? true : false;

    if ($new_document_exist) {

        $file = new FileManeger($_FILES['documento_ficheiro']);

  

        if ($file->getExtension() !== 'pdf') Request::goToPage("instituicoes-moradores", ['error', 'tipo de ficheiro invalido']);

        $request['documento_ficheiro'] = $file->getName();
        $file->save(__DIR__ . "/../../public/uploads/");
    }



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
    header('location:/recolha/instituicoes-moradores');
    exit;
}

function messageError()
{
    setcookie('error', 'operação foi falhou!');
    header('location:/recolha/instituicoes-moradores');
    exit;
}
