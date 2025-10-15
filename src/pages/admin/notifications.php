<?php

use App\models\Notificacoes;
use App\pages\components\Modal;

require_once __DIR__ . "/../../controllers/NotificacoesController.php";
?>

<div class="flex flex-col w-full h-full">

    <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
    <!-- end -->

    <?php include_once __DIR__ . "/../includes/title-section.php"; ?>
    <!-- end -->

    <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">
        <section class="flex flex-wrap min-h-96 max-h-[620px] container">

            <ul class="flex flex-col items-center gap-2 panel w-full">

                <?php if (!empty($_NOTIFICATIONS)): ?>
                    <?php foreach ($_NOTIFICATIONS as $notification): ?>
                        <li class="w-full">

                            <div class="flex gap-2 w-full panel">

                                <div class="flex flex-col gap-4 truncate">
                                    <h1>solicitação de acção!</h1>
                                    <p class="opacity-60 text-sm"><?= $notification['sobre'] ?></p>
                                    <p class="text-xs opacity-60"><?= date("H:i", $notification['data']) ?></p>

                                    <div class="">
                                        <form action="" class="flex flex-col ">

                                            <span class="flex items-center gap-1 text-blue-500 bg-blue-500/30 p-2 rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                                </svg>

                                                proceder com a acção?
                                            </span>

                                            <p class="p-2 opacity-60 text-sm"><?= $notification['sobre'] ?></p>


                                            <div class="ml-auto flex gap-2">
                                                <button class="btn-option">rejeitar</button>
                                                <button class="btn-option">aceitar</button>
                                            </div>


                                        </form>

                                    </div>

                                </div>

                                <div class="relative ml-auto mb-auto">
                                    <ul class="flex items-center gap-1">
                                        <li>

                                            <button class="btn-option" onclick="showModal('')" data-title="ver">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>


                                            </button>
                                        </li>


                                        <li>
                                            <button class="btn-option" data-title="deletar" onclick="showModal('<?= $notification['id'] ?>')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </button>
                                            <!-- end -->

                                        </li>



                                    </ul>

                                    <?= Modal::render($notification['id'], 'delete'); ?>
                                </div>
                            </div>


                        </li>
                    <?php endforeach ?>

                <?php else: ?>
                    <?php include_once __DIR__ . "/../includes/status/empty.php" ?>
                <?php endif ?>
            </ul>

        </section>
    </main>

</div>