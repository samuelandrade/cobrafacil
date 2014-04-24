<?php
if($access_control != "549ugh4gre98h943"){header("location: ?pag=");}
echo "<script>bg_menu('m_boleto');</script>\n";

$boleto = new boleto();
if(valida::numero($_GET["id"])){
    $boleto->carregar($_GET["id"]);
}

if($_POST["btn_salvar"] == "Salvar"){
    $erro = 0;
    
    $boleto->set_id_empresa($_SESSION["cf_id_empresa"]);
    if(!$boleto->set_titulo($_POST["titulo"])){ $erro = 1; }
    if(!$boleto->set_banco($_POST["banco"])){ $erro = 1; }
    if(!$boleto->set_prazo_pagamento($_POST["prazo_pagamento"])){ $erro = 1; }
    if(!$boleto->set_taxa_boleto($_POST["taxa_boleto"])){ $erro = 1; }
    if(!$boleto->set_agencia($_POST["agencia"])){ $erro = 1; }
    if(!$boleto->set_conta($_POST["conta"])){ $erro = 1; }
    if(!$boleto->set_conta_dv($_POST["conta_dv"])){ $erro = 1; }
    if(!$boleto->set_convenio($_POST["convenio"])){ $erro = 1; }
    if(!$boleto->set_instrucoes1($_POST["instrucoes1"])){ $erro = 1; }
    if(!$boleto->set_instrucoes2($_POST["instrucoes2"])){ $erro = 1; }
    if(!$boleto->set_instrucoes3($_POST["instrucoes3"])){ $erro = 1; }
    if(!$boleto->set_instrucoes4($_POST["instrucoes4"])){ $erro = 1; }
    if(!$boleto->set_identificacao($_POST["identificacao"])){ $erro = 1; }
    if(!$boleto->set_cpf_cnpj($_POST["cpf_cnpj"])){ $erro = 1; }
    if(!$boleto->set_endereco($_POST["endereco"])){ $erro = 1; }
    if(!$boleto->set_cidade($_POST["cidade"])){ $erro = 1; }
    if(!$boleto->set_uf($_POST["estado"])){ $erro = 1; }

    if($erro == 0){
        if($boleto->salvar()){
            echo "
            <script>
                alert('Boleto salvo com sucesso');
                location.href = '?pag=boleto';
            </script>";
        }else{
            echo "
            <script>
                alert('Boleto salvo com sucesso');
            </script>";
        }
    }else{
        echo "
            <script>
                alert('Preencha todos os campos corretamente');
            </script>";
    }
}

function banco($b){
    switch($b){
        case 1: return "Banco do Brasil";
        case 2: return "Caixa";
        case 3: return "Itaú";
        default: return NULL;
    }
}

function optionBanco($b){
    $cont = 1;
    while(banco($cont)){
        echo "
        <option value='$cont'";
        if($b == $cont){ echo " selected "; } 
        echo ">".  banco($cont)."</option>";
        $cont++;
    }
}

function mostraBoleto(){
    $sql = "select * from boleto where id_empresa = '".$_SESSION["cf_id_empresa"]."' order by id desc";
    
    $db = new db(config::$driver);
    $con = $db->conecta();
    $res = $db->query($sql, $con);
    $db->close($con);
    $cnt = 0;
    $i_cont = 0;
    while($boleto = $db->fetch_array($res)){
        
        if($cnt == 0){
            $zb = "zb1";
            $cnt = 1;
        }else{
            $zb = "zb2";
            $cnt = 0;
        }
        
        echo "
            <tr class='$zb'>
                <td>".$boleto["titulo"]."</td>
                <td>".banco($boleto["banco"])."</td>
                <td>".$boleto["agencia"]."</td>
                <td>".$boleto["conta"]."</td>
                <td>".$boleto["identificacao"]."</td>
                <td>
                    <a href='?pag=boletoSet&id=".$boleto["id"]."' title='Editar este boleto'><button class='botao'>Editar</button></a>
                    <a href='../boleto/teste.php?id=".$boleto["id"]."' target='_blank' title='Imprimir boleto teste'>Teste</a>
                </td>
            </tr>";
        $i_cont++;
    }
    if ($i_cont == 0){
        echo "
            <tr><td colspan='6' class='zb1'>Nenhum Boleto</td></tr>
            ";
    }
}

function mostraInstituicao($inst){
    $sql = "select * from instituicao order by nome";
    
    $db = new db(config::$driver);
    $con = $db->conecta();
    $res = $db->query($sql, $con);
    $db->close($con);
    $cont = 0;
    while($instituicao = $db->fetch_array($res)){
        echo "
        <option value='".$instituicao["id"]."'";
        if($inst == $instituicao["id"]){ echo " selected"; }
        echo ">".$instituicao["nome"]."</option>";
        $cont++;
    }
}