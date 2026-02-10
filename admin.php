<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
    header("Location: index.php");  // Redireciona se não for admin
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Colmeia</title>
</head>
<body>
    <h1>Admin logado com sucesso!</h1>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?>!</p>
    <!-- Adicione funcionalidades admin aqui, ex: lista de usuários -->
</body>
</html>