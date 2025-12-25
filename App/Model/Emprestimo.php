<?php

namespace App\Model;
use App\DAO\EmprestimoDAO;

class Emprestimo{
    public $id;
    public $data_emprestimo;
    public $data_devolucao;
    public $id_aluno;
    public $id_livro;
    public $titulo_livro;
    public $id_usuario;


    public function save(){
        return (new EmprestimoDAO())->save($this);
    }
    public function getAllRows(){
        return (new EmprestimoDAO())->getAllRows();
    }

    public function getById(int $id){
        return (new EmprestimoDAO())->getById($id);
    }

    public function delete(int $id){
        return (new EmprestimoDAO())->delete($id);
    }
}


?>