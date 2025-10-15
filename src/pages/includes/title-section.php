<?php


$uri = $_SERVER['REQUEST_URI'];
$title_section = parse_url($uri, PHP_URL_PATH);
$title_section = explode('/', $title_section);
$title_section = $title_section[sizeof($title_section) - 1];

$back_page_url = "/" . explode('/', $uri)[1] . "/main";

?>



<div class="flex  justify-center items-center w-full mt-4">

    <div class="container panel">

        <div class="flex items-center justify-between">



            <a href="<?= $back_page_url ?>" class="btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>

                voltar
            </a>


     
     
        </div>

    </div>
</div>