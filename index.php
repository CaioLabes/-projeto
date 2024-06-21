<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Sistema de Receitas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="icon-container">
            <i class="bi bi-book"></i>
        </div>
        <h1>Bem-vindo ao Sistema de Receitas</h1>
        <p>Compartilhe suas receitas favoritas com outros usuários!</p>
        <div class="buttons">
            <a href="Login.php" class="button"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <a href="Registrar.php" class="button"><i class="bi bi-person-plus"></i> Registrar</a>
        </div>
    </div>
</body>
</html>
