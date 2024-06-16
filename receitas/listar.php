<?php
session_start();
require '../Banco.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$stmt = $conn->prepare("SELECT * FROM receitas WHERE usuario = :usuario");
$stmt->bindParam(':usuario', $_SESSION['usuario']);
$stmt->execute();
$receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Receitas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Minhas Receitas</h2>
    <ul>
        <?php foreach ($receitas as $receita): ?>
            <li>
                <h3><?php echo htmlspecialchars($receita['titulo']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($receita['ingredientes'])); ?></p>
                <p><?php echo nl2br(htmlspecialchars($receita['preparo'])); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
