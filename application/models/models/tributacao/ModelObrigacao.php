<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model da Entidade.
 * 
 * @since     1.0
 * @package   models/tributacao
 * @copyright Kukoo
 */
class ModelObrigacao {
    
    
    public $obrId;
    public $obrNome;
    public $obrTipoObr;
    public $obrPeriodo;
    public $obrRepeticao;
    public $obrDptResp;
    public $obrDataMovel;
    
    
    /**
     * Monta o objeto de obrosto.
     * 
     * @param  int    $obrId         ID da obrigação.
     * @param  string $obrNome       Nome da obrigação.
     * @param  string $obrTipoObr    Indica qual é o tipo da obrigação (I = imposto / E = específica).
     * @param  string $obrPeriodo    Indica qual é o periodo da obrigação (M = mês / A = ano).
     * @param  int    $obrRepeticao  Indica a repetição do período.
     * @param  int    $obrDptResp    Departamento responsável pela obrigação.
     * @param  string $obrDataMovel  Indica se a repetição da data é a cada 365 dias, ou se é a mesma data a cada ano.
     */
    public function ModelObrigacao($obrId, $obrNome, $obrTipoObr, $obrPeriodo, $obrRepeticao, $obrDptResp, $obrDataMovel) {
        $this->obrId = $obrId;
        $this->obrNome = $obrNome;
        $this->obrTipoObr = $obrTipoObr;
        $this->obrPeriodo = $obrPeriodo;
        $this->obrRepeticao = $obrRepeticao;
        $this->obrDptResp = $obrDptResp;
        $this->obrDataMovel = $obrDataMovel;
    }
}

?>