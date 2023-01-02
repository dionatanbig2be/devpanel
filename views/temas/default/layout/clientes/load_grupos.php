<?php if ($tipo == "table") : ?>
    <?php if (count($grupos) > 0) : ?>
        <?php foreach ($grupos as $g) : ?>
            <tr>
                <td><?= $g['id'] ?></td>
                <td><?= $g['nomeGrupo'] ?></td>
                <td><?= $g['acesso'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="3">Nenhum grupo encontrado</td>

        </tr>
    <?php endif; ?>
<?php endif; ?>
<?php if ($tipo == "select") : ?>

    <?php if (count($grupos) > 0) : ?>
        <?php foreach ($grupos as $g) : ?>
            <option value="<?= $g['id'] ?>"><?= $g['nomeGrupo'] ?></option>
        <?php endforeach; ?>
    <?php else : ?>
        <option value="">Nenhum grupo encontrado</option>
    <?php endif; ?>
<?php endif; ?>