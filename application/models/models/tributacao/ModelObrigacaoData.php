<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model da Entidade.
 * 
 * @since     1.0
 * @package   models/tributacao
 * @copyright Kukoo
 */
class ModelObrigacaoData {
    
    
    public $obrId;
    public $odtDiaLimite;
    public $odtMesLimite;
    public $odtAnoLimite;
    
    
    /**
     * Monta o objeto de Imposto.
     * 
     * @param  int $obrId         ID da obrigação.
     * @param  int $odtDiaLimite  Dia limite para envio da obrigação.
     * @param  int $odtMesLimite  Mês limite para envio da obrigação, quando esta for anual ou de outra data específica.
     */
    public function ModelObrigacaoData($obrId, $odtDiaLimite, $odtMesLimite, $odtAnoLimite) {
        $this->obrId = $obrId;
        $this->odtDiaLimite = $odtDiaLimite;
        $this->odtMesLimite = $odtMesLimite;
        $this->odtAnoLimite = $odtAnoLimite;
    }
}

?>