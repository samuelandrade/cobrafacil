<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
echo "<script>bg_menu('m_grupo');</script>\n";

$grupo = new grupo();
if(valida::numero($_GET["id"]) && $_GET["id"] != ''){
    $grupo->carregar($_GET["id"]);
}

if($_GET["exc"] == 1 && valida::numero($_GET["id"]) && $_GET["id"] != ''){
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    
    $sql_sel = "SELECT id FROM cliente WHERE grupo = '".$_GET["id"]."'";
    $res = $db->query($sql_sel, $conexao);
    $clientes = '';
    while($cli = $db->fetch_array($res)){
        if($clientes != ''){
            $clientes .= ", ";
        }
        $clientes .= $cli[0];
    }
    
    $sql_upd = "UPDATE cliente SET grupo = '0' WHERE grupo = '".$_GET["id"]."' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $sql_del = "DELETE FROM grupo WHERE id = '".$_GET["id"]."' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $sql_res = "UPDATE cliente SET grupo = '".$_GET["id"]."' WHERE id IN ($clientes) AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    if($db->query($sql_upd, $conexao)){
        if($db->query($sql_del, $conexao)){
            $erro = 0;
        }else{
            $erro = 2;
            $db->query($sql_res, $conexao);
        }
    }else{
        $erro = 1;
    }
    $db->close($conexao);
    unset($db);
    
    if($erro == 0){
        echo "
        <script>
            alert('Grupo excluído com sucesso!');
            location.href='?pag=grupo';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Falha ao excluir este grupo!\\nErro $erro');
            location.href='?pag=grupo';
        </script>
        ";
    }
}

if($_POST["btn_salvar"] == "Salvar"){
    $grupo->set_id_empresa($_SESSION["cf_id_empresa"]);
    if($grupo->set_nome($_POST["nome"])){
        if(!$grupo->existeGrupo($grupo->get_nome())){
            if($grupo->salvar()){
                echo "
                <script>
                    alert('Grupo salvo com sucesso!');
                    location.href='?pag=grupo';
                </script>
                ";
            }else{
                echo "
                <script>
                    alert('Falha ao salvar o grupo!');
                </script>
                ";
            }
        }else{
            echo "
                <script>
                    alert('Este grupo já existe!');
                </script>
                ";
        }
    }else{
        echo "
            <script>
                alert('Preencha o campo nome corretamente!');
            </script>
            ";
    }
}

function mostraGrupos(){
    $sql = "SELECT * FROM grupo WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $db->close($conexao);
    $c = 0;
    $i = 0;
    while($grupo = $db->fetch_array($result)){
        if($c == 0){
            $zb = "zb1";
            $c = 1;
        }else{
            $zb = "zb2";
            $c = 0;
        }
        
        echo "
        <tr class='$zb'>
            <td><a href='?pag=parcelas&grupo=".$grupo["id"]."' title='Ver parcelas'>".$grupo["nome"]."</a></td>
            <td><a href='?pag=parcelas&grupo=".$grupo["id"]."' title='Ver parcelas'>".clientesGrupos($grupo["id"])."</a></td>
            <td>
                <a href='?pag=grupoSet&id=".$grupo["id"]."' title='Editar este grupo'>E</a> | 
                <a href='?pag=grupo&exc=1&id=".$grupo["id"]."' title='Excluir este grupo' onClick=\"confirm('Tem certeza que deseja excluir o grupo ".$grupo["nome"]."?')\">X</a>
            </td>
        </tr>";
        $i++;
    }
    if($i == 0){
        echo "
        <tr class='zb1'>
            <td colspan='2'>Nenhum resultado</td>
        </tr>";
    }
    unset($db);
}