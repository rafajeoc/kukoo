<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das funcionalidades de suporte.
 * 
 * @author      Rafael Cantoni Augusto
 * @since       2.0
 * @package     controllers/suporte
 * @copyright   Kukoo
 */
class ControllerSuporte extends CI_Controller {
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Carrega a página de tickets.
     */
    public function tickets() {
    	
    }
    
    
    /**
     * Carrega a página com os dados do ticket selecionado.
     * 
     * @param	int	$ticId	ID do ticket.
     */
    public function dadosTicket($ticId) {
    	
    }
    
    
    /**
     * Abre um ticket para o escritório informado (ação da entidade).
     * 
     * @param	string	$hashEntidade	Hash da entidade.
     * @param	string	$hashArquivo	Hash do arquivo.
     */
    public function abrirTicket($hashEntidade, $hashArquivo) {
    	
    }
}

?>
