<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_parcela.php";
?>
<h1>Parcelas</h1>
<?=nomeCliente($id_cliente)?>
<?=nomeGrupo($id_grupo)?>
<br><br>
<table class="tabela">
    <tr>
        <th>Cliente</th>
        <th>Vencimento</th>
        <th>Multa</th>
        <th>Juros a.d.</th>
        <th>Valor</th>
        <th>Total</th>
        <th>Data do pagamento</th>
        <th>Valor pago</th>
        <th>Status</th>
        <th></th>
    </tr>
    <?=mostraTransacao($id_cliente)?>
</table>