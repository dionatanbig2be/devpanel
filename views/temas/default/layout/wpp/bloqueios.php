<div class="container-fluid">
    <div class="content">
        <section class="section">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Clientes </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="tabela_bancos">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Prefixo</th>
                                        <th>Sufixo</th>
                                        <th>Bloqueio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tabelas as $t) : ?>
                                        <tr>
                                            <td><?= $t['id'] ?></td>
                                            <td>wap_</td>
                                            <td><?= $t['banco'] ?></td>
                                            <td>
                                                <?php if ($t['bloqueio'] != NULL) : ?>
                                                    <a href="<?= BASE_URL ?>wpp/desbloquear/<?= $t['bloqueio'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-lock"></i></a>
                                                <?php else : ?>
                                                    <a href="<?= BASE_URL ?>wpp/bloquear/<?= $t['cliente_id'] ?>" class="btn btn-sm btn-success"><i class="fa fa-lock-open"></i></a>
                                                <?php endif; ?>
                                            </td>
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
                                <p class="title" style="color: white;"> Lista de bloqueios </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-striped" id="bloqueios">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Tipo</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($log as $l) : ?>
                                        <tr>
                                            <td><?= $l['id'] ?></td>
                                            <td><?= $l['cliente'] ?></td>
                                            <td><?= $l['tipo'] ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($l['data'])) ?></td>
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
<script>
    $("#tabela_bancos").DataTable();
    $("#bloqueios").DataTable();
</script>