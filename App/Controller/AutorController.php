<?php

namespace App\Controller;

use App\Model\Autor;

class AutorController extends Controller
{

    public static function listar(): void
    {
        parent::isProtected();
        $autor = new Autor();
        $lista = $autor->getAllRows();

        include VIEWS . '/Autor/lista_autor.php';
    }

    public static function cadastro(): void
    {
        parent::isProtected();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Autor();
            $model->id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
            $model->nome = $_POST['nome'];
            $model->data_nascimento = $_POST['data_nascimento'];
            $model->cpf = $_POST['cpf'];
            $model->save();

            header("location: /autor");
        } else {
            $model = new Autor();

            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
            include VIEWS . '/Autor/form_autor.php';
        }
    }

    public static function excluir(): void
    {
        parent::isProtected();
        $id = (int) $_GET['id'];
        $autor = new Autor();
        $autor->delete($id);
        header("location: /autor");
    }
}
