<?php include_once "controle/controle.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cobra Fácil</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="cache-control" content="max-age=0">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta name="robots" content="noindex, nofollow">
        
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen">
        <script type="text/javascript" src="js/javascript.js" ></script>
        <script type="text/javascript" src="js/aw_validacao.js" ></script>
        <script type="text/javascript" src="js/valida.js" ></script>
    </head>
    <body>
        <div id="center">
            <header id="header_login">
                <img src="imagens/sgm.png" alt="SGM">
                <div><label>Cobra Fácil</label></div>
            </header>
            <section id="session_login">
                <form id="form_login" action="" method="post">
                    <input type="hidden" name="tp_usuario" value="adm">
                    <div>
                        <h1>ÁREA RESTRITA (ADM)</h1>
                    </div>
                    <div>
                        <label>Login: </label>
                        <input type="email" name="login" autofocus>
                    </div>
                    <div>
                        <label>Senha: </label>
                        <input type="password" name="senha" autocomplete="off">
                    </div>
                    <div>
                        <input type="submit" name="btn_logar" value="Logar" id="form_submit">
                    </div>
                </form>
            </section>
            <footer>
                <label>Cobra Fácil</label><br>
                <a href="http://www.anguloweb.com.br" title="AnguloWeb">&COPY; ÂnguloWeb Soluções para Internet - Todos os direitos reservados&nbsp;&nbsp;</a>
                <a href="http://www.anguloweb.com.br/" title="AnguloWeb" id="marcadagua">
                    <img src="imagens/AWMdagua.png" alt="AnguloWeb">
                </a>
            </footer>
        </div>
    </body>
</html>
