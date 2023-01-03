<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Criar Acesso </p>
                            </div>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cliente">Cliente</label>
                                            <select name="cliente" id="cliente" class="form-control" required>
                                                <option value="">Selecione um cliente</option>
                                                <?php foreach ($clientes as $c) : ?>
                                                    <option value="<?= $c['id'] ?>"><?= $c['alcunha'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
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
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="prefixo">Login</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="login_addon">prefixo_</span>
                                                </div>
                                                <input type="text" class="form-control" id="login" name="login" required>
                                                <input type="hidden" class="form-control" id="nome_cliente" name="nome_cliente" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="prefixo">Senha</label>
                                            <input type="text" class="form-control" id="senha" name="senha" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="prefixo">Site Ecommerce</label>
                                            <input type="text" class="form-control" id="ecommerce" name="ecommerce">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        Tipo de Acesso
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="painel" checked>
                                                    <label class="form-check-label" for="tipo1">Painel</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="operacoes">
                                                    <label class="form-check-label" for="tipo2">Operações teste</label> 
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo3" value="consulta">
                                                    <label class="form-check-label" for="tipo3">Consulta</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo4" value="separacao">
                                                    <label class="form-check-label" for="tipo4">Separação</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo5" value="delivery">
                                                    <label class="form-check-label" for="tipo5">Delivery</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="tipo" id="tipo6" value="motoboy">
                                                    <label class="form-check-label" for="tipo6">Motoboy</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        Lojas
                                        <div class="row">
                                            <div class="col-12">
                                                <div style="max-height: 250px; overflow-y:scroll;padding:10px; border: 1px solid #ccc" id="lojas">

                                                </div>
                                            </div>
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
        $("#nome_cliente").val($("#cliente option:selected").text());
        $("#lojas").load('./clientes/load_lojas/check/' + $("#cliente option:selected").text());
    })
</script>