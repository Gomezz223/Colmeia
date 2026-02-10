<?php
session_start();  // Inicia sessão em todas as páginas
?>
<header>
    <div class="img"><img src="assets/img/logo.png" alt="Logo Colmeia"></div>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <nav class="menu">
        <a href="index.php">INÍCIO</a>
        <a href="sobre.php">SOBRE NÓS</a>
        <a href="ecommerce.php">E-COMMERCE</a>
        <a href="ajuda.php">AJUDA & DENÚNCIAS</a>
        <?php if (!isset($_SESSION['usuario'])): ?>
            <a href="login.php">LOGIN</a>
        <?php else: ?>
            <img src="assets/img/user.png" alt="Usuário" style="width: 30px; height: 30px; border-radius: 50%;">  <!-- Foto de usuário comum -->
        <?php endif; ?>
    </nav>
</header>   