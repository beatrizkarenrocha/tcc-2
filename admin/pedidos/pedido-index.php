<?php include_once('../../conf/conexao.php'); ?>
<h2>Gestão de Pedidos</h2>
<p>Aqui você pode cadastrar e administrar seus pedidos.</p>
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
                                <a href="../public/cadastro_new_V2.php" class="btn btn-action">
                                    <i class="fas fa-user-plus"></i> Cadastrar Pedido
                                </a>
                            </div>