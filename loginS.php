<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Inter:wght@400;700&display=swap"
    rel="stylesheet">
  <link rel="icon" href="assets/img/favicon.png" type="image/png">
  <title>Colmeia - Login</title>
</head>

<body>

  <?php include 'header.php'; ?>
  <body>

  <main id="loginmain">
    <section class="login-container">
      <div class="imagemlogin">
        <img src="assets/img/imgLogin.png" alt="Bem-vinda de volta">
      </div>

      <div class="formulariologin">
        <h2>FAÇA SEU LOGIN!</h2>

        <form id="formlogin" action="login.php" method="post">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Digite seu email" required>

          <label for="senha">Senha:</label>
          <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

          <button type="submit">LOGIN</button>

          <div class="form-footer">
            <a href="#">Esqueceu sua senha?</a>
            <p>Não tem uma conta? <a href="cadastro.html">Cadastre-se aqui!</a></p>
          </div>
        </form>
      </div>
    </section>
  </main>

  <script src="assets/js/script.js" defer></script>
</body>

</html>