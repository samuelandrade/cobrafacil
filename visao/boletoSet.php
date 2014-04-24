<?php
include_once "controle/controle_boleto.php";
?>
        <h1>Novo Boleto</h1>
        <form action="" method="post" class="formulario">
            <fieldset>
                <legend>Dados do boleto</legend>

                <div>
                    <label class="campos"><span>*</span> Título</label><br>
                    <input type="text" name="titulo" value="<?=$boleto->get_titulo()?>"><br>
                    <label>Identificação do boleto</label>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Banco</label><br>
                    <select name="banco">
                        <option value='0'> -- Selecione -- </option>
                        <?=optionBanco($boleto->get_banco())?>
                    </select><br>
                    <label>Selecione o banco</label>
                </div>
                
                <div>
                    <label class="campos">Prazo para pagamento</label><br>
                    <input type="text" name="prazo_pagamento" value="<?=$boleto->get_prazo_pagamento()?>"><br>
                    <label>Dias de prazo para o pagamento do boleto após sua geração</label>
                </div>
                
                <div>
                    <label class="campos">Taxa do boleto</label><br>
                    <input type="text" name="taxa_boleto" value="<?=$boleto->get_taxa_boleto()?>"><br>
                    <label>Taxa cobrada pelo banco para a geração do boleto</label>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Agência</label><br>
                    <input type="text" name="agencia" value="<?=$boleto->get_agencia()?>"><br>
                    <label>Número da agência sem o dígito verificador</label>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Conta</label><br>
                    <input type="text" name="conta" value="<?=$boleto->get_conta()?>"><br>
                    <label>Número da conta sem o dígito verificador</label>
                </div>
                
                <div>
                    <label class="campos"><span>*</span> Dígito verificador</label><br>
                    <input type="text" name="conta_dv" value="<?=$boleto->get_conta_dv()?>"><br>
                    <label>Dígito verificador da conta</label>
                </div>
                
                <div>
                    <label class="campos">Convênio</label><br>
                    <input type="text" name="convenio" value="<?=$boleto->get_convenio()?>"><br>
                    <label>Número do convênio, de 6 a 8 dígitos</label>
                    <br>
                    <label>(O preenchimento deste campo é opcional de acordo com os dados fornecidos<br>pela Instituição Bancária)</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Informações auxiliares</legend>
                <div>
                    <label class="campos">Instruções 1</label><br>
                    <input type="text" name="instrucoes1" value="<?=$boleto->get_instrucoes1()?>">
                </div>
                
                <div>
                    <label class="campos">Instruções 2</label><br>
                    <input type="text" name="instrucoes2" value="<?=$boleto->get_instrucoes2()?>">
                </div>
                
                <div>
                    <label class="campos">Instruções 3</label><br>
                    <input type="text" name="instrucoes3" value="<?=$boleto->get_instrucoes3()?>">
                </div>
                
                <div>
                    <label class="campos">Instruções 4</label><br>
                    <input type="text" name="instrucoes4" value="<?=$boleto->get_instrucoes4()?>">
                </div>
            </fieldset>
            <fieldset>
                <legend>Identificação da empresa</legend>
                
                <div>
                    <label class="campos">Instituição</label><br>
                    <input type="text" name="identificacao" value="<?=$boleto->get_identificacao()?>">
                </div>
                
                <div>
                    <label class="campos">CPF ou CNPJ</label><br>
                    <input type="text" name="cpf_cnpj" value="<?=$boleto->get_cpf_cnpj()?>">
                </div>
                
                <div>
                    <label class="campos">Endereço</label><br>
                    <input type="text" name="endereco" value="<?=$boleto->get_endereco()?>">
                </div>
                
                <div>
                    <div id="form_estado"></div>
                </div>
                
                <div>
                    <div id="form_cidade"></div>
                </div>
                
            </fieldset>
            
            <div class="dv_label">
                <input type="hidden" name="btn_salvar" value="Salvar">
                <button class="button">Salvar</button>
            </div>
        </form>
        
        <script language="javascript">
            var est = "<?=$boleto->get_uf()?>";
            var cid = "<?=$boleto->get_cidade()?>";
            estado_cidade(est, cid);
        </script>
