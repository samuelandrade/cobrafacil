<?php include_once "controle/controle_boleto.php"; ?>
<h1>Boleto</h1>
<table class="tabela">
    <tr>
        <th>Título</th>
        <th>Banco</th>
        <th>Agência</th>
        <th>Conta</th>
        <th>Instituição</th>
        <th> </th>
    </tr>
    <?=mostraBoleto()?>
</table>
