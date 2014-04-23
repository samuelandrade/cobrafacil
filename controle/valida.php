<?php
class valida{
	static function nome($nome){
		$nome = addslashes($nome);
		if(strstr($nome,"/") || strstr($nome,"@") || strstr($nome,"-") || strstr($nome,"_") || strstr($nome,"+") || strstr($nome,"=") || strstr($nome,"!") || strstr($nome,"#") || strstr($nome,"$") || strstr($nome,"%") || strstr($nome,"&") || strstr($nome,"*") || strstr($nome,"?") || strstr($nome,"|") || strstr($nome,":") || strstr($nome,";") || strstr($nome,"{") || strstr($nome,"}") || strstr($nome,"[") || strstr($nome,"]")){
			return 0;
		}else{
			$cnt = 0;
			$num = 0;
			while($cnt <= strlen($nome)){
				if(ord(substr($nome,$cnt,1)) >= 48 && ord(substr($nome,$cnt,1)) <= 58){ $num++; }
				$cnt++;
			}
			if($num > 0){
				return 0;
			}else{
				return 1;
			}
		}
	}
	
	static function nome_num($nome){
		$nome = addslashes($nome);
		if(strstr($nome,"/") || strstr($nome,"@") || strstr($nome,"-") || strstr($nome,"_") || strstr($nome,"+") || strstr($nome,"=") || strstr($nome,"!") || strstr($nome,"#") || strstr($nome,"$") || strstr($nome,"%") || strstr($nome,"&") || strstr($nome,"*") || strstr($nome,"?") || strstr($nome,"|") || strstr($nome,":") || strstr($nome,";") || strstr($nome,"{") || strstr($nome,"}") || strstr($nome,"[") || strstr($nome,"]")){
			return 0;
		}else{
			return 1;
		}
	}
	
	static function email($email){
		$email = addslashes($email);
		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@") && (!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))){
			$x = 0;
			while(substr($email,$x,1) != "@"){
				$x++;
			}
			$dom = substr($email,$x+1,strlen($email));
			if((substr($dom,0,1) != ".") && (substr($email,strlen($email)-1,1) != ".") && (substr_count($email,".") > 0)){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	static function numero($num){
		$cnt = 0;
		$erro = 0;
		while($cnt < strlen($num)){
			if(ord(substr($num,$cnt,1)) < 48 || ord(substr($num,$cnt,1)) > 58){
				if(substr($num,$cnt,1) != ' '){
					$erro++;
				}
			}
			$cnt++;
		}
		if($erro > 0){
			return 0;
		}else{
			return 1;
		}
	}
	
	static function float($num){
		$cnt = 0;
		$erro = 0;
                
                if(substr($num,$cnt,1) == '-'){
                    $cnt++;
                }
		while($cnt < strlen($num)){
			if(ord(substr($num,$cnt,1)) < 48 || ord(substr($num,$cnt,1)) > 58){
				if(substr($num,$cnt,1) != ' ' && substr($num,$cnt,1) != '.' && substr($num,$cnt,1) != ','){
					$erro++;
				}
			}
			$cnt++;
		}
		if($erro > 0){
			return 0;
		}else{
			return 1;
		}
	}
	
	static function endereco($nome){
			$nome = addslashes($nome);
			if(strstr($nome,"/") || strstr($nome,"@") || strstr($nome,"_") || strstr($nome,"+") || strstr($nome,"=") || strstr($nome,"!") || strstr($nome,"#") || strstr($nome,"$") || strstr($nome,"%") || strstr($nome,"&") || strstr($nome,"*") || strstr($nome,"?") || strstr($nome,"|") || strstr($nome,":") || strstr($nome,";") || strstr($nome,"{") || strstr($nome,"}") || strstr($nome,"[") || strstr($nome,"]")){
				return 0;
			}else{
				return 1;
			}
	}

	static function data($dia, $mes, $ano){
                if(substr($dia, 4, 1) == '-' && substr($dia, 7, 1) == '-'){
                    $data = $dia;
                    $dia = substr($data, 0, 2);
                    $mes = substr($data, 3, 2);
                    $ano = substr($data, 6, 4);
                }
                
		// Checa se o ano é bissexto
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
		
		if($mes == 2){
			if($bissexto && $dia < 30){
				return 1;
			}else{
				if(!$bissexto && $dia < 29){
					return 1;
				}else{
					return 0;
				}
			}
		}else{
			if($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11){
				if($dia > 30){
					return 0;
				}else{
					return 1;
				}
			}else{
				if($dia > 31){
					return 0;
				}else{
					return 1;
				}
			}
		}
	}
	
        // Função que valida hora (hh:mm:ss)
        static function hora($hora){
            if($hora == ''){
                return 1;
            }
            
            $h = substr($hora, 0, 2);
            $m = substr($hora, 3, 2);
            $s = substr($hora, 6, 2);
            
            if(valida::numero($h) && valida::numero($m) && valida::numero($s) && 
            substr($hora, 2, 1) == ':' && substr($hora, 5, 1) == ':'){
                return 1;
            }else{
                return 0;
            }
        }
        
        // Função que valida o data e hora
        static function data_hora($data_hora){
            $data = substr($data_hora, 0, 10);
            $hora = substr($data_hora, 11);
            if(valida::data($data) && valida::hora($hora) && substr($data_hora, 10, 1) == " "){
                return 1;
            }else{
                return 0;
            }
        }
        
	// Função que valida o CPF
	static function cpf($cpf){	
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'){
			return false;
		}else{
			// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
			
				$d = ((10 * $d) % 11) % 10;
			
				if ($cpf{$c} != $d) {
					return false;
				}
			}
		
			return true;
		}
	}
	
	static function cnpj($cnpj) {
		if (strlen($cnpj) <> 18) return 0;
		$soma1 = ($cnpj[0] * 5) +
	
		($cnpj[1] * 4) +
		($cnpj[3] * 3) +
		($cnpj[4] * 2) +
		($cnpj[5] * 9) +
		($cnpj[7] * 8) +
		($cnpj[8] * 7) +
		($cnpj[9] * 6) +
		($cnpj[11] * 5) +
		($cnpj[12] * 4) +
		($cnpj[13] * 3) +
		($cnpj[14] * 2);
		$resto = $soma1 % 11;
		$digito1 = $resto < 2 ? 0 : 11 - $resto;
		$soma2 = ($cnpj[0] * 6) +
	
		($cnpj[1] * 5) +
		($cnpj[3] * 4) +
		($cnpj[4] * 3) +
		($cnpj[5] * 2) +
		($cnpj[7] * 9) +
		($cnpj[8] * 8) +
		($cnpj[9] * 7) +
		($cnpj[11] * 6) +
		($cnpj[12] * 5) +
		($cnpj[13] * 4) +
		($cnpj[14] * 3) +
		($cnpj[16] * 2);
		$resto = $soma2 % 11;
		$digito2 = $resto < 2 ? 0 : 11 - $resto;
		return (($cnpj[16] == $digito1) && ($cnpj[17] == $digito2));
	}
	
	// verifica se um esta esta de escrito de forma correta
	static function cep($cep) {
		//valida::cep("99999-000");
		// retira espacos em branco
		$cep = trim($cep);
		// expressao regular para avaliar o cep
		$avaliaCep = ereg("^[0-9]{5}-[0-9]{3}$", $cep);
	
		// verifica o resultado
		if(!$avaliaCep) {
			return 0;
		}else{
			return 1;
		}
	}
	
	// VALIDAR TELEFONE NO SEGUINTE FORMATO: 33333333
	static function telefone($tel){
            if($tel != ''){
                for($i = 0; $i < strlen($tel); $i++){
                    $char = substr($tel, $i, 1);
                    if($char != '(' && $char != ')' && $char != '-' && $char != ' ' && (ord($char) < 48 || ord($char) > 58)){
                        return 0;
                    }
                }
                return 1;
                /*
		if(eregi("^[0-9]{8}$", $tel)) {
			return 1;
		}else{
			return 0;
		}
                */
            }else{
                return 1;
            }
	}
	
	
}
?>
