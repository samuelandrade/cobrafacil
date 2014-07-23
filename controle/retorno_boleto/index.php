<?php
if($access_control != "3tgbuh9gbufwd"){header("location: ../../../");}

require_once("RetornoBanco.php");
require_once("RetornoFactory.php");

function linhaProcessada($self, $numLn, $vlinha) {
  if($vlinha) {
	  if($vlinha["registro"] == $self::DETALHE) {
      printf("%08d: ", $numLn);
      echo "Nosso N&uacute;mero <b>".$vlinha['nosso_numero']."</b> ".
           "Data <b>".$vlinha["data_ocorrencia"]."</b> ". 
           "Valor Recebido <b>".$vlinha["valor_recebido"]."</b> ".
           "Valor Pago <b>".$vlinha["valor_pago"]."</b> ".
           "Valor do Documento <b>".$vlinha["valor"]."</b><br/>\n";
    }
  } else echo "Tipo da linha n&atilde;o identificado<br/>\n";
}

function linhaProcessada1($self, $numLn, $vlinha) {
  printf("%08d) ", $numLn);
  if($vlinha) {
    foreach($vlinha as $nome_indice => $valor)
      echo "$nome_indice: <b>$valor</b><br/>\n ";
    echo "<br/>\n";
  } else echo "Tipo da linha n&atilde;o identificado<br/>\n";
}

//--------------------------------------INÍCIO DA EXECUÇÃO DO CÓDIGO-----------------------------------------------------
$fileName = "retorno_cnab240.ret";
$fileName = "retorno_cnab400conv7.ret";

$cnab400 = RetornoFactory::getRetorno($fileName, "linhaProcessada");

$retorno = new RetornoBanco($cnab400);
$retorno->processar();
?>  
