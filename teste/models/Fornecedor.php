<?php
require_once __DIR__ . '/../config/conexao.php';

class Fornecedor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM fornecedores ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $contato, $telefone) {
        $stmt = $this->pdo->prepare("INSERT INTO fornecedores (nome, contato, telefone) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $contato, $telefone]);
    }

    public function atualizar($id, $nome, $contato, $telefone) {
        $stmt = $this->pdo->prepare("UPDATE fornecedores SET nome = ?, contato = ?, telefone = ? WHERE id = ?");
        return $stmt->execute([$nome, $contato, $telefone, $id]);
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM fornecedores WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
