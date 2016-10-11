<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller das funcionalidades dos parâmetros do sistema.
 * 
 * @since     1.0
 * @package   controllers/parametros
 * @copyright Kukoo
 */
class ControllerParametros extends CI_Controller {
    
    public function index() {
    }
    
    /**
     * Carrega a view dos parâmetros do módulo Administrativo.
     */
    public function loadParametrosAdministrativo() {
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        $arrModel = $controllerPadrao->carregarSQLHelper(array('administrativo/ModelUsuarioDAO'));
        $modelUsuario = $arrModel[0];
        
        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
        
        // Carrega as views.
        $arrayViews = array("padrao/header", "parametros/contabilidade_adm", "padrao/footer");
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $dataCI);
        
    }
    
    /**
     * Carrega a view dos parâmetros do módulo de Contabilidade.
     */
    public function loadParametrosContabilidade() {
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        $arrModel = $controllerPadrao->carregarSQLHelper(array('administrativo/ModelUsuarioDAO'));
        $modelUsuario = $arrModel[0];
        
        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
        
        // Carrega as views.
        $arrayViews = array("padrao/header", "parametros/contabilidade_par", "padrao/footer");
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $dataCI);
        
    }
    
    /**
     * Grava os parâmetros do módulo Administrativo no banco de dados.
     */
    public function gravarParametrosAdministrativo() {
        
    }
    
    /**
     * Grava os parâmetros do módulo de Contabilidade no banco de dados.
     */
    public function gravarParametrosContabilidade() {
        $this->load->model('parametros/ModelParametrosDAO');
        $model = $this->ModelParametrosDAO;
        
        // Carrega os parâmetros no vetor de parâmetros para mandar para o banco de dados
        $slcMesCargaAgenda = $this->input->post('slcMesCargaAgenda');
        $arrayParametros = array('pca_mescargaagenda' => $slcMesCargaAgenda);
        
        // Grava os parâmetros no banco de dados
        $model->gravarParametrosContabilidade($arrayParametros);
    }
    
}

?>