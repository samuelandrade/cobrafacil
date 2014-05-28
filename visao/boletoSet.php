<?php
include_once "controle/controle_boleto.php";
?>
        <h1>Novo Boleto</h1>
        <form action="" method="post" class="formulario" onSubmit="return boleto_valida()">
            <fieldset>
                <legend>Dados do boleto</legend>

                <div>
                    <label class="campos"><span>*</span> Título</label><br>
                    <input type="text" name="titulo" id="titulo" value="<?=$boleto->get_titulo()?>" onBlur="valida('titulo', this, 0, 'Título inválido')"><br>
                    <label>Identificação do boleto</label><br>
                    <?php if($erro_msg["titulo"] != ''){ echo "<div class='erro'>".$erro_msg["titulo"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Banco</label><br>
                    <select name="banco" id="banco" onBlur="valida('numero', this, 0, 'Banco inválido')">
                        <option value=''> -- Selecione -- </option>
                        <?=optionBanco($boleto->get_banco())?>
                    </select><br>
                    <label>Selecione o banco</label><br>
                    <?php if($erro_msg["banco"] != ''){ echo "<div class='erro'>".$erro_msg["banco"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Prazo para pagamento</label><br>
                    <input type="text" name="prazo_pagamento" id="prazo_pagamento" value="<?=$boleto->get_prazo_pagamento()?>" onBlur="valida('numero', this, 1, 'Valor inválido')"><br>
                    <label>Dias de prazo para o pagamento do boleto após sua geração</label><br>
                    <?php if($erro_msg["prazo_pagamento"] != ''){ echo "<div class='erro'>".$erro_msg["prazo_pagamento"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Taxa do boleto</label><br>
                    <input type="text" name="taxa_boleto" id="taxa_boleto" value="<?=$boleto->get_taxa_boleto()?>" onBlur="valida('float', this, 1, 'Valor inválido')"><br>
                    <label>Taxa cobrada pelo banco para a geração do boleto</label><br>
                    <?php if($erro_msg["taxa_boleto"] != ''){ echo "<div class='erro'>".$erro_msg["taxa_boleto"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Nosso número (Sem digito)</label><br>
                    <input type="number" name="nosso_numero" id="nosso_numero" value="<?=$boleto->get_nosso_numero()?>" maxlength="17" onBlur="valida('numero', this, 0, 'Valor inválido')"><br>
                    <label>Número atual do boleto (próximo boleto a ser gerado)</label><br>
                    <?php if($erro_msg["nosso_numero"] != ''){ echo "<div class='erro'>".$erro_msg["nosso_numero"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Agência</label><br>
                    <input type="number" name="agencia" id="agencia" value="<?=$boleto->get_agencia()?>" onBlur="valida('numero', this, 0, 'Valor inválido')"><br>
                    <label>Número da agência sem o dígito verificador</label><br>
                    <?php if($erro_msg["agencia"] != ''){ echo "<div class='erro'>".$erro_msg["agencia"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Conta</label><br>
                    <input type="number" name="conta" id="conta" value="<?=$boleto->get_conta()?>" onBlur="valida('numero', this, 0, 'Valor inválido')"><br>
                    <label>Número da conta sem o dígito verificador</label><br>
                    <?php if($erro_msg["conta"] != ''){ echo "<div class='erro'>".$erro_msg["conta"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Dígito verificador</label><br>
                    <input type="number" name="conta_dv" id="conta_dv" value="<?=$boleto->get_conta_dv()?>" onBlur="valida('numero', this, 0, 'Valor inválido')"><br>
                    <label>Dígito verificador da conta</label><br>
                    <?php if($erro_msg["conta_dv"] != ''){ echo "<div class='erro'>".$erro_msg["conta_dv"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Convênio</label><br>
                    <input type="number" name="convenio" id="convenio" value="<?=$boleto->get_convenio()?>" onBlur="valida('numero', this, 1, 'Valor inválido')"><br>
                    <label>Número do convênio, de 6 a 8 dígitos</label>
                    <br>
                    <label>(O preenchimento deste campo é opcional de acordo com os dados fornecidos<br>pela Instituição Bancária)</label><br>
                    <?php if($erro_msg["convenio"] != ''){ echo "<div class='erro'>".$erro_msg["convenio"]."</div>";}?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Informações auxiliares</legend>
                <div>
                    <label class="campos">Instruções 1</label><br>
                    <input type="text" name="instrucoes1" id="instrucoes1" value="<?=$boleto->get_instrucoes1()?>" onBlur="valida('aberto', this, 1, 'Texto inválido')"><br>
                    <?php if($erro_msg["instrucoes1"] != ''){ echo "<div class='erro'>".$erro_msg["instrucoes1"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Instruções 2</label><br>
                    <input type="text" name="instrucoes2" id="instrucoes2" value="<?=$boleto->get_instrucoes2()?>" onBlur="valida('aberto', this, 1, 'Texto inválido')"><br>
                    <?php if($erro_msg["instrucoes2"] != ''){ echo "<div class='erro'>".$erro_msg["instrucoes2"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Instruções 3</label><br>
                    <input type="text" name="instrucoes3" id="instrucoes3" value="<?=$boleto->get_instrucoes3()?>" onBlur="valida('aberto', this, 1, 'Texto inválido')"><br>
                    <?php if($erro_msg["instrucoes3"] != ''){ echo "<div class='erro'>".$erro_msg["instrucoes3"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Instruções 4</label><br>
                    <input type="text" name="instrucoes4" id="instrucoes4" value="<?=$boleto->get_instrucoes4()?>" onBlur="valida('aberto', this, 1, 'Texto inválido')"><br>
                    <?php if($erro_msg["instrucoes4"] != ''){ echo "<div class='erro'>".$erro_msg["instrucoes4"]."</div>";}?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Identificação da empresa</legend>
                
                <div>
                    <label class="campos"><span>*</span> Instituição</label><br>
                    <input type="text" name="identificacao" id="identificacao" value="<?=$boleto->get_identificacao()?>" onBlur="valida('titulo', this, 0, 'Instituição inválida')"><br>
                    <?php if($erro_msg["identificacao"] != ''){ echo "<div class='erro'>".$erro_msg["identificacao"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> CNPJ</label><br>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?=$boleto->get_cpf_cnpj()?>" onBlur="valida('cnpj', this, 0, 'CNPJ inválido')"><br>
                    <?php if($erro_msg["cpf_cnpj"] != ''){ echo "<div class='erro'>".$erro_msg["cpf_cnpj"]."</div>";}?>
                </div>
                
                <div>
                    <label class="campos">Endereço</label><br>
                    <input type="text" name="endereco" id="endereco" value="<?=$boleto->get_endereco()?>" onBlur="valida('endereco', this, 1, 'Edereço inválido')"><br>
                    <?php if($erro_msg["endereco"] != ''){ echo "<div class='erro'>".$erro_msg["endereco"]."</div>";}?>
                </div>
                
                <div>
                    <div id="form_estado"></div><br>
                    <?php if($erro_msg["estado"] != ''){ echo "<div class='erro'>".$erro_msg["estado"]."</div>";}?>
                </div>
                
                <div>
                    <div id="form_cidade"></div><br>
                    <?php if($erro_msg["cidade"] != ''){ echo "<div class='erro'>".$erro_msg["cidade"]."</div>";}?>
                </div>
                
            </fieldset>
            
            <div class="dv_label">
                <button type="hidden" name="btn_salvar" value="Salvar" class="button">Salvar</button>
            </div>
        </form>
        
        <script language="javascript">
            var est = "<?=$boleto->get_uf()?>";
            var cid = "<?=$boleto->get_cidade()?>";
            estado_cidade(est, cid);
        </script>
