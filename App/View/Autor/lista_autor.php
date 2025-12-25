<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .card-author {
            border: 0;
            border-radius: 16px;
            transition: all 0.3s ease;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .card-author:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

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
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">

        <div class="row align-items-center mb-5 g-3">
            <div class="col-md-5">
                <h2 class="fw-bold text-dark mb-0">Autores</h2>
                <p class="text-muted mb-0">Escritores cadastrados no acervo.</p>
            </div>
            
            <div class="col-md-7">
                <div class="d-flex gap-3">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white flex-grow-1">
                        <span class="input-group-text border-0 bg-white ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 py-3" placeholder="Buscar autor...">
                    </div>
                    
                    <a href="/autor/cadastro" class="btn btn-dark rounded-pill px-4 d-flex align-items-center fw-bold shadow-sm">
                        <i class="bi bi-pen-fill me-2"></i> Novo
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <?php if (empty($lista)): ?>
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 mb-3"><i class="bi bi-pen" style="font-size: 3rem;"></i></div>
                    <h5 class="text-muted">Nenhum autor cadastrado.</h5>
                    <a href="/autor/cadastro" class="btn btn-outline-primary mt-2">Cadastrar primeiro</a>
                </div>
            <?php else: ?>

                <?php foreach ($lista as $autor): ?>
                    <?php 
                        // LÓGICA DE APRESENTAÇÃO
                        $iniciais = strtoupper(substr($autor->nome, 0, 2));
                        
                        // Cores (Mesma lógica do Aluno para manter padrão)
                        $cores = ['bg-indigo', 'bg-purple', 'bg-pink', 'bg-teal', 'bg-cyan']; // Cores diferentes se quiser
                        $cor_avatar = 'bg-primary'; // Simplifiquei aqui, ou use array random

                        // Formatar Data (Idade)
                        $nascimento = $autor->data_nascimento ? date('d/m/Y', strtotime($autor->data_nascimento)) : 'N/D';
                    ?>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card card-author h-100 p-3">
                            <div class="card-body text-center d-flex flex-column align-items-center">
                                
                                <div class="avatar-lg shadow-sm bg-primary bg-gradient">
                                    <?= $iniciais ?>
                                </div>

                                <h5 class="fw-bold text-dark mb-1 text-truncate w-100" title="<?= $autor->nome ?>">
                                    <?= $autor->nome ?>
                                </h5>
                                
                                <span class="badge bg-light text-dark border mb-3">
                                    <i class="bi bi-cake2 me-1"></i> <?= $nascimento ?>
                                </span>

                                <div class="w-100 mt-auto">
                                    <div class="text-muted small mb-3">
                                        CPF: <?= $autor->cpf ?: 'Não informado' ?>
                                    </div>

                                    <div class="d-grid gap-2 d-flex justify-content-center">
                                        <a href="/autor/cadastro?id=<?= $autor->id ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <a href="/autor/excluir?id=<?= $autor->id ?>" 
                                           class="btn btn-sm btn-outline-danger flex-fill" 
                                           onclick="return confirm('Excluir este autor?')">
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