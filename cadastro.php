<?php

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter as informações do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarsenha = $_POST['confirmarsenha'];

    // Verificar se as senhas correspondem
    if ($senha !== $confirmarsenha) {
        echo "As senhas não correspondem.";
        exit; // Encerrar o script se as senhas não correspondem
    }

    // Configuração do banco de dados
    $host = "localhost"; // nome do servidor
    $usuario = "root"; // nome de usuário do banco de dados
    $dbsenha = ""; // senha do banco de dados
    $database = "login"; // nome do banco de dados

    // Criar a conexão
    $conn = new mysqli($host, $usuario, $dbsenha, $database);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    
    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
   
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $conn->close(); // Fechar a conexão com o banco de dados
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form method="POST" action="">
                <h1>Cadastro</h1>
                <input id="nome" type="text" name="nome" placeholder="Nome de Usuário" required>
                <input id="email" type="email" name="email" placeholder="Email" required>
                <input id="senha" type="password" name="senha" placeholder="Senha" required>
                <input id="confirmarsenha" type="password" name="confirmarsenha" placeholder="Confirmar Senha" required>
                <button type="submit">Cadastrar</button>
                <a href="index.php">Já possui uma conta?Faça Login</a>
            </form>
        </div>
    </div>
</body>
</html>