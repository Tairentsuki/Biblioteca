<?php

namespace App\DAO;

use App\Model\Log;
use PDO;

class LogDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(Log $model)
    {
        $sql = "INSERT INTO sistema_logs (tabela_nome, registro_id, acao, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tabela_nome);
        $stmt->bindValue(2, $model->registro_id);
        $stmt->bindValue(3, $model->acao);
        $stmt->bindValue(4, $model->usuario_id);
        $stmt->execute();
    }

    public function select(): array
    {
        $sql = "SELECT * FROM sistema_logs ORDER BY data_hora DESC LIMIT 50";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Log");
    }
}
