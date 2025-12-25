<?php

namespace App\Controller;

use App\Model\Categoria;

class CategoriaController extends Controller
{

    public static function listar()
    {
        parent::isProtected();
        $categoria = new Categoria();
        $lista = $categoria->getAllRows();
        include VIEWS . '/Categoria/lista_categoria.php';
    }

    public static function cadastro()
    {
        parent::isProtected();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $model = new Categoria();
            $model->id = !empty($_POST['id']) ? $_POST['id'] : null;
            $model->descricao = $_POST['descricao'];
            $model->save($model);

            header("Location: /Categoria");
        } else {
            $model = new Categoria();

            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
            include VIEWS . '/Categoria/form_categoria.php';
        }
    }

    public static function excluir()
    {
        parent::isProtected();
        $categoria = new Categoria();
        $id = (int) $_GET['id'];
        $categoria->delete($id);
        header("Location: /Categoria");
    }
}
