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
        <script type="text/javascript" src="js/estado_cidade.js" ></script>
        <script type="text/javascript" src="js/javascript.js" ></script>
    </head>
    <body>
        <div id="center">
            <?php if(logado()){ ?>
            <header>
                <div id="logo">
                    <img src="<?//=logoEmpresa()?>" alt="<?//=nomeEmpresa()?>" id="imagem_logo"  <?//=ajustaLogo()?>>
                </div>
                <div id="nome_empresa" <?//=ajustaNomeEmpresa()?>>
                    <label><?//=nomeEmpresa()?></label>
                </div>
                
                <div id="id_usuario">
                    <label>Olá <?=$_SESSION["cf_nome"]?> | <a href="?pag=cnf" title="Configurações">Configurações</a> | <a href="?sair=1" title="Sair">Sair</a></label>
                </div>
                <menu>
                <ul>
                    <li class="menu_li">
                        <a href="?pag=" id="m_inicio"><span>Início</span></a>
                    </li>
                    <li class="menu_li">
                        <a href="?pag=cliente" id="m_cliente"><span>Clientes</span></a>
                        <ul>
                            <li><a href="?pag=clienteSet">Novo</a></li>
                            <li><a href="?pag=cliente">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="menu_li">
                        <a href="?pag=grupo" id="m_grupo"><span>Grupos</span></a>
                        <ul>
                            <li><a href="?pag=grupoSet">Novo</a></li>
                            <li><a href="?pag=grupo">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="menu_li">
                        <a href="?pag=parcelas" id="m_parcelas"><span>Parcelas</span></a>
                        <ul>
                            <li><a href="?pag=parcelasSet">Novas</a></li>
                            <li><a href="?pag=parcelas">Consultar</a></li>
                        </ul>
                    </li>
                    <li class="menu_li">
                        <a href="?pag=boleto" id="m_boleto"><span>Boletos</span></a>
                        <ul>
                            <li><a href="?pag=boletoSet">Novo</a></li>
                            <li><a href="?pag=boleto">Consultar</a></li>
                        </ul>
                    </li>
                    
                </ul>
                </menu>
            </header>
            <div id="linha"></div>
            <section>
                <?php
                //if(logado()){
                    switch($pag){
                        case "grupo"       : include_once "visao/grupo.php";       echo "<script>bg_menu('m_grupo');</script>\n";    break;
                        case "grupoSet"    : include_once "visao/grupoSet.php";    echo "<script>bg_menu('m_grupo');</script>\n";    break;
                        case "cliente"     : include_once "visao/cliente.php";     echo "<script>bg_menu('m_cliente');</script>\n";  break;
                        case "clienteSet"  : include_once "visao/clienteSet.php";  echo "<script>bg_menu('m_cliente');</script>\n";  break;
                        case "parcelas"    : include_once "visao/parcelas.php";    echo "<script>bg_menu('m_parcelas');</script>\n"; break;
                        case "parcelasSet" : include_once "visao/parcelasSet.php"; echo "<script>bg_menu('m_parcelas');</script>\n"; break;
                        case "boleto"      : include_once "visao/boleto.php";      echo "<script>bg_menu('m_boleto');</script>\n";   break;
                        case "boletoSet"   : include_once "visao/boletoSet.php";   echo "<script>bg_menu('m_boleto');</script>\n";   break;
                        
                        default: include_once "visao/home.php"; echo "<script>bg_menu('m_inicio');</script>\n"; break;
                    }
                    echo "
            </section>";
                }else{
                    include_once "visao/login.php";
                }
                ?>
            
            <footer>
                <!--
                    <a href="http://www.anguloweb.com.br/" title="AnguloWeb" id="marcadagua">
                        <img src="imagens/AWMdagua.png" alt="AnguloWeb">
                    </a>
                -->
                <label>Cobra Fácil</label><br>
                <a href="http://www.anguloweb.com.br" title="AnguloWeb">&COPY; ÂnguloWeb Soluções para Internet - Todos os direitos reservados&nbsp;&nbsp;</a>
            </footer>
        </div>
    </body>
</html>
