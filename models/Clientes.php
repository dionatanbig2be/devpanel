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

    //ANCHOR - Get Grupo
    public function getGrupo($grupo_id)
    {
        $sql = $this->db->prepare("SELECT id, nomeGrupo, acesso FROM clientes__gruposusuarios WHERE id = ?");
        $sql->execute(array($grupo_id));
        $dados = $sql->fetch();
        return $dados;
    }

    //ANCHOR - Listar Lojas
    public function listLojas($usr)
    {
        $this->server->initialize($usr);
        if ($this->server->isInitialized() === false) die('Erro no Servidor');
        $dados = $this->server->addSql('sql', "SELECT id, storeId, title FROM stores")->execute()->getResult("sql")->getRows();
        return  $dados;
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

    //ANCHOR - Insere Login CLI
    public function insertAuthloginCli($cliente, $usuario, $senha,  $grupo, $siteecommerce, $tipo)
    {
        $server = new Big2be_Server();
        $server->initialize('cli');
        if ($server->isInitialized() === false) die('Erro no Servidor');
        $sql =  "INSERT INTO authlogin (
            user,
            pass, 
            authType, 
            suffix, 
            businessType, 
            apiVersion, 
            opencart_suffix, 
            siteecommerce, 
            userecommerce, 
            dashboard_fat, 
            big2be_operacoes, 
            big2be_consulta, 
            big2be_separacao, 
            pk, 
            big2be_delivery, 
            big2be_motoboy, 
            initial_page) 
            VALUES (
                '$usuario',
                '$senha',
                '$grupo',
                '$cliente',
                'S',
                'v2',
                'dlv_$cliente',
                '$siteecommerce',
                'usuario',
                '',
                '" . $tipo['operacoes'] . "',
               '" . $tipo['consulta'] . "',
               '" . $tipo['separacao'] . "',
                '',
                '" . $tipo['delivery'] . "',
                '" . $tipo['motoboy'] . "',
                '')";
        $server->addSql('sql', $sql)->execute()->getResult("sql");
        if ($server->getLastErrorMessage() != '') {
            return false;
        } else {
            return true;
        }
    }

    //ANCHOR - Insere Pages CLI
    public function insertAuthpagesCli($grupo, $pages)
    {
        $server = new Big2be_Server();
        $server->initialize('cli');
        if ($server->isInitialized() === false) die('Erro no Servidor');
        $sql =  "INSERT INTO authpages (authType,authPages) VALUES ('$grupo','$pages')";
        $server->addSql('sql', $sql)->execute()->getResult("sql");
        if ($server->getLastErrorMessage() != '') {
            return false;
            die($server->getLastErrorMessage());
        } else {
            return true;
        }
    }

     //ANCHOR - Insere Permissions CLI
     public function insertPermissionsCli($usuario, $cliente, $lojas)
     {
         $server = new Big2be_Server();
         $server->initialize('cli');
         if ($server->isInitialized() === false) die('Erro no Servidor');
         $sql =  "INSERT INTO permissions (username, suffix, permission, extra, created_by, created_at) VALUES ('$usuario','$cliente', 'permission.admin', '$lojas', 'system', NOW())";
         $server->addSql('sql', $sql)->execute()->getResult("sql");
         if ($server->getLastErrorMessage() != '') {
             return false;
         } else {
             return true;
         }
     }
}
