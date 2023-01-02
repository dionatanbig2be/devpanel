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
                                <p class="title" style="color: white;">Aletar senha - <?php echo $usuario['nomeUsuario']; ?> </p>
                            </div>
                        </div>
                        <form method="post" action="<?php echo BASE_URL . "usuario/alterarsenha"; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form md-outline">
                                            <input type="password" name="atual" class="form-control">
                                            <label data-error="wrong" data-success="right" for="atual">Senha atual</label>
                                        </div>
                                        <div class="md-form md-outline">
                                            <input type="password" name="nova" class="form-control">
                                            <label data-error="wrong" data-success="right" for="nova">Nova senha</label>
                                        </div>

                                        <div class="md-form md-outline">
                                            <input type="password" name="confirma" class="form-control">
                                            <label data-error="wrong" data-success="right" for="confirma">Confirmar senha</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" name="submit" class="btn btn-primary">Alterar senha</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>