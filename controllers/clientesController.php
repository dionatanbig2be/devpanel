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
        if (isset($_POST['submit'])) {
            $cliente = $_POST['nome_cliente'];
            $siteecommerce = $_POST['ecommerce'];
            $user = $_POST['nome_cliente'] . '_' . $_POST['login'];
            $hashpass = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $grupo  = $c->getGrupo($_POST['grupo']);

            $tipo['painel'] = 0;
            $tipo['operacoes'] = 0;
            $tipo['consulta'] = 0;
            $tipo['separacao'] = 0;
            $tipo['delivery'] = 0;
            $tipo['motoboy'] = 0;

            $tipo[$_POST['tipo']] = 1;
            $insert_login = $c->insertAuthloginCli($cliente, $user, $hashpass, $grupo['nomeGrupo'], $siteecommerce, $tipo);
            if (!$insert_login) {
                $this->msg('d', 'Falha ao inserir login, já existente');
                header("Location: " . BASE_URL . "clientes/criar_acesso");
                die();
            }
            foreach ($_POST['lojas'] as $l) {
                $loja = explode(';', $l);
                $lojas[] = ['code' => $loja[0], 'name' => $loja[0] . ' - ' . $loja[1]];
            }
            $lojas = json_encode($lojas, JSON_UNESCAPED_UNICODE);
            $c->insertAuthpagesCli($grupo['nomeGrupo'], $grupo['acesso']);
           
            $insert_permissions = $c->insertPermissionsCli($user, $cliente, $lojas);
            if (!$insert_permissions) {
                $this->msg('d', 'Falha ao inserir Permissões');
                header("Location: " . BASE_URL . "clientes/criar_acesso");
                die();
            }
          
        }
        $this->loadTemplate('clientes/criar_acesso', $dados);
    }


    //ANCHOR - Grupos de Usuários
    public function gruposusuarios()
    {
        $this->checkAcesso(array(1));
        $c = new Clientes();
        if (isset($_POST['submit'])) {
            $paginas = 'v2/client/home.php;';
            if (isset($_POST['paginas_all']))
                $paginas = "ALL";
            else {
                foreach ($_POST['paginas'] as $pg) {
                    $paginas .= $pg . ';';
                }
                $paginas = rtrim($paginas, ';');
            }
            $add_grupo = $c->addGrupo($_POST['nome_grupo_prefix'] . $_POST['nome_grupo'], $_POST['cliente_id'], $paginas);
            if ($add_grupo) {
                $this->msg('s', 'Grupo adicionado com sucesso');
                header("Location: " . BASE_URL . "clientes/gruposusuarios");
            }
        } else {
            $dados = array();
            $dados['tituloPagina'] = "Criar Acesso ao Painel";
            $dados['clientes'] = $c->listClientes();
            $dados['paginas'] = $c->listPaginas();
            $this->loadTemplate('clientes/gruposusuarios', $dados);
        }
    }

    //ANCHOR - Carrega Grupos
    public function load_grupos($tipo, $cliente_id = 0)
    {
        if ($cliente_id != 0) {
            $this->checkAcesso(array(1));
            $c = new Clientes();
            $dados = array();
            $dados['grupos'] = $c->listGrupos($cliente_id);
            $dados['tipo'] = $tipo;
            $this->loadTemplateBlank('clientes/load_grupos', $dados);
        }
    }


    //ANCHOR - Carrega Lojas
    public function load_lojas($tipo, $cliente)
    {
        if ($cliente != 'Selecione um cliente') {
            $this->checkAcesso(array(1));
            $c = new Clientes();
            $dados = array();
            $dados['lojas'] = $c->listLojas($cliente);
            var_dump($dados['lojas']);
            die();
            $dados['tipo'] = $tipo;
            $this->loadTemplateBlank('clientes/load_lojas', $dados);
        }
    }
}
