<?php
    session_start();
    require_once "usuario.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome     = trim($_POST["nomeCompleto"] ?? '');
    $email    = trim($_POST["email"] ?? '');
    $telefone = trim($_POST["telefone"] ?? '');
    $senha   = $_POST["senha"] ?? '';
    $confirmarSenha = $_POST["confirmarSenha"] ?? '';
    //BANCO DE DADOS
    $dsn = "mysql:dbname=testePPA;host=localhost";
    $usuario = "root";
    $pass = "";


    // VALIDAÇÃO DO FORM
    if (str_word_count($nome) < 2) {
        die("Erro: informe seu nome completo.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: email inválido.");
    }

    $telefoneLimpo = preg_replace('/\D/', '', $telefone);
    if (strlen($telefoneLimpo) < 10 || strlen($telefoneLimpo) > 11) {
        die("Erro: telefone inválido.");
    }

    if (strlen($senha) < 6) {
        die("Erro: a senha deve ter pelo menos 6 caracteres.");
    }

    if ($senha !== $confirmarSenha) {
        die("Erro: as senhas não coincidem.");
    }


    //CONEXÃO BANCO DE DADOS
    try{
        $pdo = new PDO($dsn, $usuario, $pass);
        echo "Conexão efetuada com sucesso!";
    }catch(PDOException $e){
        echo 'Erro na conexão do banco de dados: ' . $e;
    }

    $stmt = $pdo ->prepare("INSERT INTO usuario(nome,email,telefone,senha) VALUES (:n,:e,:t,:s)");
    $stmt ->execute([':n' => $nome, ':e'=> $email, ':t' => $telefoneLimpo, ':s' => $senha]);

    $user = new Usuario($nome,$senha,$email,$telefoneLimpo);

    
    $_SESSION['usuario'] = [
        'nome' => $user->getNome(),
        'email' => $user->getEmail(),
        'telefone' => $user->getTelefone()
    ];

    //QUERY DO BANCO DE DADOS
    // CREATE TABLE usuario(
    // codigo int primary key AUTO_INCREMENT,
    // nome varchar(30),
    // email varchar(30) primary key,
    // telefone varchar(12),
    // senha varchar(30)
    // );

    header("Location: index.html");
    exit;
}


?>