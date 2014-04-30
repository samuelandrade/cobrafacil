<?php
if($_POST["btn_logar"] == "Logar"){
    if($_POST["tp_usuario"] == 1){
        if(!cliente_login()){
            echo "<script>alert('Falha no login do cliente')</script>";
        }else{
            echo "<script>location.href='?pag='</script>";
        }
    }else{
        if(!login()){
            echo "<script>alert('Falha no login')</script>";
        }else{
            echo "<script>location.href='?pag='</script>";
        }
    }
}
?>
            <header id="header_login">
                <img src="imagens/sgm.png" alt="SGM">
                <div><label>Cobra Fácil</label></div>
            </header>
            <section id="session_login">
                <form id="form_login" action="" method="post">
                    <div>
                        <h1>ÁREA RESTRITA</h1>
                    </div>
                    <div>
                        <input type="radio" name="tp_usuario" id="cliente" value="1" checked>
                        <label for="cliente">Cliente</label>
                        <div id="dv_administrador">
                            <input type="radio" name="tp_usuario" id="administrador" value="2">
                            <label for="administrador">Administrador</label>
                        </div>
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