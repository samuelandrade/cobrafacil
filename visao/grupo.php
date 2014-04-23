<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_grupo.php";
?>
<h1>Grupo</h1>
<table class="tabela">
    <tr>
        <th>Nome</th>
        <th>Clientes</th>
        <th></th>
    </tr>
    <?=mostraGrupos()?>
</table>