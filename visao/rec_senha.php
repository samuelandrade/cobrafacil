<?php
if($_POST["btn_recuperar"] == "Recuperar"){
    recupera_senha();
}
?>
            <header id="header_login">
                <img src="imagens/sgm.png" alt="SGM">
                <div><label>Cobra Fácil</label></div>
            </header>
            <section id="session_login">
                <form id="form_login" action="?esq=1" method="post">
                    <div>
                        <h1>Esqueceu sua senha?</h1>
                    </div>
                    <p>Informe seu CPF e E-Mail que sua senha será enviada para seu e-mail.</p>
                    <div>
                        <label>CPF: </label>
                        <input type="text" name="cpf" autofocus maxlength="14" OnKeyPress="formatar(this, '000.000.000-00')" onblur="valida_cpf('cpf', this, 0, 'CPF inválido')">
                    </div>
                    <div>
                        <label>E-Mail: </label>
                        <input type="email" name="email" onblur="valida_cpf('email', this, 0, 'E-Mail inválido')">
                    </div>
                    <div>
                        <input type="submit" name="btn_recuperar" value="Recuperar" id="form_submit">
                    </div>
                </form>
                <div id="rec_senha"></div>
                <a href="?esq=" title="Voltar"><button class="botao">Voltar</button></a>
            </section>