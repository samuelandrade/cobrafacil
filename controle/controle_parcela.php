<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
echo "<script>bg_menu('m_parcelas');</script>\n";

$transacao = new transacao();
if(valida::numero($_GET["id"]) && $_GET["id"] != ''){
    $transacao->carregar($_GET["id"]);
}

if(valida::numero($_GET["cliente"]) && $_GET["cliente"] != ''){
    $id_cliente = $_GET["cliente"];
}

if(valida::numero($_GET["grupo"]) && $_GET["grupo"] != ''){
    $id_grupo = $_GET["grupo"];
}

$parcelas = new parcela();
if($_POST["btn_salvar"] == "Salvar"){
    $erro = 0;
    
    if(!$parcelas->set_id_boleto($_POST["boleto"])){ $erro = 1; }
    if(!$parcelas->set_id_cliente($_POST["cliente"])){ $erro = 1; }
    if(!$parcelas->set_valor($_POST["valor"])){ $erro = 1; }
    if(!$parcelas->set_multa($_POST["multa"])){ $erro = 1; }
    if(!$parcelas->set_juro($_POST["juro"])){ $erro = 1; }
    if(!$parcelas->set_quantidade($_POST["quantidade"])){ $erro = 1; }
    if(!$parcelas->set_dt_vencimento($_POST["vencimento"])){ $erro = 1; }
    
    if($erro == 0){
        if(geraParcela($parcelas)){
            echo "
            <script>
                alert('Parcelas salvas com sucesso!');
                location.href = '?pag=parcelas';
            </script>";
        }else{
            echo "
            <script>
                alert('Falha ao salvar as parcelas!');
            </script>";
        }
    }
}

function geraParcela($parcelas){
    for($i = 0; $i < $parcelas->get_quantidade();$i++){
        $n = $i * 30;
        $dt_vencimento = soma_data($n, $parcelas->get_dt_vencimento());
        $transacao = new transacao();
        $transacao->set_id_empresa($_SESSION["cf_id_empresa"]);
        
        $transacao->set_id_boleto($parcelas->get_id_boleto());
        $transacao->set_id_cliente($parcelas->get_id_cliente());
        $transacao->set_valor($parcelas->get_valor());
        $transacao->set_multa($parcelas->get_multa());
        $transacao->set_juro($parcelas->get_juro());
        $transacao->set_dt_vencimento($dt_vencimento);
        
        if(!$transacao->salvar()){
            return 0;
        }
    }
    
    return 1;
}

function mostraTransacao($id = NULL){
    $sql = "SELECT * FROM transacao WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    if($id){
        $sql .= " AND id_cliente = '$id'";
    }
    $sql .= " ORDER BY dt_vencimento";
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    
    $c = 0;
    $i = 0;
    while($parcela = $db->fetch_array($result)){
        $sql_cli = "SELECT nome FROM cliente WHERE id = '".$parcela["id_cliente"]."' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
        $res_cli = $db->query($sql_cli, $conexao);
        $cliente = $db->fetch_array($res_cli);
        
        if($c == 0){
            $zb = "zb1";
            $c = 1;
        }else{
            $zb = "zb2";
            $c = 0;
        }
        /*
        $sql = "SELECT nome FROM grupo WHERE id = '".$cliente["grupo"]."'";
        $res_g = $db->query($sql, $conexao);
        $grupo = $db->fetch_array($res_g);
        if($grupo[0] == ''){
            $g = "Nenhum";
        }else{
            $g = $grupo[0];
        }
        */
        if($parcela["dt_vencimento"] < date("Y-m-d")){
            if($parcela["dt_pagamento"] != "0000-00-00" && $parcela["valor_pago"] >= $parcela["valor"]){
                
            }else{
                $multa = $parcela["multa"];
                $juro = $parcela["juro"];
                $total = $parcela["valor"] + $parcela["multa"] - $parcela["valor_pago"];
                $status = "Atrasado";
                $zb .= " erro";

                $atrazo = dias_atrazo($parcela["dt_vencimento"]);
                for($x = 0; $x < $atrazo; $x++){
                    $j = $total / 100 * $juro;
                    $total = add_0($total + limita_casa($j));
                }
            }
        }else{
            $multa = "0";
            $juro = "0";
            $total = $parcela["valor"];
            $status = "Pendente";
        }
        
        echo "
        <tr class='$zb'>
            <td>".$cliente[0]."</td>
            <td>".data_ptbr($parcela["dt_vencimento"])."</td>
            <td>$multa</td>
            <td>$juro%</td>
            <td>".add_0($parcela["valor"])."</td>
            <td>".add_0($total)."</td>
            <td>".data_ptbr($parcela["dt_pagamento"])."</td>
            <td>".add_0($parcela["valor_pago"])."</td>
            <td>$status</td>
            <td>
                <a href='' title='Editar parcela'><button class='botao'>E</button></a>
                <a href='boleto/?id=".$parcela["id"]."' target='_blank' title='Imprimir o boleto'><button class='botao'>Imp</button></a>
            </td>
        </tr>";
        $i++;
    }
    
    if($i == 0){
        echo "
        <tr class='zb1'>
            <td colspan='10'>Nenhum resultado</td>
        </tr>";
    }
    $db->close($conexao);
    unset($db);
}

function parcela_mostraCliente($grupo = NULL, $id = NULL){
    $sql = "SELECT id, nome FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    if($grupo){
        $sql .= " AND grupo = '$grupo'";
    }
    if($id){
        $sql .= " AND id = '$id'";
    }
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    while($cliente = $db->fetch_array($result)){
        echo "
        <option value='".$cliente["id"]."'>".$cliente["nome"]."</option>";
    }
}

function parcela_mostraBoleto($boleto){
    $sql = "SELECT id, titulo FROM boleto WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";

    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    while($boleto = $db->fetch_array($result)){
        echo "
        <option value='".$boleto["id"]."'>".$boleto["titulo"]."</option>";
    }
}