<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object de Escritório.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class SQLHelperEscritorio extends CI_Model {
    
    // Nome da tabela
    private $tabela = 'kukooDBP.admEscritorio';
    
    /**
     * Pega um usuário pelo seu ID.
     */
    function get_by_id($id) {
        return $this->db->get_where($this->tabela, array('escId' => $id));
    }
    
    /**
     * Verifica se o escritório está ativo.
     */
    function verificaEscritorioAtivo($id) {
        $this->db->select("escAtivo");
        $result = $this->db->get_where($this->tabela, array('escId' => $id));
        
        // Se achou algum resultado
        if ($result->num_rows() > 0) {
            return $result->result_array()[0]['escAtivo'];
        // Senão, deu algum erro.
        } else {
            return -1;
        }
    }
    
}

?>
