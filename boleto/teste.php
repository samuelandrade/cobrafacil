<?php
include_once "topo.php";

if(valida::numero($_GET["id"])){
    $boleto->carregar($_GET["id"]);
    
    $ic["id"] = 99999999;
    $data_venc = data_ptbr(soma_data($boleto->get_prazo_pagamento()));
    $cargo->set_valor_inscricao(1);
    
    $insti->set_nome("KLC Concursos");
    $insti->set_cnpj("11.761.650/0001-76");
    $insti->set_endereco("Praça Monteiro Lobato, 94");
    $insti->set_cidade("Lobato");
    $insti->set_estado("PR");
    
    $inscrito->set_nome($insti->get_nome());
    $inscrito->set_endereco($insti->get_endereco());
    $inscrito->set_cidade($insti->get_cidade());
    $inscrito->set_uf($insti->get_estado());
    $inscrito->set_cep("86790-000");
    
    switch($boleto->get_banco()){
        case 1: include_once "boleto_bb.php"; break;
        case 2: include_once "boleto_cef.php"; break;
        case 3: include_once "boleto_itau.php"; break;
        default: header("location: ../?pag=men");
    }
}else{
    header("location: ../?pag=men");
}
