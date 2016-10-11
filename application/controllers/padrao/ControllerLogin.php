<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das funcionalidades de login.
 * 
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/padrao
 * @copyright   Kukoo
 */
class ControllerLogin extends CI_Controller {
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Carrega a view do login de Escritório.
     */
    public function loadLoginEscritorio() {
        
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        
        // Carrega as views.
        $arrayViews = array('login/login_escritorio');
        $arrayMapeamentoDataCI = array(0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, null);
    }
    
    
    /**
     * Carrega a view do login de Usuário.
     */
    public function loadLoginUsuario() {
        
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        
        // Carrega as views.
        $arrayViews = array('login/login_usuario');
        $arrayMapeamentoDataCI = array(0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, null);
    }
    
    
    /**
     * Realiza o login para o escritório.
     */
    public function realizarLoginEscritorio() {
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelEHDAO) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/padrao/seguranca/SQLHelperEH')
        );
        
        $e = $this->input->post('txtEscritorio');
        $p = $this->input->post('txtSenha');
        $h = $modelEHDAO->getHash($e, $p);
        
        // Se não achou o hash, é porque o escritório não existe ou a senha está incorreta.
        if ($h == '') {
            $_SESSION['escLoadCode'] = 0;
            redirect(base_url().'acessar-escritorio');
        }
        // Senão, achou o escritório, e vai verificar se está ativo ou não.
        else { 
            
            // Verifica se o escritório está ativo.
            $escAtivo = $this->verificarEscritorioAtivo($e);
            
            // Se estiver ativo, redireciona para o login de usuários.
            if ($escAtivo == 1) {
                $_SESSION['escLoadCode'] = 1;
                $_SESSION['h'] = $h;
                $_SESSION['escId'] = $e;
                redirect(base_url().'acessar-usuario');
            }
            // Senão, volta e informa que o escritório está inativo.
            else {
                $_SESSION['escLoadCode'] = -1;
                redirect(base_url().'acessar-escritorio');
            }
        }
    }
    
    
    /**
     * Verifica se um escritório está ativo ou não no sistema, para permitir ou não o login.
     * Retorna o status da atividade do escritório.
     * 
     * @param   int $escId  ID do escritório.
     * @return  int
     */
    public function verificarEscritorioAtivo($escId) {
        
        // Inicia a sessão e carrega o DAO.
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelEscritorio) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperEscritorio')
        );
        
        // Retorna se o escritório está ativo no sistema ou não.
        return $modelEscritorio->verificaEscritorioAtivo($escId);
    }
    
    
    /**
     * Realiza o login para o usuário.
     */
    public function realizarLoginUsuario() {
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        require_once APPPATH.'models/models/administrativo/usuario/ModelDetLoginUsuario.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario')
        );
        
        // Pega o IP do Usuário.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddr = $_SERVER['REMOTE_ADDR'];
        }
        
        // Pega as informações vindas do form.
        $idUsuario = intval($this->input->post('txtIdUsuario'));
        $senhaUsuario = hash('sha256', $this->input->post('txtSenha'));
        
        // Verifica se o usuário está ativo.
        $usuarioOK = $modelUsuario->verificaUsuarioAtivo($idUsuario, $senhaUsuario);
        $_SESSION['usrLoadCode'] = $usuarioOK;
        
        // Ou usuário não existe/senha inválida, ou está inativo.
        if ($usuarioOK == -1 || $usuarioOK == 0) {
            
            // Cria o objeto de Detalhes de Login do Usuário.
            $detalhesLoginUsuario = $modelUsuario->criarDetLoginUsuario($idUsuario, date('Y-m-d H:m:s'), $ipAddr, 1);
            
            // Grava as informações de login com falha e informa o erro.
            $modelUsuario->gravarInformacoesLogin($detalhesLoginUsuario);
            redirect(base_url().'acessar-usuario');
        }
        // Senão, logou com sucesso.
        else {
            
            // Atribui o usuário na sessão, grava as informações de login e redireciona para o dashboard.
            $_SESSION['usrId'] = intval($idUsuario);
            $detalhesLoginUsuario = $modelUsuario->criarDetLoginUsuario($idUsuario, date('Y-m-d H:m:s'), $ipAddr, 1);
            $modelUsuario->gravarInformacoesLogin($detalhesLoginUsuario);
            redirect(base_url().'dashboard');
        }
    }
    
    
    /**
     * Sai do sistema e destrói a sessão.
     */
    public function logoff() {
        session_start();
        session_destroy();
        redirect(base_url());
    }
}

?>
