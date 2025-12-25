<?php

use App\Controller\{AlunoController, InicialController, LogController, LivroController, CategoriaController, AutorController, UsuarioController, LoginController, EmprestimoController};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        InicialController::index();
        break;
    case '/login':
        LoginController::index();
        break;
    case '/logout':
        LoginController::logout();
        break;
    case '/logs':
        LogController::listar();
        break;
    case '/aluno':
    case '/aluno/listar':
        AlunoController::listar();
        break;
    case '/aluno/cadastro':
        AlunoController::cadastro();
        break;
    case '/aluno/excluir':
        AlunoController::excluir();
        break;
    case '/livro':
    case '/livro/listar':
        LivroController::listar();
        break;
    case '/livro/cadastro':
        LivroController::cadastro();
        break;
    case '/livro/excluir':
        LivroController::excluir();
        break;
    case '/categoria':
    case '/categoria/listar':
        CategoriaController::listar();
        break;
    case '/categoria/cadastro':
        CategoriaController::cadastro();
        break;
    case '/categoria/excluir':
        CategoriaController::excluir();
        break;
    case '/autor':
    case '/autor/listar':
        AutorController::listar();
        break;
    case '/autor/cadastro':
        AutorController::cadastro();
        break;
    case '/autor/excluir':
        AutorController::excluir();
        break;
    case '/usuario':
    case '/usuario/listar':
        UsuarioController::listar();
        break;
    case '/usuario/cadastro':
        UsuarioController::cadastro();
        break;
    case '/usuario/excluir':
        UsuarioController::excluir();
        break;
    case '/emprestimo':
    case '/emprestimo/listar':
        EmprestimoController::listar();
        break;
    case '/emprestimo/cadastro':
        EmprestimoController::cadastro();
        break;
    case '/emprestimo/excluir':
        EmprestimoController::excluir();
        break;
    default:
        echo "Erro 404 - Página não encontrada";
        break;
}
