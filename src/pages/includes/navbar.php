<?php

use App\database\Db;

require_once __DIR__ . "/../../controllers/Usuario.php";
require_once __DIR__ . "/../logout.php";




?>


<header class=" flex items-center justify-center w-full  border-gray-300 border shadow bg-white z-20">


    <div class="container flex items-center justify-between h-16 p-4">

        <span class="flex items-center font-bold">
            <img src="./public/RecolhaSystem.svg" class="size-8 " alt="">
            <h1 class="opacity-50">colha</h1>
        </span>
        <!-- end -->
        <div class="flex items-center gap-4 relative">

            <a href="/recolha/perfil" class="relative flex items-center justify-center font-bold text-sm text-white size-10 p-2 rounded-full hover:cursor-pointer border shadow-md capitalize" data-title="<?= $_USER['nome'] ?>">

                <img src="public/uploads/<?= $_USER['foto'] ?>" class="absolute w-full h-full object-cover top-0 left-0 rounded-full" draggable="false">

                <span class="z-10">
                    <?= str_split($_USER['nome'])[0] ?>
                </span>

            </a>
            <!-- end -->

            <a href="/recolha/equipe" class="btn-option" data-title="equipe">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

            </a>
            <!-- end -->

            <span class="h-8 w-[1px] bg-gray-300"></span>
            <!-- end -->

            <a href="notificacoes" data-title="notificações" class="relative btn-option">

                <?php if ($_NOTIFICATION_COUNT > 0): ?>
                    <span class="absolute top-1 -right-0  flex items-center justify-center text-xs text-white h-4 w-6 bg-red-500 rounded-full"><?= $_NOTIFICATION_COUNT > 9 ? '+9' : $_NOTIFICATION_COUNT ?></span>
                <?php endif; ?>
                
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.8569 17.0817C16.7514 16.857 18.5783 16.4116 20.3111 15.7719C18.8743 14.177 17.9998 12.0656 17.9998 9.75V9.04919C17.9999 9.03281 18 9.01641 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9L5.9998 9.75C5.9998 12.0656 5.12527 14.177 3.68848 15.7719C5.4214 16.4116 7.24843 16.857 9.14314 17.0818M14.8569 17.0817C13.92 17.1928 12.9666 17.25 11.9998 17.25C11.0332 17.25 10.0799 17.1929 9.14314 17.0818M14.8569 17.0817C14.9498 17.3711 15 17.6797 15 18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18C9 17.6797 9.05019 17.3712 9.14314 17.0818" stroke="#0F172A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <!-- end -->


            <span class="h-8 w-[1px] bg-gray-300"></span>
            <!-- end -->

            <button id="btn-menu" class="btn-option" onclick="startMenu()" data-title="menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </button>
            <!-- end -->

            <div class="absolute right-0 top-full hidden panel max-h-84 min-w-48 max-w-84 shadow-2xl mt-4 animate-out" id="menu">

                <ul class="capitalize flex flex-col gap-4">
                    <li>
                        <button class="flex items-center gap-1 text-red-600 cursor-pointer" title="terminar sessão" onclick="showModal('close')">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>

                            terminar sessão
                        </button>
                    </li>
                </ul>

            </div>

        </div>
        <!-- end -->



    </div>


</header>

<?php

use App\pages\components\Modal;

echo Modal::render('close', "sair");

?>