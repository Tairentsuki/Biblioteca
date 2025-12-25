<?php

namespace App\Controller;

use App\Model\Log;

final class LogController extends Controller
{

    public static function Listar(): void
    {
        parent::isProtected();
        $log = new Log();
        $lista = $log->getAllRows();
        include VIEWS . '/Log/lista_log.php';
    }
}
