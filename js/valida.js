var css_default_valida = "background:#FFF;border:1px solid #888;";

function valida_est_cid(id){
    if(document.getElementById(id).value ==''){
        alert("Seleção inválida");
        document.getElementById(id).style = "border:1px solid red; background:#FCC";
        return false;
    }else{
        document.getElementById(id).style = css_default_valida;
        return true;
    }
}

function valida_sexo(){
    if(document.getElementById("sexo_fem").checked == false && document.getElementById("sexo_masc").checked == false){
        document.getElementById("sexo").style = "border:1px solid red; background:#FCC; border-radius:10px";
        return false;
    }else{
        document.getElementById("sexo").style = "border:none;background:none";
        return true;
    }
}

function boleto_valida(){
    var erro = 0;
    
    if(!valida("titulo",   document.getElementById("titulo"),          0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("banco"),           0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("prazo_pagamento"), 1,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("taxa_boleto"),     1,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("nosso_numero"),    0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("agencia"),         0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("conta"),           0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("conta_dv"),        0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("convenio"),        1,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("instrucoes1"),     1,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("instrucoes2"),     1,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("instrucoes3"),     1,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("instrucoes4"),     1,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("identificacao"),   0,'')){ erro = 1; }
    if(!valida("cnpj",     document.getElementById("cpf_cnpj"),        0,'')){ erro = 1; }
    if(!valida("endereco", document.getElementById("endereco"),        1,'')){ erro = 1; }
    if(!valida("nome",     document.getElementById("estado"),          0,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("cidade"),          0,'')){ erro = 1; }
    
    if(erro == 0){
        if(confirm("Tem certeza que deseja salvar estes dados?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha todos os campos corretamente!");
        return false;
    }
}

function parcelas_valida(){
    var erro = 0;
    
    if(!valida("numero", document.getElementById("boleto"),     0,'')){ erro = 1; }
    if(!valida("float",  document.getElementById("valor"),      0,'')){ erro = 1; }
    if(!valida("float",  document.getElementById("multa"),      0,'')){ erro = 1; }
    if(!valida("float",  document.getElementById("juro"),       0,'')){ erro = 1; }
    if(!valida("numero", document.getElementById("quantidade"), 0,'')){ erro = 1; }
    if(!valida("data",   document.getElementById("vencimento"), 0,'')){ erro = 1; }
    
    if(document.getElementById("sel_cliente").checked){
        if(!valida("numero", document.getElementById("cliente"), 0,'')){ erro = 1; }
    }else{
        if(!valida("numero", document.getElementById("grupo"), 0,'')){ erro = 1; }
    }
    
    
    if(erro == 0){
        if(confirm("Tem certeza que deseja salvar estes dados?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha todos os campos corretamente!");
        return false;
    }
}

function grupo_valida(){
    if(valida("titulo", document.getElementById("nome"), 0,'')){
        if(confirm("Tem certeza que deseja salvar este grupo?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha o nome do grupo corretamente!");
        return false;
    }
}

function cliente_valida(){
    var erro = 0;
    
    if(!valida("nome",     document.getElementById("nome"),        0,'')){ erro = 1; }
    if(!valida("cpf",      document.getElementById("cpf"),         0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("rg"),          0,'')){ erro = 1; }
    if(!valida("data",     document.getElementById("dt_nasc"),     1,'')){ erro = 1; }
    if(!valida("endereco", document.getElementById("logadouro"),   1,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("numero"),      1,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("complemento"), 1,'')){ erro = 1; }
    if(!valida("nome",     document.getElementById("estado"),      0,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("cidade"),      0,'')){ erro = 1; }
    if(!valida("cep",      document.getElementById("cep"),         1,'')){ erro = 1; }
    if(!valida("telefone", document.getElementById("telefone"),    0,'')){ erro = 1; }
    if(!valida("email",    document.getElementById("email"),       0,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("senha"),       0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("contrato"),    1,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("grupo"),       1,'')){ erro = 1; }
    if(!valida_sexo()){ erro = 1; }
    
    if(erro == 0){
        if(confirm("Tem certeza que deseja salvar estes dados?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha todos os campos corretamente!");
        return false;
    }
}



























function valida_instituicao(){
    var sel  = document.getElementById("inst_set").value;
    var inst = document.getElementById("instituicao").value;
    
    if(sel == "0" && inst.length == 0){
        alert("Você deve informar sua isntituição");
        document.getElementById("instituicao").style = "border:1px solid red; background:#FCC";
        return false;
    }else{
        document.getElementById("instituicao").style = css_default_valida;
        return true;
    }
}

function valida_senha_2(){
    var s1 = document.getElementById("senha").value;
    var s2 = document.getElementById("senha1").value;
    
    if(s1 != s2){
        alert("Os dois campos de senhas devem ser iguais");
        document.getElementById("senha1").style = "border:1px solid red; background:#FCC";
        return false;
    }else{
        document.getElementById("senha1").style = css_default_valida;
        return true;
    }
}

function valida_cpf_cnpj( elem ){
     var cpf  = valida('cpf', elem, 0, '');
     var cnpj = valida('cnpj', elem, 0, '');
     
     if(!cpf && !cnpj){
         alert("CPF ou CNPJ inválido");
         document.getElementById(elem.id).style = "border:1px solid red; background:#FCC";
     }else{
         document.getElementById(elem.id).style = css_default_valida;
     }
}

function cadastro_valida(){
    var erro = 0;
    
    if(!valida("nome",     document.getElementById("nome"),          0,'')){ erro = 1; }
    if(!valida("data",     document.getElementById("dt_nasc"),       0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("rg"),            0,'')){ erro = 1; }
    if(!valida("cpf",      document.getElementById("cpf"),           0,'')){ erro = 1; }
    if(!valida("nome",     document.getElementById("nacionalidade"), 1,'')){ erro = 1; }
    if(!valida("endereco", document.getElementById("logadouro"),     0,'')){ erro = 1; }
    if(!valida("numero",   document.getElementById("numero"),        1,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("complemento"),   1,'')){ erro = 1; }
    if(!valida("titulo",   document.getElementById("bairro"),        0,'')){ erro = 1; }
    if(!valida("cep",      document.getElementById("cep"),           0,'')){ erro = 1; }
    if(!valida("telefone", document.getElementById("telefone_1"),    0,'')){ erro = 1; }
    if(!valida("telefone", document.getElementById("telefone_2"),    1,'')){ erro = 1; }
    if(!valida("email",    document.getElementById("email_1"),       0,'')){ erro = 1; }
    if(!valida("email",    document.getElementById("email_2"),       1,'')){ erro = 1; }
    if(!valida("aberto",   document.getElementById("senha"),         0,'')){ erro = 1; }
    
    if(!valida_sexo()){ erro = 1; }
    
    if(document.getElementById("estado").value ==''){
        erro = 1;
        document.getElementById("estado").style = "border:1px solid red; background:#FCC";
    }else{
        document.getElementById("estado").style = css_default_valida;
    }
    
    if(document.getElementById("cidade").value ==''){
        erro = 1;
        document.getElementById("cidade").style = "border:1px solid red; background:#FCC";
    }else{
        document.getElementById("cidade").style = css_default_valida;
    }
    
    var s1 = document.getElementById("senha").value;
    var s2 = document.getElementById("senha1").value;
    
    if(s1 != s2){
        erro = 1;
        document.getElementById("senha1").style = "border:1px solid red; background:#FCC";
    }else{
        document.getElementById("senha1").style = css_default_valida;
    }
    
    if(!valida_titulo(document.getElementById("inst_sel").value, 0)){
        erro = 1;
        document.getElementById("inst_sel").style = "border:1px solid red; background:#FCC";
    }else{
        document.getElementById("inst_sel").style = css_default_valida;
        
        var sel  = document.getElementById("inst_set").value;
        var inst = document.getElementById("instituicao").value;

        if(sel == "0" && inst.length == 0){
            erro = 1;
            document.getElementById("instituicao").style = "border:1px solid red; background:#FCC";
        }else{
            document.getElementById("instituicao").style = css_default_valida;
        }
    }
    
    
    if(erro == 0){
        if(confirm("Tem certeza que deseja salvar estes dados?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha todos os campos corretamente!");
        return false;
    }
}

function evento_valida(){
    var erro = 0;
    
    if(!valida("titulo", document.getElementById("titulo"),           0,'')){ erro = 1; }
    //logo
    if(!valida("aberto", document.getElementById("url"),              1,'')){ erro = 1; }
    if(!valida("email",  document.getElementById("email"),            1,'')){ erro = 1; }
    if(!valida("data",   document.getElementById("dt_inicio_evento"), 0,'')){ erro = 1; }
    if(!valida("hora",   document.getElementById("hr_inicio_evento"), 0,'')){ erro = 1; }
    if(!valida("data",   document.getElementById("dt_final_evento"),  0,'')){ erro = 1; }
    if(!valida("hora",   document.getElementById("hr_final_evento"),  0,'')){ erro = 1; }
    if(!valida("data",   document.getElementById("dt_inicio_inscri"), 0,'')){ erro = 1; }
    if(!valida("hora",   document.getElementById("hr_inicio_inscri"), 0,'')){ erro = 1; }
    if(!valida("data",   document.getElementById("dt_final_inscri"),  0,'')){ erro = 1; }
    if(!valida("hora",   document.getElementById("hr_final_inscri"),  0,'')){ erro = 1; }
    if(!valida("numero", document.getElementById("boleto"),           0,'')){ erro = 1; }
    //inst participantes
    //palestras
    //tx palestra
    if(!valida("float",  document.getElementById("tx_inscricao"),     1,'')){ erro = 1; }
    
    
    if(erro == 0){
        if(confirm("Tem certeza que deseja salvar estes dados?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("Preencha todos os campos corretamente!");
        return false;
    }
}
