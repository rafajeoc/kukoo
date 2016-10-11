<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object de Protocolo.
 * 
 * @since     1.0
 * @package   models/protocolo
 * @copyright Kukoo
 */
class SQLHelperProtocolo extends CI_Model {
    
    
    // Nomes das tabelas.
    private $tabelaProtocolo = 'kukooDBP.proProtocolo';
    private $tabelaCliente = 'kukooDBP.admCliente';
    private $tab_hash;
    
    
    /**
     * Atribui o hash.
     */
    public function setTabHash($tab_hash) {
        $this->tabelaProtocolo .= $tab_hash;
        $this->tabelaCliente .= $tab_hash;
    }
    
    
    /**
     * 
     */
    public function getTabelaProtocolo() {
        return $this->tabelaProtocolo;
    }
    
    
    /**
     * Monta o objeto de Protocolo.
     * 
     * @param  int      $proId           ID do Protocolo.
     * @param  int      $cliId           ID da Cliente.
     * @param  int      $flx_id           ID do Fluxo.
     * @param  datetime $proDtHrEmissao  Data e hora de emissão do protocolo.
     * @param  int      $proImpresso     Indica de o Protocolo já foi impresso.
     * @param  string   $proAssunto      Assunto ao qual o Protocolo se refere.
     * @param  string   $proDescricao    Descrição do Protocolo.
     * 
     * @return  A instância do objeto de Protocolo.
     */
    public function criarProtocolo($proId, $cliId, $flx_id, $proDtHrEmissao, $proImpresso, $proAssunto, $proDescricao) {
        return new ModelProtocolo($proId, $cliId, $flx_id, $proDtHrEmissao, $proImpresso, $proAssunto, $proDescricao);
    }
    
    
    /**
     * Pega todos os Protocolos da tabela.
     * 
     * @return  O array de objetos obtidos do banco de dados, ou null se não achou nada.
     */
    public function get() {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * '.
                    'FROM '.$this->tabelaProtocolo.' pro '.
                    'JOIN '.$this->tabelaCliente.' cli ON pro.cliId = cli.cliId';
        
        // Executa a query.
        $query = $this->db->query($sqlSel);
        $result = $query->result();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Pega um Protocolo pelo seu ID.
     * 
     * @param  int $proId  ID do Protocolo que está sendo buscado.
     * 
     * @return  O objeto do Protocolo obtido do banco de dados, ou null se não achou nada.
     */
    public function get_by_id($proId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * '.
                    'FROM '.$this->tabelaProtocolo.' pro '.
                    'JOIN '.$this->tabelaCliente.' cli ON pro.cliId = cli.cliId '.
                    'WHERE pro.proId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($proId));
        $result = $query->row();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Salva um protocolo no banco de dados.
     * 
     * @param   object $protocolo   Objeto de protocolo.
     * 
     * @return  TRUE se gravou os dados com sucesso, ou FALSE se houve erro.
     */
    public function save($protocolo, $tipoOperacao) {
        
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Insere os dados no banco de dados.
        if ($tipoOperacao == 'i') {
            $this->db->insert($this->tabelaProtocolo, $protocolo);
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
    public function remove($proId) {
        
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Remove os registros das tabelas.
        $this->db->delete($this->tabelaProtocolo, array('proId' => $proId));
        
        // Termina o processamento.
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
    
}
