<div class="screen-section flex flex-col items-center panel">
    <form class="flex flex-col gap-8 h-[420px] w-md" method="post">



        <?php if ($_ID!=null): ?>
            <input type="hidden" name="id" value="<?=$_ID?>">
        <?php endif ?>

        <input type="hidden" name="action" value="<?= $_ACTION ?>">

        <?php foreach ($_INPUTS as $input): ?>

            <?php if ($input['type'] != "select"): ?>
                <fieldset class="flex flex-col">
                    <label class='flex items-center gap-2' for="<?= $input['name'] ?>"><?= $input['label'] ?> <?= $input["required"] ? "*" : "<p class='text-xs'>opcional</p>" ?></label>
                    <input type="<?= $input['type'] ?>" name="<?= $input['name'] ?>" id="<?= $input['name'] ?>" value="<?= $input["value"] ?? "" ?>" <?= $input["required"]? "required" :""?>>
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

            <button class="btn-primary" type="submit" onclick="sendDuplicate('submit')" id="submit">confirmar</button>
            <button class="btn-secondary" type="reset">cancelar</button>

        </fieldset>
    </form>
</div>