<?php

use App\database\Db;
use App\kit\Debuger;
use App\models\Notificacoes;
use App\pages\components\Modal;

session_start();


require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/config/showError.php";
require_once __DIR__ . "/src/controllers/Usuario.php";
require_once __DIR__."/src/controllers/Main.php";

function paint(string $text): string
{


    return <<<HTML
    <p class='flex items-center justify-center max-w-16 text-sky-600 border bg-sky-600/30 rounded-md text-shadow-sm text-xs'>
        {$text}
    </p>

    HTML;
}
function void(): string
{


    return <<<HTML
    <p class='flex items-center justify-center max-w-16 text-yellow-600 border bg-yellow-600/30 rounded-md text-shadow-sm text-xs'>
        vazio
    </p>

    HTML;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/RecolhaSystem.svg" type="image/x-icon">
    <title><?=$title_app ?? "App" ?></title>
    <link rel="stylesheet" href="./public/style.css">
</head>

<body class="relative w-full h-screen bg-gray-200">

<!-- 
  <div class="fixed flex justify-center items-center left-0 top-0 w-full h-full bg-white/30 backdrop-blur-md z-50" id="loander">

        sgl

        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>  -->



    <?php

    require_once __DIR__ . "/src/pages/includes/messages.php";
    require_once __DIR__ . "/src/config/routes.php";
    ?>

    <script src="./public/js/app.js" defer></script>
</body>

</html>