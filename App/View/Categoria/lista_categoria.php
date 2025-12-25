<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .card-category {
            border: 0;
            border-radius: 16px;
            transition: all 0.3s ease;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .card-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        /* Caixa do Ícone */
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">

        <div class="row align-items-center mb-5 g-3">
            <div class="col-md-5">
                <h2 class="fw-bold text-dark mb-0">Categorias</h2>
                <p class="text-muted mb-0">Gêneros e classificações literárias.</p>
            </div>
            
            <div class="col-md-7">
                <div class="d-flex gap-3">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white flex-grow-1">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 py-3" placeholder="Buscar categoria...">
                    </div>
                    
                    <a href="/categoria/cadastro" class="btn btn-dark rounded-pill px-4 d-flex align-items-center fw-bold shadow-sm">
                        <i class="bi bi-plus-lg me-2"></i> Nova
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <?php if (empty($lista)): ?>
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 mb-3"><i class="bi bi-tags" style="font-size: 3rem;"></i></div>
                    <h5 class="text-muted">Nenhuma categoria cadastrada.</h5>
                    <a href="/categoria/cadastro" class="btn btn-outline-primary mt-2">Criar a primeira</a>
                </div>
            <?php else: ?>

                <?php foreach ($lista as $categoria): ?>
                    <?php 
                        // CORES DINÂMICAS PARA OS ÍCONES
                        // Cria um visual colorido sem precisar salvar cor no banco
                        $cores = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-indigo', 'bg-dark'];
                        $cor_icone = $cores[$categoria->id % count($cores)];
                    ?>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card card-category h-100 p-4">
                            <div class="card-body text-center d-flex flex-column align-items-center p-0">
                                
                                <div class="icon-box shadow-sm <?= $cor_icone ?> bg-gradient">
                                    <i class="bi bi-tag-fill"></i>
                                </div>

                                <h5 class="fw-bold text-dark mb-2 text-truncate w-100" title="<?= $categoria->descricao ?>">
                                    <?= $categoria->descricao ?>
                                </h5>
                                
                                <span class="badge bg-light text-secondary border mb-4">
                                    ID: #<?= str_pad($categoria->id, 3, '0', STR_PAD_LEFT) ?>
                                </span>

                                <div class="w-100 mt-auto d-flex gap-2">
                                    <a href="/categoria/cadastro?id=<?= $categoria->id ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                        Editar
                                    </a>
                                    <a href="/categoria/excluir?id=<?= $categoria->id ?>" 
                                       class="btn btn-sm btn-outline-danger flex-fill" 
                                       onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                        Excluir
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