<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {
 
    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu email: ";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);


        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('Location: painel.php');

        } else{
            echo "Falha ao logar! Email ou senha incorretos";
        }
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form action="" method="POST">
                <h1>Acesse sua conta</h1>

                <input type="text" name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">

                <button type="submit">Entrar</button>

                <a href="">Esqueceu a senha?</a>
                <a href="cadastro.php">Não tem Login? Cadastre-se</a>
            </form>
        </div>
       
    </div>
    
    
</body>
</html>