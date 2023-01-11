<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Clientes Cadastrados </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Clientes</th>
                                        <th>Bancos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cl) : ?>
                                        <tr>
                                            <td><?= $cl['id'] ?></td>
                                            <td><?= $cl['alcunha'] ?></td>
                                            <td><?= $cl['bancos'] ?></td>
                                        </tr>
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
                                <p class="title" style="color: white;"> Adicionar Cliente </p>
                            </div>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="prefixo">Alcunha</label>
                                    <input type="text" class="form-control" id="alcunha" name="alcunha">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="app_" value="app_">
                                            <label class="form-check-label" for="app_">app_</label>
                                        </div>
                                    </div>
                                    <select name="servidor_app" id="servidor_app" class="form-control" >
                                        <option value="">Selecione o Servidor</option>
                                        <?php foreach ($servidores as $s) : ?>
                                            <option value="<?= $s['id'] ?>"><?= $s['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="dlv_" value="dlv_">
                                            <label class="form-check-label" for="app_">dlv_</label>
                                        </div>
                                    </div>
                                    <select name="servidor_dlv" id="servidor_dlv" class="form-control" >
                                        <option value="">Selecione o Servidor</option>
                                        <?php foreach ($servidores as $s) : ?>
                                            <option value="<?= $s['id'] ?>"><?= $s['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="dwh_" value="dwh_">
                                            <label class="form-check-label" for="app_">dwh_</label>
                                        </div>
                                    </div>
                                    <select name="servidor_dwh" id="servidor_dwh" class="form-control" >
                                        <option value="">Selecione o Servidor</option>
                                        <?php foreach ($servidores as $s) : ?>
                                            <option value="<?= $s['id'] ?>"><?= $s['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="wap_" value="wap_">
                                            <label class="form-check-label" for="app_">wap_</label>
                                        </div>
                                    </div>
                                    <select name="servidor_wap" id="servidor_wap" class="form-control" >
                                        <option value="">Selecione o Servidor</option>
                                        <?php foreach ($servidores as $s) : ?>
                                            <option value="<?= $s['id'] ?>"><?= $s['descricao'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>