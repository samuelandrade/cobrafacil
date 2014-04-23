<?php
if($access_control != "549ugh4gre98h943"){ header("location:../"); }
include_once "controle/controle_grupo.php";
?>
<h1>Grupo</h1>
<fieldset>
    <legend>Novo grupo</legend>
    <form action="" method="post" class="formulario">
        <input type='hidden' value='<?php echo $grupo->get_id(); ?>' name='id'>
        <div>
            <label class="campos">Nome do grupo: </label><br>
            <input type='text' value='<?php echo $grupo->get_nome(); ?>' name='nome' id='nome'>
        </div>
        <div>
            <button type="submit" name="btn_salvar" value="Salvar" class="botao">Salvar</button>
        </div>
    </form>
</fieldset>