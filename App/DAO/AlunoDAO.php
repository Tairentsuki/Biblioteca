<?php

namespace App\DAO;

use App\Model\Aluno;
use PDO;

final class AlunoDAO extends DAO
{
    public function save(Aluno $model): Aluno
    {
        return (empty($model->id)) 
        ? $this->insert($model) 
        : $this->update($model);
    }

    public function insert(Aluno $model): Aluno
    {
        $sql = "INSERT INTO aluno (nome, ra, curso) VALUES (?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->ra);
        $stmt->bindValue(3, $model->curso);
        $stmt->execute();

        $model->id = self::$conexao->lastInsertId();

        // Gera array de dados para o log
        $dadosLog = $this->compararMudancas(null, $model);
        $this->registerLog('aluno', $model->id, 'Inserido', $dadosLog);

        return $model;
    }

    public function update(Aluno $model): Aluno
    {
        $antigo = $this->selectById($model->id);

        $sql = "UPDATE aluno SET nome = ?, ra = ?, curso = ? WHERE id = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->ra);
        $stmt->bindValue(3, $model->curso);
        $stmt->bindValue(4, $model->id);
        $stmt->execute();

        $dadosLog = $this->compararMudancas($antigo, $model);
        $this->registerLog('aluno', $model->id, 'Atualizado', $dadosLog);

        return $model;
    }

    public function selectById(int $id): ?Aluno
    {
        $sql = "SELECT * FROM aluno WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        // Retorna false se não achar, ou o objeto Aluno
        return $stmt->fetchObject(Aluno::class) ?: null;
    }

    public function select(): array
    {
        $sql = "SELECT * FROM aluno";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Aluno::class);
    }

    public function delete(int $id): bool
    {
        $alunoParaDeletar = $this->selectById($id);

        if ($alunoParaDeletar) {
            $sql = "DELETE FROM aluno WHERE id = ?";
            $stmt = self::$conexao->prepare($sql);
            $stmt->bindValue(1, $id);

            if ($stmt->execute()) {
                $dadosLog = $this->compararMudancas($alunoParaDeletar, null);
                $this->registerLog('aluno', $id, 'Deletado', $dadosLog);
                return true;
            }
        }
        return false;
    }
}
