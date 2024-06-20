<?php
session_start();
require '../Banco.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

// Consulta SQL para buscar as receitas do usuário logado
$sql = "SELECT * FROM receitas WHERE usuario = '$usuario'";
$resultado = $conexao->query($sql);

// Verificar se encontrou alguma receita
if ($resultado->num_rows > 0) {
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
            <?php while ($receita = $resultado->fetch_assoc()): ?>
                <li>
                    <h3><?php echo htmlspecialchars($receita['titulo']); ?></h3>
                    <p>Ingredientes:</p>
                    <p><?php echo nl2br(htmlspecialchars($receita['ingredientes'])); ?></p>
                    <p>Modo de preparo:</p>
                    <p><?php echo nl2br(htmlspecialchars($receita['preparo'])); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    </body>
    </html>
    <?php
} else {
    echo "Nenhuma receita encontrada.";
}

// Fechar conexão
$conexao->close();
?>
