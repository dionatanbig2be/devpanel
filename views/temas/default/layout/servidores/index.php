<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Servidores Cadastrados </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descrição</th>
                                        <th>Domínio</th>
                                        <th>Acesso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($servidores as $sv) : ?>
                                        <tr>
                                            <td><?= $sv['id'] ?></td>
                                            <td><?= $sv['descricao'] ?></td>
                                            <td><?= $sv['dominio'] ?></td>
                                            <td><?= $sv['acesso'] ?></td>
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
                                <p class="title" style="color: white;"> Adicionar Servidor </p>
                            </div>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="prefixo">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao">
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Domínio</label>
                                    <input type="text" class="form-control" id="dominio" name="dominio">
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Acesso</label>
                                    <input type="text" class="form-control" id="acesso" name="acesso">
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>