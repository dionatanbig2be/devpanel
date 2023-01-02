<!doctype html>
<html lang="pt">

<head>
    <base href="<?php echo BASE_URL;?>">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Painel de desenvolvimento Big2be">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="views/temas/default/assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="views/temas/default/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="views/temas/default/assets/css/style.css">
    <link rel="stylesheet" href="views/temas/default/assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="views/temas/default/assets/css/morris.css">
    <script type="text/javascript" src="views/temas/default/assets/js/jquery.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/popper.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/script.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/morris.js"></script>
    <script type="text/javascript" src="views/temas/default/assets/js/raphael.js"></script>

    <title><?php if (isset($tituloPagina))
                echo $tituloPagina . " - Big2be";
            else
                echo "Big2be"; ?></title>
</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3" style="text-align: center;">
                    <div id="logo">
                        <a href=""><img src="media/images/logo.png" title="Logo" alt="Big2be" class="img-responsive" style="width: 100%;max-width:200px;"></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-9">
                    <div class="row">
                        <div class="col-md-8" style="text-align: center; color: #eee">
                            <div class="busca-topo">
                                
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; color: #eee">
                            <div class="top-header">

                                <div class="dropdown">
                                    <a class="dropdown-toggle" style="color: #eee; text-decoration: none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <?php echo $user['nomeUsuario']; ?> 
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="usuario/perfil">Perfil</a>
                                        <a class="dropdown-item" href="usuario/alterarsenha">Alterar senha</a>
                                        <a class="dropdown-item" href="usuario/logout">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>