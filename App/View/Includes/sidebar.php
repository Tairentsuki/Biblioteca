<?php
// Função auxiliar para verificar se o link é o atual
// Ela retorna 'active' (azul) se for a página atual, ou 'text-white' se não for.
function is_active($rota, $url_atual)
{
    // Se a rota for apenas '/', tem que ser idêntica.
    if ($rota == '/' && $url_atual == '/') {
        return 'active';
    }
    // Para outras rotas (ex: /aluno), verifica se a URL *começa* com ela
    // Assim, /aluno/cadastro mantém o botão "Alunos" aceso.
    if ($rota != '/' && strpos($url_atual, $rota) === 0) {
        return 'active';
    }
    return 'text-white';
}

// Pega a URL atual caso não tenha sido passada globalmente
$current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar" style="width: 280px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Sisbiblioteca</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="/" class="nav-link <?php echo is_active('/', $current_url); ?>" aria-current="page">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#home"></use>
                </svg>
                Home
            </a>
        </li>

        <li>
            <a href="/aluno" class="nav-link <?php echo is_active('/aluno', $current_url); ?>">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Alunos
            </a>
        </li>

        <li>
            <a href="/livro" class="nav-link <?php echo is_active('/livro', $current_url); ?>">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#grid"></use>
                </svg>
                Livros
            </a>
        </li>

        <li>
            <a href="/categoria" class="nav-link <?php echo is_active('/categoria', $current_url); ?>">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#table"></use>
                </svg>
                Categorias
            </a>
        </li>

        <li>
            <a href="/logs" class="nav-link <?php echo is_active('/logs', $current_url); ?>">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Logs do Sistema
            </a>
        </li>

    </ul>
    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sair</a></li>
        </ul>
    </div>
</div>