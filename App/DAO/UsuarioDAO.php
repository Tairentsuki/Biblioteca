<?php

namespace App\DAO;

use App\Model\Usuario;

use PDO;

class UsuarioDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Usuario $usuario): Usuario
    {
        return (empty($usuario->id))
            ? $this->insert($usuario)
            : $this->update($usuario);
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * FROM usuario";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Usuario::class);
    }

    public function getById(int $id): ?Usuario
    {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $obj = $stmt->fetchObject(Usuario::class);

        return $obj === false ? null : $obj;
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    private function insert(Usuario $usuario): Usuario
    {
        // 1. Crie o hash seguro usando a função nativa do PHP
        // PASSWORD_DEFAULT usa Bcrypt atualmente (muito seguro)
        // O PHP gera um 'salt' aleatório automaticamente e o embute na string final
        $hashDaSenha = password_hash($usuario->senha, PASSWORD_DEFAULT);

        // 2. No SQL, tire a função sha3() e passe apenas o placeholder (?)
        $sql = "INSERT INTO usuario (nome, email, senha) 
            VALUES (?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $usuario->nome);
        $stmt->bindValue(2, $usuario->email);

        // 3. Passe a variável com o hash, e não a senha original
        $stmt->bindValue(3, $hashDaSenha);

        $stmt->execute();

        $usuario->id = self::$conexao->LastInsertId();

        return $usuario;
    }
    private function update(Usuario $usuario): Usuario
    {
        // Verificamos se a senha NÃO está vazia (ou seja, o usuário digitou uma nova)
        if (!empty($usuario->senha)) {

            // Cenario 1: O usuário QUER trocar a senha
            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?";

            // Gera o novo hash seguro
            $novoHash = password_hash($usuario->senha, PASSWORD_DEFAULT);

            $stmt = self::$conexao->prepare($sql);
            $stmt->bindValue(1, $usuario->nome);
            $stmt->bindValue(2, $usuario->email);
            $stmt->bindValue(3, $novoHash); // Salva a nova senha criptografada
            $stmt->bindValue(4, $usuario->id);
        } else {

            // Cenario 2: O usuário SÓ mudou o nome ou email (manteve a senha antiga)
            // Note que removemos o campo 'senha' do SQL para não estragar a senha atual
            $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";

            $stmt = self::$conexao->prepare($sql);
            $stmt->bindValue(1, $usuario->nome);
            $stmt->bindValue(2, $usuario->email);
            $stmt->bindValue(3, $usuario->id); // O ID agora é o terceiro parametro
        }

        $stmt->execute();

        return $usuario;
    }

    public function logar(Usuario $usuario): ?Usuario
    {
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $usuario->email);
        $stmt->execute();

        $obj = $stmt->fetchObject(Usuario::class);

        // Verifica se o usuário foi encontrado E se a senha bate com o hash
        if ($obj && password_verify($usuario->senha, $obj->senha)) {
            return $obj;
        }
        
        return null;
    }
}
