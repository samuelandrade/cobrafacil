<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
echo "<script>bg_menu('m_cliente');</script>\n";

$cliente = new cliente();
if(valida::numero($_GET["id"]) && $_GET["id"] != ''){
    $cliente->carregar($_GET["id"]);
}

if($_POST["btn_salvar"] == "Salvar"){
    $erro = 0;
    $erro_msg = array();
    $cliente->set_id_empresa($_SESSION["cf_id_empresa"]);
    if(!$cliente->set_bloqueado(  $_POST["bloqueado"]  )){ $erro = 1; $erro_msg[0] = "Escolha o status";}
    if(!$cliente->set_nome(       $_POST["nome"]       )){ $erro = 1; $erro_msg[1] = "Nome inválido";}
    if(!$cliente->set_cpf(        $_POST["cpf"]        )){ $erro = 1; $erro_msg[2] = "CPF inválido";}
    if(!$cliente->set_rg(         $_POST["rg"]         )){ $erro = 1; $erro_msg[3] = "RG inválido";}
    if(!$cliente->set_dt_nasc(    $_POST["dt_nasc"]    )){ $erro = 1; $erro_msg[4] = "Data de nascimento inválida";}
    if(!$cliente->set_sexo(       $_POST["sexo"]       )){ $erro = 1; $erro_msg[5] = "Escolha o sexo";}
    if(!$cliente->set_uf(         $_POST["estado"]     )){ $erro = 1; $erro_msg[6] = "Escolha o estado";}
    if(!$cliente->set_cidade(     $_POST["cidade"]     )){ $erro = 1; $erro_msg[7] = "Escolha a cidade";}
    if(!$cliente->set_cep(        $_POST["cep"]        )){ $erro = 1; $erro_msg[8] = "CEP inválido";}
    if(!$cliente->set_telefone(   $_POST["telefone"]   )){ $erro = 1; $erro_msg[9] = "Telefone inválido";}
    if(!$cliente->set_email(      $_POST["email"]      )){ $erro = 1; $erro_msg[10] = "E-Mail inválido";}
    if(!$cliente->set_senha(      $_POST["senha"]      )){ $erro = 1; $erro_msg[11] = "Senha inválida";}
    if(!$cliente->set_contrato(   $_POST["contrato"]   )){ $erro = 1; $erro_msg[12] = "Número de contrato inválido";}
    if(!$cliente->set_grupo(      $_POST["grupo"]      )){ $erro = 1; $erro_msg[13] = "Escolha o grupo";}
    if(!$cliente->set_observacoes($_POST["observacoes"])){ $erro = 1; $erro_msg[14] = "";}
    if(!$cliente->set_logadouro(  $_POST["logadouro"]  )){ $erro = 1; $erro_msg[15] = "";}
    if(!$cliente->set_numero(     $_POST["numero"]     )){ $erro = 1; $erro_msg[16] = "";}
    if(!$cliente->set_complemento($_POST["complemento"])){ $erro = 1; $erro_msg[17] = "";}
    
    if($cliente->checa_cpf($_POST["cpf"])){ $erro = 1; $erro_msg[2] = "CPF já existente"; }
    if($cliente->checa_email($_POST["email"])){ $erro = 1; $erro_msg[10] = "E-Mail já existente"; }
    
    if($erro == 0){
        if($cliente->salvar()){
            echo "
            <script>
                alert('Cliente salvo com sucesso!');
                location.href='?pag=cliente';
            </script>";
        }else{
            echo "
            <script>
                alert('Falha ao salvar o cliente!');
            </script>";
        }
    }else{
        echo "
        <script>
            alert('Preencha todos os campos corretamente!');
        </script>";
    }
}

function cliente_mostraGrupo($id){
    $sql = "SELECT * FROM grupo WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $db->close($conexao);
    while ($grupo = $db->fetch_array($result)){
        echo "
        <option value='".$grupo["id"]."'";
        if($id == $grupo["id"]){ echo " selected"; }
        echo ">".$grupo["nome"]."</option>";
    }
}

function cliente_mostraCliente(){
    $sql = "SELECT * FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $c = 0;
    $i = 0;
    while($cliente = $db->fetch_array($result)){
        if($c == 0){
            $zb = "zb1";
            $c = 1;
        }else{
            $zb = "zb2";
            $c = 0;
        }
        
        $sql = "SELECT nome FROM grupo WHERE id = '".$cliente["grupo"]."'";
        $res_g = $db->query($sql, $conexao);
        $grupo = $db->fetch_array($res_g);
        if($grupo[0] == ''){
            $g = "Nenhum";
        }else{
            $g = $grupo[0];
        }
        
        echo "
        <tr class='$zb'>
            <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["nome"]."</a></td>
            <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["contrato"]."</a></td>
            <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".data_ptbr($cliente["dt_nasc"])."</a></td>
            <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["cidade"]." - ".$cliente["uf"]."</a></td>
            <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>$g</a></td>
            <td>
                <a href='?pag=clienteSet&id=".$cliente["id"]."' title='Editar este cliente'>E</a>
            </td>
        </tr>";
        $i++;
    }
    
    if($i == 0){
        echo "
        <tr class='zb1'>
            <td colspan='6'>Nenhum resultado</td>
        </tr>";
    }
    
    $db->close($conexao);
    unset($db);
}