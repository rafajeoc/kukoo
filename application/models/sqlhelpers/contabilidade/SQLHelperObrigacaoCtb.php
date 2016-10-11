<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object de Imposto.
 * 
 * @since     1.0
 * @package   models/tributacao
 * @copyright Kukoo
 */
class SQLHelperObrigacaoCtb extends CI_Model {
    
    
    // Nomes das tabelas
    private $tabelaObrigacao = 'kukooDBP.triObrigacao';
    private $tabelaObrigacaoData = 'kukooDBP.triObrigacaoData';
    private $tabelaRegimeTributacaoObrigacao = 'kukooDBP.triRegimeTributacaoObrigacao';
    private $tabelaClienteObrigacaoData = 'kukooDBP.admClienteObrigacaoData';
    private $tabelaCliente = 'kukooDBP.admCliente';
    private $tabelaObrigacaoClienteOdt = 'kukooDBP.ctbObrigacaoClienteOdt';
    private $tabelaAgendaObrigacao = 'kukooDBP.ctbAgendaObrigacao';
    
    
    /**
     * Seta o hash das tabelas.
     */
    public function setTabHash($pTabHash) {
        $this->tabelaObrigacao .= $pTabHash;
        $this->tabelaObrigacaoData .= $pTabHash;
        $this->tabelaClienteObrigacaoData .= $pTabHash;
        $this->tabelaCliente .= $pTabHash;
        $this->tabelaRegimeTributacaoObrigacao .= $pTabHash;
        $this->tabelaObrigacaoClienteOdt .= $pTabHash;
        $this->tabelaAgendaObrigacao .= $pTabHash;
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
    public function getTabelaCliente() {
        return $this->tabelaCliente;
    }
    
    
    /**
     * 
     */
    public function getTabelaObrigacaoClienteOdt() {
        return $this->tabelaObrigacaoClienteOdt;
    }
    
    
    /**
     * 
     */
    public function getTabelaAgendaObrigacao() {
        return $this->tabelaAgendaObrigacao;
    }
    
    
    /**
     * Pega todos os impostos.
     * 
     * @return  Os impostos existentes no banco de dados.
     */
    public function get() {
        
        // Monta o SQL.
        $sqlSel = 'SELECT * FROM ' . $this->tabelaObrigacaoClienteOdt . ' obrcod ' .
                    'JOIN ' . $this->tabelaClienteObrigacaoData . ' cliodt ON obrcod.cliodtId = cliodt.cliodtId ' .
                    'JOIN ' . $this->tabelaCliente . ' cli ON cli.cliId = cliodt.cliId ' .
                    'JOIN ' . $this->tabelaObrigacaoData . ' odt ON cliodt.obrId = odt.obrId ' .
                    'JOIN ' . $this->tabelaObrigacao . ' obr ON obr.obrId = odt.obrId';
        
        // Executa a query e retorna os resultados.
        $query = $this->db->query($sqlSel);
        return $query->result();
    }
    
    
    /**
     * 
     */
    public function remove($obrcodId) {
        
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Remove os registros das tabelas.
        $this->db->delete($this->tabelaObrigacaoClienteOdt, array('obrcodId' => $obrcodId));
        $this->db->delete($this->tabelaAgendaObrigacao, array('obrcodId' => $obrcodId));
        
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
    public function getHashArquivo($obrcodId) {
        
        // Monta a instrução SQL.
        $sqlSel = 'SELECT obrcodHashDoc ' .
                    'FROM ' . $this->tabelaObrigacaoClienteOdt . ' ' .
                    'WHERE obrcodId = ?';
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel, array($obrcodId));
        $result = $query->row();
        return $result->obrcodHashDoc;
    }
    
}

?>
