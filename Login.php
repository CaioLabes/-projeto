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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
    <div class="login-container">
        <form method="post">
            <h2>Login</h2>
            <?php if (!empty($erro)) echo "<p class='error'>$erro</p>"; ?>
            <div class="input-group">
                <label for="usuario"></label>
                <div class="input-wrapper">
                    <i class="bi bi-person"></i>
                    <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
                </div>
            </div>
            <div class="input-group">
                <label for="senha"></label>
                <div class="input-wrapper">
                    <i class="bi bi-lock"></i>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                </div>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
    </div>
</body>
</html>
