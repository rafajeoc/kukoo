<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das utilidades de controllers.
 *
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/padrao
 * @copyright   Kukoo
 */
class ControllerUtilidadesCIController extends CI_Controller
{


    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */

    /**
     * Realiza o require_once para todos os scripts passados por parâmetro.
     *
     * @param   array $arrayRequireOnce Array de strings contendo o endereços dos scripts.
     */
    public function requireOnce($arrayRequireOnce)
    {
        foreach ($arrayRequireOnce as $arrayRequireOnceItem) require_once APPPATH . $arrayRequireOnceItem;
    }

}

?>
