<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object para operações com Cliente e Cliente/Obrigação.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class SQLHelperCliente extends CI_Model {
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------ ATRIBUTOS E CONSTRUTOR ------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Variável para guardar o nome da tabela de entidades.
     * 
     * @var string
     */
    private $tabelaCliente = 'kukooDBP.admCliente';
    
    /**
     * Variável para guardar o nome da tabela de entidades/obrigações.
     * 
     * @var string
     */
    private $tabelaClienteObrigacaoData = 'kukooDBP.admClienteObrigacaoData';
    
    /**
     * Variável para guardar o nome da tabela de obrigações.
     * 
     * @var string
     */
    private $tabelaObrigacao = 'kukooDBP.triObrigacao';
    
    /**
     * Variável para guardar o nome da tabela de regime de tributação.
     * 
     * @var	string
     */
    private $tabelaRegimeTributacao = 'kukooDBP.triRegimeTributacao';
    
    
    /**
     * Construtor da classe
     * 
     * @return  void.
     */
    public function __construct() {
    	parent::__construct();
    	
    	// Seta o hash para as tabelas relacionadas com este SQL Helper.
    	$hashTabela = $_SESSION['h'];
        $this->tabelaCliente .= $hashTabela;
        $this->tabelaClienteObrigacaoData .= $hashTabela;
        $this->tabelaObrigacao .= $hashTabela;
    }
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------ FUNÇÕES GET ------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Função get da variável $tabelaCliente.
     * 
     * @return	string
     */
    public function getTabelaCliente() {
        return $this->tabelaCliente;
    }
    
    
    /**
     * Função get da variável $tabelaClienteObrigacaoData.
     * 
     * @return	string
     */
    public function getTabelaClienteObrigacaoData() {
        return $this->tabelaClienteObrigacaoData;
    }
    
    
    /**
     * Função get da variável $tabelaObrigacao.
     * 
     * @return	string
     */
    public function getTabelaObrigacao() {
    	return $this->tabelaObrigacao;
    }
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Monta o objeto de Cliente.
     * 
     * @param  int    $cliId			Id da Cliente.
     * @param  string $cliRazaoSocial	Razão social da Cliente.
     * @param  string $cli_nomefantasia	Nome fantasia da Cliente.
     * @param  string $cli_cpfcnpj      CPF ou CNPJ da Cliente.
     * @param  string $cli_email        Endereço de e-mail da Cliente.
     * @param  string $cli_telefone1    Telefone 1 da Cliente.
     * @param  string $cli_telefone2    Telefone 2 da Cliente.
     * @param  string $cli_cep          CEP da Cliente.
     * @param  string $cli_logradouro   Logradouro da Cliente.
     * @param  int    $cli_numero       Número do logradouro da Cliente.
     * @param  string $cli_complemento  Complemento do logradouro da Cliente.
     * @param  string $cli_bairro       Bairro da Cliente.
     * @param  string $cli_municipio    Município da Cliente.
     * @param  string $cli_UF           UF da Cliente.
     * @param  int    $cli_ativa        Indica se a Cliente está ativa ou não.
     * @param  int    $rgtId            Id do regime de tributação da Cliente.
     * 
     * @return  A instância do objeto de Cliente.
     */
    public function criarCliente($cliId, $cliRazaoSocial, $cliNomeFantasia, $cliCPFCNPJ, $cliEmail, $cliTelefone1, $cliTelefone2, $cliCEP, $cliLogradouro,
    		$cliNumero, $cliComplemento, $cliBairro, $cliMunicipio, $cliUF, $cliAtivo, $rgtId) {
        return new ModelCliente($cliId, $cliRazaoSocial, $cliNomeFantasia, $cliCPFCNPJ, $cliEmail, $cliTelefone1, $cliTelefone2, $cliCEP, $cliLogradouro,
    		$cliNumero, $cliComplemento, $cliBairro, $cliMunicipio, $cliUF, $cliAtivo, $rgtId);
    }
    
    
    /**
     * Monta o objeto de Cliente/Imposto.
     * 
     * @param  int $cliodtId         Id da relação entre Cliente e Imposto.
     * @param  int $cliId            Id da Cliente.
     * @param  int $odtId            Id do Imposto.
     * @param  int $cliodtDiaLimite  Dia limite para envio do Imposto ao cliente.
     * 
     * @return  A instância do objeto de Cliente/Imposto.
     */
    public function criarClienteObrigacaoData($cliodtId, $cliId, $odtId, $cliodtDiaLimite, $cliodtMesLimite, $cliodtAnoLimite, $cliodtProxDiaLimite, $cliodtProxMesLimite, $cliodtProxAnoLimite) {
        return new ModelClienteObrigacaoData($cliodtId, $cliId, $odtId, $cliodtDiaLimite, $cliodtMesLimite, $cliodtAnoLimite, $cliodtProxDiaLimite, $cliodtProxMesLimite, $cliodtProxAnoLimite);
    }
    
    
    /**
     * Pega todas as Clientes da tabela.
     * 
     * @return  O array de objetos obtidos do banco de dados, ou null se não achou nada.
     */
    public function get() {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * FROM '.$this->tabelaCliente.' cli '.
                    'JOIN '.$this->tabelaRegimeTributacao.' rgt ON cli.rgtId = rgt.rgtId';
        
        // Executa a query.
        $query = $this->db->query($sqlSel);
        $result = $query->result();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Pega uma Cliente pelo seu Id.
     * 
     * @param  int $cliId  Id da entidade que está sendo buscada.
     * 
     * @return  O objeto da Cliente obtido do banco de dados, ou null se não achou nada.
     */
    public function get_by_id($cliId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * FROM '.$this->tabelaCliente.' cli '.
                    'JOIN '.$this->tabelaClienteObrigacaoData.' cliodt ON cli.cliId = cliodt.cliId '.
                    'JOIN '.$this->tabelaObrigacao.' obr ON cliodt.obrId = obr.obrId '.
                    'JOIN '.$this->tabelaRegimeTributacao.' rgt ON cli.rgtId = rgt.rgtId '.
                    'WHERE cli.cliId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($cliId));
        $result = $query->result();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Salva um Usuário no banco de dados.
     * 
     * @param   object $cliente                        Objeto da entidade.
     * @param   array  $arrClienteObrigacaoInc         Array das obrigações a serem inseridas no banco de dados.
     * @param   array  $arrayClienteObrigacaoRemId     Array que guarda os IDs das obrigações a serem removidas daquela entidade.
     * @param   string $tipoOperacao                    Variável que indica qual é o tipo de operação (i = inclusão / a = alteração).
     * 
     * @return  TRUE se gravou os dados com sucesso, ou FALSE se houve erro.
     */
    public function save($cliente, $arrClienteObrigacaoInc, $arrClienteObrigacaoRemId, $tipoOperacao) {
        
        // Inicia a transação e salva os dados da entidade de qualquer forma.
        $this->db->trans_begin();
        $this->saveCliente($cliente, $tipoOperacao);
        
        // Verifica se houve alteração nas obrigações; em caso positivo, chama a function saveClienteObrigacao para tratar isso.
        if (($arrClienteObrigacaoInc != null) || ($arrClienteObrigacaoRemId)) {
            $this->saveClienteObrigacao($cliente->cliId, $arrClienteObrigacaoInc, $arrClienteObrigacaoRemId, $tipoOperacao);
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
    
    
    /**
     * Grava os dados da Cliente.
     * 
     * @param   object $cliente        Objeto de entidade.
     * @param   string $tipoOperacao    Tipo da operação (i = inclusão / a = alteração).
     */
    public function saveCliente($cliente, $tipoOperacao) {
        
        // Se for inclusão,
        if ($tipoOperacao == 'i') {
            $this->db->insert($this->tabelaCliente, $cliente);
        }
        // Senão, é alteração.
        else if ($tipoOperacao == 'a') {
            $this->db->where('cliId', $cliente->cliId);
            $this->db->update($this->tabelaCliente, $cliente);
        }
    }
    
    
    /**
     * Grava os dados de Cliente/Imposto da Cliente.
     * 
     * @param   object $idCliente                      Id da entidade.
     * @param   array  $arrClienteObrigacaoInc         Array das obrigações a serem inseridas no banco de dados.
     * @param   array  $arrayClienteObrigacaoRemId     Array que guarda os IDs das obrigações a serem removidas daquela entidade.
     * @param   string $tipoOperacao                    Variável que indica qual é o tipo de operação (i = inclusão / a = alteração).
     */
    public function saveClienteObrigacao($idCliente, $arrClienteObrigacaoInc, $arrClienteObrigacaoRemId, $tipoOperacao) {
        
        // Se for inclusão, insere as obrigações normalmente.
        if ($tipoOperacao == 'i') {
            
            // Realiza o insert para cada um das obrigações.
            foreach ($arrClienteObrigacaoInc as $arrClienteObrigacaoIncItem) {
                list($proxDiaLimite, $proxMesLimite, $proxAnoLimite) = $this->calcularProximaDataLimite($arrClienteObrigacaoIncItem);
                $arrClienteObrigacaoIncItem->cliodtProxDiaLimite = $proxDiaLimite;
                $arrClienteObrigacaoIncItem->cliodtProxMesLimite = $proxMesLimite;
                $arrClienteObrigacaoIncItem->cliodtProxAnoLimite = $proxAnoLimite;
                $this->db->insert($this->tabelaClienteObrigacaoData, $arrClienteObrigacaoIncItem);
            }
        }
        // Senão, precisa mexer nas obrigações.
        else {
            
            // Primeiro, vamos verificar se existe algum imposto para ser removido.
            if (count($arrClienteObrigacaoRemId) > 0) {
                
                // Se existir, remove as obrigações daquela entidade que estão no array de remoção.
                foreach ($arrClienteObrigacaoRemId as $arrClienteObrigacaoRemIdItem) {
                    $this->db->where('cliId', $idCliente);
                    $this->db->where('obrId', $arrClienteObrigacaoRemIdItem);
                    $this->db->delete($this->tabelaClienteObrigacaoData);
                }
            }
            
            // Depois, vamos ver se existe algum imposto a ser incluído/alterado.
            if (count($arrClienteObrigacaoInc) > 0) {
                
                // Percorre todo o vetor de inclusão.
                foreach ($arrClienteObrigacaoInc as $arrClienteObrigacaoIncItem) {
                    
                    // Calcula a próxima data limite.
                    list($proxDiaLimite, $proxMesLimite, $proxAnoLimite) = $this->calcularProximaDataLimite($arrClienteObrigacaoIncItem);
                    $arrClienteObrigacaoIncItem->cliodtProxDiaLimite = $proxDiaLimite;
                    $arrClienteObrigacaoIncItem->cliodtProxMesLimite = $proxMesLimite;
                    $arrClienteObrigacaoIncItem->cliodtProxAnoLimite = $proxAnoLimite;
                    
                    // Verifica se, para este item, já existe algum correspondente na base; se existir, altera.
                    if ($this->verificaClienteObrigacaoDataExistente($arrClienteObrigacaoIncItem)) {
                        $this->db->where('cliodtId', $arrClienteObrigacaoIncItem->cliodtId);
                        $this->db->update($this->tabelaClienteObrigacaoData, $arrClienteObrigacaoIncItem);
                    }
                    // Senão, insere no banco de dados.
                    else {
                        $this->db->insert($this->tabelaClienteObrigacaoData, $arrClienteObrigacaoIncItem);
                    }
                }
            }
        }
    }
    
    
    /**
     * 
     */
    public function calcularProximaDataLimite($clienteObrigacaoData) {
        
        // Busca as informações a respeito da obrigação na tabela de obrigações.
        $sqlSel = 'SELECT obrRepeticao, obrDataMovel '.
                    'FROM '.$this->tabelaObrigacao.' obr '.
                    'WHERE obr.obrId = ?';
        
        $query = $this->db->query($sqlSel, array('obrId' => $clienteObrigacaoData->obrId));
        $row = $query->row();
        
        // Verifica se a data é movel, para calcular corretamente com base no valor atualizado.
        if ($row->obrDataMovel == 1) {
            
            // Cria o objeto de data para deixar que o PHP calcule, para não correr risco de calcular errado.
            $proximaData = new DateTime();
            $proximaData->setDate($clienteObrigacaoData->cliodtAnoLimite, $clienteObrigacaoData->cliodtMesLimite, $clienteObrigacaoData->cliodtDiaLimite);
            
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
            return array($clienteObrigacaoData->cliodtDiaLimite, $clienteObrigacaoData->cliodtMesLimite, ($clienteObrigacaoData->cliodtAnoLimite + $row->obrRepeticao));
        }
        
    }
    
    
    /**
     * Verifica se a entidade está ativa no sistema.
     * 
     * @param  int $cliId  O Id da entidade.
     * 
     * @return  1 se a entidade estiver ativa,
     *          0 se o entidade estiver inativa,
     *          -1 se houve erro.
     */
    public function verificaClienteAtiva($cliId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT cliAtivo '.
                    'FROM '.$this->tabelaCliente.' cli '.
                    'WHERE cli.cliId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($cliId));
        $result = $query->row();
        
        // Se achou algum resultado, retorna. Se não achou, retorna -1.
        return (count($result) > 0 ? $result->cliAtivo : -1);
    }

    
    
    /**
     * Verifica quantos Impostos existem para determinada Cliente.
     * 
     * @param  int $cliId  O Id da Cliente.
     * 
     * @return  A quantidade de obrigações que aquela entidade tem.
     */
    public function getQuantidadeClienteObrigacaoData($cliId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT count(cliodtId) as count_cliodtId '.
                    'FROM '.$this->tabelaClienteObrigacaoData.' cliodt '.
                    'WHERE cliodt.cliId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($cliId));
        $result = $query->row();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result->count_cliodtId : null);
    }
    
    
    /**
     * Verifica se determinada relação Cliente/Obrigação existe para determinada Cliente.
     * 
     * @param  ModelClienteObrigacao $clienteObrigacao  Objeto de Cliente/Obrigação.
     * 
     * @return  TRUE se existir a relação Cliente/Imposto, e FALSE se não existir.
     */
    public function verificaClienteObrigacaoDataExistente($clienteObrigacao) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT count(*) as cliodt_existe FROM '.$this->tabelaClienteObrigacaoData.' cliodt '.
                    'WHERE cliodt.cliId = ? AND cliodt.obrId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($clienteObrigacao->cliId, $clienteObrigacao->obrId));
        $result = $query->row();
        
        // Se achou o resultado, retorna true. Se não achou, retorna false.
        return (count($result) > 0)
            ? (($result->cliodt_existe > 0) ? true : false)
            : false;
    }
    
    
    /**
     * Carrega as entidades de forma básica para popular um select, apenas com código e razão social.
     * 
     * @return  Um array contendo as Clientes com Id e razão social.
     */
    public function carregarClientesProtocolo() {
        
        // Monta a instrução SQL.
        $sqlSel = 'SELECT cliId, cliRazaoSocial '.
                    'FROM '.$this->tabelaCliente.' cli '.
                    'ORDER BY cliRazaoSocial asc';
        
        // Executa a query e retorna os resultados.
        $query = $this->db->query($sqlSel);
        $result = $query->result();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
}

?>
