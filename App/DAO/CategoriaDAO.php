<?php

namespace App\DAO;

use App\Model\Categoria;
use PDO;

class CategoriaDAO extends DAO {


    public function save(Categoria $model): Categoria
    {
        return (empty($model->id)) 
        ? $this->insert($model) 
        : $this->update($model);
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * 
                  FROM categoria";

        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categoria::class);
    }

    public function insert(Categoria $model): Categoria
    {
        $sql = "INSERT INTO categoria (descricao)
                VALUES (?)";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->descricao);
        $stmt->execute();

        $model->id = self::$conexao->LastInsertId();

        return $model;
    }

    public function update(Categoria $model): Categoria
    {
        $sql = "UPDATE categoria 
                   SET descricao = ? 
                 WHERE id = ?";
        
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->descricao);
        $stmt->bindValue(2, $model->id);
        $stmt->execute();

        return $model;

    }

    public function getById(int $id): ?Categoria
    {
        $sql = "SELECT * FROM categoria WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        
        return $stmt->FetchObject(Categoria::class) ?: null;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM categoria WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
