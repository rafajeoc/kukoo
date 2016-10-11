<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

/**
 * Classe de utilidades de email.
 * 
 * @author Rafael Cantoni Augusto
 * @version 1.0
 * @package utilidades
 */
class UtilidadesMail {
    
    
    /**
     * Prepara o objeto de envio de e-mail para utilização.
     * 
     * @return  O objeto de e-mail com as informações básicas de envio.
     */
    public function prepararEmail() {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtplw.com.br';
        $mail->SMTPAuth = true;
        $mail->Username = 'rafael@kukoo.com.br';
        $mail->Password = 'Jesus4life7';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port = 587;
        
        return $mail;
    }
    
    
    /**
     * Envia a senha por email ao usuário.
     * 
     * @param   string $para    Destinatário da mensagem de e-mail.
     * @param   string $senha   Senha a ser enviada.
     */
    public function enviarSenha($para, $senha) {
        
        // Cria o objeto de email para utilização.
        $mail = $this->prepararEmail();
        
        $mail->setFrom('naoresponda@kukoo.com.br', 'Envio Automático Kukoo');
        $mail->addAddress($para);
        $mail->isHTML(true);
        
        $mail->Subject = 'Sua senha de acesso ao Kukoo';
        $mail->Body = '<html>
                            <head>
                                <title>Sua senha de acesso ao Kukoo</title>
                            </head>
                            <body>
                                <p>Oi! Tudo bem com você?</p>
                                <p>Vim te avisar que seu endereço de e-mail foi cadastrado em nosso sistema. Sua senha de acesso é: '.$senha.'</p>
                                <p>Recomendamos fortemente que sua senha seja trocada no primeiro acesso. Em caso de dúvidas, não hesite em nos contatar. Tchau!</p>
                            </body>
                        </html>';
        
        // Envia a mensagem de e-mail.
        if(!$mail->send()) {
            $_SESSION['msgRetorno'] .= (' / '.$mail->ErrorInfo);
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
    
    
    /**
     * Envia a obrigação por e-mail à entidade.
     * 
     * @param   string $para            Destinatário da mensagem de e-mail.
     * @param   string $caminhoArquivo  Caminho do arquivo a ser colocado na mensagem HTML.
     */
    public function enviarObrigacao($para, $caminhoArquivo) {
        
        // Cria o objeto de email para utilização.
        $mail = $this->prepararEmail();
        
        $mail->setFrom('naoresponda@kukoo.com.br', 'Envio Automático Kukoo');
        $mail->addAddress('rafa.jeoc@gmail.com');
        $mail->isHTML(true);
        
        $mail->Subject = 'Sua guia está disponível para download!';
        $mail->Body = '<html>
                            <head>
                                <title>Sua guia está disponível para download!</title>
                            </head>
                            <body>
                                <p>Oi! Tudo bem com você?</p>
                                <p>Vim te avisar que a sua guia está disponível para download! É só você 
                                    <a href="'.base_url().'baixar-arquivo/'.$caminhoArquivo.'">clicar aqui</a> para baixá-la no seu computador.</p>
                                <p>Em caso de dúvidas, não hesite em nos contatar. Tchau!</p>
                            </body>
                        </html>';
        
        // Envia a mensagem de e-mail.
        if(!$mail->send()) {
            $_SESSION['msgRetorno'] .= (' / '.$mail->ErrorInfo);
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
}