<?php

namespace App\Controller;

use App\Model\Livro;

final class LivroController extends Controller
{
    public static function cadastro(): void
    {
        parent::isProtected();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Livro();
            $model->id = !empty($_POST['id']) ? (int) $_POST['id'] : null;

            $model->titulo = $_POST['titulo'];
            $model->editora = $_POST['editora'];
            $model->ano = (int) $_POST['ano'];
            $model->isbn = $_POST['isbn'];
            $model->id_categoria = (int) $_POST['id_categoria'];
            $model->id_autor = (int) $_POST['autor'];

            $model->save();

            header("location: /livro");
        } else {
            $model = new Livro();
            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
            $model->categorias = $model->getCategorias();
            $model->autores = $model->getAutores();
            $lista = $model->getAllRows();
            include VIEWS . '/Livro/form_livro.php';
        }
    }


    public static function listar(): void
    {
        parent::isProtected();
        $model = new Livro();
        $model->categorias = $model->getCategorias();
        $lista = $model->getAllRows();

        include VIEWS . '/Livro/lista_livro.php';
    }

    public static function excluir(): void
    {
        parent::isProtected();
        $id = (int) $_GET['id'];
        $livro = new Livro();
        $livro->delete($id);
        header("location: /livro");
    }
}
