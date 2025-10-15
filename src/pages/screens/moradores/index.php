<?php

use App\database\Db;
use App\pages\components\Modal;


include_once __DIR__ . "/../../includes/tools-panel.php";

?>

<!-- end -->

<div class="screen-section panel">

    <?php if (!empty($_MORADORES) && !$_IS_SEARCH): ?>
        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th>indice</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Documento</th>
                    <th>comissao de moradores</th>

                    <th>opções</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($_MORADORES as $morador): ?>

                    <tr>

                        <td><?= $_INDEX ?></td>
                        <td><?= $morador['nome'] ?></td>
                        <td><?= $morador['email'] ?></td>
                        <td><a href="./public/uploads/<?= $morador['documento_ficheiro'] ?>" class="link" target="_blank">documento</a></td>
                        <td><?= Db::idName('comissao_de_moradores', $morador['id_comissao_de_moradores']) ?></td>

                        <td class="flex p-2 gap-1">



                            <a href="?page=formulario&&id=<?= $morador['id'] ?>" class="btn-option" title="editar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <button onclick="showModal(<?= $morador['id'] ?>)" class="btn-option" title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <div class="fixed left-0 top-0 h-full w-full hidden items-center justify-center bg-black/30 backdrop-blur-xs" id="<?= 'x-' . $morador['id'] ?>">


                            <article class="flex flex-col w-md min-h-96 panel ">

                                <header class="w-full flex items-center justify-end panel">
                                    <button class="cursor-pointer" onclick="closeModal('<?= 'x-' . $morador['id'] ?>')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>

                                    </button>
                                </header>

                                <?php foreach ($morador as $key => $value): ?>
                                    <div class="flex items-center gap-2 even:bg-gray-200 odd:bg-white p-2">
                                        <h1 class="capitalize font-bold text-base"><?= $key ?>:</h1>
                                        <p><?= $value ?></p>
                                    </div>
                                <?php endforeach ?>

                            </article>


                        </div>
                        <!-- end -->
                        <?= Modal::render($morador['id'], 'delete'); ?>

                    </tr>
                <?php endforeach ?>



            </tbody>

        </table>
        <!-- end -->
    <?php elseif (!empty($_RESULTS) && $_IS_SEARCH): ?>

        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th>indice</th>
                    <th>Nome</th>
                    <th>Bairro</th>
                    <th>zona</th>
                    <th>codigo</th>
                    <th>opções</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($_RESULTS as $result): ?>

                    <tr>


                        <td><?= $morador['nome'] ?></td>
                        <td><?= $morador['nivel_de_renda'] ? "*****" : "****" ?></td>
                        <td><?= $morador['email'] ?></td>
                        <td><?= $morador['zona'] ?></td>

                        <td class="flex p-2 gap-1">


                            <a href="?page=formulario&&id=<?= $result['id'] ?>" class="btn-option" title="editar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <button onclick="showModal(<?= $result['id'] ?>)" class="btn-option" title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <!-- end -->
                        <?= Modal::render($result['id'], 'delete'); ?>

                    </tr>

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