<?php

namespace App\Controller;

use App\Model\Aluno;

final class AlunoController extends Controller
{
    public static function cadastro(): void
    {
        parent::isProtected();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Aluno();
            $model->id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
            $model->nome = $_POST['nome'];
            $model->ra = $_POST['ra'];
            $model->curso = $_POST['curso'];
            $model->save();

            header("location: /aluno");
        } else {
            $model = new Aluno();

            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
            include VIEWS . '/Aluno/form_aluno.php';
        }

        //       echo "Vou mostrar o formulário a depender do método de requisição";

        // echo "Aluno inserido";

    }

    public static function listar(): void
    {
        parent::isProtected();
        $aluno = new Aluno();
        $lista = $aluno->getAllRows();
        // var_dump($lista);

        include VIEWS . '/Aluno/lista_aluno.php';
    }

    public static function excluir(): void
    {
                parent::isProtected();
        $id = (int) $_GET['id'];
        $aluno = new Aluno();
        $aluno->delete($id);
        header("location: /aluno");
    }
}
