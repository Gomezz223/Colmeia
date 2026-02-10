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
  <title>Colmeia - Cadastro</title>
</head>

<body>

  <?php include 'header.php'; ?>

  <<header>
    <div class="img"><img src="assets/img/logo.png" alt="logo"></div>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-icon">
      <span></span>
      <span></span>
      <span></span>
    </label>
    <nav class="menu">
      <a href="index.html">INÍCIO</a>
      <a href="sobre.html">SOBRE NÓS</a>
      <a href="ecommerce.html">E-COMMERCE</a>
      <a href="ajuda.html">AJUDA & DENUNCIAS</a>
      <a href="login.html">LOGIN</a>
    </nav>
  </header>

  <main id="maincadastro">
    <section class="cadastroContainer">
      <div class="formCadastro">
        <h2>FAÇA SEU CADASTRO!</h2>
        <hr class="linhacadastro"
          style="margin: 20px auto; width: 80%; border: none; height: 1px; background-color: #402547;">

        <form id="formCadastro" action="backend.php" method="post">
          <label class="labelcadastro" for="nomeCompleto">Nome completo:</label>
          <input class="inputcadastro" type="text" id="nomeCompleto" name="nomeCompleto"
            placeholder="Digite seu nome completo" required>

          <label class="labelcadastro" for="email">Email:</label>
          <input class="inputcadastro" type="email" id="email" name="email" placeholder="Digite seu email" required>

          <label class="labelcadastro" for="telefone">Telefone:</label>
          <input class="inputcadastro" type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone"
            required>

          <label class="labelcadastro" for="senha">Senha (min. 6 caracteres):</label>
          <input class="inputcadastro" type="password" id="senha" name="senha" placeholder="Crie uma senha"
            minlength="6" required>

          <label class="labelcadastro" for="confirmarSenha">Confirmar senha:</label>
          <input class="inputcadastro" type="password" id="confirmarSenha" name="confirmarSenha"
            placeholder="Repita sua senha" minlength="6" required>

          <div class="divbuttoncadastro">
            <button class="buttoncadastro" type="submit">CADASTRAR-SE</button>
          </div>

          <div class="form-footer">
            <p class="pcadastro">Já tem uma conta? <a href="login.html">Faça login aqui!</a></p>
          </div>
        </form>
      </div>
    </section>
  </main>

  <script src="assets/js/script.js" defer></script>

</body>

</html>