<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model da Agenda.
 * 
 * @since     1.0
 * @package   models/contabilidade
 * @copyright Kukoo
 */
class ModelAgendaObrigacao {
    
    
    public $agnobrId;
    public $obrcodId;
    public $agnobrStatusObr;
    public $agnobrDtHrEnvio;
    public $agnobrDtHrAcesso;
    public $agnobrDtHrAcesso2;
    
    
    /**
     * Monta o objeto de Agenda.
     * 
     * @param  int    $agnobrId        ID do relacionamento entre Entidade e Imposto.
     * @param  string $obrcodId      Hash do Documento.
     * @param  int    $agnobrStatusObr    Status do Imposto.
     * @param  string $agn_caminhoarq   Caminho do arquivo.
     * @param  date   $agnobrDtHrEnvio    Data e hora de envio do Documento ao sistema.
     * @param  date   $agnobrDtHrAcesso   Primeira data e hora de acesso ao Documento.
     * @param  date   $agnobrDtHrAcesso2  Última data e hora de acesso ao Documento.
     */
    public function ModelAgendaObrigacao($agnobrId, $obrcodId, $agnobrStatusObr, $agnobrDtHrEnvio, $agnobrDtHrAcesso, $agnobrDtHrAcesso2) {
        
        $this->agnobrId = $agnobrId;
        $this->obrcodId = $obrcodId;
        $this->agnobrStatusObr = $agnobrStatusObr;
        $this->agnobrDtHrEnvio = $agnobrDtHrEnvio;
        $this->agnobrDtHrAcesso = $agnobrDtHrAcesso;
        $this->agnobrDtHrAcesso2 = $agnobrDtHrAcesso2;
    }
      
}

?>