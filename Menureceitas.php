<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: Login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <nav>
        <ul>
            <li><a href="receitas/adicionar.php">Adicionar Receita</a></li>
            <li><a href="receitas/ver.php?ver_todas=minhas">Ver Minhas Receitas</a></li>
            <li><a href="receitas/ver.php?ver_todas=todas">Ver Todas as Receitas</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
