<?php


use App\controllers\base\Request;
use App\database\Db;




$_INDEX = 1;

$table_name = $_GET['table'] ?? "";

$db = new Db();
$db = $db->getConnection();

$rows_table = $db->select($table_name, '*');
// use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf =new DOMPDF();



$dompdf->load_html('helo world');


// $dompdf->loadHtml('hello world');

// // (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');

// // Render the HTML as PDF
$dompdf->render();

// // Output the generated PDF to Browser
// // $dompdf->stream();




if (empty($rows_table)) {

    Request::goToPage('/bairros', ["alert", "não existe itens"]);
}




?>



<table>

    <tbody>

        <?php foreach ($rows_table as $row): ?>

            <tr>

                <?php foreach ($row as $item): ?>
                    <td><?= is_int($item) ? $_INDEX++ : $item ?></td>
                <?php endforeach ?>
            </tr>

        <?php endforeach ?>
    </tbody>

</table>