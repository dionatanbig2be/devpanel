<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Editar banco <?= $banco['id']; ?> </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <select name="cliente" id="cliente" class="form-control">
                                        <?php foreach ($clientes as $c) : ?>
                                            <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $banco['cliente_id']) echo 'selected' ?>><?= $c['alcunha'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Prefixo</label>
                                    <input type="text" class="form-control" id="prefixo" name="prefixo" value="<?= $banco['prefixo']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="sufixo">Sufixo</label>
                                    <input type="text" class="form-control" id="sufixo" name="sufixo" value="<?= $banco['banco']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="servidor">Servidor</label>
                                    <select name="servidor" id="servidor" class="form-control">
                                        <?php foreach ($servidores as $sv) : ?>
                                            <option value="<?= $sv['id'] ?>" <?php if ($sv['id'] == $banco['servidor']) echo 'selected' ?>><?= $sv['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $("#tabela_bancos").DataTable();
</script>