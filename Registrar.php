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
    <title>Registrar</title>
    <link rel="stylesheet" href="css/styleregistrar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <form method="post" class="form-container">
            <h2>Registrar</h2>
            <?php if (!empty($erro)) echo "<p class='error'>$erro</p>"; ?>
            <div class="input-group">
                <label for="usuario"></label>
                <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="input-group">
                <label for="nome"></label>
                <input type="text" id="nome" name="nome" placeholder="Nome" required>
            </div>
            <div class="input-group">
                <label for="senha"></label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="button"><i class="bi bi-person-plus"></i> Registrar</button>
        </form>
    </div>
</body>
</html>
