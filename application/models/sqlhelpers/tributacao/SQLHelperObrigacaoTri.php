<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object de Imposto.
 * 
 * @since     1.0
 * @package   models/tributacao
 * @copyright Kukoo
 */
class SQLHelperObrigacaoTri extends CI_Model {
    
    
    // Nomes das tabelas
    private $tabelaObrigacao = 'kukooDBP.triObrigacao';
    private $tabelaObrigacaoData = 'kukooDBP.triObrigacaoData';
    private $tabelaRegimeTributacaoObrigacao = 'kukooDBP.triRegimeTributacaoObrigacao';
    private $tabelaClienteObrigacaoData = 'kukooDBP.admClienteObrigacaoData';
    
    
    /**
     * Seta o hash das tabelas.
     */
    public function setTabHash($pTabHash) {
        $this->tabelaObrigacao .= $pTabHash;
        $this->tabelaObrigacaoData .= $pTabHash;
        $this->tabelaClienteObrigacaoData .= $pTabHash;
        $this->tabelaRegimeTributacaoObrigacao .= $pTabHash;
    }
    
    
    /**
     * 
     */
    public function getTabelaObrigacao() {
        return $this->tabelaObrigacao;
    }
    
    
    /**
     * 
     */
    public function getTabelaObrigacaoData() {
        return $this->tabelaObrigacaoData;
    }
    
    
    /**
     * 
     */
    public function getRegimeTributacaoObrigacao() {
        return $this->tabelaRegimeTributacaoObrigacao;
    }
    
    
    /**
     * 
     */
    public function getTabelaClienteObrigacaoData() {
        return $this->tabelaClienteObrigacaoData;
    }
    
    
    /**
     * 
     */
    public function criarObrigacao($obrId, $obrNome, $obrTipoObr, $obrPeriodo, $obrRepeticao, $obrDptResp, $obrDataMovel)
    {
        require_once APPPATH.'models/models/tributacao/ModelObrigacao.php';
        return new ModelObrigacao($obrId, $obrNome, $obrTipoObr, $obrPeriodo, $obrRepeticao, $obrDptResp, $obrDataMovel);
    }
    
    
    /**
     * 
     */
    public function criarObrigacaoData($obrId, $odtDiaLimite, $odtMesLimite, $odtAnoLimite)
    {
        require_once APPPATH.'models/models/tributacao/ModelObrigacaoData.php';
        return new ModelObrigacaoData($obrId, $odtDiaLimite, $odtMesLimite, $odtAnoLimite);
    }
    
    
    /**
     * Pega todos os impostos.
     * 
     * @return  Os impostos existentes no banco de dados.
     */
    public function get()
    {
        // Monta o SQL.
        $sqlSel = 'SELECT * FROM '.$this->tabelaObrigacao;
        
        // Executa a query e retorna os resultados.
        $query = $this->db->query($sqlSel);
        return $query->result();
    }
    
    
    /**
     * Pega uma obrigação pelo seu ID.
     * 
     * @param  int $obrId  ID da obrigação.
     * 
     * @return  O imposto buscado.
     */
    public function get_by_id($obrId)
    {
        // Monta o SQL.
        $sqlSel = 'SELECT * FROM '.$this->tabelaObrigacao.' obr '.
                    'JOIN '.$this->tabelaObrigacaoData.' odt ON obr.obrId = odt.obrId '.
                    'WHERE obr.obrId = ?';
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel, array($obrId));
        return $query->row();
    }
    
    
    /**
     * Salva os dados da obrigação.
     */
    public function save($obrigacao, $obrigacaoData, $tipoOperacao)
    {
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Se for inclusão, somente inclui a obrigação com sua data.
        if ($tipoOperacao == 'i') {
            $this->db->insert($this->tabelaObrigacao, $obrigacao);
            $this->db->insert($this->tabelaObrigacaoData, $obrigacaoData);
        }
        // Se for alteração, também atualiza todas as entidades que compartilham desta obrigação.
        else {
            
            // NÃO MEXER!!!! Só atualiza os dados gerais da obrigação via tela se for específica.
            if ($obrigacao != null) {
                $this->db->update($this->tabelaObrigacao, $obrigacao, array('obrId' => $obrigacao->obrId));
            }
            
            $vObrigacao = $this->get_by_id($obrigacaoData->obrId);
            
            $this->db->update($this->tabelaObrigacaoData, $obrigacaoData, array('obrId' => $obrigacaoData->obrId));
            $this->alterarDataLimiteClientes($vObrigacao, $obrigacaoData);
        }
        
        // Termina o processamento.
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
    
    
    /**
     * 
     */
    public function remove($obrId)
    {
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Remove os registros das tabelas.
        $this->db->delete($this->tabelaClienteObrigacaoData, array('obrId' => $obrId));
        $this->db->delete($this->tabelaObrigacaoData, array('obrId' => $obrId));
        $this->db->delete($this->tabelaObrigacao, array('obrId' => $obrId));
        
        // Termina o processamento.
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
    
    
    /**
     * Altera a data limite do imposto para todas as entidades que o tem em seu cadastro.
     * 
     * @param  object $imposto       Objeto de imposto (data específica ou variável, de acordo com a function save).
     * @param  int    $imp_tipodata  Tipo de data do Imposto (mensal, trimestral, anual ou data específica).
     * 
     */
    public function alterarDataLimiteClientes($obrigacao, $obrigacaoData)
    {
        
        /* ----------------------------------------------------------------------------------- */
        /* -                                    ATENÇÃO!                                     - */
        /* -                                                                                 - */
        /* -  TOMAR MUITO CUIDADO AO MEXER NESTA FUNCTION - ELA LIDA COM UPDATES EM MASSA!!  - */
        /* ----------------------------------------------------------------------------------- */
        
        // Atualiza todas as ocorrências desta obrigação nas entidades (tabela de entidade/obrigação).
        list($proxDiaLimite, $proxMesLimite, $proxAnoLimite) = $this->calcularProximaDataLimite($obrigacaoData);
        $this->db->set('cliodtDiaLimite', $obrigacaoData->odtDiaLimite);
        $this->db->set('cliodtMesLimite', $obrigacaoData->odtMesLimite);
        $this->db->set('cliodtAnoLimite', $obrigacaoData->odtAnoLimite);
        $this->db->set('cliodtProxDiaLimite', $proxDiaLimite);
        $this->db->set('cliodtProxMesLimite', $proxMesLimite);
        $this->db->set('cliodtProxAnoLimite', $proxAnoLimite);
        $this->db->where('obrId', $obrigacaoData->obrId);
        $this->db->update($this->tabelaClienteObrigacaoData);
    }
    
    
    
    /**
     * 
     */
    public function calcularProximaDataLimite($obrigacaoData)
    {
        // Busca as informações a respeito da obrigação na tabela de obrigações.
        $sqlSel = 'SELECT obrRepeticao, obrDataMovel '.
                    'FROM '.$this->tabelaObrigacao.' obr '.
                    'WHERE obr.obrId = ?';
        
        $query = $this->db->query($sqlSel, array('obrId' => $obrigacaoData->obrId));
        $row = $query->row();
        
        // Verifica se a data é movel, para calcular corretamente com base no valor atualizado.
        if ($row->obrDataMovel == 1) {
            
            // Cria o objeto de data para deixar que o PHP calcule, para não correr risco de calcular errado.
            $proximaData = new DateTime();
            $proximaData->setDate($obrigacaoData->odtAnoLimite, $obrigacaoData->odtMesLimite, $obrigacaoData->odtDiaLimite);
            
            /*
                Soma 365 dias para cada repetição do imposto.
                
                REGRA: Os impostos que têm data móvel são chamados assim pois, por exemplo, um imposto que é pago de forma trienal, ou seja, de 3 em 3 anos,
                        e foi pago no dia 20/03 de um determinado ano, será pago no dia 20/03 do terceiro ano contando a partir de agora, ou no dia 19/03,
                        caso exista um ano bissexto no meio do cálculo.
            */
            for ($i = 0; $i < $row->obrRepeticao; $i++) {
                $proximaData->modify('+365 days');
            }
            
            // Se for data móvel, retorna a data calculada.
            return array(intval($proximaData->format('d')), intval($proximaData->format('n')), intval($proximaData->format('Y')));
        } else {
            // Se não for data móvel, retorna o mesmo dia, o mesmo mês e o ano somado da repetição.
            // Ex.: 7/10/2016 de obrigação com repetição 3 -> retorna (7, 10, 2019)
            return array($obrigacaoData->odtDiaLimite, $obrigacaoData->odtMesLimite, ($obrigacaoData->odtAnoLimite + $row->obrRepeticao));
        }
        
    }
    
    
    /**
     * 
     */
    public function carregarObrigacoesRegimeTributacao($idRegimeTributacao)
    {
        // Monta a instrução SQL.
        /*
            REGRA: São trazidas obrigações do regime de tributação passado por parâmetro, enquanto as obrigações específicas são sempre carregadas,
                    por se tratarem de qualquer coisa. Existem obrigações específicas que não necessariamente dizem respeito a uma tributação, mas
                    sim a qualquer documento que precise ser enviado. Isto foi desenhado desta forma por conta de o Kukoo não lidar todas as vezes
                    com escritórios de contabilidade.
        */
        $sqlSel = 'SELECT obr.obrId as obrId, obr.obrNome as obrNome, obr.obrPeriodo as obrPeriodo, obr.obrRepeticao as obrRepeticao, obr.obrDptResp as obrDptResp, obr.obrDataMovel as obrDataMovel, odt.odtDiaLimite as odtDiaLimite, odt.odtMesLimite as odtMesLimite, odt.odtAnoLimite as odtAnoLimite '.
                    'FROM '.$this->tabelaObrigacao.' obr '.
                    'JOIN '.$this->tabelaObrigacaoData.' odt ON obr.obrId = odt.obrId '.
                    'LEFT JOIN '.$this->tabelaRegimeTributacaoObrigacao.' rgtobr ON obr.obrId = rgtobr.obrId '.
                    'WHERE (rgtobr.rgtId = ? AND obr.obrTipoObr = ?) '.
                    'OR obr.obrTipoObr = ?';
        
        // Executa a query e retorna os resultados.
        $query = $this->db->query($sqlSel, array($idRegimeTributacao, 'I', 'E'));
        return $query->result();
    }
    
}

?>
