<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_parcela.php";
?>
<h1>Parcelas</h1>
<?=nomeCliente($id_cliente)?>
<?=nomeGrupo($id_grupo)?>
<br>
<form action="?pag=parcelas" method="post" id="form_mostra_status" name="form_mostra_status">
    Status
    <select name="mostra_status" onChange="mostra_status();" onclick="submete()">
        <option value="4" <?php if($mostra_status == 4){echo "selected";} ?>>Pendente e Atrasado</option>
        <option value="2" <?php if($mostra_status == 2){echo "selected";} ?>>Pendente</option>
        <option value="3" <?php if($mostra_status == 3){echo "selected";} ?>>Atrasado</option>
        <option value="1" <?php if($mostra_status == 1){echo "selected";} ?>>Pago</option>
        <option value="0" <?php if($mostra_status == 0){echo "selected";} ?>>Todos</option>
    </select>
    <input type="submit" value="Ok" name="btn_status">
</form>
<br>
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
    <?=mostraTransacao($id_cliente, $mostra_status)?>
</table>