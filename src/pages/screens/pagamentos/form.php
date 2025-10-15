<div class="screen-section flex flex-col items-center panel">
    <form class="flex flex-col gap-8 h-[420px] w-md" method="post">


        <input type="hidden" name="action" value="<?= $_ACTION ?>">

        <?php if ($_ID != null): ?>
            <input type="hidden" name="id_comissao" value="<?= $_ID ?>">
        <?php endif ?>




        <?php foreach ($_INPUTS as $input): ?>

            <?php if ($input['type'] != "select"): ?>
                <fieldset class="flex flex-col">
                    <label for="<?= $input['name'] ?>"><?= $input['label'] ?></label>
                    <input type="<?= $input['type'] ?>" name="<?= $input['name'] ?>" id="<?= $input['name'] ?>" value="<?= $input["value"] ?? "" ?>">
                </fieldset>
            <?php else: ?>
                <fieldset class="flex flex-col">
                    <label for="<?= $input["name"] ?>"><?= $input["label"] ?></label>

                    <select name="<?= $input['name'] ?>" id="<?= $input["name"] ?>">

                        <?php foreach ($input['options'] as $option): ?>
                            <option value="<?= $option['value'] ?? $option ?>"><?= $option['text'] ?? $option ?></option>
                        <?php endforeach; ?>

                    </select>
                </fieldset>
            <?php endif ?>
        <?php endforeach ?>







        <fieldset class="flex gap-1 items-center justify-end">

            <button class="btn-primary" type="submit">Registrar</button>
            <button class="btn-secondary" type="reset">cancelar</button>

        </fieldset>
    </form>
</div>