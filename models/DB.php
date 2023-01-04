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

    //ANCHOR - Listar por prefixo
    public function listByPrefix($prefix)
    {
        if ($prefix == 'app_')
            $prefix = '';
        $sql = $this->db->prepare("SELECT id, banco FROM clientes__bancos WHERE status = 1 AND prefixo = ?");
        $sql->execute(array($prefix));
        $dados = $sql->fetchAll();
        return $dados;
    }


    //ANCHOR - Adicionar Banco
    public function addBanco($cliente, $prefix, $sufix)
    {
        if ($prefix == 'app_')
            $prefix = '';
        $sql = $this->db->prepare("INSERT INTO clientes__bancos ( cliente_id, prefixo, banco , status ) VALUES ( ?, ?, ?, 1 )");
        $sql->execute(array($cliente, $prefix, $sufix));
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
