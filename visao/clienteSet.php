<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_cliente.php";
?>
<h1>Cliente</h1>
<fieldset>
    <legend>Novo cliente</legend>
    <form action="" method="post" class="formulario" onSubmit="return cliente_valida()">
        <input type='hidden' value='<?php echo $cliente->get_id(); ?>' name='id'>
        <div>
            <label class="campos">Bloqueado: </label>
            <label for="bloq_sim" class="lb_bloqueado">Sim</label>
            <input type='radio' value='1' name='bloqueado' id='bloq_sim' <?php if($cliente->get_bloqueado() == 1){ echo "checked"; } ?>>
            <label for="bloq_nao" class="lb_bloqueado">Não</label>
            <input type='radio' value='0' name='bloqueado' id='bloq_nao' <?php if($cliente->get_bloqueado() == 0){ echo "checked"; } ?>>
            <?php if($erro_msg[0] != ''){ echo "<div class='erro'>".$erro_msg[0]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> Nome: </label><br>
            <input type='text' value='<?php echo $cliente->get_nome(); ?>' name='nome' id='nome' onBlur="valida('nome', this, 0, 'Nome inválido')">
            <?php if($erro_msg[1] != ''){ echo "<div class='erro'>".$erro_msg[1]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> CPF: </label><br>
            <input type='text' value='<?php echo $cliente->get_cpf(); ?>' name='cpf' id='cpf' OnKeyPress="formatar(this, '000.000.000-00')" maxlength="14" onBlur="valida('cpf', this, 0, 'CPF inválido')">
            <?php if($erro_msg[2] != ''){ echo "<div class='erro'>".$erro_msg[2]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> RG: </label><br>
            <input type='text' value='<?php echo $cliente->get_rg(); ?>' name='rg' id='rg' onBlur="valida('numero', this, 0, 'RG inválido')">
            <?php if($erro_msg[3] != ''){ echo "<div class='erro'>".$erro_msg[3]."</div>";}?>
        </div>
        <div>
            <label class="campos">Data de nascimento: </label><br>
            <input type='text' value='<?php echo $cliente->get_dt_nasc(); ?>' name='dt_nasc' id='dt_nasc' OnKeyPress="formatar(this, '00/00/0000')" maxlength="10" onBlur="valida('data', this, 1, 'Data inválida')">
            <?php if($erro_msg[4] != ''){ echo "<div class='erro'>".$erro_msg[4]."</div>";}?>
        </div>
        <div id="sexo">
            <label class="campos"><span>*</span> Sexo: </label>
            <label for="sexo_masc" class="lb_bloqueado">Masculino</label>
            <input type='radio' value='1' name='sexo' id='sexo_masc' <?php if($cliente->get_sexo() == 1){ echo "checked"; } ?>>
            <label for="sexo_fem" class="lb_bloqueado">Feminino</label>
            <input type='radio' value='2' name='sexo' id='sexo_fem' <?php if($cliente->get_sexo() == 2){ echo "checked"; } ?>>
            <?php if($erro_msg[5] != ''){ echo "<div class='erro'>".$erro_msg[5]."</div>";}?>
        </div>
        <div>
            <label class="campos">Endereço: </label><br>
            <input type='text' value='<?php echo $cliente->get_logadouro(); ?>' name='logadouro' id='logadouro' onBlur="valida('endereco', this, 1, 'Endereço inválido')">
            <?php if($erro_msg[15] != ''){ echo "<div class='erro'>".$erro_msg[15]."</div>";}?>
        </div>
        <div>
            <label class="campos">Número: </label><br>
            <input type='text' value='<?php echo $cliente->get_numero(); ?>' name='numero' id='numero' onBlur="valida('numero', this, 1, 'Número inválido')">
            <?php if($erro_msg[16] != ''){ echo "<div class='erro'>".$erro_msg[16]."</div>";}?>
        </div><div>
            <label class="campos">Complemento: </label><br>
            <input type='text' value='<?php echo $cliente->get_complemento(); ?>' name='complemento' id='complemento' onBlur="valida('titulo', this, 1, 'Complemento inválido')">
            <?php if($erro_msg[17] != ''){ echo "<div class='erro'>".$erro_msg[17]."</div>";}?>
        </div>
        <div>
            <div id="form_estado"></div>
            <?php if($erro_msg[6] != ''){ echo "<div class='erro'>".$erro_msg[6]."</div>";}?>
        </div>
        <div>
            <div id="form_cidade"></div>
            <?php if($erro_msg[7] != ''){ echo "<div class='erro'>".$erro_msg[7]."</div>";}?>
        </div>
        <div>
            <label class="campos">CEP: </label><br>
            <input type='text' value='<?php echo $cliente->get_cep(); ?>' name='cep' id='cep' OnKeyPress="formatar(this, '00000-000')" maxlength="9" onBlur="valida('cep', this, 1, 'CEP inválido')">
            <?php if($erro_msg[8] != ''){ echo "<div class='erro'>".$erro_msg[8]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> Telefone: </label><br>
            <input type='text' value='<?php echo $cliente->get_telefone(); ?>' name='telefone' id='telefone' onBlur="valida('telefone', this, 0, 'Telefone inválido')">
            <?php if($erro_msg[9] != ''){ echo "<div class='erro'>".$erro_msg[9]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> E-Mail: </label><br>
            <input type='text' value='<?php echo $cliente->get_email(); ?>' name='email' id='email' onBlur="valida('email', this, 0, 'E-Mail inválido')">
            <?php if($erro_msg[10] != ''){ echo "<div class='erro'>".$erro_msg[10]."</div>";}?>
        </div>
        <div>
            <label class="campos"><span>*</span> Senha: </label><br>
            <input type='password' value='<?php echo $cliente->get_nome(); ?>' name='senha' id='senha' onBlur="valida('aberto', this, 0, 'Senha inválida')">
            <?php if($erro_msg[11] != ''){ echo "<div class='erro'>".$erro_msg[11]."</div>";}?>
        </div>
        <div>
            <label class="campos">Número do contrato: </label><br>
            <input type='number' value='<?php echo $cliente->get_contrato(); ?>' name='contrato' id='contrato' onBlur="valida('numero', this, 1, 'Contrato inválido')">
            <?php if($erro_msg[12] != ''){ echo "<div class='erro'>".$erro_msg[12]."</div>";}?>
        </div>
        <div>
            <label class="campos">Grupo: </label><br>
            <select name="grupo" id="grupo" onBlur="valida('numero', this, 1, 'Grupo inválido')">
                <option value="0">Nenhum</option>
                <?=cliente_mostraGrupo($cliente->get_grupo())?>
            </select>
            <?php if($erro_msg[13] != ''){ echo "<div class='erro'>".$erro_msg[13]."</div>";}?>
        </div>
        <div>
            <label class="campos">Observações: </label><br>
            <textarea name='observacoes' id='observacoes'><?php echo $cliente->get_observacoes(); ?></textarea>
        </div>
        
        <div>
            <button type="submit" name="btn_salvar" value="Salvar" class="botao">Salvar</button>
        </div>
    </form>
</fieldset>

<script language="javascript">
    var est = "<?=$cliente->get_uf()?>";
    var cid = "<?=$cliente->get_cidade()?>";
    estado_cidade(est, cid);
</script>