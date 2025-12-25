<?php

namespace App\Model;

use App\DAO\LogDAO;

class Log
{
    public $id;
    public $tabela_nome;
    public $registro_id;
    public $acao;
    public $usuario_id;
    public $data_hora;
    public $dados;

    public function getAllRows(): array
    {
        return (new LogDAO())->select();
    }
}
