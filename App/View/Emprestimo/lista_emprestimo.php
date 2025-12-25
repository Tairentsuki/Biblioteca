<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisBiblioteca - Gestão de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .card-loan { border: 0; border-radius: 12px; transition: all 0.3s ease; background: #fff; position: relative; overflow: hidden; }
        .card-loan:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.08); }
        .status-strip { position: absolute; left: 0; top: 0; bottom: 0; width: 6px; }
        
        .status-late .status-strip { background-color: #dc3545; }
        .status-late .badge-status { background-color: #fee2e2; color: #dc3545; }
        
        .status-warning .status-strip { background-color: #ffc107; }
        .status-warning .badge-status { background-color: #fff3cd; color: #856404; }
        
        .status-ok .status-strip { background-color: #198754; }
        .status-ok .badge-status { background-color: #d1e7dd; color: #0f5132; }
    </style>
</head>

<body>
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">
        <div class="row align-items-center mb-5 g-3">
            <div class="col-md-6">
                <h2 class="fw-bold text-dark mb-0">Gestão de Empréstimos</h2>
                <p class="text-muted mb-0">Total: <?= count($lista) ?> registros</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/emprestimo/cadastro" class="btn btn-dark px-4 fw-bold shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Novo Empréstimo
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php if (empty($lista)): ?>
                <div class="col-12 text-center py-5">
                    <div class="opacity-50 mb-3"><i class="bi bi-journal-x" style="font-size: 3rem;"></i></div>
                    <h5 class="text-muted">Nenhum registro encontrado.</h5>
                </div>
            <?php else: ?>
                <?php foreach ($lista as $item): ?>
                    <?php
                        // Tratamento de segurança para dados nulos
                        $data_dev_banco = $item->data_devolucao ?? null;
                        
                        if ($data_dev_banco) {
                            $hoje = new DateTime();
                            $devolucao = new DateTime($data_dev_banco);
                            $diferenca = $hoje->diff($devolucao);
                            $dias = $diferenca->days;
                            
                            // Lógica de status
                            if ($devolucao < $hoje && $dias > 0) {
                                $status_class = 'status-late';
                                $status_text = "Atrasado ({$dias} dias)";
                                $icon = 'bi-exclamation-triangle-fill';
                            } elseif ($dias <= 3 && $devolucao >= $hoje) {
                                $status_class = 'status-warning';
                                $status_text = "Vence em breve";
                                $icon = 'bi-clock-history';
                            } else {
                                $status_class = 'status-ok';
                                $status_text = "No prazo";
                                $icon = 'bi-check-circle-fill';
                            }
                            $data_formatada = $devolucao->format('d/m/Y');
                        } else {
                            $status_class = 'status-warning';
                            $status_text = "Data Inválida";
                            $icon = 'bi-question-circle';
                            $data_formatada = "--/--/----";
                        }
                    ?>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-loan h-100 shadow-sm <?= $status_class ?>">
                            <div class="status-strip"></div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <span class="badge badge-status rounded-pill px-3 py-2">
                                        <i class="bi <?= $icon ?> me-1"></i> <?= $status_text ?>
                                    </span>
                                </div>
                                <h5 class="fw-bold text-truncate" title="<?= $item->titulo_livro ?? 'Sem Título' ?>">
                                    <?= $item->titulo_livro ?? 'Livro Desconhecido' ?>
                                </h5>
                                <p class="text-muted small mb-4">
                                    Devolução: <strong><?= $data_formatada ?></strong>
                                </p>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <small class="text-muted">Aluno ID: #<?= $item->id_aluno ?? '?' ?></small>
                                    <div class="d-flex gap-2">
                                        <a href="/emprestimo/cadastro?id=<?= $item->id ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                        <a href="/emprestimo/excluir?id=<?= $item->id ?>" onclick="return confirm('Excluir?')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>