<?php
class DB extends model
{

    //ANCHOR - Listar DB
    public function listDB()
    {
        $sql = $this->db->prepare("SELECT DISTINCT prefixo FROM clientes__bancos");
        $sql->execute();
        $prefix = $sql->fetchAll();
        $dados = array();
        foreach ($prefix as $pf) {
            if ($pf['prefixo'] == '')
                $pf['prefixo'] = 'app_';
            $dados[$pf['prefixo']] = $this->listByPrefix($pf['prefixo']);
        }
        return $dados;
    }

    //ANCHOR - Get Banco
    public function getBanco($id)
    {
        $sql = $this->db->prepare("SELECT * FROM clientes__bancos WHERE id = ?");
        $sql->execute(array($id));
        $dados = $sql->fetch();
        return $dados;
    }

    //ANCHOR - Listar por prefixo
    public function listByPrefix($prefix)
    {
        if ($prefix == 'app_')
            $prefix = '';
        $sql = $this->db->prepare("SELECT cb.id, cb.banco, s.descricao AS servidor FROM clientes__bancos cb INNER JOIN servidores s ON s.id = cb.servidor WHERE cb.status = 1 AND cb.prefixo = ?");
        $sql->execute(array($prefix));
        $dados = $sql->fetchAll();
        return $dados;
    }


    //ANCHOR - Adicionar Banco
    public function addBanco($cliente, $prefix, $sufix, $servidor)
    {
        if ($prefix == 'app_')
            $prefix = '';
        $sql = $this->db->prepare("INSERT INTO clientes__bancos ( cliente_id, prefixo, banco, servidor, status ) VALUES ( ?, ?, ?, ?, 1 )");
        $sql->execute(array($cliente, $prefix, $sufix, $servidor));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    //ANCHOR - Editar Banco
    public function editaBanco($id, $cliente, $prefix, $sufix, $servidor)
    {
        if ($prefix == 'app_')
            $prefix = '';
        $sql = $this->db->prepare("UPDATE clientes__bancos SET cliente_id = ?, prefixo = ?, banco = ?, servidor = ? WHERE id = ?");
        $sql->execute(array($cliente, $prefix, $sufix, $servidor, $id));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ANCHOR - Excluir Banco
    public function deleteBanco($id)
    {
        $sql = $this->db->prepare("DELETE FROM clientes__bancos WHERE id = ?");
        $sql->execute(array($id));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //ANCHOR - Executar SQL
    public function doSql($usr, $sql)
    {
        $server = new Big2be_Server();
        $server->initialize($usr);
        if ($server->isInitialized() === false)
            return "Não conectado";
        $server->addSql('sql', $sql)->execute()->getResult("sql");
        return $server->getLastErrorMessage();
    }
}
