<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar com o banco de dados
    $servername = "localhost"; 
    $username = "root";
    $password = "Senai@118";
    $dbname = "palmeiras";
    $port = 3306;

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificar conexão
    if ($conn->connect_error) {
        $_SESSION['mensagem'] = "Conexão falhou: " . $conn->connect_error;
    } else {
        // Coletar dados do formulário
        $nome = $conn->real_escape_string($_POST['nome']);
        $inscricao = $conn->real_escape_string($_POST['inscricao']);
        $descricao = $conn->real_escape_string($_POST['descricao']);

        // Criar o comando SQL
        $sql = "INSERT INTO torcedor (nome, inscricao, descricao) VALUES ('$nome', '$inscricao', '$descricao')";

        // Executar o comando SQL
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem'] = "Cadastro de torcedor realizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao realizar cadastro: " . $conn->error;
        }
        // Fechar conexão
        $conn->close();
    }

    // Redirecionar para a página do formulário
    header("Location: cadastro.php");
    exit;
} else {
    // Se o arquivo for acessado diretamente, redireciona para o início
    header("Location: index.php");
    exit;
}
?>
