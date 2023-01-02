<?php
class Usuarios extends model
{

    //ANCHOR - Verifica Usuário
    public function verificaUsuario($user)
    {
        $sql = $this->db->prepare("SELECT u.id,
        u.username,
        u.nomeUsuario,
        u.saltUser,
        u.password,
        u.status AS statusUser,
        g.status AS statusGrupo 
        FROM system__users u 
        INNER JOIN system__gruposusuarios g on u.grupoUsuario = g.id 
        WHERE u.username= :user");
        $sql->bindValue(":user", $user);
        $sql->execute();
        $dados = array();
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch();
        } else {
            $dados = false;
        }
        return $dados;
    }

    //ANCHOR - Loga Usuário
    public function logaUsuario($user, $salt)
    {
        $validadeSalt = strtotime('+30 days');
        $validadeSalt = date('Y-m-d', $validadeSalt);
        $sql = $this->db->prepare("UPDATE system__users SET saltUser= null, validadeSalt = null, ultimoLogin = NOW() WHERE id= :id");
        $sql->bindValue(":id", $user);
        $sql->execute();
        $sql = $this->db->prepare("UPDATE system__users SET saltUser= :salt, validadeSalt = :validadeSalt, ultimoLogin = NOW() WHERE id= :id");
        $sql->bindValue(":salt", $salt);
        $sql->bindValue(":validadeSalt", $validadeSalt);
        $sql->bindValue(":id", $user);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ANCHOR - Alterar Senha
    public function alterarSenha($user, $senha)
    {
        $sql = $this->db->prepare("UPDATE system__users SET password= :senha WHERE id= :id");
        $sql->bindValue(":id", $user);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ANCHOR - Desloga Usuário
    public function deslogaUsuario($id)
    {
        $sql = $this->db->prepare("UPDATE system__users SET saltUser = null, validadeSalt = null WHERE id= :id");
        $sql->bindValue(":id", $id);
        print_r($id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //ANCHOR - Desloga Todos
    public function deslogaTodos()
    {
        $sql = $this->db->prepare("UPDATE system__users SET saltUser= null");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //ANCHOR - Lista Usuários
    public function listaUsuarios($ativo = false)
    {
        if ($ativo) {
            $sql = $this->db->prepare("SELECT * FROM system__users WHERE status=1");
        } else {
            $sql = $this->db->prepare("SELECT * FROM system__users");
        }
        $sql->execute();
        $dados = array();
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
        }
        return $dados;
    }

    //ANCHOR - Busca Username
    public function buscaUsername($username)
    {
        $sql = $this->db->prepare("SELECT * FROM system__users WHERE username=:username");
        $sql->bindValue(":username", $username);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    //ANCHOR - Busca ID
    public function buscaID($id)
    {
        $sql = $this->db->prepare("SELECT * FROM system__users WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $dados = array();
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch();
        }
        return $dados;
    }

    //ANCHOR - Lista Grupos
    public function listaGrupos()
    {
        $sql = $this->db->prepare("SELECT * FROM system__gruposusuarios");
        $sql->execute();
        $dados = array();
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
        }
        return $dados;
    }

    //ANCHOR - Cadastra Usuário
    public function cadastraUsuario($nome, $usuario, $grupo, $senha)
    {
        $sql = $this->db->prepare("INSERT INTO `system__users`(`nomeUsuario`, `username`,  `grupoUsuario`, `password`, `status`) VALUES (:nomeUsuario, :username,  :grupoUsuario, :password, 1)");
        $sql->bindValue(":nomeUsuario", $nome);
        $sql->bindValue(":username", $usuario);
        $sql->bindValue(":grupoUsuario", $grupo);
        $sql->bindValue(":password", $senha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ANCHOR - Edita Usuário
    public function editaUsuario($id, $nome, $usuario, $grupo, $status)
    {
        $user = $this->buscaID($id);
        $sql = "UPDATE `system__users` SET ";
        if ($user['nomeUsuario'] != $usuario) {
            $sql .= "`nomeUsuario` = :nomeUsuario,";
        }
        if ($user['username'] != $usuario) {
            $sql .= "`username` = :username,";
        }
        if ($user['grupoUsuario'] != $usuario) {
            $sql .= "`grupoUsuario` = :grupoUsuario,";
        }
        $sql .= "`status`=:status WHERE id=:id";
        $sql = $this->db->prepare($sql);
        if ($user['nomeUsuario'] != $usuario) {
            $sql->bindValue(":nomeUsuario", $nome);
        }
        if ($user['username'] != $usuario) {
            $sql->bindValue(":username", $usuario);
        }
        if ($user['grupoUsuario'] != $usuario) {
            $sql->bindValue(":grupoUsuario", $grupo);
        }
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
