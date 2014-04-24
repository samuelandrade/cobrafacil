<?php
error_reporting(1);

include_once "../controle/db.php";
include_once "../controle/valida.php";
include_once "../controle/config.php";
include_once "../controle/funcoes.php";
include_once "../classe/classe_boleto.php";
include_once "../classe/classe_cliente.php";

$boleto = new boleto();
$cliente = new cliente();
