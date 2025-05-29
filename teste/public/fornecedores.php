<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Fornecedor.php';

$fornecedorModel = new Fornecedor($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    if ($acao == 'criar') {
        $fornecedorModel->criar($_POST['nome'], $_POST['contato'], $_POST['telefone']);
        header('Location: fornecedores.php');
        exit;
    }

    if ($acao == 'atualizar') {
        $fornecedorModel->atualizar($_POST['id'], $_POST['nome'], $_POST['contato'], $_POST['telefone']);
        header('Location: fornecedores.php');
        exit;
    }

    if ($acao == 'deletar') {
        $fornecedorModel->deletar($_POST['id']);
        header('Location: fornecedores.php');
        exit;
    }
}

$fornecedorEdit = null;
if (isset($_GET['editar'])) {
    $fornecedorEdit = $fornecedorModel->buscarPorId($_GET['editar']);
}

$fornecedores = $fornecedorModel->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Fornecedores - CRUD PDO</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <h1>Fornecedores</h1>

    <a href="index.php">Voltar ao painel</a>

    <h2><?= $fornecedorEdit ? "Editar Fornecedor" : "Novo Fornecedor" ?></h2>
    <form method="post">
        <input type="hidden" name="acao" value="<?= $fornecedorEdit ? 'atualizar' : 'criar' ?>" />
        <?php if ($fornecedorEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($fornecedorEdit['id']) ?>" />
        <?php endif; ?>

        <label>Nome:</label><br />
        <input type="text" name="nome" required value="<?= $fornecedorEdit ? htmlspecialchars($fornecedorEdit['nome']) : '' ?>" /><br />

        <label>Contato:</label><br />
        <input type="text" name="contato" required value="<?= $fornecedorEdit ? htmlspecialchars($fornecedorEdit['contato']) : '' ?>" /><br />

        <label>Telefone:</label><br />
        <input type="text" name="telefone" required value="<?= $fornecedorEdit ? htmlspecialchars($fornecedorEdit['telefone']) : '' ?>" /><br /><br />

        <button type="submit"><?= $fornecedorEdit ? 'Atualizar' : 'Criar' ?></button>
        <?php if ($fornecedorEdit): ?>
            <a href="fornecedores.php">Cancelar</a>
        <?php endif; ?>
    </form>

    <hr />

    <h2>Lista de Fornecedores</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nome</th><th>Contato</th><th>Telefone</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fornecedores as $f): ?>
                <tr>
                    <td><?= htmlspecialchars($f['id']) ?></td>
                    <td><?= htmlspecialchars($f['nome']) ?></td>
                    <td><?= htmlspecialchars($f['contato']) ?></td>
                    <td><?= htmlspecialchars($f['telefone']) ?></td>
                    <td>
                        <a href="?editar=<?= $f['id'] ?>">Editar</a> |
                        <form method="post" style="display:inline" onsubmit="return confirm('Confirma exclusão?');">
                            <input type="hidden" name="acao" value="deletar" />
                            <input type="hidden" name="id" value="<?= $f['id'] ?>" />
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
