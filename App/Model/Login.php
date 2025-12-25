<?php

namespace App\Model;

use App\DAO\LoginDAO;

final class Login
{

    public $email;
    public $senha;

    public function authenticate(): ?Usuario
    {
        return (new LoginDAO())->autenticar($this);
    }
}
