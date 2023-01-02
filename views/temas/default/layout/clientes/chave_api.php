<div class="container-fluid">
    <div class="content">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Chaves API </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>SK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $c) : ?>
                                        <tr>
                                            <td> <?= $c['alcunha'] ?> </td>
                                            <td> <?= hash("sha256", '1423ac1b947c8d8536a46e05b762adb4f646249413021dadba2b1598f4a8b947fdd402a715b7c73c93498089d8f53a226ce54d4ca24c449f064df0e585281339' . $c['alcunha'] . 'V1cxc2JrMXRTbXhNYms0eFdtMXNOR0ozUFQwPQ')  ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>

</script>