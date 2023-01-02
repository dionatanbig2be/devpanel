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

    //ANCHOR - Listar Grupos
    public function listGrupos($cliente_id)
    {
        $sql = $this->db->prepare("SELECT id, nomeGrupo, acesso FROM clientes__gruposusuarios WHERE status=1 AND cliente_id = ?");
        $sql->execute(array($cliente_id));
        $dados = $sql->fetchAll();
        return $dados;
    }

    //ANCHOR - Listar Páginas
    public function listPaginas()
    {
        $sql = $this->db->prepare("SELECT id, pagina FROM clientes__paginas ORDER BY pagina ASC");
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

    //ANCHOR - Adicionar Grupo
    public function addGrupo($nome, $cliente_id,  $paginas)
    {
        $sql = $this->db->prepare("INSERT INTO clientes__gruposusuarios (nomeGrupo, cliente_id, acesso, status) VALUES (?,?,?,1)");
        $sql->execute(array($nome, $cliente_id,  $paginas));
        if ($sql->rowCount() > 0) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
}
