<?php
    session_start();
    if (isset($_SESSION['escLoadCode']) && ($_SESSION['escLoadCode'] == '1')) { // Aqui, já validou o escritório
        if (isset($_SESSION['usrLoadCode']) && ($_SESSION['usrLoadCode'] == '1')) { // Aqui, já validou o usuário
            redirect(base_url().'dashboard');
        } else { // Senão, apresenta a tela de login de usuário
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kukoo | Entrar</title>
        
        <link href="<?= base_url() ?>static/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>static/dist/css/AdminLTE.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>static/plugins/iCheck/square/blue.css" rel="stylesheet">
    </head>

    <body>
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>K</b>ukoo</a>
            </div><!-- /.login-logo -->
            
            <div class="login-box-body">
                <p class="login-box-msg">Entre com suas informações</p>
                <form action="<?= base_url() ?>validar-usuario" method="post">
                    <?php if (isset($_SESSION['usrLoadCode']) && ($_SESSION['usrLoadCode'] == '-1')) { ?>
                        <div id="divErroLogin" class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            Usuário inativo!
                        </div>
                    <?php } else if (isset($_SESSION['usrLoadCode']) && ($_SESSION['usrLoadCode'] == '0')) { ?>
                        <div id="divErroLogin" class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            Usuário e/ou senha incorretos!
                        </div>
                    <?php } ?>
            
                    <div class="form-group has-feedback">
                        <input id="txtIdUsuario" name="txtIdUsuario" class="form-control" type="text" placeholder="ID de Usuário" onKeyPress="bloquearLetras(event);"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="txtSenha" name="txtSenha" class="form-control" type="password" placeholder="Senha"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <!--<div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label><input type="checkbox"> Lembrar</label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <a href="#">Esqueci minha senha!</a><br>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?= base_url() ?>static/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?= base_url() ?>static/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
            $(document).ready(function () {
                document.getElementById('txtIdUsuario').focus();
            });
        </script>
    </body>
</html>
<?php
        }
    } else { // Aqui, redireciona para a página de login de escritório pois o acesso é indevido; não validou o escritório ainda.
        redirect(base_url().'acessar-escritorio');
    }
?>