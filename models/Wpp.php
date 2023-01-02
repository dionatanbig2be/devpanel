<?php
class Wpp extends model
{

    //ANCHOR - List Clientes
    public function listClientes()
    {
        $sql = $this->db->prepare("SELECT cb.id, cb.cliente_id, cb.banco, (SELECT id FROM clientes__log_whatsapp WHERE data >= ? AND cliente_id = cb.cliente_id AND tipo='bloqueio') AS bloqueio FROM clientes c INNER JOIN clientes__bancos cb ON c.id = cb.cliente_id WHERE cb.status = 1 AND cb.prefixo = 'wap_'");
        $sql->execute(array(date("Y-m-d H:i:s", strtotime('-7 days'))));
        $dados = $sql->fetchAll();
        return $dados;
    }
    
    //ANCHOR - Listar DB
    public function listLog()
    {
        $sql = $this->db->prepare("SELECT clw.id, c.alcunha AS cliente, clw.data, clw.tipo FROM clientes__log_whatsapp clw INNER JOIN clientes c ON c.id = clw.cliente_id");
        $sql->execute();
        $dados = $sql->fetchAll();
        return $dados;
    }

    //ANCHOR - Bloquear Cliente
    public function bloquear($cliente_id)
    {
        $sql = $this->db->prepare("SELECT alcunha FROM clientes WHERE id = ?");
        $sql->execute(array($cliente_id));
        $usr = 'wap_' . $sql->fetchColumn();
        $server = new Big2be_Server();
        $server->initialize($usr);
        if ($server->isInitialized() === false) die('Erro no Servidor');
        $message_title = base64_encode("Opção Sair Automática");
        $date_send = date("Y-m-d 08:00:00", strtotime("+2 days"));
        $message = base64_encode("Digite sair a qualquer momento caso não deseje mais receber nossas ofertas.");
        $sql_message = "INSERT INTO messages (message_title, message, datetime_send, frequencia, stores, status) VALUES ('$message_title', '$message', '$date_send', 10, 1, 0)";
        $server->addSql('message', $sql_message)->execute();
        if ($server->getLastErrorMessage() != '') {
            return false;
            die();
        }
        $server->addSql('sql', "INSERT INTO service_status (chip, tipo, data, status) VALUES (1,'bloqueio', NOW(), 1)")->execute();
        if ($server->getLastErrorMessage() != '')
            return false;
        else {
            $sql = $this->db->prepare("INSERT INTO clientes__log_whatsapp (cliente_id, tipo, data) VALUES (?,?,NOW())");
            $sql->execute(array($cliente_id, 'bloqueio'));
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    //ANCHOR - Desbloquear Cliente
    public function desbloquear($bloqueio_id)
    {
        $sql = $this->db->prepare("SELECT alcunha FROM clientes c INNER JOIN clientes__log_whatsapp clw ON clw.cliente_id = c.id WHERE clw.id = ?");
        $sql->execute(array($bloqueio_id));
        $usr = 'wap_' . $sql->fetchColumn();
        $server = new Big2be_Server();
        $server->initialize($usr);
        if ($server->isInitialized() === false) die('Erro no Servidor');
        $data_ini = date("Y-m-d", strtotime('-7 days'));
        $message_title = base64_encode("Opção Sair Automática");
        $date_send = date("Y-m-d 23:59:59", strtotime("+2 days"));
        $sql_delete = "DELETE FROM messages WHERE message_title = '$message_title' AND (datetime_send BETWEEN NOW() AND '$date_send')";
        $server->addSql('delete', $sql_delete)->execute();
        $server->addSql('sql', "UPDATE service_status SET tipo='desbloqueio' WHERE tipo = 'bloqueio' AND data >= '$data_ini'")->execute()->getResult("sql");
        if ($server->getLastErrorMessage() != '')
            return false;
        else {
            $sql = $this->db->prepare("UPDATE clientes__log_whatsapp SET tipo = 'desbloqueio' WHERE id = ?");
            $sql->execute(array($bloqueio_id));
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    //ANCHOR - Importar Contatos
    public function importarContatos($csv, $usr)
    {
        $sql = "INSERT INTO customer (chip_id, cpf, name, phone, store_id, receive_offers, date_lgpd, date_added) VALUES ";
        foreach ($csv as $c) {
            $sql .= "($c[0], '$c[1]', '$c[2]', '$c[3]', $c[4], 1, NOW(), NOW()),";
        }
        $sql = rtrim($sql, ',');
        $server = new Big2be_Server();
        $server->initialize($usr);
        if ($server->isInitialized() === false) die('Erro no Servidor');
        $server->addSql('sql',  $sql)->execute()->getResult("sql");
        $dados = $server->getLastErrorMessage();
        if ($dados == '')
            return true;
        else
            return false;
    }
}
