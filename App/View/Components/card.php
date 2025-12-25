<div class="card h-100 border-0 shadow-sm p-3">
    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="badge bg-light text-dark">#<?= $id ?></span>
            <span class="text-muted small"><?= $subtitulo ?></span>
        </div>
        
        <h5 class="card-title fw-bold mb-3"><?= $titulo ?></h5>

        <div class="mt-auto d-flex gap-2 border-top pt-3">
            <a href="<?= $rota ?>/cadastro?id=<?= $id ?>" class="btn btn-light btn-sm flex-fill">
                Editar
            </a>
            <a href="<?= $rota ?>/excluir?id=<?= $id ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Excluir?')">
                Excluir
            </a>
        </div>
    </div>
</div>