<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Novo Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; overflow: hidden; }
        .card-header { background: #0d6efd; color: white; padding: 1.5rem; }
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="card shadow-lg border-0">

                    <div class="card-header">
                        <h2 class="h4 mb-0"><i class="bi bi-journal-arrow-up me-2"></i>Registrar Empréstimo</h2>
                        <small class="opacity-75">Preencha os dados do livro e prazos abaixo.</small>
                    </div>

                    <div class="card-body p-4">
                        <form method="post" action="/emprestimo/cadastro">

                            <input name="id" type="hidden" value="<?= $model->id ?? '' ?>" />
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo"
                                            value="<?= $model->data_emprestimo ?? '' ?>">
                                        <label for="data_emprestimo"><i class="bi bi-calendar-check me-1"></i> Data do Empréstimo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="data_devolucao" name="data_devolucao"
                                            value="<?= $model->data_devolucao ?? '' ?>">
                                        <label for="data_devolucao"><i class="bi bi-calendar-x me-1"></i> Data de Devolução</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="id_livro" name="id_livro" required>
                                    <option value="" selected disabled>Selecione o livro...</option>
                                    <?php foreach ($lista_livros as $livro): ?>
                                        <?php $selected = (isset($model->id_livro) && $model->id_livro == $livro->id) ? 'selected' : ''; ?>
                                        <option value="<?= $livro->id ?>" <?= $selected ?>>
                                            <?= $livro->titulo ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="id_livro"><i class="bi bi-book me-1"></i> Livro Selecionado</label>
                            </div>

                            <hr class="my-4 text-muted">

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_aluno" name="id_aluno" required>
                                            <option value="" selected disabled>Quem vai levar?</option>
                                            <?php foreach ($lista_alunos as $aluno): ?>
                                                <?php $selected = (isset($model->id_aluno) && $model->id_aluno == $aluno->id) ? 'selected' : ''; ?>
                                                <option value="<?= $aluno->id ?>" <?= $selected ?>>
                                                    <?= $aluno->id . " - " . $aluno->nome ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_aluno"><i class="bi bi-person-badge me-1"></i> Aluno</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_usuario" name="id_usuario" required>
                                            <option value="" selected disabled>Quem registrou?</option>
                                            <?php foreach ($lista_usuarios as $usuario): ?>
                                                <?php $selected = (isset($model->id_usuario) && $model->id_usuario == $usuario->id) ? 'selected' : ''; ?>
                                                <option value="<?= $usuario->id ?>" <?= $selected ?>>
                                                    <?= $usuario->id . " - " . $usuario->nome ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_usuario"><i class="bi bi-person-gear me-1"></i> Usuário (Bibliotecário)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="/emprestimo" class="btn btn-outline-secondary px-4">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-bold">
                                    <i class="bi bi-check-lg me-1"></i> Confirmar Empréstimo
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>