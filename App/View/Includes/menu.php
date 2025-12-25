<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase tracking-widest" href="/" style="letter-spacing: 1px;">
      <i class="bi bi-book-half me-2"></i>SisBiblioteca
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link px-3" href="/aluno">Alunos</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="/livro">Livros</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="/emprestimo">Empréstimos</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">Cadastros</a>
          <ul class="dropdown-menu border-0 shadow-sm">
            <li><a class="dropdown-item" href="/autor">Autores</a></li>
            <li><a class="dropdown-item" href="/categoria">Categorias</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/usuario">Usuários</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link px-3" href="/logs">Logs</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="/logout">Sair</a></li>
      </ul>
    </div>
  </div>
</nav>