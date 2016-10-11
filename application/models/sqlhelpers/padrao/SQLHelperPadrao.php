<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object Padrão.
 * 
 * @since     1.0
 * @package   models/padrao
 * @copyright Kukoo
 */
class SQLHelperPadrao extends CI_Model {
    
    
    /**
     * Atribui o hash do Escritório em uma determinada tabela.
     * 
     * @param  array  $pArrTabela  Array com os nomes das tabelas.
     * @param  string $pTabHash    Hash da tabela para identificação do Escritório.
     * @return  As tabelas com o Hash no final.
     */
    public function setTabHash($pArrTabela, $pTabHash) {
        
        // Inicializa o array de tabelas que será retornado.
        $arrTabHash = array();
        
        // Itera o array de tabelas passado por parâmetro e adiciona o Hash a todas elas.
        foreach ($pArrTabela as $tabela) array_push($arrTabHash, ($tabela.$pTabHash));
        
        // Retorna o array de tabelas com Hash.
        return $arrTabHash;
    }
    
    
    /**
     * Retorna o nome da coluna que é PK de uma tabela.
     * 
     * @param	string	$nomeTabela		Nome da tabela.
     * @return	string
     */
    public function getNomeColunaPKTabela($nomeTabela) {
    	
    	// Monta a instrução SQL do nome da PK da tabela.
        $sqlSelPK = 'SELECT COLUMN_NAME '.
                    'FROM INFORMATION_SCHEMA.COLUMNS '.
                    'WHERE TABLE_SCHEMA = ? '.
                    'AND TABLE_NAME = ? '.
                    'AND COLUMN_KEY = ?';
        
        // Executa a instrução e retorna o nome da coluna.
        $query = $this->db->query($sqlSelPK, array('kukooDBP', substr($nomeTabela, 9), 'PRI'));
        $resultPK = $query->row();
        return $resultPK->COLUMN_NAME;
        
    }
    
    
    /**
     * Retorna o próximo ID da tabela passada por parâmetro.
     * 
     * @param   string  $nomeTabela    Nome da tabela a ser buscado o próximo ID.
     * @return  int
     */
    public function getProximoIdTabela($nomeTabela) {
        
        // Pega o nome da coluna PK da tabela.
        $colunaPKTabela = $this->getNomeColunaPKTabela($nomeTabela);
        
        // Monta a instrução SQL para o próximo ID.
        $sqlSel = 'SELECT MAX('.$colunaPKTabela.') proximoID '.
                    'FROM '.$nomeTabela;
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel);
        $result = $query->row();
        return (($result->proximoID == null) ? 1 : ($result->proximoID + 1));
    }
    
    
    /**
     * Retorna a quantidade de registros da tabela passada por parâmetro.
     * 
     * @param   string  $nomeTabela    Nome da tabela a ser buscada a quantidade de registros.
     * @return  int
     */
    public function getQuantidadeRegistrosTabela($nomeTabela) {
        
        // Monta a instrução SQL.
        $sqlSel = 'SELECT count(*) '.
                    'FROM '.$nomeTabela;
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel);
        return $query->row();
    }
    
    
    /**
     * Pega o valor da PK da tabela passada por parâmetro a partir de uma coluna que não é PK.
     * 
     * @param	string	$nomeTabela			Nome da tabela.
     * @param	string	$colunaWhere		Nome da coluna que fará parte da cláusula WHERE.
     * @param	object	$valorColunaWhere	Valor da coluna $colunaWhere.
     * @return	object
     */
    public function getValorPKTabela($nomeTabela, $colunaWhere, $valorColunaWhere) {
    	
    	// Pega o nome da coluna PK da tabela.
        $colunaPKTabela = $this->getNomeColunaPKTabela($nomeTabela);
        
        // Monta a instrução SQL.
        $sqlSel = 'SELECT '.$colunaPKTabela.' PKTabela '.
        			'FROM '.$nomeTabela.' '.
        			'WHERE '.$colunaWhere.' = ?';
        
        // Executa a query e retorna o resultado.
        $query = $this->db->query($sqlSel, array($valorColunaWhere));
        $result = $query->row();
        return $result->PKTabela;
    }
    
}
