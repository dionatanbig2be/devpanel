<?php
class sistemaController extends controller
{
    public function Index()
    {
    }

    public function adicionarmenu()
    {
        $user = $this->usuarioAtual;
        $this->checkAcesso(array(1));
        $c = new Config();
        $u = new Usuarios();

        if (isset($_POST['submit'])) {

            $grupos = array();
            $i = 0;
            foreach ($_POST['grupos'] as $g) {
                $grupos[$i] = (int)$g;
                $i++;
            }

            $serial = serialize($grupos);

            $lid = $c->insertMenu($_POST['titulo'], $_POST['icone'], $_POST['caminho'], $_POST['menup'], $_POST['ordem'], $serial);

            if (!$lid) {
                $this->msg("d", "Falha ao adicionar.");
                header("Location: " . BASE_URL . "sistema/adicionarmenu");
            } else {
                $this->msg("s", "Menu adicionado com Sucesso.");
                header("Location: " . BASE_URL . "sistema/adicionarmenu");
            }

        } else {
            $dados = array();
            $dados['menuP'] = $c->getMenus();
            $dados['grupos'] = $u->listaGrupos();
            $dados['tituloPagina'] = "Adicionar Menu";
            $this->loadTemplate('sistema/menu/adicionar', $dados);
        }
    }
}