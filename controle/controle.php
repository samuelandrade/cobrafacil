<?php
error_reporting(1);
session_start();
$access_control = "549ugh4gre98h943";
$pag = $_GET["pag"];
include_once "controle/valida.php";
include_once "controle/db.php";
include_once "classe/log.php";
include_once "classe/classe_grupo.php";
include_once "classe/classe_cliente.php";
include_once "classe/classe_transacao.php";
include_once "classe/classe_parcela.php";

class config{
    //               sgbd;servidor;banco;usuario;senha
    static $driver = "mysql;localhost;cobraFacil;root;mandriva;";
    static $driver_login = "mysql;localhost;sgm;root;mandriva;";
    static $url_aw = "http://localhost/";
    static $id_sistema = "4";
}

if($_GET["sair"] == 1){
    logout();
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

function logado(){
    if($_SESSION["cf_id"]         != NULL && 
       $_SESSION["cf_id_empresa"] != NULL && 
       $_SESSION["cf_usuario"]    != NULL && 
       $_SESSION["cf_senha"]      != NULL && 
       $_SESSION["cf_nome"]       != NULL && 
       $_SESSION["cf_master"]     != NULL && 
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

function soma_data($n, $data = null) {
    if($data){
        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, 2);
        $dia = substr($data, 8, 2);
    }else{
        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");
    }
    
    if($n > 0){
        $tmp = $ano;
        if($tmp > 2012){
                while($tmp > 2012) {
                        $tmp -=4;
                }
        }elseif($tmp < 2012){
                while($tmp < 2012) {
                        $tmp +=4;
                }
        }
        if($tmp == 2012){
                $bissexto = 1;
        }else {
                $bissexto = 0;
        }

        for($x = 0; $x < $n; $x++) {
                $dia++;
                if($mes == 2){
                        if($bissexto == 1){
                                if($dia == 30){ $dia = 1; $mes = 3; }
                        }else {
                                if($dia == 29){ $dia = 1; $mes = "3"; }
                        }
                }elseif($mes == "04" || $mes == "06" || $mes == "09" || $mes == "11") {
                        if($dia == 31){ $dia = 1; $mes++; }
                }else {
                        if($dia == 32){ $dia = 1; $mes++; }
                        if($mes == 13){ $mes = 1; $ano++; }
                }
        }

        if($dia < 10 && strlen($dia) < 2){
                $dia = "0".$dia;
        }

        if($mes < 10 && strlen($mes) < 2){
                $mes = "0".$mes;
        }
    }
    return $ano."-".$mes."-".$dia;
}

//Conveerte data para o formato SQL
function data_sql($data){
    $dia = substr($data, 0, 2);
    $mes = substr($data, 3, 2);
    $ano = substr($data, 6, 4);
    
    if(strlen($data) == 10){
        return $ano."-".$mes."-".$dia;
    }else{
        return NULL;
    }
}

function dias_atrazo($data){
    $ano = substr($data, 0, 4);
    $mes = substr($data, 5, 2);
    $dia = substr($data, 8, 2);
    $a = (date("Y") - $ano) * 12;
    $m = ((date("m") + $a) - $mes) * 30;
    $d = (date("d") + $m) - $dia;
    
    return $d;
}

//converte data para o formato brasileiro
function data_ptbr($data){
    $ano = substr($data, 0, 4);
    $mes = substr($data, 5, 2);
    $dia = substr($data, 8, 2);
    $hora = substr($data, 10);
    
    if(strlen($data) >= 10){
        if(strlen($hora) > 0){
            $ret = $dia."/".$mes."/".$ano." ".$hora;
        }else{
            $ret = $dia."/".$mes."/".$ano;
        }
    }else{
        $ret = NULL;
    }
    
    return $ret;
}

function nomeCliente($id){
    $sql = "SELECT nome FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND id = '$id'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $cliente = $db->fetch_array($result);
    if($cliente[0] != ''){
        return "<strong>Cliente </strong>".$cliente[0];
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
        return "<strong>Grupo </strong>".$grupo[0];
    }else{
        return NULL;
    }
}

function add_0($val){
    $p = 0;
    if($val == ''){ $val = 0; }
    
    for($i = 0; $i < strlen($val); $i++){
        if(substr($val, $i, 1) == '.'){
            $p = $i;
        }
    }
    
    if($p != 0){
        if($p+2 == strlen($val)){
            $r = $val.'0';
        }else{
            $r = $val;
        }
    }else{
        $r = $val.".00";
    }
    return $r;
}

function limita_casa( $val ){
    /*
    $p = 0;
    for($i = 0; $i < strlen($val); $i++){
        if(substr($val, $i, 1) == '.'){
            $p = $i;
        }
    }
    if($p > 0){
        return substr($val, 0, $p+3);
    }else{
        return $val;
    }
    */
    
    $p = explode('.', $val);
    $result = $p[0].'.'.substr($p[1], 0, 2);
    return $result;
}
