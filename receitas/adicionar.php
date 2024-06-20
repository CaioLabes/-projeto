<?php
session_start();
require '../Banco.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['titulo']) && !empty($_POST['descricao']) && !empty($_POST['categoria'])) {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $usuario_id = $_SESSION['usuario_id'];

        $stmt = $conexao->prepare("INSERT INTO receitas (titulo, descricao, categoria, usuario_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $titulo, $descricao, $categoria, $usuario_id);

        if ($stmt->execute()) {
            header('Location: ver.php');
            exit();
        } else {
            $erro = "Erro ao adicionar receita.";
            echo $erro;
        }

        $stmt->close();
    } else {
        $erro = "Por favor, preencha todos os campos.";
        echo $erro;
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
    <a href="../Menureceitas.php">Voltar ao Menu</a>
    <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
    <form method="post">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>
    <br><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="4" required></textarea>
    <br><br>
    <label for="categoria">Categoria:</label>
    <select id="categoria" name="categoria">
        <option value="Doce">Doce</option>
        <option value="Salgada">Salgada</option>
    </select>
    <br><br>
    <button type="submit">Salvar Receita</button>
</form>

</body>
</html>
