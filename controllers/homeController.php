<?php
class homeController extends controller
{

    public function Index()
    {
        $user = $this->usuarioAtual;
        $dados = array();
        $dados['tituloPagina'] = "Dashboard";


        if (isset($user['grupoUsuario'])) {
            switch ($user['grupoUsuario']) {
                case 0:
                case 1:
                    $c = new Clientes();
                    $dados['clientes'] = $c->listClientes();
                    $this->loadTemplate('sistema/dashboard/admin', $dados);
                    break;
                default:
                    $this->loadTemplate('sistema/dashboard/default', $dados);
            }
        }
    }
}
