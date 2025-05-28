<?php include_once('../../conf/conexao.php'); ?>
<h2>Gestão de Produtos</h2>
<p>Aqui você pode cadastrar e administrar seus produtos.</p>
<!-- Exemplo de tabela de produtos -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Notebook</td>
            <td>R$ 2.500,00</td>
        </tr>
    </tbody>
</table>
<div class="text-center mt-3">
                                <a href="../public/cad_produtos.php" class="btn btn-action">
                                    <i class="fas fa-user-plus"></i> Cadastrar Produto
                                </a>
                            </div>