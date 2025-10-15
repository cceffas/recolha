<?php

use App\database\Db;
use App\pages\components\Modal;

include_once __DIR__ . "./../../includes/tools-panel.php";
?>

<!-- end -->

<div class="screen-section panel">

    <?php if (!empty($_ECOPONTOS) && !$_IS_SEARCH): ?>
        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th class="p-2">indice</th>
                    <th class="p-2">Nome</th>
                    <th class="p-2">Bairro</th>
                    <th class="p-2">zona</th>
                    <th class="p-2">codigo</th>
                    <th class="p-2">opções</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                <?php foreach ($_ECOPONTOS as $ecoponto): ?>

                    <tr class="odd:bg-gray-200 even:bg-white outline-sky-500 hover:outline-1">

                        <td class="p-2"><?= $_INDEX++ ?></td>
                        <td class="p-2"><?= $ecoponto['nome'] ?></td>
                        <td class="p-2"><?= Db::idName('bairro', $ecoponto['id_bairro']) ?></td>
                        <td class="p-2"><?= $ecoponto['zona'] ?></td>
                        <td class="p-2"><?= $ecoponto['codigo'] ?></td>

                        <td class="flex p-2 gap-1">

                            <a href="?page=formulario&&id=<?= $ecoponto['id'] ?>" class="btn-option" data-title="editar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <button onclick="showModal(<?= $ecoponto['id'] ?>)" class="btn-option" data-title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <!-- end -->
                        <?= Modal::render($ecoponto['id'], 'delete'); ?>

                    </tr>
                <?php endforeach ?>



            </tbody>

        </table>
        <!-- end -->
    <?php elseif (!empty($_RESULTS) && $_IS_SEARCH): ?>

        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th class="p-2">indice</th>
                    <th class="p-2">Nome</th>
                    <th class="p-2">Bairro</th>
                    <th class="p-2">zona</th>
                    <th class="p-2">codigo</th>
                    <th class="p-2">opções</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                <?php foreach ($_RESULTS as $result): ?>

                    <tr class="odd:bg-gray-200 even:bg-white outline-sky-500 hover:outline-1">


                        <td class="p-2"><?= $_INDEX ?></td>
                        <td class="p-2"><?= $result['nome'] ?></td>
                        <td class="p-2"><?= Db::idName('bairro', $result['id_bairro']) ?></td>
                        <td class="p-2"><?= $result['zona'] ?></td>
                        <td class="p-2"><?= $result['codigo'] ?></td>

                        <td class="flex p-2 gap-1">

                            <a href="?page=formulario&&id=<?= $result['id'] ?>" class="btn-option" data-title="editar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <button onclick="showModal(<?= $result['id'] ?>)" class="btn-option" data-title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <!-- end -->
                        <?= Modal::render($result['id'], 'delete'); ?>

                    </tr>
                    <?php $_INDEX++ ?>
                <?php endforeach ?>

            </tbody>

        </table>
        <!-- end -->
    <?php elseif (empty($_RESULTS) && $_IS_SEARCH): ?>

        <?php require_once __DIR__ . "/../../includes/status/no_result.php" ?>
        <!-- end -->

    <?php else: ?>

        <?php require_once __DIR__ . "/../../includes/status/empty.php" ?>
        <!-- end -->

    <?php endif ?>

</div>