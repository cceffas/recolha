<?php

namespace App\pages\components;

class Modal
{

    public static function render(string $id, string $action): string
    {

        return "
        <!-- modal -->
        <div class='fixed left-0 top-0 h-screen w-screen justify-center bg-black/80 hidden z-50' id='{$id}' >

        <div class='flex flex-col mt-30 h-48 w-96 panel'>
            <header class='flex items-center justify-end w-full p-2 h-8'>
                <button class='cursor-pointer' onclick='closeModal(`{$id}`)'>
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-4'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M6 18 18 6M6 6l12 12' />
                    </svg>

                </button>
            </header>
            <main class='flex items-center justify-center p-4'>
                <h1 class='text-yellow-600'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z' />
                    </svg>
                </h1>
                <p class='text-yellow-600'>tem certeza que deseja efectuar esta acção?</p>
            </main>

            <footer class='flex items-center justify-end gap-1 mt-auto w-full h-11 p-2'>
                <button class='btn-secondary' onclick='closeModal(`{$id}`)'>Não</button>
                <form method='post'>
                    <input type='hidden' name='action' value='{$action}'>
                    <input type='hidden' name='id' value='{$id}'>
                    <button type='submit' class='btn-primary'>Sim</button>
                </form>
            </footer>
        </div>

        </div>

        ";
    }
}
