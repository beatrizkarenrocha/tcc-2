<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Usuario.php';

$usuarioModel = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    if ($acao == 'criar') {
        $usuarioModel->criar($_POST['nome'], $_POST['email'], $_POST['senha']);
        header('Location: usuarios.php');
        exit;
    }

    if ($acao == 'atualizar') {
        // Senha é opcional na atualização
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
        $usuarioModel->atualizar($_POST['id'], $_POST['nome'], $_POST['email'], $senha);
        header('Location: usuarios.php');
        exit;
    }

    if ($acao == 'deletar') {
        $usuarioModel->deletar($_POST['id']);
        header('Location: usuarios.php');
        exit;
    }
}

$usuarioEdit = null;
if (isset($_GET['editar'])) {
    $usuarioEdit = $usuarioModel->buscarPorId($_GET['editar']);
}

$usuarios = $usuarioModel->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Usuários - CRUD PDO</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <h1>Usuários</h1>

    <a href="index.php">Voltar ao painel</a>

    <h2><?= $usuarioEdit ? "Editar Usuário" : "Novo Usuário" ?></h2>
    <form method="post">
        <input type="hidden" name="acao" value="<?= $usuarioEdit ? 'atualizar' : 'criar' ?>" />
        <?php if ($usuarioEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioEdit['id']) ?>" />
        <?php endif; ?>

        <label>Nome:</label><br />
        <input type="text" name="nome" required value="<?= $usuarioEdit ? htmlspecialchars($usuarioEdit['nome']) : '' ?>" /><br />

        <label>Email:</label><br />
        <input type="email" name="email" required value="<?= $usuarioEdit ? htmlspecialchars($usuarioEdit['email']) : '' ?>" /><br />

        <label>Senha: <?= $usuarioEdit ? '(Deixe em branco para não alterar)' : '' ?></label><br />
        <input type="password" name="senha" <?= $usuarioEdit ? '' : 'required' ?> /><br /><br />

        <button type="submit"><?= $usuarioEdit ? 'Atualizar' : 'Criar' ?></button>
        <?php if ($usuarioEdit): ?>
            <a href="usuarios.php">Cancelar</a>
        <?php endif; ?>
    </form>

    <hr />

    <h2>Lista de Usuários</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nome</th><th>Email</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['id']) ?></td>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <a href="?editar=<?= $u['id'] ?>">Editar</a> |
                        <form method="post" style="display:inline" onsubmit="return confirm('Confirma exclusão?');">
                            <input type="hidden" name="acao" value="deletar" />
                            <input type="hidden" name="id" value="<?= $u['id'] ?>" />
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
