<?php
class controller
{
    function __construct()
    {
        global $cookiename;
        $this->cookiename = $cookiename;
        $this->usuarioAtual = $this->usuarioAtual();
        $this->checaLogado();
        $this->menu = $this->geraMenu();
        global $ambiente;
        $this->ambiente = $ambiente;
        global $pepper;
        $this->pepper = $pepper;
    }
    public function LoadTemplate($viewName, $viewData = array())
    {
        $user = $this->usuarioAtual;
        extract($viewData);
      /*   $bs = new Bootstrap();
        $bf = new Bootstrap_Field(); */
        if (file_exists('views/temas/' . $user['tema'] . '/layout/sistema/common/header.php'))
            require 'views/temas/' . $user['tema'] . '/layout/sistema/common/header.php';
        else
            require 'views/temas/default/common/header.php';
        if (file_exists('views/temas/' . $user['tema'] . '/layout/sistema/common/menu.php'))
            require 'views/temas/' . $user['tema'] . '/layout/sistema/common/menu.php';
            
        else
            require 'views/temas/default/layout/sistema/common/menu.php';
        if (file_exists('views/temas/' . $user['tema'] . '/layout/sistema/common/msg.php'))
            require 'views/temas/' . $user['tema'] . '/layout/sistema/common/msg.php';
        else
            require 'views/temas/default/layout/sistema/common/msg.php';
        if (file_exists('views/temas/' . $user['tema'] . '/layout/' . $viewName . '.php'))
            require 'views/temas/' . $user['tema'] . '/layout/' . $viewName . '.php';
        else
            require 'views/temas/default/' . $viewName . '.php';
        if (file_exists('views/temas/' . $user['tema'] . '/layout/sistema/common/footer.php'))
            require 'views/temas/' . $user['tema'] . '/layout/sistema/common/footer.php';
        else
            require 'views/temas/default/layout/sistema/common/footer.php';
    }
    public function LoadTemplateBlank($viewName, $viewData = array())
    {
        $user = $this->usuarioAtual;
        extract($viewData);
        if (file_exists('views/temas/' . $user['tema'] . '/layout/' . $viewName . '.php'))
            require 'views/temas/' . $user['tema'] . '/layout/' . $viewName . '.php';
        else
            require 'views/temas/default/layout/' . $viewName . '.php';
    }
    public function checaLogado()
    {
        if (isset($_COOKIE[$this->cookiename]) && strlen($_COOKIE[$this->cookiename]) > 0) {
            $user = $this->usuarioAtual;
            if ($user['saltUser'] != $_COOKIE[$this->cookiename] || $user['statusUser'] == 0 || $user['statusGrupo'] == 0) {
                $this->msg('d', "Usuário não está logado");
                unset($_COOKIE[$this->cookiename]);
                setcookie($this->cookiename, null, -1, '/');
                header("Location: " . BASE_URL . "login.php");
            }
        } else {
            $this->msg('d', "Usuário não está logado");
            header("Location: " . BASE_URL . "login.php");
        }
    }
    public function usuarioAtual()
    {
        if (isset($_COOKIE[$this->cookiename])) {
            $m = new model();
            $user = $m->checaSalt($_COOKIE[$this->cookiename]);
            if ($user) {
                $hoje = new DateTime();
                $validSalt = new DateTime($user['validadeSalt']);
                if ($validSalt > $hoje) {
                    return $user;
                } else {
                    $u = new Usuarios();
                    $u->deslogaUsuario($user['id']);
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    public function geraMenu()
    {
        $m = new model();
        return $m->geraMenu();
    }

    public function msg($type = '', $msg = '')
    {
        if (!empty($msg)) {
            if (strlen(trim($type)) == 1) {
                $type = str_replace(array('d', 'i', 'w', 's'), array('danger', 'info', 'warning', 'success'), $type);
            }
            $_SESSION['msg'][$type] = $msg;
        }
    }
    public function display_msg()
    {
        $output = array();
        if (!empty($_SESSION['msg'])) {
            foreach ($_SESSION['msg'] as $key => $value) {
                $output  = "<div class=\"alert alert-{$key}\">";
                $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
                $output .= $value;
                $output .= "</div>";
            }
            unset($_SESSION['msg']);
            echo $output;
        }
    }
    public function checkAcesso($nivel = array())
    {
        $user = $this->usuarioAtual;
        $acesso = false;
        foreach ($nivel as $n) {
            if ($n == $user['grupoUsuario'] or $user['grupoUsuario'] == 0) {
                $acesso = true;
            }
        }
        if (!$acesso) {
            $this->msg('d', 'Sem permissão');
            header('Location: ' . BASE_URL);
            exit();
        }
    }

    public function randString($len = 5, $special = true)
    {
        $str = '';
        if ($special) {
            $cha = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*";
        } else {
            $cha = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        for ($x = 0; $x < $len; $x++)
            $str .= $cha[mt_rand(0, strlen($cha) - 1)];

        return $str;
    }
}
