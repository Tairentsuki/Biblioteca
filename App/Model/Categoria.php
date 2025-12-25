<?php

namespace App\Model;

use App\DAO\CategoriaDAO;

class Categoria
{
    public $id;
    public $descricao;


    public function save(): Categoria
    {
        return (new CategoriaDAO())->save($this);
    }

    public function getAllRows()
    {
        return (new CategoriaDAO())->getAllRows();
    }

    public function insert(): Categoria
    {
        return (new CategoriaDAO())->insert($this);
    }

    public function getById(int $id): ?Categoria
    {
        return (new CategoriaDAO())->getById($id);
    }

    public function delete(int $id): bool
    {
        return (new CategoriaDAO())->delete($id);
    }
}
