<?php

namespace App\DAO;

use App\Model\Login;
use App\Model\Usuario;
use PDO;

final class LoginDAO extends DAO
{

    public function autenticar(Login $model)
    {
        // 1. Alteramos o SQL para buscar APENAS pelo email
        $sql = "SELECT * FROM usuario WHERE email = ?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->email);
        $stmt->execute();

        // 2. Buscamos o objeto do usuário (que trará a senha hashada do banco)
        $usuarioEncontrado = $stmt->fetchObject(Usuario::class);

        // 3. Verificamos se o usuário foi encontrado E se a senha bate
        // password_verify(senha_texto_puro, hash_do_banco)

        if ($usuarioEncontrado && password_verify($model->senha, $usuarioEncontrado->senha)) {
            echo "Senha correta!";
            return $usuarioEncontrado;
        }
        return null;
    }
}
