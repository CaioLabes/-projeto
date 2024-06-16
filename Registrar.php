<?php
require 'Banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['usuario']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, nome, senha) VALUES (:usuario, :nome, :senha)");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            echo "Registro realizado com sucesso!<br>";
            echo "Usuário: $usuario<br>";
            echo "Nome: $nome<br>";
            echo "Senha (hash): $senha<br>";
            header('Location: Login.php');
            exit();
        } else {
            $error = "Erro ao registrar.";
            echo $error;
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
        echo $error;
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
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
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
