<?php

namespace App\DAO;

use App\Model\livro;
use PDO;

final class livroDAO extends DAO
{
    public function save(livro $model): livro
    {
        var_dump($model->titulo);
        return (empty($model->id))
            ? $this->insert($model)
            : $this->update($model);
    }

    public function insert(livro $model): livro
    {
        $sql = "INSERT INTO livro (titulo, editora, ano, isbn, id_categoria, id_autor)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->titulo);
        $stmt->bindValue(2, $model->editora);
        $stmt->bindValue(3, $model->ano);
        $stmt->bindValue(4, $model->isbn);
        $stmt->bindValue(5, $model->id_categoria);
        $stmt->bindValue(6, $model->id_autor);
        $stmt->execute();

        return $model;
    }

    public function update(livro $model): livro
    {
        $sql = "UPDATE livro 
                    SET titulo = ?, 
                        editora = ?, 
                        ano = ?,
                        isbn = ?, 
                        id_categoria = ?, 
                        id_autor = ?
                    WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->titulo);
        $stmt->bindValue(2, $model->editora);
        $stmt->bindValue(3, $model->ano);
        $stmt->bindValue(4, $model->isbn);
        $stmt->bindValue(5, $model->id_categoria);
        $stmt->bindValue(6, $model->id_autor);
        $stmt->bindValue(7, $model->id);
        $stmt->execute();

        return $model;
    }

    public function getById(int $id): ?livro
    {
        $sql = "SELECT * FROM livro WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $model = $stmt->fetchObject(LIVRO::class);
        return $model;
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * FROM livro";

        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Livro::class);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM livro WHERE id = ?";
        
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
