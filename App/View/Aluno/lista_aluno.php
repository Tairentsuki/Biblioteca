<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Estilo do Card */
        .card-student {
            border: 0;
            border-radius: 16px;
            transition: all 0.3s ease;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .card-student:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        /* Avatar com Iniciais */
        .avatar-lg {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            margin-bottom: 1rem;
        }

        /* Search Bar arredondada */
        .search-box {
            border-radius: 50px;
            border: 0;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">

        <div class="row align-items-center mb-5 g-3">
            <div class="col-md-5">
                <h2 class="fw-bold text-dark mb-0">Alunos Cadastrados</h2>
                <p class="text-muted mb-0">Gerencie matrículas e dados acadêmicos.</p>
            </div>
            
            <div class="col-md-7">
                <div class="d-flex gap-3">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white flex-grow-1">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 py-3" placeholder="Buscar por nome ou RA...">
                    </div>
                    
                    <a href="/aluno/cadastro" class="btn btn-dark rounded-pill px-4 d-flex align-items-center fw-bold shadow-sm">
                        <i class="bi bi-person-plus-fill me-2"></i> Novo
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <?php if (empty($lista)): ?>
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 mb-3"><i class="bi bi-people" style="font-size: 3rem;"></i></div>
                    <h5 class="text-muted">Nenhum aluno cadastrado.</h5>
                    <a href="/aluno/cadastro" class="btn btn-outline-primary mt-2">Cadastrar o primeiro</a>
                </div>
            <?php else: ?>

                <?php foreach ($lista as $aluno): ?>
                    <?php 
                        // LÓGICA VISUAL (PHP)
                        // 1. Iniciais do Nome
                        $iniciais = strtoupper(substr($aluno->nome, 0, 2));

                        // 2. Cor do Avatar (Baseado no ID para ser sempre a mesma cor para a mesma pessoa)
                        $cores = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark', 'bg-secondary'];
                        $cor_avatar = $cores[$aluno->id % count($cores)];
                    ?>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card card-student h-100 p-3">
                            <div class="card-body text-center d-flex flex-column align-items-center">
                                
                                <div class="avatar-lg shadow-sm <?= $cor_avatar ?>">
                                    <?= $iniciais ?>
                                </div>

                                <h5 class="fw-bold text-dark mb-1 text-truncate w-100" title="<?= $aluno->nome ?>">
                                    <?= $aluno->nome ?>
                                </h5>
                                
                                <span class="badge bg-light text-dark border mb-3">
                                    RA: <?= $aluno->ra ?>
                                </span>

                                <div class="w-100 mt-auto">
                                    <div class="d-flex justify-content-between align-items-center bg-light rounded p-2 mb-3">
                                        <span class="fw-bold text-primary small text-uppercase"><?= $aluno->curso ?></span>
                                    </div>

                                    <div class="d-grid gap-2 d-flex justify-content-center">
                                        <a href="/aluno/cadastro?id=<?= $aluno->id ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <a href="/aluno/excluir?id=<?= $aluno->id ?>" 
                                           class="btn btn-sm btn-outline-danger flex-fill" 
                                           onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
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