<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Importar Contatos </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <select name="cliente" id="cliente" class="form-control">
                                        <?php foreach ($clientes as $c) : ?>
                                            <option value="<?= $c['banco'] ?>"><?= $c['banco'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="csv">Arquivo CSV</label>
                                    <input type="file" name="csv" id="csv" class="form-control-file">
                                    <small id="csvHelp" class="form-text text-muted">Formato: ID do chip, CPF, Nome, Telefone, ID da loja</small>
                                </div>
                                <input type="submit" value="Enviar" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>

</script>