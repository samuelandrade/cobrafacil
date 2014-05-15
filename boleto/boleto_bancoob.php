<?php
function dv($coop, $cliente, $NossoNumero){
    $constante = 3197;
    $res = array();
    $numero = tamanho($coop, 4).tamanho($cliente, 10).tamanho($NossoNumero, 7);
    $cont = 0;
    
    for($i = 0; $i < strlen($numero); $i++){
        $res[$i] = substr($numero, $i, 1) * substr($constante, $cont, 1);
        
        $cont++;
        if($cont > 3){
            $cont = 0;
        }
    }
    
    $x = 0;
    $total = 0;
    for($x = 0; $x < $i; $x++){
        $total += $res[$x];
    }
    
    $dv = 11 - ($total % 11);

	if ($dv > 9) {$dv = 0;}

    /*
    if($dv == 1){
        $dv = 0;
    }
    */
    return $dv;
}

function tamanho($numero, $tam){
    if(strlen($numero) >= $tam){
        return substr($numero, 0, $tam);
    }else{
        while(strlen($numero) < $tam){
            $numero = "0".$numero;
        }
        return $numero;
    }
}
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto BANCOOB/SICOOB: Marcelo de Souza              |
// | Ajuste de algumas rotinas: Anderson Nuernberg                        |
// +----------------------------------------------------------------------+

// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 15;
$taxa_boleto = 2.00;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "1,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
$NossoNumero = "5"; // Coloque o seu n�mero, at� 10 d�gitos

//$dadosboleto["nosso_numero"] = "1";  // At� 8 digitos, sendo os 2 primeiros o ano atual (Ex.: 08 se for 2008)
$dadosboleto["numero_documento"] = "1";	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "Cliente Teste Homologacao 1";
$dadosboleto["endereco1"] = "Rua teste, 1000";
$dadosboleto["endereco2"] = "Maringa - Parana -  CEP 86755-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "";
//$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa bancaria - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, nao receber apos o vencimento";
$dadosboleto["instrucoes2"] = "- Pagavel preferencialmente nas agencias do Banco Sicoob";
$dadosboleto["instrucoes3"] = "- Em caso de duvidas entre em contato conosco: contato@anguloweb.com.br";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "1";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
// DADOS ESPECIFICOS DO SICOOB
$dadosboleto["modalidade_cobranca"] = "02";
$dadosboleto["numero_parcela"] = "001";


// DADOS DA SUA CONTA - BANCO SICOOB
$dadosboleto["agencia"] = "4340"; // Num da agencia, sem digito
$dadosboleto["conta"] = "44362"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - SICOOB
$dadosboleto["convenio"] = "993379";  // Num do conv�nio - REGRA: No m�ximo 10 d�gitos
$dadosboleto["carteira"] = "1";

// SEUS DADOS
$dadosboleto["identificacao"] = "AnguloWeb Solucoes para Internet";
$dadosboleto["cpf_cnpj"] = "14.942.261/0001-35";
$dadosboleto["endereco"] = "Rua Delmiro Costa de Oliveira, 46";
$dadosboleto["cidade_uf"] = "Angulo / PR";
$dadosboleto["cedente"] = "Everton Rodrigo da Silva 06678233956";

$Dv = dv($dadosboleto["agencia"], $dadosboleto["convenio"], $NossoNumero);
$dadosboleto["nosso_numero"] = $NossoNumero . $Dv;

// N�O ALTERAR!
include("include/funcoes_bancoob.php");
include("include/layout_bancoob.php");
?>
