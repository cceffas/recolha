<div class="flex flex-col items-center w-full h-full bg-white panel">

    <form class="flex flex-col w-96 min-h-96 gap-8 mt-30" action="main" method="post">

        <div class="flex justify-center flex-col w-full">
            <!-- <span>
                <img src="./public/RecolhaSystem.svg" class="size-18" alt="logoMark">
            </span> -->
            <h1 class="opacity-80 text-lg">Sistema de registro de pagamentos</h1>
            <p class="opacity-60">somente funcionario autorizado</p>
        </div>

        <div class="flex flex-col gap-4">

            <input type="hidden" name="action" value="auth">

            <fieldset class="flex flex-col w-full mt-4">
                <label for="name">nome *</label>
                <input type="text" name="name" placeholder="" id="name">
            </fieldset>
            <!-- end -->
            <fieldset class="flex flex-col w-full">
                <label for="password">Senha *</label>
                <input type="password" name="password" placeholder="******" id="password">
            </fieldset>

            <div class="flex items-center gap-1">
                <input type="checkbox" class="size-4 outline-gray-100 accent-emerald-500 text-white" name="token" id="token">
                <fieldset>
                    <label for="token">
                        lembrar
                    </label>
                </fieldset>
            </div>

            <div class="flex items-center w-full">
                <button class="btn-primary w-full">iniciar sessão</button>
            </div>

        </div>



    </form>


    <footer class="flex items-center justify-center mt-auto panel w-full">
        <p class="text-xs opacity-50">todos direitos reservados a DTN TECH 2020</p>
    </footer>

</div>