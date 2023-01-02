<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Criar Acesso </p>
                            </div>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <select name="cliente" id="cliente" class="form-control" required>
                                        <option value="">Selecione um cliente</option>
                                        <?php foreach ($clientes as $c) : ?>
                                            <option value="<?= $c['id'] ?>"><?= $c['alcunha'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Login</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="login_addon">prefixo_</span>
                                        </div>
                                        <input type="text" class="form-control" id="login" name="login" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prefixo">Senha</label>
                                    <input type="text" class="form-control" id="senha" name="senha" required>
                                </div>
                                <div class="form-group">
                                    <label for="grupo">Grupo</label>
                                    <div class="input-group mb-3">
                                        <select name="grupo" id="grupo" class="form-control" required>
                                        </select>
                                        <div class="input-group-append">
                                            <a href="./clientes/gruposusuarios" class="btn  btn-success "><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name='submit' class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $("#cliente").change(function() {
        var cliente_id = $(this).val();
        $("#grupo").load('./clientes/load_grupos/select/' + cliente_id);
        $("#login_addon").html($("#cliente option:selected").text() + '_');
    })
</script>