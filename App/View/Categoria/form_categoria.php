<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Cadastro de Categoria</title>
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
                        <h2 class="h4 mb-0"><i class="bi bi-tags-fill me-2"></i>Cadastro de Categoria</h2>
                        <small class="opacity-75">Defina os gêneros literários do acervo.</small>
                    </div>

                    <div class="card-body p-4">
                        <form method="post" action="/categoria/cadastro">

                            <input name="id" type="hidden" value="<?= $model->id ?? null ?>" />

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" 
                                       value="<?= $model->descricao ?? '' ?>" required>
                                <label for="descricao"><i class="bi bi-tag me-1"></i> Descrição da Categoria</label>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="/categoria" class="btn btn-outline-secondary px-4">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-bold">
                                    <i class="bi bi-check-lg me-1"></i> Salvar Categoria
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