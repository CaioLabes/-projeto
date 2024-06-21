<?php
session_start();

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
    <link rel="stylesheet" href="css/stylemenureceitas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
        <nav>
            <ul>
                <li><a href="receitas/adicionar.php"><i class="bi bi-file-earmark-plus"></i> Adicionar Receita</a></li>
                <li><a href="receitas/ver.php?ver_todas=minhas"><i class="bi bi-list-task"></i> Ver Minhas Receitas</a></li>
                <li><a href="receitas/ver.php?ver_todas=todas"><i class="bi bi-list"></i> Ver Todas as Receitas</a></li>
                <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
