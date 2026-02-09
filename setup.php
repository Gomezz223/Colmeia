<?php
$host = 'localhost';
$dbname = 'testPPA';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco '$dbname' criado/verificado.<br>";

    $pdo->exec("USE `$dbname`");

    $tables = [
        "CREATE TABLE IF NOT EXISTS usuario (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            telefone VARCHAR(20) NOT NULL,
            senha VARCHAR(255) NOT NULL,
            tipo ENUM('cliente', 'admin') DEFAULT 'cliente',
            foto VARCHAR(255) DEFAULT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ultimo_login TIMESTAMP NULL
        )",
        "CREATE TABLE IF NOT EXISTS logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mensagem TEXT,
            data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS eventos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT,
            acao VARCHAR(255),
            detalhes TEXT,
            data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
        )"
    ];

    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }

    echo "Tabelas criadas. Setup concluído!<br>";
    echo "Remova este arquivo em produção.";

} catch (PDOException $e) {
    die("Erro no setup: " . $e->getMessage());
}

?> 