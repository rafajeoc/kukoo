<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object da Agenda.
 * 
 * @since     1.0
 * @package   models/contabilidade
 * @copyright Kukoo
 */
class SQLHelperAgenda extends CI_Model {
    
    
    // Nome da tabela
    private $tabelaAgendaObrigacao = 'kukooDBP.ctbAgendaObrigacao';
    private $tabelaObrigacaoClienteOdt = 'kukooDBP.ctbObrigacaoClienteOdt';
    private $tabelaCliente = 'kukooDBP.admCliente';
    private $tabelaClienteObrigacaoData = 'kukooDBP.admClienteObrigacaoData';
    private $tabelaObrigacaoData = 'kukooDBP.triObrigacaoData';
    private $tabelaObrigacao = 'kukooDBP.triObrigacao';
    
    
    /**
     * Atribui o hash. PASSAR PARA O CONTROLLER PADRÃO
     */
    public function setTabHash($tabHash) {
        $this->tabelaAgendaObrigacao .= $tabHash;
        $this->tabelaObrigacaoClienteOdt .= $tabHash;
        $this->tabelaCliente .= $tabHash;
        $this->tabelaClienteObrigacaoData .= $tabHash;
        $this->tabelaObrigacaoData .= $tabHash;
        $this->tabelaObrigacao .= $tabHash;
    }
    
    
    /**
     * 
     */
    public function getTabelaAgendaObrigacao() {
        return $this->tabelaAgendaObrigacao;
    }
    
    
    /**
     * 
     */
    public function getTabelaObrigacaoClienteOdt() {
        return $this->tabelaObrigacaoClienteOdt;
    }
    
    
    /**
     * Monta a agenda.
     * 
     * @param
     */
    public function get($mesAtual) {
        
        // Monta a instrução SQL.
        $sqlSel = 'SELECT cli.cliId, cli.cliRazaoSocial, cli.cliEmail, cliodt.cliodtId, obr.*, '.
						'cliodt.cliodtDiaLimite, cliodt.cliodtMesLimite, cliodt.cliodtAnoLimite, agnobr.* '.
                    'FROM '.$this->tabelaCliente.' cli '.
                    'JOIN '.$this->tabelaClienteObrigacaoData.' cliodt ON cli.cliId = cliodt.cliId '.
                    'LEFT JOIN '.$this->tabelaObrigacaoClienteOdt.' obrcod ON cliodt.cliodtId = obrcod.cliodtId '.
                    'LEFT JOIN '.$this->tabelaAgendaObrigacao.' agnobr ON obrcod.obrcodId = agnobr.obrcodId '.
                    'JOIN '.$this->tabelaObrigacaoData.' odt ON cliodt.obrId = odt.obrId '.
                    'JOIN '.$this->tabelaObrigacao.' obr ON odt.obrId = obr.obrId '.
                    'WHERE cli.cliAtivo = 1 '.
                    'AND (cliodt.cliodtMesLimite IS NULL or cliodt.cliodtMesLimite <= ?) '.
                    'AND obrcod.obrcodId IS NULL '.
                    'ORDER BY cliodt.cliodtDiaLimite ASC, cli.cliRazaoSocial ASC';
        
        // Executa a query e retorna os resultados.
        $query = $this->db->query($sqlSel, array($mesAtual));
        $result = $query->result();
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Grava as informações no banco de dados.
     * Retorna TRUE se gravado com sucesso, ou FALSE se houve erro.
	 *
	 * @param	object	$obrigacaoClienteOdt	Objeto de Obrigação/Cliente Obrigação Data.
	 * @param	object	$agendaObrigacao		Objeto de Agenda/Obrigação.
	 * @param	string	$tipoOperacao			Tipo da operação (i = inclusão / a = alteração).
	 * @return	boolean
     */
    public function save($obrigacaoClienteOdt, $agendaObrigacao, $tipoOperacao) {
        
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Grava os valores no banco de dados de acordo com a operação.
        if ($tipoOperacao == 'i') {
            $this->db->insert($this->tabelaObrigacaoClienteOdt, $obrigacaoClienteOdt);
            $this->db->insert($this->tabelaAgendaObrigacao, $agendaObrigacao);
        }
        
        // Termina o processamento.
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            return TRUE;
        } else {
            $this->db->trans_rollback();
            return FALSE;
        }
    }
    
}

?>
