<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_parcela.php";
?>
<h1>Parcelas</h1>
<fieldset>
    <legend>Gerar parcelas</legend>
    <form action="" method="post" class="formulario">
        <div>
            <label class="campos">Cliente: </label><br>
            <select name='cliente'>
                <option value=""> -- Selecione o cliente -- </option>
                <?=parcela_mostraCliente($grupo, $parcelas->get_id_cliente())?>
            </select>
        </div>
        <div>
            <label class="campos">Valor da parcela: </label><br>
            <input type='text' value='<?=$parcelas->get_valor()?>' name='valor' id='valor'>
        </div>
        <div>
            <label class="campos">Multa por atrazo: </label><br>
            <input type='text' value='<?=$parcelas->get_multa()?>' name='multa' id='multa'>
        </div>
        <div>
            <label class="campos">Taxa de juros ao dia (%): </label><br>
            <input type='text' value='<?=$parcelas->get_juro()?>' name='juro' id='juro'>
        </div>
        <div>
            <label class="campos">Quantidade de parcelas: </label><br>
            <input type='number' value='<?=$parcelas->get_quantidade()?>' name='quantidade' id='quantidade'>
        </div>
        <div>
            <label class="campos">Data de vencimento da primeira parcela: </label><br>
            <input type='text' value='<?=$parcelas->get_dt_vencimento()?>' name='vencimento' id='vencimento' OnKeyPress="formatar(this, '00/00/0000')" maxlength="10">
        </div>
        <div>
            <button type="submit" name="btn_salvar" value="Salvar" class="botao">Salvar</button>
        </div>
    </form>
</fieldset>