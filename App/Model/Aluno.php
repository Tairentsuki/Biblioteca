<?php

namespace App\Model;


use App\DAO\AlunoDAO;
final class Aluno
{
    public $id;
    public $nome;
    public $ra;
    public $curso;



    public function save(): Aluno
    {
        return (new AlunoDAO())->save($this);
    }

    public function getById(int $id): ?Aluno
    {
        return (new AlunoDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        return (new AlunoDAO())->select();
    }

    public function delete(int $id): bool
    {
        return (new AlunoDAO())->delete($id);
    }
}
