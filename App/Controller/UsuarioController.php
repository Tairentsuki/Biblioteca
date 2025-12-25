<?php

namespace App\Controller;
use App\Model\Usuario;

class UsuarioController extends Controller{
    
    public static function listar(): void{
        parent::isProtected();
        $usuario = new Usuario();
        $lista = $usuario->getAllRows();

        include VIEWS . '/Usuario/lista_usuario.php';

    }

    public static function cadastro(): void{
    
        parent::isProtected();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $model = new Usuario();
            $model->id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
            $model->nome = $_POST['nome'];
            $model->email = $_POST['email'];
            $model->senha = $_POST['senha'];
            $model->save();

            header("location: /usuario");

        } else {
            $model = new Usuario();

            if (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
            include VIEWS . '/Usuario/form_usuario.php';
        }
    }

    public static function excluir(): void{
        parent::isProtected();
        $id = (int) $_GET['id'];
        $usuario = new Usuario();
        $usuario->delete($id);
        header("location: /usuario");
    }
}