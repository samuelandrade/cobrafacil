<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_parcela.php";
?>
<h1>Parcelas</h1>
<fieldset>
    <legend>Gerar parcelas</legend>
    <form action="" method="post" class="formulario" onSubmit="return parcelas_valida()">
        <div>
            <label class="campos"><span>*</span> Boleto: </label><br>
            <select name='boleto' id="boleto" onBlur="valida('numero', this, 0, 'Selecione o boleto')">
                <option value=""> -- Selecione o boleto -- </option>
                <?=parcela_mostraBoleto($parcelas->get_id_boleto())?>
            </select>
        </div>
        <div>
            <label class="campos"><span>*</span> Parcelas para: </label>
            <input type="radio" value="1" name="sel_cg" id="sel_cliente" class="lb_bloqueado" onchange="troca_clieGrupo(1)" <?php if($parcelas->get_ch_cg() == 1){ echo "checked";} ?>>
            <label class="campos" for="sel_cliente">Cliente</label>
            <input type="radio" value="2" name="sel_cg" id="sel_grupo" class="lb_bloqueado" onchange="troca_clieGrupo(2)" <?php if($parcelas->get_ch_cg() == 2){ echo "checked";} ?>>
            <label class="campos" for="sel_grupo">Grupo</label>
        </div>
        <div id="grp_cliente" class="grp_div">
            <label class="campos"><span>*</span> Cliente: </label><br>
            <select name='cliente' id="cliente" onBlur="valida('numero', this, 0, 'Selecione o cliente')">
                <option value=""> -- Selecione o cliente -- </option>
                <?=parcela_mostraCliente($grupo, $parcelas->get_id_cliente())?>
            </select>
        </div>
        <div id="grp_grupo" class="grp_div">
            <label class="campos"><span>*</span> Grupo: </label><br>
            <select name='grupo' id="grupo" onBlur="valida('numero', this, 0, 'Selecione o grupo')">
                <option value=""> -- Selecione o grupo -- </option>
                <?=parcela_mostraGrupo($parcelas->get_id_grupo())?>
            </select>
        </div>
        <div>
            <label class="campos"><span>*</span> Valor da parcela: </label><br>
            <input type='text' value='<?=$parcelas->get_valor()?>' name='valor' id='valor' onBlur="valida('float', this, 0, 'Valor inválido')">
        </div>
        <div>
            <label class="campos">Multa por atraso: </label><br>
            <input type='text' value='<?=$parcelas->get_multa()?>' name='multa' id='multa' onBlur="valida('float', this, 1, 'Valor inválido')">
        </div>
        <div>
            <label class="campos">Taxa de juros ao dia (%): </label><br>
            <input type='text' value='<?=$parcelas->get_juro()?>' name='juro' id='juro' onBlur="valida('float', this, 1, 'Valor inválido')">
        </div>
        <div>
            <label class="campos">Quantidade de parcelas: </label><br>
            <input type='number' value='<?=$parcelas->get_quantidade()?>' name='quantidade' id='quantidade' onBlur="valida('numero', this, 1, 'Quantidade inválida')">
        </div>
        <div>
            <label class="campos"><span>*</span> Data de vencimento da primeira parcela: </label><br>
            <input type='text' value='<?=$parcelas->get_dt_vencimento_pt()?>' name='vencimento' id='vencimento' OnKeyPress="formatar(this, '00/00/0000')" maxlength="10" onBlur="valida('data', this, 0, 'Data inválida')">
        </div>
        <div>
            <button type="submit" name="btn_salvar" value="Salvar" class="botao">Salvar</button>
        </div>
    </form>
</fieldset>
<script>
    troca_clieGrupo(<?=$parcelas->get_ch_cg()?>);
</script>