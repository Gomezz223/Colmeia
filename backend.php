<?php
session_start();
require_once "config/Database.php";
require_once "src/Usuario.php";

use Config\Database;
use Src\Usuario;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método de requisição inválido.");
}

$nome = trim($_POST["nomeCompleto"] ?? '');
$email = trim($_POST["email"] ?? '');
$telefone = trim($_POST["telefone"] ?? '');
$senha = $_POST["senha"] ?? '';
$confirmarSenha = $_POST["confirmarSenha"] ?? '';
$tipo = $_POST["tipo"] ?? 'cliente';

$user = new Usuario($nome, $email, $telefone, $senha, $tipo);

if (!$user->validarNome() || !$user->validarEmail() || !$user->validarTelefone() || !$user->validarSenha() || !$user->validarTipo() || $senha !== $confirmarSenha) {
    die("Erro: dados inválidos.");
}

try {
    $pdo = Database::getInstance();
    $stmtCheck = $pdo->prepare("SELECT email FROM usuario WHERE email = :e");
    $stmtCheck->execute([':e' => $user->getEmail()]);
    if ($stmtCheck->fetch()) {
        die("Erro: Email já cadastrado.");
    }

    $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha, tipo) VALUES (:n, :e, :t, :s, :tp)");
    $stmt->execute([
        ':n' => $user->getNome(),
        ':e' => $user->getEmail(),
        ':t' => $user->getTelefone(),
        ':s' => $user->getSenha(),
        ':tp' => $user->getTipo()
    ]);

    $userId = $pdo->lastInsertId();
    Usuario::registrarEvento($userId, 'cadastro', 'Usuário cadastrado', $pdo);

    $_SESSION['usuario'] = ['id' => $userId, 'nome' => $user->getNome(), 'tipo' => $user->getTipo()];
    header("Location: index.html");
    exit;
} catch (PDOException $e) {
    die("Erro ao processar cadastro.");
}

?>