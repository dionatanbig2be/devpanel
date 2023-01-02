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
            </div>
        </section>
    </div>
</div>