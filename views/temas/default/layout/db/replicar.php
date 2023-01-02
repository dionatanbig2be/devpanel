<div class="container-fluid">
    <div class="content">
        <section class="section">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> SQL Replication </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="sql">SQL para execução</label>
                                    <textarea class="form-control" id="sql" rows="3" name="sql"></textarea>
                                </div>
                                <div class="row">
                                    <?php foreach ($tabelas as $key => $value) : ?>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="clientes"><?= $key ?></label>
                                                <select multiple class="form-control" id="clientes" name="clientes[]">
                                                    <?php foreach ($value as $tb) : ?>
                                                        <option value="<?php if ($key != 'app_') echo $key; ?><?= $tb['banco'] ?>"><?php if ($key != 'app_') echo $key; ?><?= $tb['banco'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>