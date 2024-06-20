<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: Menureceitas.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Sistema de Receitas</title>
    <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao Sistema de Receitas</h1>
        <p>Compartilhe suas receitas favoritas com outros usuários!</p>
        <div class="buttons">
            <a href="Login.php" class="button">Login</a>
            <a href="Registrar.php" class="button">Registrar</a>
        </div>
    </div>
</body>
</html>
