<?php
session_start();
require '../Banco.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Definir a consulta padrão
$sql = "SELECT r.id, r.titulo, r.descricao, r.categoria, u.nome AS autor 
        FROM receitas r 
        JOIN usuarios u ON r.usuario_id = u.cod";

// Verificar se o usuário quer ver apenas suas receitas ou todas
if (isset($_GET['ver_todas']) && $_GET['ver_todas'] == 'todas') {
    
} else {
    // Se estiver visualizando apenas suas receitas
    $usuario_id = $_SESSION['usuario_id'];
    $sql .= " WHERE r.usuario_id = :usuario_id";
}

// Verificar e aplicar filtro por categoria
if (isset($_GET['filtro_categoria'])) {
    $filtro = $_GET['filtro_categoria'];
    if ($filtro == 'doce' || $filtro == 'salgada') {
        if (strpos($sql, 'WHERE') === false) {
            $sql .= " WHERE r.categoria = :categoria";
        } else {
            $sql .= " AND r.categoria = :categoria";
        }
    }
}

$stmt = $conn->prepare($sql);

//parâmetros se houver filtro de categoria
if (isset($filtro) && ($filtro == 'doce' || $filtro == 'salgada')) {
    $stmt->bindParam(':categoria', $filtro);
}

//parâmetro de usuario se estiver visualizando apenas suas receitas
if (isset($_SESSION['usuario_id']) && isset($_GET['ver_todas']) && $_GET['ver_todas'] != 'todas') {
    $stmt->bindParam(':usuario_id', $usuario_id);
}

$stmt->execute();
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
        <label for="filtro_categoria">Filtrar por Categoria:</label>
        <select name="filtro_categoria" id="filtro_categoria">
            <option value="todos" <?php if (!isset($_GET['filtro_categoria']) || $_GET['filtro_categoria'] == 'todos') echo 'selected'; ?>>Todos</option>
            <option value="doce" <?php if (isset($_GET['filtro_categoria']) && $_GET['filtro_categoria'] == 'doce') echo 'selected'; ?>>Doce</option>
            <option value="salgada" <?php if (isset($_GET['filtro_categoria']) && $_GET['filtro_categoria'] == 'salgada') echo 'selected'; ?>>Salgada</option>
        </select>
        <label for="ver_todas">Ver:</label>
        <select name="ver_todas" id="ver_todas">
            <option value="minhas" <?php if (!isset($_GET['ver_todas']) || $_GET['ver_todas'] == 'minhas') echo 'selected'; ?>>Minhas Receitas</option>
            <option value="todas" <?php if (isset($_GET['ver_todas']) && $_GET['ver_todas'] == 'todas') echo 'selected'; ?>>Todas as Receitas</option>
        </select>
        <button type="submit">Aplicar</button>
    </form>
    
    <?php if (!empty($receitas)): ?>
        <ul>
            <?php foreach ($receitas as $receita): ?>
                <li>
                    <h3><?php echo htmlspecialchars($receita['titulo']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($receita['descricao'])); ?></p>
                    <p>Categoria: <?php echo htmlspecialchars($receita['categoria']); ?></p>
                    <p><em>Autor: <?php echo htmlspecialchars($receita['autor']); ?></em></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhuma receita encontrada.</p>
    <?php endif; ?>
</body>
</html>
