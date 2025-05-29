<?php
require_once __DIR__ . '/../config/conexao.php';

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT id, nome, email FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash]);
    }

    public function atualizar($id, $nome, $email, $senha = null) {
        if ($senha) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
            return $stmt->execute([$nome, $email, $senhaHash, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            return $stmt->execute([$nome, $email, $id]);
        }
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
