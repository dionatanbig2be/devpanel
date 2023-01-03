<?php if ($tipo == "check") : ?>
    <?php if (count($lojas) > 0) : ?>
        <?php foreach ($lojas as $l) : ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?= $l['storeId'] ?>;<?= $l['title'] ?>" id="loja_<?= $l['storeId'] ?>" name="lojas[]">
                <label class="form-check-label" for="loja_<?= $l['storeId'] ?>">
                    <?= $l['storeId'] ?> - <?= $l['title'] ?>
                </label>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        Nenhuma loja encontrado
    <?php endif; ?>
<?php endif; ?>