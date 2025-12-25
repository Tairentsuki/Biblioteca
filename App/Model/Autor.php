<?php

namespace App\Model;

class Autor{
    public $id;
    public $nome;
    public $data_nascimento;
    public $cpf;

    public function save(): Autor{
        return (new \App\DAO\AutorDAO())->save($this);
    }

    public function getAllRows(): array{
        return (new \App\DAO\AutorDAO())->getAllRows();
    }

    public function getById(int $id): ?Autor{
        return (new \App\DAO\AutorDAO())->getById($id);
    }

    public function delete(int $id): void{
        (new \App\DAO\AutorDAO())->delete($id);
    }
}