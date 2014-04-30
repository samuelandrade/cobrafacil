<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_configuracoes.php";

/*
if($_SESSION["cf_master"] == 1){
    echo "
                    <a href='".config::$url_aw."cliente/' target='_blank' title='Clique aqui para consultar as mensalidades do CobraFacil'><button class='botao'>Boletos de Mensalidades CobraFacil</button></a>
                    <br><br>";
}
*/
?>

                    <fieldset>
                        <legend>Unuários</legend>
                        <?php if($_SESSION["sgm_master"] == 1){?>
                        <a href='?pag=usuarioSet' title='Novo Usuário'><button class='botao'>Novo</button></a>
                        <?php } ?>
                        <table class="tabela">
                            <tr>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th> </th>
                            </tr>
                            <?=mostraUsuarios()?>
                        </table>
                    </fieldset>
                    <?php if($_SESSION["cf_master"] == 1){?>
                    <fieldset>
                        <legend>Dados da empresa</legend>
                        <form action="" method="post" enctype="multipart/form-data" class="formulario">
                            <div>
                                <label>CNPJ</label><br>
                                <strong><?=$emp_conf->get_cnpj()?></strong>
                            </div>
                            <div>
                                <label>Empresa</label><br>
                                <input type="text" name="empresa" value="<?=$emp_conf->get_empresa()?>">
                                <?php if($erro_msg[0]){ echo "<br><label class='erro_msg'>".$erro_msg[0]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <label>Logo</label><br>
                                <?php if($emp_conf->get_logo()){ ?>
                                <img src="<?=config::$url_aw?>cliente/logo/<?=$emp_conf->get_logo()?>" alt="Logo de <?=$emp_conf->get_empresa()?>">
                                <br>
                                <?php } ?>
                                <input type="file" name="logo" value="">
                                <?php if($erro_msg[8]){ echo "<br><label class='erro_msg'>".$erro_msg[8]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <label>Telefone</label><br>
                                <input type="text" name="telefone" value="<?=$emp_conf->get_telefone()?>">
                                <?php if($erro_msg[1]){ echo "<br><label class='erro_msg'>".$erro_msg[1]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <label>E-Mail</label><br>
                                <input type="email" name="email" value="<?=$emp_conf->get_email()?>">
                                <?php if($erro_msg[2]){ echo "<br><label class='erro_msg'>".$erro_msg[2]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <label>Endereço</label><br>
                                <input type="text" name="endereco" value="<?=$emp_conf->get_endereco()?>">
                                <?php if($erro_msg[3]){ echo "<br><label class='erro_msg'>".$erro_msg[3]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <label>Bairro</label><br>
                                <input type="text" name="bairro" value="<?=$emp_conf->get_bairro()?>">
                                <?php if($erro_msg[6]){ echo "<br><label class='erro_msg'>".$erro_msg[6]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <div id="form_estado" class="no_span"></div>
                            </div>
                            
                            <div>
                                <div id="form_cidade" class="no_span"></div>
                            </div>
                            
                            <div>
                                <label>CEP</label><br>
                                <input type="text" name="cep" value="<?=$emp_conf->get_cep()?>">
                                <?php if($erro_msg[7]){ echo "<br><label class='erro_msg'>".$erro_msg[7]."</label>"; } ?>
                            </div>
                            
                            <div>
                                <button type="submit" name="btn_salvar" value="Salvar" class="botao">Salvar</button>
                            </div>
                        </form>
                    </fieldset>

                    <script language="javascript">
                        var est = "<?=$emp_conf->get_estado()?>";
                        var cid = "<?=$emp_conf->get_cidade()?>";
                        estado_cidade(est, cid);
                    </script>
                    <?php } ?>
