<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Cadastro de Autor</title>
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
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-lg border-0">
                    
                    <div class="card-header">
                        <h2 class="h4 mb-0"><i class="bi bi-pen-fill me-2"></i>Cadastro de Autor</h2>
                        <small class="opacity-75">Gerencie os escritores do acervo.</small>
                    </div>

                    <div class="card-body p-4">
                        <form method="post" action="/autor/cadastro">
                            
                            <input name="id" type="hidden" value="<?= $model->id ?>" />

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" 
                                       value="<?= $model->nome ?? '' ?>" required>
                                <label for="nome"><i class="bi bi-person me-1"></i> Nome do Autor</label>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" 
                                               value="<?= $model->data_nascimento ?? '' ?>">
                                        <label for="data_nascimento"><i class="bi bi-calendar-event me-1"></i> Nascimento</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" 
                                               value="<?= $model->cpf ?? '' ?>">
                                        <label for="cpf"><i class="bi bi-person-vcard me-1"></i> CPF</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="/autor" class="btn btn-outline-secondary px-4">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-bold">
                                    <i class="bi bi-check-lg me-1"></i> Salvar Autor
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