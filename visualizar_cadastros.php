<?php
$servername = "localhost";
$username = "root";
$password = "Senai@118";
$dbname = "palmeiras";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Excluir torcedor
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM torcedor WHERE id = $id");
    header("Location: visualizar_cadastros.php");
    exit;
}

// Atualizar torcedor via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['column'], $_POST['value'])) {
    $id = intval($_POST['id']);
    $column = $_POST['column'];
    $value = $conn->real_escape_string($_POST['value']);

    $valid_columns = ['nome', 'inscricao', 'descricao'];
    if (in_array($column, $valid_columns)) {
        $sql = "UPDATE torcedor SET $column='$value' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "✔ Registro atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar: " . $conn->error;
        }
    }
    exit;
}

// Buscar cadastros
$sql = "SELECT id, nome, inscricao, descricao FROM torcedor";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Cadastros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="table.css">
</head>
<body>
<div class="container mt-4 text-center">
    <img src="https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2024/07/PUMA-e-Palmeiras-renovam-contrato-imagem-e1721139703561.jpeg?w=1200&h=675&crop=1" 
         alt="header-image" class="header-image img-fluid mx-auto d-block" width="600px">
    <hr>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center navbar-custom mb-4">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastro</a></li>
            <li class="nav-item"><a class="nav-link" href="visualizar_cadastros.php">Visualizar</a></li>
        </ul>
    </nav>
    <h1>Torcedores Cadastrados</h1>
</div>

<div class="container">
    <p id="statusMessage" class="text-success font-weight-bold"></p>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered table-green table-striped'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Inscrição</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td id='nome-" . $row["id"] . "' contentEditable='false'>" . $row["nome"]. "</td>
                    <td id='inscricao-" . $row["id"] . "' contentEditable='false'>" . $row["inscricao"]. "</td>
                    <td id='descricao-" . $row["id"] . "' contentEditable='false'>" . $row["descricao"]. "</td>
                    <td>
                        <button class='btn btn-sm btn-primary' onClick='enableEditing(".$row["id"].")'>✏️ Editar</button>
                        <button class='btn btn-sm btn-danger' onClick='deleteRow(".$row["id"].")'>🗑️ Excluir</button>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-info'>Ainda não há torcedores cadastrados.</div>";
    }
    ?>
</div>

<div class="footer">
    © 2025 PALMEIRAS
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
