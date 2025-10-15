<?php


require_once __DIR__."/../../controllers/Main.php";

?>


<div class="flex flex-col w-full h-full">


    <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
    <!-- end -->
    <?php include_once __DIR__ . "/../includes/main_asidebar.php"; ?>
    <!-- end -->

    <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">
        <section class="flex flex-col  gap-4 min-h-96 container p-4">

            <div class="flex  items-center flex-wrap gap-4 w-full">

                <?php foreach ($_CARDS as $card): ?>
                    <div class="card-app">



                        <div class="flex flex-col items-center justify-center gap-2 text-xl grow w-full">

                            <div class="size-16 p-2 rounded-full text-gray-600 bg-gray-500/30">
                                <?= $card["icon"] ?>
                            </div>


                            <h2 class="font-bold"><?= $card['title'] ?></h2>

                        </div>
                        <div class="flex items-center justify-center gap-1 w-full panel">
                            <a href="#" class="btn-secondary cursor-wait">


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                historico
                            </a>
                            <!-- end -->
                            <a href="<?= $card["url"] ?>" class="btn-primary">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                                Dados
                            </a>
                        </div>

                    </div>
                    <!-- card -->
                <?php endforeach ?>

            </div>
            <!-- end -->
            <div class="flex items-center flex-wrap gap-4 w-full pb-16">
                <article class="flex flex-col gap-2 panel w-full">

                    <span class="flex gap-2 items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>

                        Estatisticas
                    </span>

                    <div class="flex items-center justify-center panel">
                        <canvas id="myChart" class="h-96 w-full max-h-96 max-w-full"></canvas>
                    </div>

                </article>
            </div>
            <!-- end -->
        </section>
    </main>

</div>


<script src="public/js/chart.umd.js"></script>


<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels:<?= json_encode($_GRAPHIC_LABELS)?>,
            datasets: [{
                label: 'estatisticas',
                data:<?= json_encode($_GRAPHIC_VALUES)?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>