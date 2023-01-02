<nav id="menu" class="navbar sticky-top navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler w-100" style="color: #383838;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-fill nav-justified w-100">
                <li class="nav-item"><a href="<?php echo BASE_URL; ?>" class="nav-link"><i class="fa fa-home"></i>
                        Dashboard</a>
                </li>
                <li class="nav-item position-static dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list"></i> DB</a>
                    <div class="dropdown-menu w-100 animate slideIn" aria-labelledby="navbarDropdown" id="" style="margin-top:-10px;overflow-y: auto;max-height: 500px;">
                        <div class="container">
                            <div class="row w-100">
                                <div class="col-sm-3">
                                    <span class="dropdown-item mega-header-title">Manutenção</span>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>db/gerenciar" style="font-size: 14px">Gerenciar bancos</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>db/replicar" style="font-size: 14px">Replicar SQL</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item position-static dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-hammer"></i> Clientes</a>
                    <div class="dropdown-menu w-100 animate slideIn" aria-labelledby="navbarDropdown" id="" style="margin-top:-10px;overflow-y: auto;max-height: 500px;">
                        <div class="container">
                            <div class="row w-100">
                                <div class="col-sm-3">
                                    <span class="dropdown-item mega-header-title">Criação</span>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>clientes/adicionar" style="font-size: 14px">Adicionar novo cliente</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>clientes/criar_acesso" style="font-size: 14px">Acesso ao Painel</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>clientes/gruposusuarios" style="font-size: 14px">Grupos</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>clientes/chave_api" style="font-size: 14px">Gerar chave API</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                                <div class="col-sm-3">
                                    <span class="dropdown-item mega-header-title">Whatsapp</span>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>wpp/bloqueios" style="font-size: 14px">Bloquear acesso</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>wpp/importar" style="font-size: 14px">Importar contatos</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item position-static dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Configurações</a>
                    <div class="dropdown-menu w-100 animate slideIn" aria-labelledby="navbarDropdown" id="" style="margin-top:-10px;overflow-y: auto;max-height: 500px;">
                        <div class="container">
                            <div class="row w-100">
                                <div class="col-sm-3">
                                    <span class="dropdown-item mega-header-title">Usuários</span>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>usuario/listar" style="font-size: 14px">Listar</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>usuario/adicionar" style="font-size: 14px">Adicionar</a>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>usuario/deslogatodos" style="font-size: 14px">Deslogar Todos</a>
                                    <div class="dropdown-divider"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>