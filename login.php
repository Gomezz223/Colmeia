<?php
session_start();
require_once "config/Database.php";
require_once "src/Usuario.php";

use Config\Database;
use Src\Usuario;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método de requisição inválido.");
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'] ?? '';
$lembrar = isset($_POST['lembrar']);

if (!$email || empty($senha)) {
    die("Preencha todos os campos.");
}

try {
    $pdo = Database::getInstance();

    $isAdmin = false;
    $adminsFile = __DIR__ . '/admins.txt';
    if (file_exists($adminsFile)) {
        $admins = file($adminsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($admins as $line) {
            list($adminEmail, $adminPassword) = explode(':', $line, 2);
            if ($adminEmail === $email && $adminPassword === $senha) {
                $isAdmin = true;
                break;
            }
        }
    }

    if ($isAdmin) {
        $_SESSION['usuario'] = ['id' => 0, 'nome' => 'Admin Master', 'tipo' => 'admin'];
        if ($lembrar) {
            setcookie('email', $email, time() + (30 * 24 * 3600), '/');
        }
        header("Location: admin.html");
        exit;
    }

    // Verificação normal no banco (usuários são clientes automaticamente)
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :e");
    $stmt->execute([':e' => $email]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dados || !password_verify($senha, $dados['senha'])) {
        die("Usuário ou senha incorretos.");
    }

    $stmtUpdate = $pdo->prepare("UPDATE usuario SET ultimo_login = NOW() WHERE id = :id");
    $stmtUpdate->execute([':id' => $dados['id']]);

    Usuario::registrarEvento($dados['id'], 'login', 'Usuário logou', $pdo);

    $_SESSION['usuario'] = ['id' => $dados['id'], 'nome' => $dados['nome'], 'tipo' => $dados['tipo']];
    if ($lembrar) {
        setcookie('email', $email, time() + (30 * 24 * 3600), '/');
    }

    header("Location: index.html");
    exit;
} catch (PDOException $e) {
    echo "". $e->getMessage();
    die("Erro no sistema.");
}

?>