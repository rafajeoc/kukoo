<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object Padrão.
 * 
 * @since     1.0
 * @package   models/padrao
 * @copyright Kukoo
 */
class SQLHelperSeguranca extends CI_Model {
    
    
    // Nomes das tabelas.
    private $tabelaEscritorioModulo = 'kukooDBP.segEscritorioModulo';
    
    
    /**
     * Atribui o hash.
     */
    public function setTabHash($tab_hash) {
        $this->tabelaEscritorioModulo .= $tab_hash;
    }
    
    
    /**
     * Verifica as licenças do escritório para mostrar no Dashboard.
     * 
     * @param  int $escId  ID do Escritório.
     * 
     * @return  As licenças daquele Escritório.
     */
    public function verificarLicencasAtivas($escId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT modId, escmodAtivo FROM '.$this->tabelaEscritorioModulo.' escmod '.
                    'WHERE escmod.escId = ?';
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel, array($escId));
        return $query->result();
    }
    
    
    /**
     * Verifica a licença de um módulo específica do escritório.
     * 
     * @param  int $escId  ID do Escritório.
     * @param  int $modId  ID do Módulo.
     * 
     * @return  A licença do Escritório para aquele módulo.
     */
    public function verificarLicencaAtiva($escId, $modId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT escmodAtivo FROM '.$this->tabelaEscritorioModulo.' escmod '.
                    'WHERE escmod.escId = ? and escmod.modId = ?';
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel, array($escId, $modId));
        $result = $query->row();
        return ($result->escmodAtivo == 1) ? TRUE : FALSE;
    }
    
}
