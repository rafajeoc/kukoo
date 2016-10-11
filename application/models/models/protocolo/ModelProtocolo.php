<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model de Protocolo.
 * 
 * @since     1.0
 * @package   models/protocolo
 * @copyright Kukoo
 */
class ModelProtocolo {
    
    
    public $proId;
    public $cliId;
    public $proDtHrEmissao;
    public $proImpresso;
    public $proAssunto;
    public $proDescricao;
    
    
    /**
     * Constrói o objeto de Protocolo.
     * 
     * @param  int      $proId           ID do Protocolo.
     * @param  int      $cliId           ID do Cliente.
     * @param  datetime $proDtHrEmissao  Data e hora de emissão do protocolo.
     * @param  int      $proImpresso     Indica de o Protocolo já foi impresso.
     * @param  string   $proAssunto      Assunto ao qual o Protocolo se refere.
     * @param  string   $proDescricao    Descrição do Protocolo.
     */
    public function ModelProtocolo($proId, $cliId, $proDtHrEmissao, $proImpresso, $proAssunto, $proDescricao) {
        $this->proId = $proId;
        $this->cliId = $cliId;
        $this->proDtHrEmissao = $proDtHrEmissao;
        $this->proImpresso = $proImpresso;
        $this->proAssunto = $proAssunto;
        $this->proDescricao = $proDescricao;
    }
    
}

?>