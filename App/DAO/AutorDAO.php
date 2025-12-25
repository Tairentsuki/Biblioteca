<?php

namespace App\DAO;

use App\Model\Autor;
use App\DAO\DAO;

use PDO;

class AutorDAO extends DAO
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(Autor $model): Autor
    {

        return (empty($model->id))
            ? $this->insert($model)
            : $this->update($model);
    }   

    public function insert(Autor $model): Autor
    {
        $sql = "INSERT INTO autor (nome, data_nascimento, cpf) 
                VALUES (?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->data_nascimento);
        $stmt->bindValue(3, $model->cpf);
        $stmt->execute();

        $model->id = self::$conexao->LastInsertId();

        return $model;
    }

    public function update(Autor $model): Autor
    {
        $sql = "UPDATE autor
                   SET nome = ?, 
                       data_nascimento = ?, 
                       cpf = ? 
                 WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->data_nascimento);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->id);
        $stmt->execute();

        $model->id = self::$conexao->LastInsertId();

        return $model;
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * FROM autor";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Autor::class);
    }

    public function getById(int $id): ?Autor
    {
        $sql = "SELECT * FROM autor WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject(Autor::class) ?: null;
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM autor WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
