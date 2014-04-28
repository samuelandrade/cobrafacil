<?php
include_once "topo.php";

if(valida::numero($_GET["id"])){
    $boleto->carregar($_GET["id"]);
    
    $ic["id"] = 99999999;
    $data_venc = data_ptbr(soma_data($boleto->get_prazo_pagamento()));
    $transacao["valor"] = 1;
    
    $cliente->set_nome("Teste");
    $cliente->set_logadouro("Rua");
    $cliente->set_numero(0);
    $cliente->set_complemento();
    $cliente->set_cidade("Ângulo");
    $cliente->set_uf("PR");
    $cliente->set_cep("86790-000");
    
    switch($boleto->get_banco()){
        case 1: include_once "boleto_bb.php"; break;
        case 2: include_once "boleto_cef.php"; break;
        case 3: include_once "boleto_itau.php"; break;
        default: header("location: ../?pag=men");
    }
}else{
    header("location: ../?pag=men");
}
