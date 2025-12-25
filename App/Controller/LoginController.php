<?php

namespace App\Controller;

final class LoginController extends Controller
{
    public static function index(): void
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = new \App\Model\Login();
            $login->email = $_POST['email'];
            $login->senha = $_POST['senha'];

            $usuario = $login->authenticate();

            if ($usuario !== null) {
                session_start();
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;

                header('Location: /aluno');
                exit();
            } else {
                $message = "Email ou senha inválidos.";
                include VIEWS . '/Login/login_form.php';
            }
        } else {
            include VIEWS . '/Login/login_form.php';
        }
    }

    public static function logout(): void
    {
        parent::isProtected();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public static function logout2(): void
    {
        // 1. Inicia a sessão para ter acesso a ela (se ainda não foi iniciada)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Apaga todas as variáveis de sessão da memória do PHP agora
        $_SESSION = array();

        // 3. Apaga o cookie do navegador (Importante!)
        // Isso diz ao navegador para expirar o cookie no passado (time - 42000)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // 4. Finalmente, destrói a sessão no servidor (apaga o arquivo)
        session_destroy();

        header('Location: /login');
        exit();
    }
}
