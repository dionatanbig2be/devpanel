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
                                <p class="title" style="color: white;"> Cadastro de Usuário </p>
                            </div>
                        </div>
                        <form method="post" class="form-horizontal" role="form" action="<?php echo BASE_URL . "usuario/adicionar"; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label for="nome" class="col-md-3 ">Nome para Exibição<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="text" name="nome" placeholder="Nome para Exibição" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="usuario" class="col-md-3 ">Usuário<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="text" name="usuario" placeholder="Usuário" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 ">Grupo<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <select class="form-control" name="grupo" required>
                                                    <option value="">Selecione o Grupo</option>
                                                    <?php foreach ($grupos as $g) : ?>
                                                        <option value="<?php echo $g['id']; ?>"><?php echo $g['nomeGrupo']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 ">Senha<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="password" name="senha" placeholder="Senha" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 ">Confirmar Senha<span style="color: #F00;">*</span></label>
                                            <div class="col-xl-9">
                                                <input type="password" name="confirmarsenha" placeholder="Senha" class="form-control" required>
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
                                <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>