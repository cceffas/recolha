<?php

namespace App\pages\components;







class AdminModal
{







    public function render()
    {






        return <<<HTML
            <div class='fixed top-0 left-0 w-full h-full flex items-center backdrop-blur-md bg-black/60' id="$id">

            <form action="admin-solicitation" class="flex flex-col gap-4 bg-white min panel">

            <p>não tens autorização para executar esta operação, envie o pedido de permição para um administrador</p>

            <fieldset class='flex flex-col items-center'>

                <label for="">escreva aqui o motivo</label>
                <textarea name="motivo"  required>
                </textarea>

            </fieldset>


            <button class="btn-primary">confirmar</button>

            </form>

            </div>
        HTML;
    }
}
