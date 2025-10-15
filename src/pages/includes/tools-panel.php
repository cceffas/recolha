<div class="panel flex items-center justify-between relative">

    <nav>

        <ul class="flex items-center gap-4 h-8">
            <li>
                <button class="btn-option" data-title="adicionar" onclick="showModal('modal-add')">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="ml-1">novo registro</span>
                </button>
            </li>
            <!-- end -->
            <li>
                <span class="flex h-8 w-0.5 bg-gray-300"></span>
            </li>
            <!-- end -->
            <li>
                <a class="btn-option" target="_blank" href="<?=BASE_URL?>export-template?table=<?=TABLE?>" data-title="exportar a tabela como pdf">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>

                    <span class="ml-1">exportar a tabela</span>

                    <span></span>
                </a>
            </li>
        </ul>

    </nav>
    <!-- end -->

    <form class="flex items-center gap-2" method="post">


        <fieldset class="flex items-center gap-2">


            <div class="relative flex items-center justify-center">

                <label class="absolute right-1 bg-gray-100 p-2">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>

                </label>

                <select name="filtre" class="h-10 px-2 lowercase outline-sky-500" required>
                    <option value="" selected disabled>filtro</option>

                    <?php

                    use App\pages\components\Modal;

                    foreach (Filtro::cases() as $filtro): ?>
                        <option value="<?= $filtro->value ?>"><?= $filtro->name ?></option>
                    <?php endforeach ?>


                </select>
            </div>


        </fieldset>

        <!-- end -->
        <fieldset class="relative flex items-center gap-1">

            <input type="hidden" name="action" value="search">


            <div class="flex items-center justify-center relative">

                <input type="text" name="keyword" list="auto-complete">

                <button class="absolute right-2">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                </button>
            </div>

        </fieldset>
        <!-- end -->

    </form>
    <!-- end -->

</div>
<!-- end -->

<div class="hidden justify-center  fixed top-0 left-0 w-full h-full z-[100] bg-black/50 backdrop-blur-md" id="modal-add">

    <div class="flex flex-col m-4 gap-1 bg-white w-2xl min-h-96 max-h-[420px] rounded-md overflow-hidden shadow-2xl">

        <header class="flex items-center justify-end border-b-1 border-gray-300 p-2">

            <button class="btn-option" onclick="closeModal('modal-add')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

        </header>
        <!-- end -->
        <main class="p-2  overflow-y-auto ">
            <form class="flex flex-wrap items-center justify-center  gap-8  panel" method="post" enctype="multipart/form-data">


                <div class="panel w-full flex justify-center items-center">
                    <h1 class="capitalize opacity-50"><?= TABLE ?></h1>

                </div>

                <?php if ($_ID != null): ?>
                    <input type="hidden" name="id" value="<?= $_ID ?>">
                <?php endif ?>

                <input type="hidden" name="action" value="<?= $_ACTION ?>">

                <?php foreach ($_INPUTS as $input): ?>

                    <?php if ($input['type'] != "select"): ?>
                        <fieldset class="flex flex-col grow">
                            <label class='flex items-center gap-2' for="<?= $input['name'] ?>"><?= $input['label'] ?> <?= $input["required"] ? "<i class='text-red-500'>*</i>" : "<p class='text-xs'>opcional</p>" ?></label>
                            <input type="<?= $input['type'] ?>" name="<?= $input['name'] ?>" id="<?= $input['name'] ?>" value="<?= $input["value"] ?? "" ?>" <?= $input["required"] ? "required" : "" ?>>
                        </fieldset>
                    <?php else: ?>
                        <fieldset class="flex flex-col grow">
                            <label class='flex items-center gap-2' for="<?= $input['name'] ?>"><?= $input['label'] ?> <?= $input["required"] ? "<i class='text-red-500'>*</i>" : "<p class='text-xs'>opcional</p>" ?></label>

                            <select name="<?= $input['name'] ?>" id="<?= $input["name"] ?>" <?= $input['multiple'] ?? "" ?>>

                                <?php foreach ($input['options'] as $option): ?>
                                    <option value="<?= $option['value'] ?? $option ?>"><?= $option['text'] ?? $option ?></option>
                                <?php endforeach; ?>

                            </select>
                        </fieldset>
                    <?php endif ?>
                <?php endforeach ?>

                <fieldset class="flex gap-1 items-center w-full justify-end">

                    <button class="btn-secondary" type="reset">cancelar</button>
                    <button class="btn-primary" type="submit" onclick="sendDuplicate('submit')" id="submit">confirmar</button>

                </fieldset>

            </form>
        </main>

    </div>

</div>
<!-- end -->