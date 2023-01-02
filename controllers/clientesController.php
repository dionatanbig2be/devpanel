<?php
class clientesController extends controller
{

    public function Index()
    {
    }

    //ANCHOR - Adicionar
    public function adicionar()
    {
        $this->checkAcesso(array(1));
        $dados = array();
        $c = new Clientes();
        if (isset($_POST['alcunha'])) {
            $d = new DB();
            $lid = $c->addCliente($_POST['alcunha']);
            if ($lid) {
                $msg = '';
                if (isset($_POST['app_'])) {
                    $insert_app = $d->addBanco($lid, '', $_POST['alcunha']);
                    if (!$insert_app)
                        $msg .= 'Falha ao inserir app_. ';
                }
                if (isset($_POST['dlv_'])) {
                    $insert_dlv = $d->addBanco($lid, 'dlv_', $_POST['alcunha']);
                    if (!$insert_dlv)
                        $msg .= 'Falha ao inserir dlv_. ';
                }
                if (isset($_POST['dwh_'])) {
                    $insert_dwh = $d->addBanco($lid, 'dwh_', $_POST['alcunha']);
                    if (!$insert_dwh)
                        $msg .= 'Falha ao inserir dwh_. ';
                }
                if (isset($_POST['wap_'])) {
                    $insert_wap = $d->addBanco($lid, 'wap_', $_POST['alcunha']);
                    if (!$insert_wap)
                        $msg .= 'Falha ao inserir wap_. ';
                }
                if ($msg != '') {
                    $this->msg('d', $msg);
                } else {
                    $this->msg('s', 'Cliente inserido com sucesso');
                }
            } else {
                $this->msg('d', 'Falha ao adicionar');
            }
            header("Location: " . BASE_URL . "clientes/adicionar");
        } else {
            $dados['clientes'] = $c->listClientes();
            $this->loadTemplate('clientes/adicionar', $dados);
        }
    }

    //ANCHOR - Gerar Chave API
    public function chave_api()
    {
        $this->checkAcesso(array(1));
        $c = new Clientes();
        $dados = array();
        $dados['tituloPagina'] = "Gerar Chave API";
        $dados['clientes'] = $c->listClientes();
        $this->loadTemplate('clientes/chave_api', $dados);
    }

     //ANCHOR - Criar acesso
     public function criar_acesso()
     {
         $this->checkAcesso(array(1));
         $c = new Clientes();
         $dados = array();
         $dados['tituloPagina'] = "Criar Acesso ao Painel";
         $dados['clientes'] = $c->listClientes();
         $this->loadTemplate('clientes/criar_acesso', $dados);
     }
}
