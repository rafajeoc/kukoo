<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model da Obrigação.
 * 
 * @since     1.0
 * @package   models/contabilidade
 * @copyright Kukoo
 */
class ModelObrigacaoClienteOdt {
    
    
    public $obrcodId;
    public $cliodtId;
    public $obrcodHashDoc;
    public $obrcodMesRef;
    public $obrcodCaminhoArq;
    
    
    /**
     * Monta o objeto de Obrigação.
     * 
     * @param
     */
    public function ModelObrigacaoClienteOdt($obrcodId, $cliodtId, $obrcodHashDoc, $obrcodMesRef, $obrcodCaminhoArq) {
        $this->obrcodId = $obrcodId;
        $this->cliodtId = $cliodtId;
        $this->obrcodHashDoc = $obrcodHashDoc;
        $this->obrcodMesRef = $obrcodMesRef;
        $this->obrcodCaminhoArq = $obrcodCaminhoArq;
    }
      
}

?>