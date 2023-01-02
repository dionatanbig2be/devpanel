<div class="container-fluid">
    <div class="content">
    <section class="section">
            <?php $this->display_msg(); ?>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Usuários </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>username</th>
                                        <th>Último login</th>
                                        <th>Editar</th>
                                    </tr>
                                    <?php foreach ($listaUsuarios as $u) : ?>
                                        <tr>
                                            <td><?php echo $u['id']; ?></td>
                                            <td><?php echo $u['nomeUsuario']; ?></td>
                                            <td><?php echo $u['username']; ?></td>
                                            <td><?php if ($u['ultimoLogin'] != null) echo date("d/m/Y H:i", strtotime($u['ultimoLogin'])); ?></td>
                                            <td><a href="<?php echo BASE_URL; ?>usuario/editar/<?php echo $u['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>