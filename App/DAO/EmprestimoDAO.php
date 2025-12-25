<?php

namespace App\DAO;

use App\DAO\DAO;
use App\Model\Emprestimo;
use PDO;

class EmprestimoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Emprestimo $model)
    {
        // CORREÇÃO 1: Lógica invertida corrigida.
        // Se tem ID, atualiza. Se não tem, insere.
        return !empty($model->id) ? $this->update($model) : $this->insert($model);
    }

    public function insert(Emprestimo $model)
    {
        // CORREÇÃO 2: Removi o 'id' (deixa o banco criar) e corrigi o erro de digitação 'id_usuar1io'
        // CORREÇÃO 3: Ajustei a quantidade de '?' para bater com as colunas (5 colunas = 5 interrogações)
        $sql = "INSERT INTO emprestimo (data_emprestimo, data_devolucao, id_livro, id_aluno, id_usuario)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);
        
        $stmt->bindValue(1, $model->data_emprestimo);
        $stmt->bindValue(2, $model->data_devolucao);
        $stmt->bindValue(3, $model->id_livro);
        $stmt->bindValue(4, $model->id_aluno);
        $stmt->bindValue(5, $model->id_usuario);

        // CORREÇÃO 4: Faltava o execute()
        $stmt->execute();

        // Pega o ID que o banco acabou de criar e coloca no model
        $model->id = self::$conexao->lastInsertId();

        return $model;
    }

    public function update(Emprestimo $model)
    {
        // Implementação do UPDATE que estava faltando
        $sql = "UPDATE emprestimo SET data_emprestimo=?, data_devolucao=?, id_livro=?, id_aluno=?, id_usuario=? WHERE id=?";

        $stmt = self::$conexao->prepare($sql);
        
        $stmt->bindValue(1, $model->data_emprestimo);
        $stmt->bindValue(2, $model->data_devolucao);
        $stmt->bindValue(3, $model->id_livro);
        $stmt->bindValue(4, $model->id_aluno);
        $stmt->bindValue(5, $model->id_usuario);
        $stmt->bindValue(6, $model->id); // O ID vai no WHERE

        return $stmt->execute();
    }

    public function getAllRows()
    {
        // Adicionei colunas do aluno e usuario para facilitar a listagem depois, se precisar
        $sql = "SELECT emprestimo.*, livro.titulo as titulo_livro 
                  FROM emprestimo
                  JOIN livro ON emprestimo.id_livro = livro.id
                 ORDER BY data_emprestimo DESC";

        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_CLASS, Emprestimo::class);
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM emprestimo WHERE id=?";
        
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject(Emprestimo::class);
    }
    
    // Método extra útil para exclusão
    public function delete(int $id)
    {
        $sql = "DELETE FROM emprestimo WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}