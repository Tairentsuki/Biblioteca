<?php

spl_autoload_register(function ($nome_da_classe) {
    $arquivo = BASE_DIR . "/" . $nome_da_classe . ".php";

    // echo $arquivo;

    if(file_exists($arquivo)){
        include $arquivo;
    }
    else{
        throw new Exception("Arquivo {$arquivo} não encontrado para a classe {$nome_da_classe}");
        
    }
    // echo "<hr />";
});
