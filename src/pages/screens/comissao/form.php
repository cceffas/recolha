<div class="screen-section flex flex-col items-center panel">
    <form class="flex flex-col gap-8 h-[420px] w-md" method="post">

        <input type="hidden" name="action" value="<?= $_ACTION ?>">

        <?php if (!empty($_ID)): ?>
            <input type="hidden" name="id" value="<?= $_ID ?>">
        <?php endif; ?>

        <?php foreach ($_INPUTS as $input): ?>
            <?php if ($input['type'] !== "select"): ?>
                <fieldset class="flex flex-col">
                    <label for="<?= $input['name'] ?>"><?= $input['label'] ?></label>
                    <input
                        type="<?= $input['type'] ?>"
                        name="<?= $input['name'] ?>"
                        id="<?= $input['name'] ?>"
                        value="<?= htmlspecialchars($input["value"] ?? "", ENT_QUOTES) ?>"
                        <?= !empty($input['required']) ? 'required' : '' ?>
                    >
                </fieldset>
            <?php else: ?>
                <fieldset class="flex flex-col">
                    <label for="<?= $input["name"] ?>"><?= $input["label"] ?></label>
                    <select
                        name="<?= $input['name'] ?>"
                        id="<?= $input["name"] ?>"
                        <?= !empty($input['required']) ? 'required' : '' ?>
                    >
                        <?php foreach ($input['options'] as $option): ?>
                            <?php
                                $val = $option['value'] ?? $option;
                                $text = $option['text'] ?? $option;
                                $selected = isset($input["value"]) && $input["value"] == $val ? "selected" : "";
                            ?>
                            <option value="<?= htmlspecialchars($val, ENT_QUOTES) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($text, ENT_QUOTES) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            <?php endif; ?>
        <?php endforeach; ?>

        <fieldset class="flex gap-1 items-center justify-end">
            <button class="btn-primary" type="submit" id="submit" onclick="sendDuplicate('submit')">confirmar</button>
            <button class="btn-secondary" type="reset">cancelar</button>
        </fieldset>
    </form>
</div>
