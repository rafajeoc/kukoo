<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data Access Object de usuário.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class SQLHelperUsuario extends CI_Model {
    
    
    // Nomes das tabelas.
    private $tabelaUsuario = 'kukooDBP.admUsuario';
    private $tabelaDepartamentoUsuario = 'kukooDBP.admDepartamentoUsuario';
    private $tabelaPermissaoUsuario = 'kukooDBP.admPermissaoUsuario';
    private $tabelaDetalhesLoginUsuario = 'kukooDBP.segDetLoginUsuario';
    private $tab_hash;
    
    
    /**
     * Atribui o hash.
     */
    public function setTabHash($tab_hash) {
        $this->tabelaUsuario .= $tab_hash;
        $this->tabelaDepartamentoUsuario .= $tab_hash;
        $this->tabelaPermissaoUsuario .= $tab_hash;
        $this->tabelaDetalhesLoginUsuario .= $tab_hash;
    }
    
    
    /**
     * Pega o nome da tabela de usuários.
     */
    public function getTabelaUsuario() {
        return $this->tabelaUsuario;
    }
    
    
    /**
     * Pega o nome da tabela de departamentos dos usuários.
     */
    public function getTabelaDepartamentoUsuario() {
        return $this->tabelaDepartamentoUsuario;
    }
    
    
    /**
     * Pega o nome da tabela de permissões dos usuários.
     */
    public function getTabelaPermissaoUsuario() {
        return $this->tabelaPermissaoUsuario;
    }
    
    
    /**
     * Pega o nome da tabela de detalhes de login dos usuários.
     */
    public function getTabelaDetalhesLoginUsuario() {
        return $this->tabelaDetalhesLoginUsuario;
    }
    
    
    /** 
     * Instancia um objeto de usuário.
     * 
     * @param  int    $usrId         ID do usuário.
     * @param  string $usrNome       Nome do usuário.
     * @param  string $usrCPF        CPF do usuário.
     * @param  string $usrEmail      Endereço de e-mail do usuário.
     * @param  string $usrSenha      Senha do usuário.
     * @param  int    $usrAtivo      Indica se o usuário está ativo no sistema.
     * 
     * @return  A instância do objeto de usuário.
     */
    public function criarUsuario($usrId, $usrNome, $usrCPF, $usrEmail, $usrSenha, $usrAtivo) {
        return new ModelUsuario($usrId, $usrNome, $usrCPF, $usrEmail, $usrSenha, $usrAtivo);
    }
    
    
    /**
     * Instancia um objeto de Permissões de usuário.
     * 
     * @param  int $usrId             ID do usuário.
     * @param  int $prmAdministrador  Indica se o usuário é administrador.
     * @param  int $prmGerObrigacoes  Indica se o usuário tem permissão para gerenciar datas de obrigações.
     * @param  int $prmGerClientes    Indica se o usuário tem permissão para gerenciar entidades.
     * @param  int $prmGerProtocolos  Indica se o usuário tem permissão para gerenciar protocolos.
     * 
     * @return  A instância do objeto de Permissões de usuário.
     */
    public function criarPermissaoUsuario($usrId, $prmAdministrador, $prmGerObrigacoes, $prmGerClientes, $prmGerProtocolos) {
        return new ModelPermissaoUsuario($usrId, $prmAdministrador, $prmGerObrigacoes, $prmGerClientes, $prmGerProtocolos);
    }
    
    
    /**
     * Instancia um objeto de Departamentos de usuário.
     * 
     * @param  int     $usrId        ID do usuário.
     * @param  boolean $dptFiscal    Indica se usuário visualiza assuntos relacionados ao departamento fiscal.
     * @param  boolean $dptContabil  Indica se usuário visualiza assuntos relacionados ao departamento contábil.
     * @param  boolean $dptPessoal   Indica se usuário visualiza assuntos relacionados ao departamento pessoal.
     * @param  boolean $dptCertAlv   Indica se usuário visualiza certidões e alvarás.
     * @param  boolean $dptDecFis    Indica se usuário visualiza declarações do departamento fiscal.
     * @param  boolean $dptDecCtb    Indica se usuário visualiza declarações do departamento contábil.
     * @param  boolean $dptDecPes    Indica se usuário visualiza declarações do departamento pessoal.
     * 
     * @return  A instância de objeto de Departamentos do usuário.
     */
    public function criarDepartamentoUsuario($usrId, $dptFiscal, $dptContabil, $dptPessoal, $dptCertAlv, $dptDecFis, $dptDecCtb, $dptDecPes) {
        return new ModelDepartamentoUsuario($usrId, $dptFiscal, $dptContabil, $dptPessoal, $dptCertAlv, $dptDecFis, $dptDecCtb, $dptDecPes);
    }
    
    
    /**
     * Instancia um objeto de Detalhes de Login do usuário.
     * 
     * @param  int     $usrId            ID do usuário.
     * @param  boolean $dluUltimoLogin  Quando foi realizado o último login com sucesso.
     * @param  boolean $dluIpUltLogin   IP do último login.
     * @param  boolean $dluLogado       Indica se o usuário está logado.
     * 
     * @return  A instância do objeto de Detalhes de Login do usuário.
     */
    public function criarDetLoginUsuario($usrId, $dluUltimoLogin, $dluIpUltLogin, $dluLogado) {
        return new ModelDetLoginUsuario($usrId, $dluUltimoLogin, $dluIpUltLogin, $dluLogado);
    }
    
    
    /**
     * Pega todos os usuários.
     * 
     * @return  O array de objetos obtidos do banco de dados, ou null se não achou nada.
     */
    public function get() {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * FROM '.$this->tabelaUsuario.' usr '.
                    'JOIN '.$this->tabelaDepartamentoUsuario.' dpt ON usr.usrId = dpt.usrId '.
                    'JOIN '.$this->tabelaPermissaoUsuario.' prm ON usr.usrId = prm.usrId';
        
        // Executa a query.
        $query = $this->db->query($sqlSel);
        $result = $query->result();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Pega um usuário pelo seu ID.
     * 
     * @param  int $usrId  ID do usuário.
     * 
     * @return  O objeto do usuário obtido do banco de dados, ou null se não achou nada.
     */
    public function get_by_id($usrId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * FROM '.$this->tabelaUsuario.' usr '.
                    'JOIN '.$this->tabelaDepartamentoUsuario.' dpt ON usr.usrId = dpt.usrId '.
                    'JOIN '.$this->tabelaPermissaoUsuario.' prm ON usr.usrId = prm.usrId '.
                    'WHERE usr.usrId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($usrId));
        $result = $query->row();
        
        // Se achou algum resultado, retorna. Se não achou, retorna null.
        return (count($result) > 0 ? $result : null);
    }
    
    
    /**
     * Salva um usuário no banco de dados.
     * 
     * @param  object $usuario              Objeto de usuário.
     * @param  object $permissaoUsuario     Objeto de Permissões de usuário.
     * @param  object $departamentoUsuario  Objeto de Departamentos de usuário.
     * @param  string       $tipoOperacao         Tipo da operação (i = inclusão / a = alteração).
     * 
     * @return  TRUE se gravou os dados com sucesso, ou FALSE se houve erro.
     */
    public function save($usuario, $permissaoUsuario, $departamentoUsuario, $detalhesLoginUsuario, $tipoOperacao) {
        
        // Inicia a transação.
        $this->db->trans_begin();
        
        // Insere os dados do usuário.
        if ($tipoOperacao == 'i') {
            $this->db->insert($this->tabelaUsuario, $usuario);
            $this->db->insert($this->tabelaPermissaoUsuario, $permissaoUsuario);
            $this->db->insert($this->tabelaDepartamentoUsuario, $departamentoUsuario);
            $this->db->insert($this->tabelaDetalhesLoginUsuario, $detalhesLoginUsuario);
        }
        // Altera os dados do usuário (não mexe na tabela de detalhes de Login - é alteração de informações de usuário).
        else {
            $this->db->where('usrId', $usuario->usrId);
            $this->db->update($this->tabelaUsuario, $usuario);
            $this->db->where('usrId', $permissaoUsuario->usrId);
            $this->db->update($this->tabelaPermissaoUsuario, $permissaoUsuario);
            $this->db->where('usrId', $departamentoUsuario->usrId);
            $this->db->update($this->tabelaDepartamentoUsuario, $departamentoUsuario);
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
     * Grava as informações da tentativa de login do usuário.
     * 
     * @param  ModelDetalhesLoginUsuario $detalhesLoginUsuario  Objeto de Detalhes de Login do usuário.
     * 
     * @return  TRUE se realizado com sucesso; FALSE se houve erro.
     */
    public function gravarInformacoesLogin($detalhesLoginUsuario) {
        
        // Grava as informações no banco de dados.
        $this->db->where('usrId', $detalhesLoginUsuarioData->usrId);
        $this->db->update($this->tabelaDetalhesLoginUsuario, $detalhesLoginUsuario);
        
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
     * Verifica se o usuário está ativo no sistema.
     * 
     * @param  int    $usrId     ID do usuário.
     * @param  string $usrSenha  Senha do usuário.
     * 
     * @return  1 se o usuário estiver ativo,
     *          0 se o usuário ou a senha estão incorretos,
     *          -1 se o usuário não estiver ativo.
     */
    public function verificaUsuarioAtivo($usrId, $usrSenha) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT * '.
                    'FROM '.$this->tabelaUsuario.' usr '.
                    'WHERE usr.usrId = ? AND usr.usrSenha = ?';
                
        // Executa a query.
        $query = $this->db->query($sqlSel, array($usrId, $usrSenha));
        $result = $query->row();
        
        // Se a combinação usuário/senha não existir, retorna 0.
        if (count($result) == 0) {
            return 0;
        }
        // Senão, retorna -1 para usuário inativo ou 1 para usuário ativo.
        else {
            if ($result->usrAtivo == 0) {
                return -1;
            } else {
                return 1;
            }
        }
    }
    
    
    /**
     * Pega a senha do usuário.
     * 
     * @param  int $usrId  ID do usuário.
     * 
     * @return  A senha do usuário.
     */
    public function getSenhaUsuario($usrId) {
        
        // Monta o SELECT.
        $sqlSel = 'SELECT usrSenha FROM '.$this->tabelaUsuario.' usr '.
                    'WHERE usr.usrId = ?';
        
        // Executa a query.
        $query = $this->db->query($sqlSel, array($usrId));
        $row = $query->row();
        
        // Se achou algum resultado, retorna; se não achou nada, retorna null.
        return ((count($row) > 0) ? $row->usrSenha : null);
    }
    
}

?>
