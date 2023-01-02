<div class="container-fluid">
    <div class="content">
        <section class="section">
            <?php $this->display_msg(); ?>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Editar Perfil </p>
                            </div>
                        </div>
                        <form method="post" class="form-horizontal" role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label for="nome" class="col-md-3 ">Nome para Exibição<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="text" name="nome" placeholder="Nome para Exibição" class="form-control" value="<?php echo $user['nomeUsuario']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="usuario" class="col-md-3 ">Usuário<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="text" name="usuario" placeholder="Usuário" class="form-control" value="<?php echo $user['username']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="grupo" class="col-md-3 ">Grupo<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <select class="form-control" name="grupo" required>
                                                    <option value="">Selecione o Grupo</option>
                                                    <?php foreach ($grupos as $g) : ?>
                                                        <option value="<?php echo $g['id']; ?>" <?php if ($user['grupoUsuario'] == $g['id']) {
                                                                                                    echo " selected";
                                                                                                } ?>><?php echo $g['nomeGrupo']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="status" class="col-md-3 ">Status</label>
                                            <div class="col-xl-9">
                                                <select class="form-control" name="status" required>

                                                    <option value="1" <?php if ($user['status'] == 1) {
                                                                            echo " selected";
                                                                        } ?>>Ativo</option>
                                                    <option value="0" <?php if ($user['status'] == 0) {
                                                                            echo " selected";
                                                                        } ?>>Inativo</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xl-9 col-xl-offset-3">
                                                <span class="help-block" style="color: red;">* Campos Obrigatórios</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                                <a href="<?php echo BASE_URL; ?>usuario" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>