<?php
session_start();
require 'Banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuarioDados = $resultado->fetch_assoc();

        if ($usuarioDados && password_verify($senha, $usuarioDados['senha'])) {
            $_SESSION['usuario'] = $usuarioDados['usuario'];
            $_SESSION['usuario_id'] = $usuarioDados['cod'];
            header('Location: Menureceitas.php');
            exit();
        } else {
            $erro = "Usuário ou senha inválidos.";
        }

        $stmt->close();
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <h2>Login</h2>
        <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
