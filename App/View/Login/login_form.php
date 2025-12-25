<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SisBiblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background-color: #0d6efd;
            /* Cor primária do Bootstrap */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem auto;
        }
    </style>
</head>

<body>
    </div>
    <div class="card shadow login-card border-0">
        
            <div class="container message-container mb-4 text-center ">
                <?php if (isset($message)): ?>
                    <div class="alert alert-info">
                        <?= htmlspecialchars($message) ?>
                    </div>  
                <?php endif; ?>
        <div class="card-body">

            <div class="brand-logo">
                <i class="bi bi-book"></i> <span>SB</span>
            </div>

            <h4 class="text-center fw-bold mb-4">Bem-vindo de volta</h4>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger py-2 text-center">
                    <small>
                        <?php
                        echo match ($_GET['erro']) {
                            'senha' => 'Senha incorreta.',
                            'usuario' => 'Usuário não encontrado.',
                            default => 'Erro ao realizar login.'
                        };
                        ?>
                    </small>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                    <label for="email">E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check invisible">
                        <input class="form-check-input" type="checkbox" id="lembrar">
                        <label class="form-check-label small" for="lembrar">
                            Lembrar-me
                        </label>
                    </div>
                    <a href="#" class="text-decoration-none small invisible">Esqueceu a senha?</a>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">ENTRAR</button>
                </div>
            </form>
        </div>

        <div class="card-footer bg-white border-0 text-center py-3">
            <small class="text-muted">SisBiblioteca &copy; <?= date('Y') ?></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>