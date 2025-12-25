<?php

namespace App\Model;

use App\DAO\LivroDAO;

final class Livro
{
    public $id;
    public $titulo;
    public $editora;
    public $ano;
    public $isbn;
    public $id_categoria;
    public $id_autor;
    public $categorias;
    public $autores;


    public function save(): Livro
    {
        return (new LivroDAO())->save($this);
    }

    public function getById(int $id): ?Livro
    {
        return (new LivroDAO())->getById($id);
    }

    public function getAllRows(): array
    {
        return (new LivroDAO())->getAllRows();
    }

    public function delete(int $id): bool
    {
        return (new LivroDAO())->delete($id);
    }

    public function getCategorias(): array
    {
        return (new Categoria())->getAllRows();
    }

    public function getAutores(): array
    {
        return (new Autor())->getAllRows();
    }
}
