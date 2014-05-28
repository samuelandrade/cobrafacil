/*
Variável global com o CSS padrão do campo validado, este valor será devolvido quando o campo for corrigido
var css_default_valida = "background:#FFF;border:1px solid #888;";
*/

function valida_nome(nome, nulo){

    if(nulo != 0 && nome.length == 0){
        return 1;
    }else{
        
        if(nome.length == 0){
            return 0;
        }
        
        var caracteres = ["/", "@","-","_","+","=","!","#","$","%","&","*","?","|",":",";","{","}","[","]"];
        var cnt = 0;
        var erro = 0;
        
        while(caracteres[cnt]){
            if(nome.indexOf(caracteres[cnt]) >= 0){
                erro = 1;
                break;
            }
            cnt++;
        }
        
        if(erro == 1){
            return 0;
        }else{
            cnt = 0;
            var num = 0;
            while(cnt <= nome.length){
                if(nome.charCodeAt(cnt) >= 48 && nome.charCodeAt(cnt) <= 58){ num++; }
                cnt++;
            }
            if(num > 0){
                return 0;
            }else{
                return 1;
            }
        }
    }
}

function valida_nome_num(nome, nulo){

    if(nulo != 0 && nome.length == 0){
        return 1;
    }else{
        
        if(nome.length == 0){
            return 0;
        }
        
        var caracteres = ["/", "@","-","_","+","=","!","#","$","%","&","*","?","|",":",";","{","}","[","]"];
        var cnt = 0;
        var erro = 0;
        
        while(caracteres[cnt]){
            if(nome.indexOf(caracteres[cnt]) >= 0){
                erro = 1;
                break;
            }
            cnt++;
        }
        
        if(erro == 1){
            return 0;
        }else{
            return 1;
        }
    }
}

function valida_titulo(titulo, nulo){

    if(nulo != 0 && titulo.length == 0){
        return 1;
    }else{
        
        if(titulo.length == 0){
            return 0;
        }
        
        var caracteres = ["/", "@","+","=","!","#","$","%","&","*","?","|",":",";","{","}","[","]"];
        var cnt = 0;
        var erro = 0;
        
        while(caracteres[cnt]){
            if(titulo.indexOf(caracteres[cnt]) >= 0){
                erro = 1;
                break;
            }
            cnt++;
        }
        
        if(erro == 1){
            return 0;
        }else{
            return 1;
        }
    }
}

function valida_email(email, nulo){
    
    if(nulo != 0 && email.length == 0){
        return 1;
    }else{
        
        if(email.length == 0){
            return 0;
        }
        
        var caracteres = ["'","\"","\\","\$"," "];
        var cnt = 0;
        var erro = 0;
        
        while(caracteres[cnt]){
            if(email.indexOf(caracteres[cnt]) >= 0){
                erro = 1;
                break;
            }
            cnt++;
        }
        
        var cnt_at = 0
        for(var i = 0; i < email.length; i++){
            if(email.substring(i, i+1) == "@"){
                cnt_at++;
            }
        }
        
        if ((email.length >= 6) && (cnt_at == 1) && (email.substring(0,1) != "@") && (email.substring(email.length -1,email.length) != "@") && (erro == 0)){
            var x = 0;
            while(email.substring(x,x+1) != "@"){
                x++;
            }
            
            var dom = email.substring(x+1,email.length);
            var cnt_dot = 0
            for(var i = 0; i < dom.length; i++){
                if(dom.substring(i, i+1) == "."){
                    cnt_dot++;
                }
            }
            
            if((dom.substring(0,1) != ".") && (dom.substring(dom.length -1, dom.length) != ".") && (cnt_dot > 0)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

function valida_numero(num, nulo){

    if(nulo != 0 && num.length == 0){
        return 1;
    }else{
        
        if(num.length == 0){
            return 0;
        }
        
        cnt = 0;
        erro = 0;
        while(cnt < num.length){
            if(num.charCodeAt(cnt) < 48 || num.charCodeAt(cnt) > 58){
                //if(num.substring(cnt,cnt+1) != ' '){
                    erro++;
                //}
            }
            cnt++;
        }
        if(erro > 0){
            return 0;
        }else{
            return 1;
        }
    }
}

function valida_float(num, nulo){

    if(nulo != 0 && num.length == 0){
        return 1;
    }else{
        
        if(num.length == 0){
            return 0;
        }
        
        var cnt = 0;
        var erro = 0;
        var cnt_dot = 0
        while(cnt < num.length){
            if(num.charCodeAt(cnt) < 48 || num.charCodeAt(cnt) > 58){
                if(num.substring(cnt,cnt+1) == '.'){
                    cnt_dot++;
                }else{
                    erro++;
                }
            }
            cnt++;
        }
        
        if(cnt_dot > 1 || num.substring(0,1) == '.' || num.substring(num.length -1,num.length) == '.'){
            erro = 1;
        }
        
        if(erro > 0){
            return 0;
        }else{
            return 1;
        }
    }
}

function valida_endereco(ende, nulo){

    if(nulo != 0 && ende.length == 0){
        return 1;
    }else{
        
        if(ende.length == 0){
            return 0;
        }
        
        var caracteres = ["/","@","_","+","=","!","#","$","%","&","*","?","|",":",";","{","}","[","]"];
        var cnt = 0;
        var erro = 0;
        
        while(caracteres[cnt]){
            if(ende.indexOf(caracteres[cnt]) >= 0){ erro = 1; }
            cnt++;
        }
        
        if(erro == 0){
            return 1;
        }else{
            return 0;
        }
    }
}

function valida_data(data, nulo){

    if(nulo != 0 && data.length == 0){
        return 1;
    }else{
    
        if(data.length < 10){
            return 0;
        }
        
        if(data.substring(4, 5) == '-' && data.substring(7, 8) == '-'){
            var dia = data.substring(8, 10);
            var mes = data.substring(5, 7);
            var ano = data.substring(0, 4);
        }else if(data.substring(2, 3) == '/' && data.substring(5, 6) == '/'){
            var dia = data.substring(0, 2);
            var mes = data.substring(3, 5);
            var ano = data.substring(6, 10);
        }
        
        if(!valida_numero(dia) || !valida_numero(mes) || !valida_numero(ano)){
            return 0;
        }
        
        if(mes < 1 || mes > 12){
            return 0;
        }

        // Checa se o ano é bissexto
        var tmp = ano;
        if(tmp > 2012){
            while(tmp > 2012) {
                tmp -=4;
            }
        }else if(tmp < 2012){
            while(tmp < 2012) {
                tmp +=4;
            }
        }
        
        if(tmp == 2012){
            var bissexto = 1;
        }else{
            var bissexto = 0;
        }

        if(mes == 2){
            if(bissexto == 1 && dia < 30){
                return 1;
            }else{
                if(bissexto == 0 && dia < 29){
                    return 1;
                }else{
                    return 0;
                }
            }
        }else{
            if(mes == 4 || mes == 6 || mes == 9 || mes == 11){
                if(dia > 30){
                    return 0;
                }else{
                    return 1;
                }
            }else{
                if(dia > 31){
                    return 0;
                }else{
                    return 1;
                }
            }
        }
    }
}

// Função que valida hora (hh:mm:ss)
function valida_hora(hora, nulo){

    if(nulo != 0 && hora.length == 0){
        return 1;
    }else{
        
        if(hora.length == 0){
            return 0;
        }
        
        var h = hora.substring(0, 2);
        var m = hora.substring(3, 5);
        var s = hora.substring(6, 8);

        if(valida_numero(h,0) && valida_numero(m,0) && valida_numero(s,0) && hora.substring(2, 3) == ':' && hora.substring(5, 6) == ':'){
            if((h >= 0 && h < 24) && (m >= 0 && m < 60) && (s >= 0 && s < 60)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

// Função que valida a data e hora
function valida_data_hora(data_hora, nulo){

    if(nulo != 0 && data_hora.length == 0){
        return 1;
    }else{
        
        if(data_hora.length == 0){
            return 0;
        }
        
        var data = data_hora.substring(0, 10);
        var hora = data_hora.substring(11);
        
        if(valida_data(data,0) && valida_hora(hora,0) && data_hora.substring(10, 11) == " "){
            return 1;
        }else{
            return 0;
        }
    }
}

// Função que valida o CPF
function valida_cpf(cpf, nulo) {

    if (nulo != 0 && cpf.length == 0){
        return 1;
    }else{
        
        if(cpf.length == 0){
            return 0;
        }
        
        var Soma;
        var Resto;
        var cnt = 0;
        var tmp = '';
        
        while(cpf.substring(cnt, cnt+1)){
            if(valida_numero(cpf.substring(cnt, cnt+1), 0)){
                tmp = tmp+''+cpf.substring(cnt, cnt+1);
            }
            cnt++;
            char = cpf.substring(cnt, cnt+1);
        }
        cpf = tmp;
        
        Soma = 0;
	    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
            return 0;
        }
        
	    for (i=1; i<=9; i++){
	        Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
	    }
	    Resto = (Soma * 10) % 11;
	
        if ((Resto == 10) || (Resto == 11)){
            Resto = 0;
        }
        
        if (Resto != parseInt(cpf.substring(9, 10)) ){
            return 0;
        }
	
	    Soma = 0;
        for (i = 1; i <= 10; i++){
            Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
        }
        Resto = (Soma * 10) % 11;
	
        if ((Resto == 10) || (Resto == 11)){
            Resto = 0;
        }
        
        if (Resto != parseInt(cpf.substring(10, 11) ) ){
            return 0;
        }
        return 1;
    }
}

function valida_cnpj(cnpj, nulo) {

    if (nulo != 0 && cnpj.length == 0){
        return 1;
    }else{
        
        if(cnpj.length == 0){
            return 0;
        }
        
        if (cnpj.length != 18) return 0;
        var resto;
        var soma1 = (cnpj.substring(0,1) * 5) +
                    (cnpj.substring(1,2) * 4) +
                    (cnpj.substring(3,4) * 3) +
                    (cnpj.substring(4,5) * 2) +
                    (cnpj.substring(5,6) * 9) +
                    (cnpj.substring(7,8) * 8) +
                    (cnpj.substring(8,9) * 7) +
                    (cnpj.substring(9,10) * 6) +
                    (cnpj.substring(11,12) * 5) +
                    (cnpj.substring(12,13) * 4) +
                    (cnpj.substring(13,14) * 3) +
                    (cnpj.substring(14,15) * 2);
                    
        resto = soma1 % 11;
        //var digito1 = resto < 2 ? 0 : 11 - resto;
        var digito1;
        if(resto < 2){
            digito1 = 0;
        }else{
            digito1 = 11 - resto;
        }
        
        var soma2 = (cnpj.substring(0,1) * 6) +
                    (cnpj.substring(1,2) * 5) +
                    (cnpj.substring(3,4) * 4) +
                    (cnpj.substring(4,5) * 3) +
                    (cnpj.substring(5,6) * 2) +
                    (cnpj.substring(7,8) * 9) +
                    (cnpj.substring(8,9) * 8) +
                    (cnpj.substring(9,10) * 7) +
                    (cnpj.substring(11,12) * 6) +
                    (cnpj.substring(12,13) * 5) +
                    (cnpj.substring(13,14) * 4) +
                    (cnpj.substring(14,15) * 3) +
                    (cnpj.substring(16,17) * 2);
                    
        resto = soma2 % 11;
        //$digito2 = $resto < 2 ? 0 : 11 - $resto;
        var digito2;
        if(resto < 2){
            digito2 = 0;
        }else{
            digito2 = 11 - resto;
        }
        
        if(((cnpj.substring(16,17) == digito1) && (cnpj.substring(17,18) == digito2))){
            return 1;
        }else{
            return 0;
        }
    }
}

// verifica se um esta esta de escrito de forma correta
function valida_cep(cep, nulo) {
    
    if (nulo != 0 && cep.length == 0){
        return 1;
    }else{
        
        if(cep.length == 0){
            return 0;
        }
        
        var c5 = cep.substring(0,5);
        var c3 = cep.substring(6,10);
        
        if(valida_numero(c5) && valida_numero(c3) && cep.substring(5,6) == '-' && cep.length == 9){
            return 1;
        }else{
            return 0;
        }
    }
}

// VALIDAR TELEFONE NO SEGUINTE FORMATO: 33333333
function valida_telefone(tel, nulo){
    
    if (nulo != 0 && tel.length == 0){
        return 1;
    }else{
        
        if(tel.length < 8){
            return 0;
        }
        
        for(var i = 0; i < tel.length; i++){
            var char = tel.substring(i, i+1);
            if(char != '(' && char != ')' && char != '-' && char != ' ' && (char.charCodeAt(0) < 48 || char.charCodeAt(0) > 58)){
                return 0;
            }
        }
        
        return 1;
    }
}

function valida_aberto(val, nulo){
    
    if(nulo != 0 && val.length == 0){
        return 1;
    }else{
        
        if(val.length == 0){
            return 0;
        }else{
            return 1;
        }
    }
}

function valida(tipo, elem, nulo, msg){
    var result = 0;
    
    switch(tipo){
        case "nome":      result = valida_nome(elem.value, nulo);      break;
        case "nome_num":  result = valida_nome_num(elem.value, nulo);  break;
        case "titulo":    result = valida_titulo(elem.value, nulo);    break;
        case "email":     result = valida_email(elem.value, nulo);     break;
        case "numero":    result = valida_numero(elem.value, nulo);    break;
        case "float":     result = valida_float(elem.value, nulo);     break;
        case "endereco":  result = valida_endereco(elem.value, nulo);  break;
        case "data":      result = valida_data(elem.value, nulo);      break;
        case "hora":      result = valida_hora(elem.value, nulo);      break;
        case "data_hora": result = valida_data_hora(elem.value, nulo); break;
        case "cpf":       result = valida_cpf(elem.value, nulo);       break;
        case "cnpj":      result = valida_cnpj(elem.value, nulo);      break;
        case "cep":       result = valida_cep(elem.value, nulo);       break;
        case "telefone":  result = valida_telefone(elem.value, nulo);  break;
        case "aberto":    result = valida_aberto(elem.value, nulo);    break;
    }
    
    if(!result){
        if(msg.length > 0){
            alert(msg);
        }
        document.getElementById(elem.id).style = "border:1px solid red; background:#FCC";
    }else{
        document.getElementById(elem.id).style = css_default_valida;
    }
    
    return result;
}
