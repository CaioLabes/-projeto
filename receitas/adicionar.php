<?php
session_start();
require '../Banco.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: Login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['titulo']) && !empty($_POST['descricao'])) {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $usuario_id = $_SESSION['usuario_id'];

        $stmt = $conn->prepare("INSERT INTO receitas (titulo, descricao, usuario_id) VALUES (:titulo, :descricao, :usuario_id)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':usuario_id', $usuario_id);

        if ($stmt->execute()) {
            header('Location: ver.php');
            exit();
        } else {
            $error = "Erro ao adicionar receita.";
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Receita</title>
</head>
<body>
    <h2>Adicionar Receita</h2>
    <a href="../Menureceitas.php">Voltar ao Dashboard</a>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="5" required></textarea>
        <br><br>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
