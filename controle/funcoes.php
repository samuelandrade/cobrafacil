<?php

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
