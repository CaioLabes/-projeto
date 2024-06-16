<?php
session_start();
require 'Banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // consulta
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // informações do usuário e senha
        //echo "Usuário digitado: $usuario<br>";
        //echo "Senha digitada: $senha<br>";

        if ($user) {
            // informações do usuário encontrado no banco
           // var_dump($user);
            if (password_verify($senha, $user['senha'])) {
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['usuario_id'] = $user['cod'];
                header('Location: Menureceitas.php');
                exit();
            } else {
                $error = "Senha inválida.";
            }
        } else {
            $error = "Usuário não encontrado.";
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
    <title>Login</title>
</head>
<body>
    <form method="post">
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
