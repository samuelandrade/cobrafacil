<?php
error_reporting(0);
session_start();
$access_control = "549ugh4gre98h943";
$pag = $_GET["pag"];

include_once "controle/valida.php";
include_once "controle/db.php";
include_once "controle/config.php";
include_once "controle/funcoes.php";
include_once "classe/log.php";
include_once "classe/classe_grupo.php";
include_once "classe/classe_cliente.php";
include_once "classe/classe_transacao.php";
include_once "classe/classe_parcela.php";
include_once "classe/classe_boleto.php";
include_once "classe/classe_empresa.php";

if($_GET["sair"] == 1){
    logout();
}

if($_POST["btn_logar"] == "Logar"){
    if($_POST["tp_usuario"] == "adm"){
        
        if(!login()){
            echo "<script>alert('Falha no login')</script>";
        }else{
            echo "<script>location.href='index.php?pag='</script>";
        }
        
    }else{
        
        if(!cliente_login()){
            echo "<script>alert('Falha no login do cliente')</script>";
        }else{
            echo "<script>location.href='?pag='</script>";
        }
        
    }
}

function login(){
    $login = addslashes($_POST["login"]);
    $senha = addslashes($_POST["senha"]);
    
    $erro = 0;
    if(valida::email($login)){
        $senha = md5($senha);
        $sql = "select * from usuario where usuario = '$login' and senha = '$senha'";
        $db = new db(config::$driver_login);
        $con = $db->conecta();
        $result = $db->query($sql, $con);
        $usuario = $db->fetch_array($result);
	
        if($usuario){
            $sql = "SELECT count(*) FROM empresa_produto WHERE id_empresa = '".$usuario["id_empresa"]."' AND id_produto = '".config::$id_sistema."' AND bloqueado = '0'";
            $result = $db->query($sql, $con);
            $emp_prod = $db->fetch_array($result);
            if($emp_prod[0] > 0){
                if($usuario["bloqueado"] == 0){
                    $_SESSION["cf_id"]         = $usuario["id"];
                    $_SESSION["cf_id_empresa"] = $usuario["id_empresa"];
                    $_SESSION["cf_usuario"]    = $usuario["usuario"];
                    $_SESSION["cf_senha"]      = $usuario["senha"];
                    $_SESSION["cf_nome"]       = $usuario["nome"];
                    $_SESSION["cf_master"]     = $usuario["master"];
                    $_SESSION["cf_bloqueado"]  = $usuario["bloqueado"];
                    $_SESSION["cf_usuario"]    = "administrador";
/*
                    $sql = "select * from empresa where id = '".$usuario["id_empresa"]."'";
                    $db = new db(config::$driver_login);
                    $result = $db->query($sql, $con);
                    $empresa = $db->fetch_array($result);

                    $_SESSION["cf_logo"]    = $empresa["logo"];
                    $_SESSION["cf_empresa"] = $empresa["empresa"];
*/
                    $log = new log($_SESSION["cf_id_empresa"], $_SESSION["cf_usuario"], "login efetuado com sucesso");
                    unset($log);
                }else{
                    echo "
                        <script>alert('Usuário bloqueado!')</script>";

                    $log = new log($usuario["id_empresa"], $usuario["id"], "login bloqueado");
                    unset($log);
                }
            }else{
                $erro = 1;
                echo "
                <script>
                    alert('Empresa bloqueada!');
                </script>
                ";
            }
        }else{
            $erro = 1;
        }
        $db->close($con);
    }else{
        $erro = 1;
        
        $log = new log('', '', "login inexistente <$login>");
        unset($log);
    }

    if($erro == 0){
        //header("location: index.php");
        return 1;
    }else{
        return 0;
    }
}

function cliente_login(){
    $login = addslashes($_POST["login"]);
    $senha = addslashes($_POST["senha"]);
    
    $erro = 0;
    if(valida::email($login)){
        $sql = "select * from cliente where email = '$login' and senha = '$senha'";
        $db = new db(config::$driver);
        $con = $db->conecta();
        $result = $db->query($sql, $con);
        $usuario = $db->fetch_array($result);
	
        if($usuario){
            if($usuario["bloqueado"] == 0){
                $_SESSION["cf_id"]         = $usuario["id"];
                $_SESSION["cf_id_empresa"] = $usuario["id_empresa"];
                $_SESSION["cf_usuario"]    = $usuario["email"];
                $_SESSION["cf_senha"]      = $usuario["senha"];
                $_SESSION["cf_nome"]       = $usuario["nome"];
                $_SESSION["cf_grupo"]      = $usuario["grupo"];
                $_SESSION["cf_bloqueado"]  = $usuario["bloqueado"];
                $_SESSION["cf_usuario"]    = "cliente";

                $sql = "select * from sgm.empresa where id = '".$usuario["id_empresa"]."'";
                $db = new db(config::$driver_login);
                $result = $db->query($sql, $con);
                $empresa = $db->fetch_array($result);

                $_SESSION["cf_logo"]    = $empresa["logo"];
                $_SESSION["cf_empresa"] = $empresa["empresa"];

                $log = new log($_SESSION["cf_id_empresa"], $_SESSION["cf_usuario"], "login de cliente efetuado com sucesso");
                unset($log);
            }else{
                echo "
                    <script>alert('Usuário bloqueado!')</script>";

                $log = new log($usuario["id_empresa"], $usuario["id"], "login de cliente bloqueado");
                unset($log);
            }
        }else{
            $erro = 1;
        }
        $db->close($con);
    }else{
        $erro = 1;
        
        $log = new log('', '', "login de cliente inexistente <$login>");
        unset($log);
    }

    if($erro == 0){
        //header("location: index.php");
        return 1;
    }else{
        return 0;
    }
}

function logado(){
    if($_SESSION["cf_id"]         != NULL && 
       $_SESSION["cf_id_empresa"] != NULL && 
       $_SESSION["cf_usuario"]    != NULL && 
       $_SESSION["cf_senha"]      != NULL && 
       $_SESSION["cf_nome"]       != NULL && 
       /*$_SESSION["cf_master"]     != NULL && */
       $_SESSION["cf_bloqueado"]  != NULL){
        return 1;
    }else{
        return 0;
    }
}

function logout(){
    $log = new log($_SESSION["cf_id_empresa"], $_SESSION["cf_usuario"], "logout efetuado");
    unset($log);

    $_SESSION["cf_id"]         = NULL;
    $_SESSION["cf_id_empresa"] = NULL;
    $_SESSION["cf_usuario"]    = NULL;
    $_SESSION["cf_senha"]      = NULL;
    $_SESSION["cf_nome"]       = NULL;
    $_SESSION["cf_master"]     = NULL;
    $_SESSION["cf_bloqueado"]  = NULL;
    $_SESSION["cf_usuario"]    = NULL;
    $_SESSION["cf_grupo"]      = NULL;
    
    header("location: index.php");
}

function clientesGrupos($id){
    $sql = "SELECT count(*) FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND grupo = '$id'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $clie = $db->fetch_array($result);
    $db->close($conexao);
    return $clie[0];
}

function mostraGruposClientes(){
    $sql = "SELECT * FROM grupo WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    while($grupo = $db->fetch_array($result)){
        $qnt = clientesGrupos($grupo["id"]);

        echo "
        <div class='grp'>
            <a href='javascript:mostra_clieGrupo(".$grupo["id"].")'>".$grupo["nome"]." ($qnt)</a>
        </div>";
        if($qnt > 0){
            echo "
        <div class='grp_tab' id='grp_".$grupo["id"]."'>
            ".mostraCliente($grupo["id"])."
        </div>";
        }
    }
    
    $sql = "SELECT count(*) FROM cliente WHERE grupo = '0' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $result = $db->query($sql, $conexao);
    $grupo = $db->fetch_array($result);
    $qnt = clientesGrupos(0);
    echo "
        <div class='grp'>
            <a href='javascript:mostra_clieGrupo(0)'>Nenhum grupo (".clientesGrupos(0).")</a>
        </div>";
    if($qnt > 0){
        echo "
        <div class='grp_tab' id='grp_0'>
            ".mostraCliente($grupo["id"])."
        </div>";
    }
    
    $db->close($conexao);
}

function mostraCliente($grupo){
    $sql = "SELECT * FROM cliente WHERE grupo = '$grupo' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $c = 0;
    
    $retorno = "
            <table class='tabela'>
                <tr>
                    <th>Nome</th>
                    <th>Número do contrato</th>
                    <th>Data de nascimento</th>
                    <th>Cidade</th>
                </tr>";
    while($cliente = $db->fetch_array($result)){
        if($c == 0){
            $zb = "zb1";
            $c = 1;
        }else{
            $zb = "zb2";
            $c = 0;
        }
        
        $retorno .= "
                <tr class='$zb'>
                    <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["nome"]."</a></td>
                    <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["contrato"]."</a></td>
                    <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".data_ptbr($cliente["dt_nasc"])."</a></td>
                    <td><a href='?pag=parcelas&cliente=".$cliente["id"]."' title='Ver parcelas'>".$cliente["cidade"]." - ".$cliente["uf"]."</a></td>
                </tr>";
    }
    $retorno .= "
            </table>";
    
    $db->close($conexao);
    unset($db);
    
    return $retorno;
}

function nomeCliente($id){
    $sql = "SELECT nome FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND id = '$id'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $cliente = $db->fetch_array($result);
    if($cliente[0] != ''){
        return "<strong>Cliente </strong>".$cliente[0]."<br>";
    }else{
        return NULL;
    }
}

function nomeGrupo($id){
    $sql = "SELECT nome FROM grupo WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND id = '$id'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $grupo = $db->fetch_array($result);
    if($grupo[0] != ''){
        return "<strong>Grupo </strong>".$grupo[0]."<br>";
    }else{
        return NULL;
    }
}

function nomeEmpresa(){
    if($_SESSION["cf_empresa"] != ''){
        echo $_SESSION["cf_empresa"];
    }else{
        echo "Sistema de cobranças - CobraFacil";
    }
}

function ajustaNomeEmpresa(){
    $size = getimagesize("logo/".$_SESSION["cf_logo"]);
    
    if($size[0] > $size[1]){
        $tam = 0 + 220;
    }else{
        $tam = $size[0] + 120;
    }
    
    //return "style='left: ".$tam."px'";
}

function logoEmpresa(){
    //echo "imagens/sgm.png";
    
    if($_SESSION["cf_logo"] != ''){
        return config::$url_aw."cliente/logo/".$_SESSION["cf_logo"];
    }else{
        return "imagens/sgm.png";
    }
    
}

function ajustaLogo(){
    $size = getimagesize(logoEmpresa());
    
    if($size[0] > $size[1]){
        $tam = "width";
        $tx = 200 / $size[0];
        $alt = (100 - ($size[1] * $tx)) / 2;
        $margem = "margin-top: ".$alt."px";
    }else{
        $tam = "height";
        $tx = 100 / $size[0];
        $lar = (200 - ($size[0] * $tx)) / 2;
        $margem = "margin-left: ".$lar."px";
    }
    
    return "style='$tam: 100%; $margem'";
}

function recupera_senha(){
    $erro = 0;
    
    if(valida::cpf($_POST["cpf"])){ $cpf = $_POST["cpf"]; }else{ $erro = 1; }
    if(valida::email($_POST["email"])){ $email = $_POST["email"]; }else{ $erro = 1; }
    
    if($erro == 0){
        $sql = "SELECT * FROM cliente WHERE cpf = '$cpf'";

        $db = new db(config::$driver);
        $con = $db->conecta();
        $result = $db->query($sql, $con);
        $db->close($con);
        $inscricao = $db->fetch_array($result);

        if($email == $inscricao["email_1"] || $email == $inscricao["email_2"]){
            $assunto = "Recuperação de senha - ".$evento->get_titulo();
            $mensagem = "Olá ".$inscricao["nome"].",

Seus dados de acesso ao evento ".$evento->get_titulo()." são:

Login: ".$inscricao["cpf"]."
Senha: ".$inscricao["senha"]."

http://eventos.anguloweb.com.br/?evento=".$evento->get_id();

            if(mailer($email, $assunto, $mensagem, utf8_decode($evento->get_titulo()), "contato@anguloweb.com.br")){
                echo "
                <script>
                    alert('Sua senha foi enviada para seu e-mail');
                    location.href='?evento=".$evento->get_id()."';
                </script>
                ";
                return 0;
            }else{
                echo "<script>alert('Falha ao enviar o e-mail')</script>";
                return 0;
            }
            
        }else{
            $erro = 1;
        }
    }
    
    if($erro == 1){
        echo "<script>alert('Preencha todos os campos corretamente')</script>";
        return 0;
    }
    
}