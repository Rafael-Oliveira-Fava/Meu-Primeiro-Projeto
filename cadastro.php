<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Torcedores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container mt-4 text-center">
    <img src="https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2024/07/PUMA-e-Palmeiras-renovam-contrato-imagem-e1721139703561.jpeg?w=1200&h=675&crop=1" 
     alt="header-image" class="header-image img-fluid mx-auto d-block" width="600px">
    <hr>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center navbar-custom mb-4">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastro.php">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="visualizar_cadastros.php">Visualizar</a>
            </li>
        </ul>
    </nav>
    <h1>Cadastro de Torcedores</h1>
</div>

<div class="card mx-auto" style="max-width:600px;">
    <form action="processa_cadastros.php" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="inscricao">Data de Inscrição:</label>
            <input type="date" id="inscricao" name="inscricao" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição do Torcedor:</label>
            <input type="text" id="descricao" name="descricao" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
    </form>

    <?php if (isset($_SESSION['mensagem']) && !empty($_SESSION['mensagem'])): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
        </div>
    <?php endif; ?>
</div>

<div class="footer mt-4 py-2 text-center bg-success text-white">
    © 2025 PALMEIRAS
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>