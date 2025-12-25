<?php

namespace App\Controller;

use App\Model\Emprestimo;
use App\Model\Livro;
use App\Model\Aluno;
use App\Model\Usuario;

class EmprestimoController extends Controller
{
    public static function listar(): void
    {
        parent::isProtected();

        $lista = (new Emprestimo())->getAllRows();

        include  VIEWS . "/Emprestimo/lista_emprestimo.php";
    }

    public static function cadastro(): void
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $model = new Emprestimo();

            $model->id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
            $model->data_emprestimo = $_POST['data_emprestimo'];
            $model->data_devolucao = $_POST['data_devolucao'];
            $model->id_livro = $_POST['id_livro'];
            $model->id_aluno = $_POST['id_aluno'];
            $model->id_usuario = $_POST['id_usuario'];

            $model->save();
            var_dump($model);
            header("location: /emprestimo");
        } else {

            $model = new Emprestimo();
            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }

            $lista_livros = (new Livro())->getAllRows();
            $lista_alunos = (new Aluno())->getAllRows();
            $lista_usuarios = (new Usuario())->getAllRows();
        }

        include VIEWS . '/Emprestimo/form_emprestimo.php';
    }

    public static function excluir()
    {
        parent::isProtected();
        $id = (int) $_GET['id'];
        $autor = new Emprestimo();
        $autor->delete($id);
        header("location: /emprestimo");
    }
}
