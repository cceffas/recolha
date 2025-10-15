<?php require_once __DIR__ . "/../../controllers/Pagamentos.php"  ?>

<div class="flex flex-col w-full h-full">
    <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
    <!-- end -->

    <?php include_once __DIR__ . "/../includes/title-section.php"; ?>
    <!-- end -->

    <main class="flex flex-col items-center w-full gap-8 overflow-y-auto grow">
        <section class="flex flex-wrap min-h-96 max-h-[620px] container">

            <?php require_once __DIR__ . "/../includes/_asidebar.php" ?>

            <!-- end -->
            <div class="relative grow min-h-96 overflow-y-auto" id="screen">


                <?php require_once __DIR__ . "/../screens/pagamentos/" . $screens[$page] ?>

            </div>
            <!-- end -->
        </section>
    </main>

</div>