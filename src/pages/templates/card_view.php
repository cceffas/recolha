<div class="fixed left-0 top-0 h-full w-full hidden items-center justify-center bg-black/30 backdrop-blur-xs" id="<?= 'x-' . $comissao['id'] ?>">


    <article class="relative flex flex-col gap-8 w-md max-h-96 overflow-y-auto panel ">



        <ul class="flex flex-col gap-2 border border-b-0 border-gray-300">

            <?php

            use App\database\Db;

            foreach ($comissao as $key => $value): ?>


                <?php

                if ($key === "id") {
                    $key = "indice";
                    $value = "0";
                }
                if (str_contains($key, "id_")) {

                    $key = str_replace("id_", "", $key);
                    $db = new Db;
                    $db = $db->getConnection();
                    $value = $db->get($key, 'nome', ['id' => $value]);
                }

                ?>

                <li class="flex items-center gap-2 border-b p-2 border-gray-300">

                    <h1 class="capitalize font-bold text-base"><?= $key ?>:</h1>
                    <p class="text-sm opacity-70"><?= $value ?></p>

                </li>

            <?php endforeach ?>

        </ul>
        <div class="mt-auto ml-auto">
            <button class="btn-primary" onclick="closeModal('<?= 'x-' . $comissao['id'] ?>')">ok</button>
        </div>


    </article>

