<?php

use App\database\Db;
use App\pages\components\AdminModal;
use App\pages\components\Modal;

require_once __DIR__ . "/../../includes/tools-panel.php"; ?>
<!-- end -->

<div class="screen-section panel">

    <?php if (!empty($_PAGAMENTOS) && !$_IS_SEARCH): ?>
        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th class="p-2">indice</th>
                    <th class="p-2">Nome do morador</th>
                    <th class="p-2">Mês referente</th>
                    <th class="p-2">Ano referente</th>
                    <th class="p-2">Anexo</th>
                    <th class="p-2">funcionario em servico</th>

                    <th class="p-2">opções</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                <?php foreach ($_PAGAMENTOS as $pagamento): ?>

                    <tr class="odd:bg-gray-200 even:bg-white outline-sky-500 hover:outline-1">

                        <td class="p-2"><?= $_INDEX++ ?></td>
                        <td class="p-2"><?= Db::idName('morador', $pagamento['id_morador']) ?></td>
                        <td class="p-2"><?= $pagamento['mes'] ?></td>
                        <td class="p-2"><?= $pagamento['ano'] ?></td>
                        <td class="p-2"><a class="link" href="public/uploads/<?= $pagamento['anexo'] ?>">anexo</a></td>

                        <td class="p-2"><?= Db::idName('usuario', $pagamento['id_usuario']) ?></td>

                        <td class="flex p-2 gap-1">


                            <button onclick="showModal(<?= $pagamento['id'] ?>)" class="btn-option" data-title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <div class="fixed left-0 top-0 h-full w-full hidden items-center justify-center bg-black/30 backdrop-blur-xs" id="<?= 'x-' . $pagamento['id'] ?>">


                            <article class="flex flex-col w-md min-h-96 panel ">

                                <header class="w-full flex items-center justify-end panel">
                                    <button class="cursor-pointer" onclick="closeModal('<?= 'x-' . $pagamento['id'] ?>')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>

                                    </button>
                                </header>

                                <?php foreach ($pagamento as $key => $value): ?>
                                    <div class="flex items-center gap-2 even:bg-gray-200 odd:bg-white p-2">
                                        <h1 class="capitalize font-bold text-base"><?= $key ?>:</h1>
                                        <p class="text-sm"><?= $value ?></p>
                                    </div>
                                <?php endforeach ?>

                            </article>


                        </div>

                        <?php $id = $pagamento['id'] ?>
                        <!-- end -->
                        <div class="fixed top-0 left-0 items-center justify-center w-full h-full hidden bg-black/80 z-50 " id="<?= $id ?>">



                            <div class="relative flex flex-col gap-4 panel w-[420px] bg-white">



                                <header class="absolute left-0 bottom-full w-full bg-white rounded-t-md mb-0.5">

                                    <button class="ml-auto btn-option" onclick="closeModal(<?= $id ?>)">x</button>

                                </header>

                                <p class="text-yellow-600 bg-yellow-600/30 border p-2 rounded-md">
                                    !Acesso negado para efectuar essa operação,
                                    envie o pedido de acesso para um Administrador
                                </p>

                                <form method="post">

                                    <input type="hidden" name="action" value="get-acess">

                                
                                    <input type="hidden" name="id_usuario" value="<?= $_USER ?>">


                                    <input type="hidden" name="tabela" value="<?=TABLE?>">

                                    <input type="hidden" name="id_item" value="<?=$id?>">



                                    <fieldset class="flex flex-col">
                                        <label for="">Obs:</label>
                                        <textarea name="obs" id="xk"></textarea>
                                    </fieldset>
                                    <button class='ml-auto btn-primary'>enviar</button>
                                </form>

                            </div>

                        </div>

                        <!-- end -->

                    </tr>
                    <?php $_INDEX++ ?>
                <?php endforeach ?>



            </tbody>

        </table>
        <!-- end -->
    <?php elseif (!empty($_RESULTS) && $_IS_SEARCH): ?>

        <table class="text-left w-full ">

            <thead>
                <tr>
                    <th class="p-2">indice</th>
                    <th class="p-2">Nome do morador</th>
                    <th class="p-2">Mês referente</th>
                    <th class="p-2">Ano referente</th>
                    <th class="p-2">funcionario em servico</th>
                    <th class="p-2">opções</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                <?php foreach ($_RESULTS as $result): ?>

                    <tr class="odd:bg-gray-200 even:bg-white outline-sky-500 hover:outline-1">

                        <td class="p-2"><?= $_INDEX++ ?></td>
                        <td class="p-2"><?= Db::idName('morador', $result['id_morador']) ?></td>
                        <td class="p-2"><?= $result['mes'] ?></td>
                        <td class="p-2"><?= $result['ano'] ?></td>
                        <td class="p-2"><?= Db::idName('usuario', $result['id_usuario']) ?></td>

                        <td class="flex items-center gap-1">



                            <button onclick="showModal(<?= $result['id'] ?>)" class="btn-option" data-title="deletar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </td>

                        <div class="fixed left-0 top-0 h-full w-full hidden items-center justify-center bg-black/30 backdrop-blur-xs" id="<?= 'x-' . $result['id'] ?>">


                            <article class="flex flex-col w-md min-h-96 panel ">

                                <header class="w-full flex items-center justify-end panel">
                                    <button class="cursor-pointer" onclick="closeModal('<?= 'x-' . $result['id'] ?>')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>

                                    </button>
                                </header>

                                <?php foreach ($result as $key => $value): ?>
                                    <div class="flex items-center gap-2 even:bg-gray-200 odd:bg-white p-2">
                                        <h1 class="capitalize font-bold text-base"><?= $key ?>:</h1>
                                        <p class="text-sm"><?= $value ?></p>
                                    </div>
                                <?php endforeach ?>

                            </article>


                        </div>
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