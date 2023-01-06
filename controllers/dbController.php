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
            $msg = '';
            foreach ($_POST['clientes'] as $cl) {
                $execute = $d->doSql($cl, $_POST['sql']);
                if ($execute != '')
                    $msg .= $cl . ': ' . $execute . "<br>";
            }
            if ($msg != '')
                $this->msg("w", $msg);
            else
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
        $s = new Servidores();
        $dados = array();
        $dados['tituloPagina'] = "Gerenciar DB";
        $dados['tabelas'] = $d->listDB();
        $dados['clientes'] = $c->listClientes();
        $dados['servidores'] = $s->getServers();
        if (isset($_POST['sufixo'])) {
            if (!$d->addBanco($_POST['cliente'], $_POST['prefixo'], $_POST['sufixo'], $_POST['servidor'])) {
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
            $this->msg("s", "Banco excluído com sucesso.");
        else
            $this->msg("d", "Falha ao excluir o banco.");
        header("Location: " . BASE_URL . "db/gerenciar");
    }


    //ANCHOR - Editar DB
    public function editar($id)
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $c = new Clientes();
        $s = new Servidores();
        $dados = array();
        if (isset($_POST['submit'])) {
            $edita = $d->editaBanco($id, $_POST['cliente'], $_POST['prefixo'], $_POST['sufixo'], $_POST['servidor']);
            if (!$edita) {
                $this->msg("d", "Falha ao editar o banco.");
            } else {
                $this->msg("s", "Banco editado com sucesso.");
            }
            header("Location: " . BASE_URL . "db/gerenciar");
        } else {
            $dados['banco'] = $d->getBanco($id);
            $dados['clientes'] = $c->listClientes();
            $dados['servidores'] = $s->getServers();
            $this->loadTemplate('db/editar', $dados);
        }
    }
}
