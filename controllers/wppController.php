<?php
class wppController extends controller
{

    public function Index()
    {
    }

    //ANCHOR - Status bloqueios
    public function bloqueios()
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $w = new Wpp();
        $dados = array();
        $dados['tituloPagina'] = "Bloquear Whatsapp";
        $dados['tabelas'] = $w->listClientes();
        $dados['log'] = $w->listLog();
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
            $this->loadTemplate('wpp/bloqueios', $dados);
        }
    }

    //ANCHOR - Bloquear Whatsapp
    public function bloquear($id_cliente = 0)
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $w = new Wpp();

        $execute = $w->bloquear($id_cliente);
        if (!$execute) {
            $this->msg("d", "Falha ao executar SQL.");
        } else {
            $this->msg("s", "Cliente bloqueado com sucesso.");
        }
        header("Location: " . BASE_URL . "wpp/bloqueios");
    }

    //ANCHOR - Desbloquear Whatsapp
    public function desbloquear($id_bloqueio = 0)
    {
        $this->checkAcesso(array(1));
        $d = new DB();
        $w = new Wpp();

        $execute = $w->desbloquear($id_bloqueio);
        if (!$execute) {
            $this->msg("d", "Falha ao executar SQL.");
        } else {
            $this->msg("s", "Cliente desbloqueado com sucesso.");
        }
        header("Location: " . BASE_URL . "wpp/bloqueios");
    }

    //ANCHOR - Importar Contatos
    public function importar()
    {
        $this->checkAcesso(array(1));
        $w = new Wpp();
        $dados = array();
        $dados['tituloPagina'] = "Importar Contatos";
        $dados['clientes'] = $w->listClientes();
        if (isset($_POST["submit"])) {
            $csv = array_map('str_getcsv', file($_FILES["csv"]["tmp_name"]));
            $usr = 'wap_' . $_POST["cliente"];
            $insert = $w->importarContatos($csv, $usr);
            if ($insert) {
                $this->msg("s", "Clientes importados com sucesso.");
                header("Location: " . BASE_URL . "wpp/importar");
            } else {
                $this->msg("d", "Falha ao importar clientes.");
                header("Location: " . BASE_URL . "wpp/importar");
            }
        } else {
            $this->loadTemplate('wpp/importar', $dados);
        }
    }
}
