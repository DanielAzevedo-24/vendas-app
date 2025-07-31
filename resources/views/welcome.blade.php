<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema de Vendas</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonte opcional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .hero {
            padding: 80px 0;
            background: #343a40;
            color: #fff;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 600;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 15px;
        }
        .btn-custom {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Vendas</a>
            <div class="d-flex">
                <a class="btn btn-outline-light btn-sm me-2" href="/login">Entrar</a>
                <a class="btn btn-primary btn-sm" href="/register">Cadastrar</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1>Bem-vindo ao Sistema de Vendas</h1>
            <p>Gerencie suas vendas de forma simples, rápida e segura.</p>
            <a href="/login" class="btn btn-light btn-lg btn-custom">Começar agora</a>
        </div>
    </section>

    <footer class="bg-light text-center py-4 mt-5 border-top">
        <div class="container">
            <p class="mb-0 text-muted">&copy; {{ date('Y') }} Sistema de Vendas. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>
