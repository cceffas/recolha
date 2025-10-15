<?php


$alert = $_COOKIE['alert'] ?? null;
$sucess = $_COOKIE['success'] ?? null;
$error = $_COOKIE['error'] ?? null;

if ($sucess) setcookie("success", "", time() - 3600);
if ($error) setcookie("error", "", time() - 3600);
if ($alert) setcookie("alert", "", time() - 3600);



?>




<?php if ($sucess): ?>
    <div class="absolute top-40 right-0 flex justify-center items-center w-full" id="popup-message">

        <span class="flex items-center gap-2 w-md h-11 p-4 text-lime-600 bg-lime-500/30 border rounded-md backdrop-blur-md z-20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <?= $sucess ?>


            <button class="ml-auto hover:cursor-pointer" id="popup-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

            </button>
        </span>

    </div>
<?php endif ?>
<!-- end -->
<?php if ($error): ?>
    <div class="absolute top-40 right-0 flex justify-center items-center w-full" id="popup-message">

        <span class="flex items-center gap-2 w-md h-11 p-4 text-red-600 bg-red-500/20 border rounded-md backdrop-blur-md z-20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            <?= $error ?>

            <button class="ml-auto hover:cursor-pointer" id="popup-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

            </button>
        </span>

    </div>
<?php endif ?>
<!-- end -->
<?php if ($alert): ?>
    <div class="absolute top-40 right-0 flex justify-center items-center w-full" id="popup-message">

        <span class="flex items-center gap-2 w-md h-11 p-4 text-yellow-600 bg-yellow-500/20 border rounded-md backdrop-blur-md z-20">
            <span>!</span>

            <?= $alert ?>

            <button class="ml-auto hover:cursor-pointer" id="popup-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

            </button>
        </span>

    </div>
<?php endif ?>