<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_parcela.php";
?>
<h1>Transação</h1>
<fieldset>
    <legend>Editar transação</legend>
    <form action="" method="post" class="formulario">
        <input type='hidden' value='<?=$transacao->get_dt_pagamento()?>' name='pgt_anterior'>
        <div>
            <label class="campos">Cliente: </label><br>
            <strong><?=parcela_cliente($transacao->get_id_cliente())?></strong>
        </div>
        <div>
            <label class="campos">Boleto: </label><br>
            <select name='boleto'>
                <option value=""> -- Selecione o boleto -- </option>
                <?=parcela_mostraBoleto($transacao->get_id_boleto())?>
            </select>
        </div>
        <div>
            <label class="campos">Valor da parcela: </label><br>
            <input type='text' value='<?=$transacao->get_valor()?>' name='valor' id='valor'>
        </div>
        <div>
            <label class="campos">Multa por atraso: </label><br>
            <input type='text' value='<?=$transacao->get_multa()?>' name='multa' id='multa'>
        </div>
        <div>
            <label class="campos">Taxa de juros ao dia (%): </label><br>
            <input type='text' value='<?=$transacao->get_juro()?>' name='juro' id='juro'>
        </div>
        <div>
            <label class="campos">Data de vencimento: </label><br>
            <input type='text' value='<?=$transacao->get_dt_vencimento_pt()?>' name='vencimento' id='vencimento' OnKeyPress="formatar(this, '00/00/0000')" maxlength="10">
        </div>
        <div>
            <label class="campos">Valor pago: </label><br>
            <input type='text' value='<?=$transacao->get_valor_pago()?>' name='valor_pago' id='valor'>
        </div>
        <!--
        <div>
            <label class="campos">Data do pagamento: </label><br>
            <input type='text' value='<?=$transacao->get_dt_pagamento_pt()?>' name='pagamento' id='pagamento' OnKeyPress="formatar(this, '00/00/0000')" maxlength="10">
        </div>
        -->
        <div>
            <button type="submit" name="btn_salvar_transacao" value="Salvar" class="botao">Salvar</button>
        </div>
    </form>
</fieldset>