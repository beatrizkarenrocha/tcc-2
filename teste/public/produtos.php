<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Produto.php';

$produtoModel = new Produto($pdo);

// Criar novo produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    if ($acao == 'criar') {
        $produtoModel->criar($_POST['nome'], $_POST['descricao'], $_POST['preco']);
        header('Location: produtos.php');
        exit;
    }

    if ($acao == 'atualizar') {
        $produtoModel->atualizar($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);
        header('Location: produtos.php');
        exit;
    }

    if ($acao == 'deletar') {
        $produtoModel->deletar($_POST['id']);
        header('Location: produtos.php');
        exit;
    }
}

// Para edição
$produtoEdit = null;
if (isset($_GET['editar'])) {
    $produtoEdit = $produtoModel->buscarPorId($_GET['editar']);
}

$produtos = $produtoModel->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Produtos - CRUD PDO</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <h1>Produtos</h1>

    <a href="index.php">Voltar ao painel</a>

    <h2><?= $produtoEdit ? "Editar Produto" : "Novo Produto" ?></h2>
    <form method="post">
        <input type="hidden" name="acao" value="<?= $produtoEdit ? 'atualizar' : 'criar' ?>" />
        <?php if ($produtoEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($produtoEdit['id']) ?>" />
        <?php endif; ?>
        <label>Nome:</label><br />
        <input type="text" name="nome" required value="<?= $produtoEdit ? htmlspecialchars($produtoEdit['nome']) : '' ?>" /><br />

        <label>Descrição:</label><br />
        <textarea name="descricao" required><?= $produtoEdit ? htmlspecialchars($produtoEdit['descricao']) : '' ?></textarea><br />

        <label>Preço:</label><br />
        <input type="number" step="0.01" name="preco" required value="<?= $produtoEdit ? htmlspecialchars($produtoEdit['preco']) : '' ?>" /><br /><br />

        <button type="submit"><?= $produtoEdit ? 'Atualizar' : 'Criar' ?></button>
        <?php if ($produtoEdit): ?>
            <a href="produtos.php">Cancelar</a>
        <?php endif; ?>
    </form>

    <hr />

    <h2>Lista de Produtos</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id']) ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="?editar=<?= $produto['id'] ?>">Editar</a> |
                        <form method="post" style="display:inline" onsubmit="return confirm('Confirma exclusão?');">
                            <input type="hidden" name="acao" value="deletar" />
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>" />
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
