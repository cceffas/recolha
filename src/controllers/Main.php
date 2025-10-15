<?php

use App\controllers\base\Request;
use App\database\Db;
use App\kit\Debuger;

$db = new Db();
$db = $db->getConnection();


$_GRAPHIC_LABELS = [
    "bairros",
    "comissão de moradores",
    "ecopontos",
    "Moradores",
    "pagamentos"

];
$_GRAPHIC_VALUES = [
    $db->count('bairro'),
    $db->count('comissao_de_moradores'),
    $db->count('ecoponto'),
    $db->count('morador'),
    $db->count('pagamento'),

];


$_NOTIFICATION_COUNT=$db->count('notificacoes',['status'=>0,'id_usuario'=>$_USER['id'] ?? 0]);





function getIcon(string $name): string
{


    $_icon = "";
    $_absolute_path = __DIR__ . "/../../public/svg/" . $name . ".svg";

    if (file_exists($_absolute_path)) {

        $icon = file_get_contents($_absolute_path);
    } else {

        $icon = "<mark>(:</mark>";
    }

    return $icon;
}



$_CARDS = [
    [
        "title" => "Bairros",
        "icon" => getIcon('bairro'),
        "url" => "bairros"
    ],
    [
        "title" => "Comissão de moradores",
        "icon" => getIcon('comissaoimoradores'),
        "url" => "comissao-moradores"
    ],
    [
        "title" => "Ecopontos",
        "icon" => getIcon('ecopontos'),
        "url" => "ecopontos"
    ],
    [
        "title" => "Moradores & instituições",
        "icon" => getIcon("ins"),
        "url" => "instituicoes-moradores"
    ],
    [
        "title" => "Pagamentos",
        "icon" => getIcon("pagamentos"),
        "url" => "pagamentos"
    ]
];


Request::post('get-acess', function ($request) {

    Debuger::dd($request);
    
});










