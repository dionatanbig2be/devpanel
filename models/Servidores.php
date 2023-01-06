<?php
class Servidores extends model
{

    //ANCHOR - Listar Servidores
    public function getServers()
    {
        $sql = $this->db->prepare("SELECT * FROM servidores");
        $sql->execute();
        $dados = $sql->fetchAll();
        return $dados;
    }

    //ANCHOR - Adicionar Servidor
    public function insertServer($descricao, $acesso, $dominio)
    {
        $sql = $this->db->prepare("INSERT INTO servidores (descricao, acesso, dominio, status) VALUES (?,?,?,?)");
        $sql->execute(array($descricao, $acesso, $dominio, 1));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
