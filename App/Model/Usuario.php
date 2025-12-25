<?php

namespace App\Model;

class Usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;

    public function save(): Usuario{
        return (new \App\DAO\UsuarioDAO())->save($this);
    }

    public function getAllRows(): array{
        return (new \App\DAO\UsuarioDAO())->getAllRows();
    }

    public function getById(int $id): ?Usuario{
        return (new \App\DAO\UsuarioDAO())->getById($id);
    }

    public function delete(int $id): void{
        (new \App\DAO\UsuarioDAO())->delete($id);
    }
}