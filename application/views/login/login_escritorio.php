<?php
    session_start();
    if (isset($_SESSION['escLoadCode']) && ($_SESSION['escLoadCode'] == 1)) {
        redirect(base_url().'acessar-usuario');
    } else {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Entrar</title>
        
        <link href="<?php echo base_url();?>static/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/css/reset.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Inspirado em form por Andy Tran (andytran.me) -->
        <div class="pen-title">
            <h1>Login de Escritório</h1>
        </div>

        <div class="module form-module">
            <div class="toggle">
                <i>?</i>
                <div class="tooltip">Ajude-me!</div>
            </div>
            <form method="post" action="<?php echo base_url();?>validar-escritorio" class="form">
                <h2>Acesse o ambiente virtual</h2>
                
                <?php if (isset($_SESSION['escLoadCode']) && ($_SESSION['escLoadCode'] == 0)) { ?>
                    <div id="divErroLogin" class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Código de escritório e/ou senha incorretos!
                    </div>
                <?php } else if (isset($_SESSION['escLoadCode']) && ($_SESSION['escLoadCode'] == -1)) { ?>
                    <div id="divErroLogin" class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Escritório inativo!<br>
                        Em caso de dúvidas, entre em contato com o suporte.
                    </div>
                <?php } ?>
                
                <input type="text" name="txtEscritorio" placeholder="Escritório" onKeyPress="bloquearLetras(event)"/>
                <input type="password" name="txtSenha" placeholder="Senha"/>
                <input type="submit" name="btnSubmit" value="Entrar">
            </form>
            <div class="form">
                <h2>O que é isto?</h2>
                <form method="post" action="<?php echo base_url();?>problemas-de-escritorio">
                    <p>Você está visualizando esta tela pois é necessário, primeiramente, acessar o
                    ambiente do seu escritório no Kukoo para acessar o seu usuário.</p><br>
                    <p>Para acessar o ambiente do seu escritório, insira o usuário e a senha que,
                    provavelmente, um superior seu já te passou.</p><br>
                    <p>Se você é aquele que recebeu estas informações através de nós, mas não se lembra 
                    (ou as perdeu), não tem problema.</p><br>
                    <button type="submit" name="btnProblemasEscritorio">Clique aqui para resolvermos esse impasse</button>
                </form>
            </div>
        </div>
        
                <script src="<?php echo base_url();?>static/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>static/js/index.js"></script>
  </body>
</html>
<?php
    }
?>