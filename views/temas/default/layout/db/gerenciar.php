<div class="container-fluid">
    <div class="content">
        <section class="section">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Bancos </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="tabela_bancos">
                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Prefixo</th>
                                        <th>Sufixo</th>
                                        <th>Servidor</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tabelas as $b => $t) : ?>
                                        <?php foreach ($t as $bn) : ?>
                                            <tr>
                                                <td><?= $bn['id'] ?></td>
                                                <td><?= $b ?></td>
                                                <td><?= $bn['banco'] ?></td>
                                                <td><?= $bn['servidor'] ?></td>
                                                <td>
                                                    <a href="./db/editar/<?= $bn['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="./db/delete/<?= $bn['id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Adicionar bancos </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <select name="cliente" id="cliente" class="form-control">
                                        <?php foreach ($clientes as $c) : ?>
                                            <option value="<?= $c['id'] ?>"><?= $c['alcunha'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Prefixo</label>
                                    <input type="text" class="form-control" id="prefixo" name="prefixo">
                                </div>
                                <div class="form-group">
                                    <label for="sufixo">Sufixo</label>
                                    <input type="text" class="form-control" id="sufixo" name="sufixo">
                                </div>
                                <div class="form-group">
                                    <label for="servidor">Servidor</label>
                                    <select name="servidor" id="servidor" class="form-control">
                                        <?php foreach ($servidores as $sv) : ?>
                                            <option value="<?= $sv['id'] ?>"><?= $sv['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
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