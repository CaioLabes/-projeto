<?php
require 'Banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['usuario']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

        $stmt = $conexao->prepare("INSERT INTO usuarios (usuario, nome, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $nome, $senha);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $erro = "Erro ao registrar.";
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
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="post">
        <h2>Registrar</h2>
        <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
