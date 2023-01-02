<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Adicionar</p>
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
                                    <label for="prefixo">Nome do Grupo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="nome_grupo_addon">prefixo_</span>
                                        </div>
                                        <input type="text" class="form-control" id="nome_grupo" name="nome_grupo">
                                        <input type="hidden" class="form-control" id="nome_grupo_prefix" name="nome_grupo_prefix" value="">
                                        <input type="hidden" class="form-control" id="cliente_id" name="cliente_id" value="">
                                    </div>
                                </div>
                                <span>Páginas</span>

                                <div style="max-height: 250px; overflow-y:scroll;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkbox_all" value="all" name="paginas_all">
                                        <label class="form-check-label" for="checkbox_all">
                                            <b>Todas</b>
                                        </label>
                                    </div>
                                    <?php foreach ($paginas as $p) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkbox_<?= $p['id'] ?>" value="<?= $p['pagina'] ?>" name="paginas[]">
                                            <label class="form-check-label" for="checkbox_<?= $p['id'] ?>">
                                                <?= $p['pagina'] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name='submit' class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Grupos</p>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Nome
                                            </th>
                                            <th>
                                                Acesso
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpo_grupos">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
<script>
    $("#cliente").change(function() {
        var cliente_id = $(this).val();
        $("#corpo_grupos").load('./clientes/load_grupos/table/' + cliente_id);
        $("#nome_grupo_addon").html($("#cliente option:selected").text() + '_');
        $("#nome_grupo_prefix").val($("#cliente option:selected").text() + '_');
        $("#cliente_id").val($("#cliente option:selected").val());
    })
</script>