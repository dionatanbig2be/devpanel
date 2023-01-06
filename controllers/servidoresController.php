<?php
class servidoresController extends controller
{

    public function Index()
    {
        $this->checkAcesso(array(1));
        $s = new Servidores();


        if (isset($_POST['submit'])) {
            $insert = $s->insertServer($_POST['descricao'], $_POST['acesso'], $_POST['dominio']);
            if (!$insert) {
                $this->msg("d", "Falha ao adicionar.");
            } else {
                $this->msg("s", "Servidor adicionado com Sucesso.");
            }
            header("Location: " . BASE_URL . "servidores/index");
        } else {
            $dados = array();
            $dados['servidores'] = $s->getServers();
            $dados['tituloPagina'] = "Servidores";
            $this->loadTemplate('servidores/index', $dados);
        }
    }
}
