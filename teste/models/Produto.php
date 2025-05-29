<?php
require_once __DIR__ . '/../config/conexao.php';

class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $descricao, $preco) {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $preco]);
    }

    public function atualizar($id, $nome, $descricao, $preco) {
        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $preco, $id]);
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
