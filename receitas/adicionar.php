<?php
session_start();
require '../Banco.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$erro = '';

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
    <title>Adicionar Receita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleadicionarreceitas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h2>Adicionar Receita</h2>
        <a href="../Menureceitas.php" class="back-link"><i class="bi bi-arrow-left"></i> Voltar ao Menu</a>
        <?php if (!empty($erro)) echo "<p class='text-danger'>$erro</p>"; ?>
        <form method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <select class="form-select" id="categoria" name="categoria">
                    <option value="Doce">Doce</option>
                    <option value="Salgada">Salgada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Receita</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
