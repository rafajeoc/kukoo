        <form method="post" action="<?php echo base_url();?>problemas-de-usuario" class="formProblemasEscritorio">
            <h2>Oi, tudo bem?</h2><br>
            <p>Eu sou o Kukoo e estou aqui para te ajudar!</p>
            <p>Você está aqui porque você clicou em um link de ajuda a respeito de informações 
            sobre o seu escritório. Quero te ajudar a resolver esse problema rapidamente, para você poder 
            retomar (ou iniciar) suas atividades!</p><br>
            <input type="radio" name="rbEscritorio" value="codigoEscritorio"> Esqueci meu código de escritório!<br>
            <input type="radio" name="rbEscritorio" value="senhaEscritorio"> Não consigo lembrar a senha de escritório!<br>
            <input type="radio" name="rbEscritorio" value="infosCertas"> O código de escritório e a senha estão certos, mas continua dando erro!<br>
            <input type="radio" name="rbEscritorio" value="botaoSemAcao"> Clico no botão para acessar, mas não acontece nada!<br>
            <input type="radio" name="rbEscritorio" value="outrosEsc"> Estou com outro problema!<br><br>
            <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
        </form>