<?php include('../../conf/conexao.php'); ?>
<h2>Gestão de Fornecedor</h2>
<p>Aqui você pode ver, editar e remover fornecedor.</p>
<!-- Exemplo de tabela de usuários -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Maria</td>
            <td>maria@exemplo.com</td>
        </tr>
    </tbody>
</table>
<div class="text-center mt-3">
                                <a href="../public/cad_fornecedores.php" class="btn btn-action">
                                    <i class="fas fa-user-plus"></i> Cadastrar Fornecedor
                                </a>
                            </div>