<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller do Dashboard.
 * 
 * @since     1.0
 * @package   controllers/geral
 * @copyright Kukoo
 */
class ControllerDashboard extends CI_Controller {
    
    
    /**
     * Chama o Dashboard.
     */
    public function index()
    {
        // Inicia a sessão.
        session_start();
        
        // Se não está logado, redireciona para a página principal.
        if ($this->verificarUsuarioLogado() == 0) {
            redirect(base_url());
        }
        // Senão, prossegue normalmente.
        else {
            // Carrega o DAO.
            require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
            $controllerPadrao = new ControllerPadrao();
            list($modelUsuario) = $controllerPadrao->carregarSQLHelper(
                array('sqlhelpers/administrativo/SQLHelperUsuario')
            );
            
            // Carrega as informações do Dashboard.
            if (!isset($_SESSION['usuarioAtual'])) {
                $_SESSION['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
            }
            
            $data['usuarioAtual'] = $_SESSION['usuarioAtual'];
            //$this->carregarDashboard(); DESCOMENTAR QUANDO AS FUNÇÕES FICAREM PRONTAS
            
            // Carrega as views.
            $arrayViews = array('padrao/header', 'dashboard/dashboard', 'padrao/footer');
            $arrayMapeamentoDataCI = array(1, 0, 0);
            $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
        }
    }
    
    
    /**
     * Carrega as informações referentes à pagina principal do Dashboard.
     */
    public function carregarDashboard() {
        $this->carregarInfoImpostos();
    }
    
    
    /**
     * Carrega as informações referentes aos quadros de impostos no Dashboard.
     */
    public function carregarInfoImpostos() {
        
    }
    
    
    /**
     * Verifica se o usuário está logado no sistema.
     * 
     * @return  O status de login do Usuário.
     */
    public function verificarUsuarioLogado() {
        
        // Verifica se existe login ativo para o usuário, para o escritório, ou se o hash está atribuído corretamente.
        if ((isset($_SESSION['usrLoadCode']) && ($_SESSION['usrLoadCode'] != 1)) ||
                (isset($_SESSION['escLoadCode']) && ($_SESSION['escLoadCode'] != 1)) ||
                (!isset($_SESSION['h']))) {
            return 0;
        } else {
            return 1;
        }
    }
    
}

?>