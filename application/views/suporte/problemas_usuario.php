        <form method="post" action="<?php base_url();?>suporte-usuario" class="formProblemasUsuario">
            <?php if (isset($_POST['rbEscritorio'])) { ?>
                <h2>Bem, neste caso...</h2><br>
                <p>Já vimos que seu problema não é sobre usuário e senha, mas fique tranquilo. Pode ser que 
                nós estejamos passando por alguma instabilidade nos servidores. Se esse for o caso, é bem provável 
                que já saibamos - e estamos tomando as providências necessárias para normalizar o serviço.</p>
                <p>Se você tem certeza de que está tudo certo, e mesmo assim não consegue avançar, ligue para a gente! 
                Estamos prontos para te atender e te ajudar a resolver este problema!</p>
            <?php } else if (isset($_POST['ajuda'])) { ?>
                <h2>Oi, tudo bem?</h2><br>
                <p>Eu sou o Kukoo e estou aqui para te ajudar!</p>
                <p>Se você chegou aqui, foi porque você clicou em um link de ajuda, a respeito de informações 
                sobre o seu usuário. Quero te ajudar a resolver esse problema rapidamente, para você poder 
                retomar (ou iniciar) suas atividades!</p>
                <input type="radio" name="rbUsuario" value="nomeUsuario"> Esqueci meu nome de usuário!<br>
                <input type="radio" name="rbUsuario" value="senhaUsuario"> Não consigo lembrar minha senha!<br>
                <input type="radio" name="rbUsuario" value="infosCertas"> O usuário e a senha estão certos, mas continua dando erro!<br>
                <input type="radio" name="rbUsuario" value="botaoSemAcao"> Clico no botão para acessar, mas não acontece nada!<br>
                <input type="radio" name="rbUsuario" value="outros"> Estou com outro problema!<br><br>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } ?>
        </form>