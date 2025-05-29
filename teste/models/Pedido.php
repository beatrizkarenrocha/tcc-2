<?php
require_once __DIR__ . '/../config/conexao.php';

class Pedido {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query(
            "SELECT pedidos.*, produtos.nome as produto_nome, usuarios.nome as usuario_nome
             FROM pedidos
             JOIN produtos ON pedidos.id_produto = produtos.id
             JOIN usuarios ON pedidos.id_usuario = usuarios.id
             ORDER BY pedidos.id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($id_produto, $id_usuario, $quantidade) {
        $stmt = $this->pdo->prepare("INSERT INTO pedidos (id_produto, id_usuario, quantidade) VALUES (?, ?, ?)");
        return $stmt->execute([$id_produto, $id_usuario, $quantidade]);
    }

    public function atualizar($id, $id_produto, $id_usuario, $quantidade) {
        $stmt = $this->pdo->prepare("UPDATE pedidos SET id_produto = ?, id_usuario = ?, quantidade = ? WHERE id = ?");
        return $stmt->execute([$id_produto, $id_usuario, $quantidade, $id]);
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM pedidos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
