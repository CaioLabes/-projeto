<?php
session_start();
require '../Banco.php';

// Verificar login usuario
if (!isset($_SESSION['usuario'])) {
    header('Location: Login.php');
    exit();
}

// Verificar a seleção do filtro
$ver_todas = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ver_todas'])) {
    $ver_todas = ($_GET['ver_todas'] == 'todas');
}

// Consultar receitas com base na opção selecionada
if ($ver_todas) {
    $stmt = $conn->query("SELECT r.id, r.titulo, r.descricao, u.nome AS autor 
                          FROM receitas r 
                          JOIN usuarios u ON r.usuario_id = u.cod");
} else {
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $conn->prepare("SELECT r.id, r.titulo, r.descricao, u.nome AS autor 
                            FROM receitas r 
                            JOIN usuarios u ON r.usuario_id = u.cod 
                            WHERE r.usuario_id = :usuario_id");
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
}

$receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ver Receitas</title>
</head>
<body>
    <h2>Receitas</h2>
    <a href="../Menureceitas.php">Voltar ao Menu</a>
    <br><br>
    <form action="ver.php" method="get">
        <label for="ver_todas">Ver:</label>
        <select name="ver_todas" id="ver_todas">
            <option value="minhas" <?php if (!$ver_todas) echo 'selected'; ?>>Minhas Receitas</option>
            <option value="todas" <?php if ($ver_todas) echo 'selected'; ?>>Todas as Receitas</option>
        </select>
        <button type="submit">Aplicar</button>
    </form>
    <?php if (!empty($receitas)): ?>
        <ul>
            <?php foreach ($receitas as $receita): ?>
                <li>
                    <h3><?php echo htmlspecialchars($receita['titulo']); ?></h3>
                    <p><?php echo nl2br($receita['descricao']); ?></p>
                    <p><em>Autor: <?php echo ($receita['autor']); ?></em></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhuma receita encontrada.</p>
    <?php endif; ?>
</body>
</html>
