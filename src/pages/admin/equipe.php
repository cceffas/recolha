<?php

use App\pages\components\Modal;

require_once __DIR__ . "/../../controllers/Equipe.php" ?>

<div class="flex flex-col w-full h-full">

    <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">

        <div class="flex flex-col w-full h-full">


            <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
            <!-- end -->
            <?php include_once __DIR__ . "/../includes/title-section.php"; ?>
            <!-- end -->


            <main class="flex flex-col items-center w-full overflow-y-auto grow">


                <div class="container">
                    <?php include_once __DIR__ . "/../includes/tools-panel.php"; ?>
                </div>
                <!-- end -->

                <section class="flex flex-col min-h-96 max-h-[620px] container panel">



                    <table class="text-left">

                        <thead class="">
                            <tr>
                                <th class="p-2">indice</th>
                                <th class="p-2">foto</th>

                                <th class="p-2">Nome</th>
                                <th class="p-2">utilizador</th>
                                <th class="p-2">permissões</th>
                                <th class="p-2">opcções</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($_USERS as $user): ?>
                                <tr class="text-sm text-gray-600 odd:bg-slate-100">
                                    <td class="p-2"><?= $_INDEX++ ?></td>
                                    <td class="p-2"> <img src="public/uploads/<?= $user['foto'] ?>" alt="picture" class="size-8 rounded-full border-2 border-white shadow-md "></td>
                                    <td class="p-2"><?= $user['nome'] ?></td>
                                    <td class="p-2"><?= $user['utilizador'] ?></td>
                                    <td class="p-2"><?= $user['tipo'] ? paint($user['tipo']) : void() ?></td>
                                    <td class="p-2">
                                        <div class="flex items-center gap-2">

                                            <a href="?page=edit" class="btn-option" data-title="editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>

                                            </a>
                                            <!-- end -->
                                            <button data-title="eliminar" onclick="showModal('<?= $user['id'] ?>')" class="btn-option">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </button>
                                            <!-- end -->

                                            <?= Modal::render($user['id'], 'delete'); ?>

                                        </div>
                                    </td>

                                </tr>


                            <?php endforeach ?>
                        </tbody>
                    </table>

                </section>
            </main>


  
        </div>

    </main>

</div>