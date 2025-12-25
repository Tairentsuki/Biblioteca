<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logs - SisBiblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include VIEWS . '/Includes/menu.php'; ?>

    <div class="container py-5">
        <h2 class="fw-bold mb-4">Histórico de Atividade</h2>

        <?php if(empty($lista)): ?>
            <div class="alert alert-info">Nenhum registro encontrado.</div>
        <?php else: ?>

        <?php foreach ($lista as $log): 
            $cor = match($log->acao) {
                'Inserido' => 'success',
                'Atualizado' => 'warning',
                'Deletado' => 'danger',
                default  => 'secondary'
            };
            
            // Decodifica o JSON salvo no banco de volta para Array
            $detalhes = json_decode($log->dados, true);
            // Fallback caso o JSON seja inválido ou null
            if (!is_array($detalhes)) $detalhes = []; 
        ?>
        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-body p-4">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-<?= $cor ?> fs-6"><?= $log->acao ?></span>
                    <small class="text-muted"><?= date('d/m/Y H:i:s', strtotime($log->data_hora)) ?></small>
                </div>

                <h5 class="fw-bold text-secondary"><?= strtoupper($log->tabela_nome) ?> #<?= $log->registro_id ?></h5>
                <hr>

                <div class="row g-3">
                    <?php foreach ($detalhes as $item): 
                        // Verifica se houve mudança real para destacar
                        $destaque = !empty($item['alterado']); 
                        $valorAntigo = $item['antigo'] ?? '-';
                        $valorNovo   = $item['novo'] ?? '-';
                    ?>
                    <div class="col-md-4">
                        <div class="p-3 rounded h-100 <?= $destaque ? 'bg-warning-subtle border border-warning' : 'bg-white border text-muted' ?>">
                            <small class="d-block fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <?= htmlspecialchars($item['campo']) ?>
                            </small>
                            
                            <div class="small">
                                <?php if ($log->acao === 'Inserido' && $destaque): ?>
                                    <span class="text-danger text-decoration-line-through me-1"><?= htmlspecialchars($valorAntigo) ?></span>
                                    <i class="bi bi-arrow-right text-dark mx-1">→</i>
                                    <span class="text-success fw-bold ms-1"><?= htmlspecialchars($valorNovo) ?></span>
                                <?php elseif ($log->acao === 'Deletado'): ?>
                                     <span class="text-danger"><?= htmlspecialchars($valorAntigo) ?></span>
                                <?php else: ?>
                                    <span class="<?= $destaque ? 'text-success fw-bold' : '' ?>">
                                        <?= htmlspecialchars($valorNovo) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>