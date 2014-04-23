<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_cliente.php";
?>
<h1>Clientes</h1>
<table class="tabela">
    <tr>
        <th>Nome</th>
        <th>Número do contrato</th>
        <th>Data de nascimento</th>
        <th>Cidade</th>
        <th>Grupo</th>
        <th></th>
    </tr>
    <?=cliente_mostraCliente()?>
</table>