<?php $usuario = $this->usuarioAtual; ?>
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
                                <p class="title" style="color: white;"> <?php echo $usuario['nomeUsuario']; ?> </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?php echo BASE_URL . "media/images/" . $usuario['imagemUsuario']; ?>" class="img-responsive img-rounded w-100" />
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-striped">
                                        <tr>
                                            <th colspan="2" style="text-align: center;">Informações</th>
                                        </tr>
                                        <tr>
                                            <th>Grupo</th>
                                            <td><?php echo $usuario['nomeGrupo']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nome</th>
                                            <td><?php echo $usuario['nomeUsuario']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Usuário</th>
                                            <td> <?php echo $usuario['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Último Login</th>
                                            <td><?php if ($usuario['ultimoLogin'] != null) echo date("d/m/Y H:i", strtotime($usuario['ultimoLogin'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php if ($usuario['statusUser'] == 1 && $usuario['statusGrupo'] == 1) echo "Ativo";
                                                else echo "Inativo"; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2"></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>