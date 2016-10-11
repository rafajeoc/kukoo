<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model do relacionamento das entidades com as Obrigações que cada uma paga.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelClienteObrigacaoData {
    
    
    public $cliodtId;
    public $cliId;
    public $obrId;
    public $cliodtDiaLimite;
    public $cliodtMesLimite;
    public $cliodtAnoLimite;
    public $cliodtProxDiaLimite;
    public $cliodtProxMesLimite;
    public $cliodtProxAnoLimite;
    
    
    /**
     * Monta o objeto do relacionamento das entidades com os Obrigações que cada uma paga.
     * 
     * @param  int $cliodtId             ID do relacionamento entre entidade e obrigação.
     * @param  int $cliId                ID da entidade.
     * @param  int $obrId                ID da obrigação.
     * @param  int $cliodtDiaLimite      Dia limite até o qual a obrigação deve ser enviado à entidade.
     * @param  int $cliodtMesLimite      Mês limite até o qual a obrigação deve ser enviado à entidade (quando o período for Ano).
     * @param  int $cliodtProxDiaLimite  Próximo dia limite até o qual a obrigação deve ser enviado à entidade.
     * @param  int $cliodtProxMesLimite  Próximo mês limite até o qual a obrigação deve ser enviado à entidade (quando o período for Ano).
     * @param  int $cliodtProxAnoLimite  Próximo ano limite até o qual a obrigação deve ser enviada ao cliente (para obrigações de datas específicas).
     */
    public function ModelClienteObrigacaoData($cliodtId, $cliId, $obrId, $cliodtDiaLimite, $cliodtMesLimite, $cliodtAnoLimite, $cliodtProxDiaLimite, $cliodtProxMesLimite, $cliodtProxAnoLimite) {
        $this->cliodtId = $cliodtId;
        $this->cliId = $cliId;
        $this->obrId = $obrId;
        $this->cliodtDiaLimite = $cliodtDiaLimite;
        $this->cliodtMesLimite = $cliodtMesLimite;
        $this->cliodtAnoLimite = $cliodtAnoLimite;
        $this->cliodtProxDiaLimite = $cliodtProxDiaLimite;
        $this->cliodtProxMesLimite = $cliodtProxMesLimite;
        $this->cliodtProxAnoLimite = $cliodtProxAnoLimite;
    }
    
}

?>