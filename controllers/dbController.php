<?php
class dbController extends controller
{

    public function Index()
    {
    }

    //ANCHOR - Replicar SQL
    public function replicar()
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $dados = array();
        $dados['tituloPagina'] = "Replicar SQL";
        $dados['tabelas'] = $d->listDB();
        if (isset($_POST['sql'])) {
            foreach ($_POST['clientes'] as $cl) {
                $execute = $d->doSql($cl, $_POST['sql']);
                if (!$execute) {
                    $this->msg("d", "Falha ao executar SQL.");
                    header("Location: " . BASE_URL . "db/replicar");
                }
            }
            $this->msg("s", "SQL executado com sucesso.");
            header("Location: " . BASE_URL . "db/replicar");
        } else {
            $this->loadTemplate('db/replicar', $dados);
        }
    }

    //ANCHOR - Gerenciar DB
    public function gerenciar()
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $c = new Clientes();
        $dados = array();
        $dados['tituloPagina'] = "Gerenciar DB";
        $dados['tabelas'] = $d->listDB();
        $dados['clientes'] = $c->listClientes();
        if (isset($_POST['sufixo'])) {
            if (!$d->addBanco($_POST['cliente'], $_POST['prefixo'], $_POST['sufixo'])) {
                $this->msg("d", "Falha ao executar SQL.");
                header("Location: " . BASE_URL . "db/gerenciar");
            } else {
                $this->msg("s", "SQL executado com sucesso.");
                header("Location: " . BASE_URL . "db/gerenciar");
            }
        } else {
            $this->loadTemplate('db/gerenciar', $dados);
        }
    }

    //ANCHOR - Apagar DB
    public function delete($id)
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $delete = $d->deleteBanco($id);
        if ($delete)
            echo 'true';
    }
}
