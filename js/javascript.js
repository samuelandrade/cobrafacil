function formatar(src, mask){
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)
    if (texto.substring(0,1) != saida){
        src.value += texto.substring(0,1);
    }
}

function bg_menu(id){
    document.getElementById(id).style.background = "#66e";
    document.getElementById(id).style.color = "#fff";
}

 function add_0(val){
    var p = 0;
    var str = val+'';
    var saida = '';
    
    for(var i = 0; i < str.length; i++){
        if(str.substring(i, i+1) == '.'){
            p = i;
        }
    }
    
    if(p != 0){
        if((p+2) == str.length){
            saida = str+'0';
        }else{
            saida = str;
        }
    }else{
        saida = str+".00";
    }
    
    return saida;
}

function add_p( val ){
    var a = '';
    for(var i = 0; i < val.length; i++){
        if(val.substring(i, i+1) == ','){
            a += '.';
        }else{
            a += val.substring(i, i+1);
        }
    }
    
    return a;
}

function limita_casa( val ){
    var p =0;
    for(i = 0; i < val.length; i++){
        if(val.substring(i, i+1) == '.'){
            p = i;
        }
    }
    if(p > 0){
        return val.substring(0, p+3);
    }else{
        return val;
    }
}

function mostra_clieGrupo( id ){
    var display = document.getElementById("grp_" + id).style.display;
    
    if(display == "block"){
        document.getElementById("grp_" + id).style.display = "none";
    }else{
        document.getElementById("grp_" + id).style.display = "block";
    }
}

function troca_clieGrupo( id ){
    if(id == 1){
        document.getElementById("grp_cliente").style.display = "block";
        document.getElementById("grp_grupo").style.display = "none";
    }else{
        document.getElementById("grp_cliente").style.display = "none";
        document.getElementById("grp_grupo").style.display = "block";
    }
}