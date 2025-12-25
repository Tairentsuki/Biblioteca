<?php

// 1° O diretório base
// 2° Onde estão as views
// 3° Acesso ao banco de dados

define('BASE_DIR', dirname(__FILE__, 2));
define('VIEWS', BASE_DIR . '/APP/View');


// Em aplicação real não é indicado deixar dados sensíveis no código fonte
$_ENV['db']['host'] = "localhost:3306";
$_ENV['db']['user'] = "root";
$_ENV['db']['pass'] = "SenhaSegura123";
$_ENV['db']['database'] = "biblioteca";


?>