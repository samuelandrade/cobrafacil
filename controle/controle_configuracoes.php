<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }

$emp_conf = new empresa();
$emp_conf->carregar($_SESSION["cf_id_empresa"]);

if($_POST["btn_salvar"] == "Salvar"){
    $erro = 0;
    $erro_msg = array();
    
    if(!$emp_conf->set_empresa($_POST["empresa"])  ){$erro = 1; $erro_msg[0] = "Nome inválido"; }
    if(!$emp_conf->set_telefone($_POST["telefone"])){$erro = 1; $erro_msg[1] = "Telefone inválido"; }
    if(!$emp_conf->set_email($_POST["email"])      ){$erro = 1; $erro_msg[2] = "E-Mail inválido"; }
    if(!$emp_conf->set_endereco($_POST["endereco"])){$erro = 1; $erro_msg[3] = "Endereço inválido"; }
    if(!$emp_conf->set_cidade($_POST["cidade"])    ){$erro = 1; $erro_msg[4] = "Cidade inválida"; }
    if(!$emp_conf->set_estado($_POST["estado"])    ){$erro = 1; $erro_msg[5] = "Estado inválido"; }
    if(!$emp_conf->set_bairro($_POST["bairro"])    ){$erro = 1; $erro_msg[6] = "Bairro inválido"; }
    if(!$emp_conf->set_cep($_POST["cep"])          ){$erro = 1; $erro_msg[7] = "CEP inválido"; }
    
    if($_FILES["logo"]["name"] != ''){
        if($_FILES["logo"]["error"] == 0 && substr($_FILES["logo"]["type"], 0, 5) == "image"){
            $nome_logo = $emp_conf->get_id().$_FILES["logo"]["name"];
            $n = config::$url_aw."cliente/logo/$nome_logo";
            if(move_uploaded_file($_FILES["logo"]["tmp_name"], "../cliente/logo/$nome_logo")){
                if($emp_conf->set_logo($nome_logo)){
                    $_SESSION["cf_logo"] = $emp_conf->get_logo();
                }else{
                    $erro = 1;
                    $erro_msg[8] = "O nome do arquivo é inválido";
                }
            }else{
                $erro = 1;
                $erro_msg[8] = "Falha ao salvar o arquivo";
            }
        }else{
            $erro = 1;
            $erro_msg[8] = "Tipo de arquivo inválido";
        }
    }
    
    if($erro == 0){
        if($emp_conf->salvar()){
        echo "
            <script>
            alert('Cadastro salvo');
            </script>";
        }else{
            echo "
            <script>
            alert('Falha ao salvar os dados');
            </script>";
        }
    }else{
        echo "
            <script>
            alert('Preencha todos os campos corretamente');
            </script>";
    }
}

function mostraUsuarios(){
    if($_SESSION["cf_master"] == 1){
        $sql = "select * from usuario where id_empresa = '".$_SESSION["cf_id_empresa"]."' order by nome";
    }else{
        $sql = "select * from usuario where id_empresa = '".$_SESSION["cf_id_empresa"]."' and id = '".$_SESSION["cf_id"]."'";
    }
    $db = new db(config::$driver_login);
    $con = $db->conecta();
    $res = $db->query($sql, $con);
    $db->close($con);
    $cont = 0;
    while ($usuario = $db->fetch_array($res)){
        
        if($usuario["bloqueado"] == 1){
            $bloq = "Bloqueado";
        }else{
            $bloq = "Ativo";
        }
        
        if($usuario["master"] == 1){
            $master = "Administrador";
        }else{
            $master = "Simples";
        }
        
        if($cont == 0){
            $cont = 1;
            $class = "zb1";
        }else{
            $cont = 0;
            $class = "zb2";
        }
        
        if($_SESSION["sgm_master"] == 1){
            echo "
        <tr class='$class'>
            <td><a href='?pag=usuarioSet&id=".$usuario["id"]."' title='Editar usuário'>".$usuario["nome"]."</a></td>
            <td><a href='?pag=usuarioSet&id=".$usuario["id"]."' title='Editar usuário'>".$usuario["usuario"]."</a></td>
            <td><a href='?pag=usuarioSet&id=".$usuario["id"]."' title='Editar usuário'>$master</a></td>
            <td><a href='?pag=usuarioSet&id=".$usuario["id"]."' title='Editar usuário'>$bloq</a></td>
            <td><a href='?pag=usrSenha&id=".$usuario["id"]."' title='Alterar Senha'>Senha</a></td>
        </tr>";
        }else{
            echo "
        <tr class='$class'>
            <td>".$usuario["nome"]."</td>
            <td>".$usuario["usuario"]."</td>
            <td>$master</td>
            <td>$bloq</td>
            <td><a href='?pag=usrSenha&id=".$usuario["id"]."' title='Alterar Senha'>Senha</a></td>
        </tr>";
        }
    }
}
