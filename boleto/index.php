<?php
include_once "topo.php";

if(valida::numero($_GET["id"])){
    
    $sql = "select * from transacao where id = '".$_GET["id"]."'";
    $db = new db(config::$driver);
    $con = $db->conecta();
    $res = $db->query($sql, $con);
    $db->close($con);
    $transacao = $db->fetch_array($res);
    
    $boleto->carregar($transacao["id_boleto"]);
    $cliente->carregar($transacao["id_cliente"]);
    
    $data_venc = soma_data($boleto->get_prazo_pagamento());
    if($data_venc > $transacao["dt_vencimento"]){
        $data_venc = data_ptbr($transacao["dt_vencimento"]);
    }else{
        $data_venc = data_ptbr($data_venc);
    }
    
    /*
    $sql_replace = "REPLACE INTO transacao(id, valor_documento, data_vencimento) VALUES('".$ic["id"]."', '".$cargo->get_valor_inscricao()."', '".data_inter($concurso->get_vencimento_boleto())."')";
    $con = $db->conecta();
    $db->query($sql_replace, $con);
    $db->close($con);
    */
    
    switch($boleto->get_banco()){
        case 1: include_once "boleto_bb.php"; break;
        case 2: include_once "boleto_cef.php"; break;
        case 3: include_once "boleto_itau.php"; break;
        default: header("location: ../?pag=men");
    }
}else{
    header("location: ../?pag=men");
}
