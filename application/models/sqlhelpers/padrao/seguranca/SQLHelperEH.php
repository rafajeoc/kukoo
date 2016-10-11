<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe de acesso ao banco para lidar com as informações de login e redirecionamento de tabelas.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class SQLHelperEH extends CI_Model {
    
    
    private $tabela = 'kukooDBP.segEH';
    
    
    /**
     * A função getHash é onde o ponto de entrada para definir qual é o escritório. Para um usuário
     * logar no sistema, ele precisa acessar o ambiente do seu escritório através de um usuário e
     * senha compartilhados entre os usuários daquele escritório. O sistema, então, obtém o hash e
     * determina para qual conjunto de tabelas deve olhar.
     */
    function getHash($e, $p) {
        $this->db->select("CONCAT('_', h) as h");
        $this->db->where(array('e' => $e, 'p' => hash('sha256', $p))); 
        $result = $this->db->get($this->tabela);
        if ($result->num_rows() > 0) {
            return $result->result_array()[0]['h'];
        } else {
            return "";
        }
    }
    
}

?>
