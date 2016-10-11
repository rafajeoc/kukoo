<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller da index do site.
 * 
 * @author RC + RA
 * @version 1.0
 * @package 
 */
class ControllerComercial extends CI_Controller
{
    
    /**
     * Carrega a index do Controller.
     */
    public function index()
    {
        // Prepara o controller para utilização.
        list($ctlPadrao) = $this->prepararController(false, false, false);
        
        // Carrega as views.
        $arrayViews = array('comercial/index');
        $arrayMapeamentoDataCI = array(0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, null);
    }
    
}

?>
