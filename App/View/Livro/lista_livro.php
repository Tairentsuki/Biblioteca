<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Acervo de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .card-book {
            border: 0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #fff;
            overflow: hidden;
        }
        
        .card-book:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        /* Simulador de Capa de Livro */
        .book-cover {
            width: 80px;
            height: 100%;
            min-height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">

        <div class="row align-items-center mb-5 g-3">
            <div class="col-md-5">
                <h2 class="fw-bold text-dark mb-0">Acervo de Livros</h2>
                <p class="text-muted mb-0">Gerencie o catálogo da biblioteca.</p>
            </div>
            
            <div class="col-md-7">
                <div class="d-flex gap-3">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white flex-grow-1">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 py-3" placeholder="Pesquisar por título, ISBN ou editora...">
                    </div>
                    
                    <a href="/livro/cadastro" class="btn btn-dark rounded-pill px-4 d-flex align-items-center fw-bold shadow-sm">
                        <i class="bi bi-journal-plus me-2"></i> Novo
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <?php if (empty($lista)): ?>
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 mb-3"><i class="bi bi-bookshelf" style="font-size: 3rem;"></i></div>
                    <h5 class="text-muted">Nenhum livro no acervo.</h5>
                    <a href="/livro/cadastro" class="btn btn-outline-primary mt-2">Cadastrar primeiro livro</a>
                </div>
            <?php else: ?>

                <?php foreach ($lista as $livro): ?>
                    <?php 
                        // Cor da Capa (Gera uma cor fixa baseada no ID)
                        $cores = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark'];
                        $cor_capa = $cores[$livro->id % count($cores)];
                    ?>
                    
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-book h-100 shadow-sm d-flex flex-row">
                            
                            <div class="book-cover <?= $cor_capa ?> bg-gradient">
                                <i class="bi bi-book"></i>
                            </div>

                            <div class="card-body d-flex flex-column p-3">
                                
                                <h6 class="fw-bold text-dark mb-1 text-truncate" title="<?= $livro->titulo ?>">
                                    <?= $livro->titulo ?>
                                </h6>
                                
                                <div class="mb-2">
                                    <span class="badge bg-light text-secondary border">
                                        <i class="bi bi-building me-1"></i> <?= $livro->editora ?>
                                    </span>
                                </div>

                                <div class="small text-muted mb-3">
                                    <i class="bi bi-upc-scan me-1"></i> ISBN: <?= $livro->isbn ?>
                                </div>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="/livro/cadastro?id=<?= $livro->id ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/livro/excluir?id=<?= $livro->id ?>" 
                                       class="btn btn-sm btn-outline-danger flex-fill" 
                                       onclick="return confirm('Excluir este livro?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach ?>

            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>