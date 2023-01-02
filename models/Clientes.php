<?php
class Clientes extends model
{
    //ANCHOR - Listar Clientes
    public function listClientes()
    {
        $sql = $this->db->prepare("SELECT id, alcunha, (SELECT count(banco) AS bancos FROM clientes__bancos WHERE banco = alcunha) AS bancos FROM clientes WHERE status=1");
        $sql->execute();
        $dados = $sql->fetchAll();
        return $dados;
    }

    //ANCHOR - Adicionar Clientes
    public function addCliente($alcunha)
    {
        $sql = $this->db->prepare("INSERT INTO clientes (alcunha, status) VALUES (?,1)");
        $sql->execute(array($alcunha));
        if ($sql->rowCount() > 0) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
}
