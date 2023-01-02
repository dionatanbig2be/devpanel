<?php
class model
{

    protected $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public function checaSalt($salt)
    {
        $sql = $this->db->prepare("SELECT u.id,
                                          u.nomeUsuario,
                                          u.username,
                                          u.password,
                                          u.saltUser,
                                          u.validadeSalt,
                                          u.imagemUsuario,
                                          u.grupoUsuario,
                                          u.status AS statusUser,
                                          u.ultimoLogin,
                                          u.tema,
                                          g.status AS statusGrupo,
                                          g.id AS idGrupo,
                                          g.nomeGrupo
                                    FROM system__users u 
                                    INNER JOIN system__gruposusuarios g on u.grupoUsuario = g.id 
                                    WHERE u.saltUser= :salt");
        $sql->bindValue(":salt", $salt);
        $sql->execute();
        $dados = array();
        $dados = $sql->fetch();
        return $dados;
    }

    public function geraMenu()
    {
        $sql = $this->db->prepare("SELECT id, titulo, icone, caminho, menuPai, acesso FROM system__menu WHERE menuPai = 0 ORDER BY ordem");
        $sql->execute();
        $dados = array();
        $dados = $sql->fetchAll();
        $i = 0;
        foreach ($dados as $d) {
            $children = $this->getMenuChildren($d['id']);
            if ($children)
                $dados[$i]['children'] = $children;
            $i++;
        }
        return $dados;
    }


    public function getMenuChildren($id)
    {
        $sql = $this->db->prepare("SELECT id, titulo, icone, caminho, menuPai, acesso FROM system__menu WHERE menuPai = :id ORDER BY ordem");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $dados = array();
        $dados = $sql->fetchAll();
        $i = 0;
        foreach ($dados as $d) {
            $children = $this->getMenuChildren($d['id']);
            if ($children)
                $dados[$i]['children'] = $children;
            $i++;
        }
        return $dados;
    }
}
