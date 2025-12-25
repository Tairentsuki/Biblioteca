<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Cadastro de Livro</title>
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
                        <h2 class="h4 mb-0"><i class="bi bi-book-half me-2"></i>Cadastro de Livro</h2>
                        <small class="opacity-75">Informe os detalhes da obra literária.</small>
                    </div>

                    <div class="card-body p-4">
                        <form method="post" action="/livro/cadastro">
                            
                            <input name="id" type="hidden" value="<?= $model->id ?>" />

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" 
                                       value="<?= $model->titulo ?? '' ?>" required>
                                <label for="titulo"><i class="bi bi-type-h1 me-1"></i> Título da Obra</label>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="autor" name="autor" required>
                                            <option value="" disabled selected>Selecione...</option>
                                            <?php foreach ($model->autores as $autor): ?>
                                                <?php $selected = ($model->id_autor == $autor->id) ? 'selected' : ''; ?>
                                                <option value="<?= $autor->id ?>" <?= $selected ?>>
                                                    <?= $autor->nome ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="autor"><i class="bi bi-pen me-1"></i> Autor</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_categoria" name="id_categoria" required>
                                            <option value="" disabled selected>Selecione...</option>
                                            <?php foreach ($model->categorias as $categoria): ?>
                                                <?php $selected = ($model->id_categoria == $categoria->id) ? 'selected' : ''; ?>
                                                <option value="<?= $categoria->id ?>" <?= $selected ?>>
                                                    <?= $categoria->descricao ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_categoria"><i class="bi bi-bookmark-star me-1"></i> Categoria</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editora" name="editora" placeholder="Editora" 
                                               value="<?= $model->editora ?? '' ?>" required>
                                        <label for="editora"><i class="bi bi-building me-1"></i> Editora</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano" 
                                               value="<?= $model->ano ?? '' ?>" required>
                                        <label for="ano"><i class="bi bi-calendar me-1"></i> Ano</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" 
                                               value="<?= $model->isbn ?? '' ?>" required>
                                        <label for="isbn"><i class="bi bi-upc-scan me-1"></i> ISBN</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="/livro" class="btn btn-outline-secondary px-4">Cancelar</a>
                                <button type="submit" class="btn btn-success px-4 fw-bold">
                                    <i class="bi bi-check-lg me-1"></i> Salvar Livro
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