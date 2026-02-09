<?php
namespace Src;

class Usuario {
    private int $id;
    private string $nome;
    private string $email;
    private string $telefone;
    private string $senha;
    private string $tipo;
    private string $dataCadastro;
    private ?string $ultimoLogin;

    public function __construct(string $nome, string $email, string $telefone, string $senha, string $tipo = 'cliente', int $id = 0, string $dataCadastro = '', ?string $ultimoLogin = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->tipo = $tipo;
        $this->dataCadastro = $dataCadastro ?: date('Y-m-d H:i:s');
        $this->ultimoLogin = $ultimoLogin;
    }

    public function getId(): int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getTelefone(): string { return $this->telefone; }
    public function getSenha(): string { return $this->senha; }
    public function getTipo(): string { return $this->tipo; }
    public function getDataCadastro(): string { return $this->dataCadastro; }
    public function getUltimoLogin(): ?string { return $this->ultimoLogin; }

    public function setId(int $id): void { $this->id = $id; }
    public function setNome(string $nome): void { $this->nome = $nome; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setTelefone(string $telefone): void { $this->telefone = $telefone; }
    public function setSenha(string $senha): void { $this->senha = password_hash($senha, PASSWORD_DEFAULT); }
    public function setTipo(string $tipo): void { $this->tipo = $tipo; }
    public function setUltimoLogin(?string $ultimoLogin): void { $this->ultimoLogin = $ultimoLogin; }

    public function validarNome(): bool { return str_word_count($this->nome) >= 2; }
    public function validarEmail(): bool { return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false; }
    public function validarTelefone(): bool { $telefoneLimpo = preg_replace('/\D/', '', $this->telefone); return strlen($telefoneLimpo) >= 10 && strlen($telefoneLimpo) <= 11; }
    public function validarSenha(): bool { return strlen($this->senha) >= 6; }
    public function validarTipo(): bool { return in_array($this->tipo, ['cliente', 'admin']); }

    public static function registrarEvento(int $usuarioId, string $acao, string $detalhes, \PDO $pdo): void {
        $stmt = $pdo->prepare("INSERT INTO eventos (usuario_id, acao, detalhes) VALUES (:u, :a, :d)");
        $stmt->execute([':u' => $usuarioId, ':a' => $acao, ':d' => $detalhes]);
    }

                                                                          
}             

?>