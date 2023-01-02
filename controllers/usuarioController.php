<?php
class usuarioController extends controller
{

    public function Index()
    {
        $this->checkAcesso(array(1));
        $u = new Usuarios();
        $dados['tituloPagina'] = "Usuários";
        $dados['listaUsuarios'] = $u->listaUsuarios();
        $this->LoadTemplate('sistema/usuario/index', $dados);
    }

    //ANCHOR - Listar Usuários
    public function listar()
    {
        $this->checkAcesso(array(1));
        $u = new Usuarios();
        $dados['tituloPagina'] = "Usuários";
        $dados['listaUsuarios'] = $u->listaUsuarios();
        $this->LoadTemplate('sistema/usuario/index', $dados);
    }

    //ANCHOR - Perfil
    public function perfil()
    {
        $this->checkAcesso(array(1, 2));
        $dados['tituloPagina'] = "Perfil";
        $this->LoadTemplate('sistema/usuario/perfil', $dados);
    }

    //ANCHOR - Alterar Senha
    public function alterarsenha()
    {
        $this->checkAcesso(array(1, 2));
        $user = $this->usuarioAtual;
        if (isset($_POST['submit'])) {
            $pwd_old_peppered = hash_hmac("sha256", $_POST['atual'], $this->pepper);
            if (password_verify($pwd_old_peppered, $user['password'])) {
                if ($_POST['nova'] == $_POST['confirma']) {
                    $u = new Usuarios;
                    $pwd = $_POST['nova'];
                    $pwd_peppered = hash_hmac("sha256", $pwd, $this->pepper);
                    $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
                    if ($u->alterarSenha($user['id'], $pwd_hashed)) {
                        $this->msg('s', "Senha atualizada");
                        header("Location: " . BASE_URL . "usuario/perfil");
                    }
                } else {
                    $this->msg('d', "A confirmação deve ser igual à nova senha");
                    header("Location: " . BASE_URL . "usuario/alterarsenha");
                }
            } else {
                $this->msg('d', "Senha atual inválida");
                header("Location: " . BASE_URL . "usuario/perfil");
            }
        } else {
            $dados['tituloPagina'] = "Alterar Senha";
            $this->LoadTemplate('sistema/usuario/alterarsenha', $dados);
        }
    }

    //ANCHOR - Adicionar Usuário
    public function adicionar()
    {
        $this->checkAcesso(array(1));
        $u = new Usuarios;
        if (isset($_POST['submit'])) {
            if ($_POST['senha'] === $_POST['confirmarsenha']) {
                if ($_POST['nome'] != '' && $_POST['usuario'] != '' && $_POST['grupo'] != '' && $_POST['senha'] != '') {
                    if ($u->buscaUsername($_POST['usuario'])) {
                        $pwd = $_POST['senha'];
                        $pwd_peppered = hash_hmac("sha256", $pwd, $this->pepper);
                        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
                        if ($u->cadastraUsuario($_POST['nome'], $_POST['usuario'], $_POST['grupo'],  $pwd_hashed)) {
                            $this->msg('s', "Usuário adicionado com sucesso");
                            header("Location: " . BASE_URL . "usuario/adicionar");
                        } else {
                            $this->msg('d', "Falha ao Adicionar");
                            header("Location: " . BASE_URL . "usuario/adicionar");
                        }
                    } else {
                        $this->msg('d', "Já existe cadastro para este usuário");
                        header("Location: " . BASE_URL . "usuario/adicionar");
                    }
                } else {
                    $this->msg('d', "Preencha os campos obrigatórios");
                    header("Location: " . BASE_URL . "usuario/adicionar");
                }
            } else {
                $this->msg('d', "A senha e a confirmação são diferentes");
                header("Location: " . BASE_URL . "usuario/adicionar");
            }
        } else {
            $dados['grupos'] = $u->listaGrupos();
            $dados['tituloPagina'] = "Cadastro de Usuário";
            $this->LoadTemplate('sistema/usuario/adicionar', $dados);
        }
    }

    //ANCHOR - Editar Usuário
    public function editar($id = 0)
    {
        $this->checkAcesso(array(1));
        $u = new Usuarios;
        if (isset($_POST['submit'])) {
            if ($_POST['nome'] != '' && $_POST['usuario'] != '' && $_POST['grupo'] != '' && $_POST['status'] != '') {

                if ($u->editaUsuario($id, $_POST['nome'], $_POST['usuario'], $_POST['grupo'], $_POST['status'])) {
                    $this->msg('s', "Usuário editado com sucesso");
                    header("Location: " . BASE_URL . "usuario");
                } else {
                    $this->msg('d', "Falha ao Editar");
                    header("Location: " . BASE_URL . "usuario");
                }
            } else {
                $this->msg('d', "Preencha os campos obrigatórios");
                header("Location: " . BASE_URL . "usuario");
            }
        } else {
            $dados['grupos'] = $u->listaGrupos();
            $dados['user'] = $u->buscaID($id);
            $dados['tituloPagina'] = "Editar Usuário";
            $this->LoadTemplate('sistema/usuario/editar', $dados);
        }
    }

    //ANCHOR - Login
    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (isset($_COOKIE[$this->cookiename])) {
                unset($_COOKIE[$this->cookiename]);
                setcookie($this->cookiename, null, -1, '/');
            }
            $u = new Usuarios();
            $pass = hash_hmac("sha256", $_POST['password'], $this->pepper);
            $user = $u->verificaUsuario($_POST['username']);
            if ($user) {
                if (password_verify($pass, $user['password'])) {
                    if ($user['statusUser'] == 1) {
                        if ($user['saltUser'] != NULL) {
                            $str = $user['saltUser'];
                        } else {
                            $str = $this->randString(30);
                        }
                        if ($u->logaUsuario($user['id'], $str)) {
                            setcookie($this->cookiename, $str, time() + (30 * 24 * 60 * 60), '/');
                            $this->msg('s', "Bem-vindo, " . $user['nomeUsuario']);
                            header("Location: " . BASE_URL);
                        } else {
                            $this->msg('d', "Não foi possível realizar o login.");
                            header("Location: " . BASE_URL . "login.php");
                        }
                    } else {
                        $this->msg('d', "Este usuário está inativo.");
                        header("Location: " . BASE_URL . "login.php");
                    }
                } else {
                    $this->msg('d', "Usuário ou senha inválidos");
                    header("Location: " . BASE_URL . "login.php");
                }
            }
        }
    }

    //ANCHOR - Logout
    public function logout()
    {
        $user = $this->usuarioAtual;
        $u = new Usuarios();
        $desloga = $u->deslogaUsuario($user['id']);
        print_r($desloga);
        if ($desloga == 1) {
            if (isset($_COOKIE[$this->cookiename])) {
                unset($_COOKIE[$this->cookiename]);
                setcookie($this->cookiename, null, -1, '/');
            }
            $this->msg('s', "Logout efetuado");
            header("Location: " . BASE_URL . "login.php");
        } else {
            unset($_COOKIE[$this->cookiename]);
            setcookie($this->cookiename, null, -1, '/');
            $this->msg('s', "Erro no Logout");
            header("Location: " . BASE_URL . "login.php");
        }
    }

    //ANCHOR - Logout Geral
    public function deslogatodos()
    {
        $this->checkAcesso(array(1));
        $u = new Usuarios();
        $desloga = $u->deslogaTodos();
        print_r($desloga);
        if ($desloga == 1) {
            if (isset($_COOKIE[$this->cookiename])) {
                unset($_COOKIE[$this->cookiename]);
                setcookie($this->cookiename, null, -1, '/');
            }
            $this->msg('s', "Logout efetuado");
            header("Location: " . BASE_URL . "login.php");
        } else {
            unset($_COOKIE[$this->cookiename]);
            setcookie($this->cookiename, null, -1, '/');
            $this->msg('s', "Erro no Logout");
            header("Location: " . BASE_URL . "login.php");
        }
    }
}
