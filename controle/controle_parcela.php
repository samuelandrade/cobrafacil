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

if($_SESSION["cf_usuario"] == "cliente"){
    $id_cliente = $_SESSION["cf_id"];
    $id_grupo = $_SESSION["cf_grupo"];
}

/*
if($_POST["btn_status"] == "Ok"){
    if(valida::numero($_POST["mostra_status"])){
        $mostra_status = $_POST["mostra_status"];
    }
}
*/
if(valida::numero($_POST["mostra_status"])){
        $mostra_status = $_POST["mostra_status"];
    }
if($mostra_status == ''){
    $mostra_status = 4;
}



/* --------------- GERA PARCELAS ---------------- */
$parcelas = new parcela();
if($_POST["btn_salvar"] == "Salvar"){
    $erro = 0;
    
    if(!$parcelas->set_ch_cg($_POST["sel_cg"])){ $erro = 1; }
    if(!$parcelas->set_id_boleto($_POST["boleto"])){ $erro = 1; }
    if(!$parcelas->set_valor($_POST["valor"])){ $erro = 1; }
    if(!$parcelas->set_multa($_POST["multa"])){ $erro = 1; }
    if(!$parcelas->set_juro($_POST["juro"])){ $erro = 1; }
    if(!$parcelas->set_quantidade($_POST["quantidade"])){ $erro = 1; }
    if(!$parcelas->set_dt_vencimento($_POST["vencimento"])){ $erro = 1; }
    
    if($_POST["sel_cg"] == 1){
        if(!$parcelas->set_id_cliente($_POST["cliente"])){ $erro = 1; }
    }else{
        if(!$parcelas->set_id_grupo($_POST["grupo"])){ $erro = 1; }
    }
    
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
    }else{
        echo "
        <script>
            alert('Preencha todos os campos!');
        </script>";
    }
}

/* --------------- SALVA TRANSAÇÃO ---------------- */
if($_POST["btn_salvar_transacao"] == "Salvar"){
    $transacao->set_id_empresa($_SESSION["cf_id_empresa"]);

    if(!$transacao->set_id_boleto($_POST["boleto"])){ $erro = 1; }
    if(!$transacao->set_valor($_POST["valor"])){ $erro = 1; }
    if(!$transacao->set_multa($_POST["multa"])){ $erro = 1; }
    if(!$transacao->set_juro($_POST["juro"])){ $erro = 1; }
    if(!$transacao->set_valor_pago($_POST["valor_pago"])){ $erro = 1; }
    if(!$transacao->set_dt_vencimento($_POST["vencimento"])){ $erro = 1; }
    if($_POST["pgt_anterior"] != $_POST["valor_pago"]){
        if($_POST["valor_pago"] == 0){
            $transacao->set_dt_pagamento("000-00-00");
        }else{
            if(!$transacao->set_dt_pagamento(date("Y-m-d"))){ $erro = 1; }
        }
    }
    
    $boleto = new boleto();
    $boleto->carregar($transacao->get_id_boleto());
    $nosso_numero = $boleto->get_nosso_numero();
    $transacao->set_nosso_numero($nosso_numero);

    $nosso_numero++;
    $boleto->set_nosso_numero($nosso_numero);
    if(!$boleto->salvar()){
        $erro = 1;
    }
    unset($boleto);
    
    if($erro == 0){
        if($transacao->salvar()){
            echo "
            <script>
                alert('Transação salva com sucesso!');
                location.href = '?pag=parcelas';
            </script>";
        }else{
            echo "
            <script>
                alert('Falha ao salvar a transação!');
            </script>";
        }
    }else{
        echo "
        <script>
            alert('Preencha todos os campos!');
        </script>";
    }
}

function geraParcela($parcelas){
    if($parcelas->get_id_grupo()){
        $sql = "SELECT id FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND grupo = '".$parcelas->get_id_grupo()."'";
        $db = new db(config::$driver);
        $conexao = $db->conecta();
        $result = $db->query($sql, $conexao);
        while($cliente = $db->fetch_array($result)){
            if($parcelas->set_id_cliente($cliente[0])){
                if(!geraParcelaCliente($parcelas)){
                    return 0;
                }
            }
        }

        return 1;
    }else{
        return geraParcelaCliente($parcelas);
    }
}

function geraParcelaCliente($parcelas){
    for($i = 0; $i < $parcelas->get_quantidade();$i++){
        $boleto = new boleto();
        $boleto->carregar($parcelas->get_id_boleto());
        $nosso_numero = $boleto->get_nosso_numero();
        
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
        $transacao->set_nosso_numero($nosso_numero);
        
        $nosso_numero++;
        $boleto->set_nosso_numero($nosso_numero);
        if(!$boleto->salvar()){
            return 0;
        }
        unset($boleto);
        echo "E";
        if(!$transacao->salvar()){
            return 0;
        }
        unset($transacao);
    }
    
    return 1;
}

function mostraTransacao($id = NULL, $ms){
    $sql = "SELECT * FROM transacao WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    if($id){
        $sql .= " AND id_cliente = '$id'";
    }
    
    switch($ms){
        case 1: $sql .= " AND valor_pago >= valor"; break;
        case 2: $sql .= " AND valor_pago < valor AND dt_vencimento > '".date("Y-m-d")."'"; break;
        case 3: $sql .= " AND valor_pago < valor AND dt_vencimento <= '".date("Y-m-d")."'"; break;
        case 4: $sql .= " AND valor_pago < valor"; break;
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
        
        if($_SESSION["cf_usuario"] == "cliente"){
            $botoes = "
                <a href='boleto/?id=".$parcela["id"]."' target='_blank' title='Imprimir o boleto'><button class='botao'>Imp</button></a>";
        }else{
            $botoes = "
                <a href='?pag=transSet&id=".$parcela["id"]."' title='Editar parcela'><button class='botao'>E</button></a>
                <a href='boleto/?id=".$parcela["id"]."' target='_blank' title='Imprimir o boleto'><button class='botao'>Imp</button></a>";
        }
        
        if($parcela["dt_vencimento"] < date("Y-m-d")){
            if($parcela["dt_pagamento"] != "0000-00-00" && $parcela["valor_pago"] >= $parcela["valor"]){
                $status = "Pago";
                $botoes = "";
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
            <td>$botoes</td>
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
        <option value='".$cliente["id"]."'";
        if($id == $cliente["id"]){
            echo " selected";
        }
        echo ">".$cliente["nome"]."</option>";
    }
}

function parcela_mostraGrupo($id){
    $sql = "SELECT id, nome FROM grupo WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";
    if($id){
        $sql .= " AND id = '$id'";
    }
    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    while($grupo = $db->fetch_array($result)){
        echo "
        <option value='".$grupo["id"]."'";
        if($id == $grupo["id"]){
            echo " selected";
        }
        echo ">".$grupo["nome"]."</option>";
    }
}

function parcela_mostraBoleto($id){
    $sql = "SELECT id, titulo FROM boleto WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."'";

    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    while($boleto = $db->fetch_array($result)){
        echo "
        <option value='".$boleto["id"]."'";
        if($id == $boleto["id"]){
            echo " selected";
        }
        echo ">".$boleto["titulo"]."</option>";
    }
}

function parcela_cliente($id){
    $sql = "SELECT nome FROM cliente WHERE id_empresa = '".$_SESSION["cf_id_empresa"]."' AND id = '$id'";

    $db = new db(config::$driver);
    $conexao = $db->conecta();
    $result = $db->query($sql, $conexao);
    $cliente = $db->fetch_array($result);
    return $cliente[0];
}