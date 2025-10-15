<div class="flex flex-col w-full h-full">

    <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">

        <div class="flex flex-col w-full h-full">

            <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
            <!-- end -->
            <?php include_once __DIR__ . "/../includes/title-section.php"; ?>
            <!-- end -->

            <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">

                <section class="flex flex-col min-h-96 max-h-[620px] container panel">
                    <div class="flex flex-col items-center justify-center w-full">
                        <span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.75 6C15.75 8.07107 14.071 9.75 12 9.75C9.9289 9.75 8.24996 8.07107 8.24996 6C8.24996 3.92893 9.9289 2.25 12 2.25C14.071 2.25 15.75 3.92893 15.75 6Z" stroke="#0F172A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.5011 20.1182C4.5714 16.0369 7.90184 12.75 12 12.75C16.0982 12.75 19.4287 16.0371 19.4988 20.1185C17.216 21.166 14.6764 21.75 12.0003 21.75C9.32396 21.75 6.78406 21.1659 4.5011 20.1182Z" stroke="#0F172A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <h1 class="font-bold capitalize">dados do Usuario</h1>

                    </div>

                    <ul class="flex flex-col gap-2 w-full text-wrap panel">
                        <?php foreach ($_USER as $key => $value): ?>

                            <li class="flex items-center gap-1">
                                <h1 class="font-bold capitalize"><?= $key ?>:</h1>
                                <p class="text-warp opacity-70 w-full"><?= $value ?></p>
                            </li>
                        <?php endforeach ?>
                    </ul>

                </section>
            </main>

        </div>

    </main>

</div>