<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Usuario.php';

$pedidoModel = new Pedido($pdo);
$produtoModel = new Produto($pdo);
$usuarioModel = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    if ($acao == 'criar') {
        $pedidoModel->criar($_POST['id_produto'], $_POST['id_usuario'], $_POST['quantidade']);
        header('Location: pedidos.php');
        exit;
    }

    if ($acao == 'atualizar') {
        $pedidoModel->atualizar($_POST['id'], $_POST['id_produto'], $_POST['id_usuario'], $_POST['quantidade']);
        header('Location: pedidos.php');
        exit;
    }

    if ($acao == 'deletar') {
        $pedidoModel->deletar($_POST['id']);
        header('Location: pedidos.php');
        exit;
    }
}

$pedidoEdit = null;
if (isset($_GET['editar'])) {
    $pedidoEdit = $pedidoModel->buscarPorId($_GET['editar']);
}

$pedidos = $pedidoModel->listar();
$produtos = $produtoModel->listar();
$usuarios = $usuarioModel->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Pedidos - CRUD PDO</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <h1>Pedidos</h1>

    <a href="index.php">Voltar ao painel</a>

    <h2><?= $pedidoEdit ? "Editar Pedido" : "Novo Pedido" ?></h2>
    <form method="post">
        <input type="hidden" name="acao" value="<?= $pedidoEdit ? 'atualizar' : 'criar' ?>" />
        <?php if ($pedidoEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($pedidoEdit['id']) ?>" />
        <?php endif; ?>

        <label>Produto:</label><br />
        <select name="id_produto" required>
            <option value="">Selecione um produto</option>
            <?php foreach ($produtos as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $pedidoEdit && $pedidoEdit['id_produto'] == $p['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select><br />

        <label>Usuário:</label><br />
        <select name="id_usuario" required>
            <option value="">Selecione um usuário</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?= $u['id'] ?>" <?= $pedidoEdit && $pedidoEdit['id_usuario'] == $u['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select><br />

        <label>Quantidade:</label><br />
        <input type="number" name="quantidade" min="1" required value="<?= $pedidoEdit ? htmlspecialchars($pedidoEdit['quantidade']) : 1 ?>" /><br /><br />

        <button type="submit"><?= $pedidoEdit ? 'Atualizar' : 'Criar' ?></button>
        <?php if ($pedidoEdit): ?>
            <a href="pedidos.php">Cancelar</a>
        <?php endif; ?>
    </form>

    <hr />

    <h2>Lista de Pedidos</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Produto</th><th>Usuário</th><th>Quantidade</th><th>Data do Pedido</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $ped): ?>
                <tr>
                    <td><?= htmlspecialchars($ped['id']) ?></td>
                    <td><?= htmlspecialchars($ped['produto_nome']) ?></td>
                    <td><?= htmlspecialchars($ped['usuario_nome']) ?></td>
                    <td><?= htmlspecialchars($ped['quantidade']) ?></td>
                    <td><?= htmlspecialchars($ped['data_pedido']) ?></td>
                    <td>
                        <a href="?editar=<?= $ped['id'] ?>">Editar</a> |
                        <form method="post" style="display:inline" onsubmit="return confirm('Confirma exclusão?');">
                            <input type="hidden" name="acao" value="deletar" />
                            <input type="hidden" name="id" value="<?= $ped['id'] ?>" />
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
