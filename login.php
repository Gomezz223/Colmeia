<?php
session_start();

$dsn = "mysql:dbname=testePPA;host=localhost";
$usuario = "root";
$pass = "";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    die("Preencha todos os campos.");
}

try {
    $pdo = new PDO($dsn, $usuario, $pass);
} catch (PDOException $e) {
    die("Erro no banco.");
}

$stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :e");
$stmt->execute([':e' => $email]);

$dados = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    die("Usuário não encontrado.");
}

if ($senha !== $dados['senha']) {
    die("Senha incorreta.");
}

$_SESSION['usuario'] = [
    'nome' => $dados['nome'],
    'email' => $dados['email'],
    'telefone' => $dados['telefone']
];

header("Location: index.html");
exit;

?>