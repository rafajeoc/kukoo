<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model da Entidade.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelCliente {
    
    
    public $cliId;
    public $cliRazaoSocial;
    public $cliNomeFantasia;
    public $cliCPFCNPJ;
    public $cliEmail;
    public $cliTelefone1;
    public $cliTelefone2;
    public $cliCEP;
    public $cliLogradouro;
    public $cliNumero;
    public $cliComplemento;
    public $cliBairro;
    public $cliMunicipio;
    public $cliUF;
    public $cliAtivo;
    public $rgtId;
    
    
    /**
     * Monta o objeto de Entidade.
     * 
     * @param  int    $cliId            ID da Entidade.
     * @param  string $cliRazaoSocial   Razão social da Entidade.
     * @param  string $cliNomeFantasia  Nome fantasia da Entidade.
     * @param  string $cliCPFCNPJ       CPF ou CNPJ da Entidade.
     * @param  string $cliEmail         Endereço de e-mail de contato da Entidade.
     * @param  string $cliTelefone1     Telefone 1 da Entidade.
     * @param  string $cliTelefone2     Telefone 2 da Entidade.
     * @param  int    $cliCEP           CEP da Entidade.
     * @param  string $cliLogradouro    Logradouro da Entidade.
     * @param  int    $cliNumero        Número no logradouro da Entidade.
     * @param  string $cliComplemento   Complemento do logradouro da Entidade.
     * @param  string $cliBairro        Bairro da Entidade.
     * @param  string $cliMunicipio     Município da Entidade.
     * @param  string $cliUF            UF da Entidade.
     * @param  int    $cliAtivo         Indica se a Entidade está ativa ou não no sistema.
     * @param  int    $rgtId            ID do regime de tributação da Entidade.
     */
    public function ModelCliente($cliId, $cliRazaoSocial, $cliNomeFantasia, $cliCPFCNPJ, $cliEmail, $cliTelefone1, $cliTelefone2, $cliCEP, $cliLogradouro, $cliNumero,
            $cliComplemento, $cliBairro, $cliMunicipio, $cliUF, $cliAtivo, $rgtId) {
        $this->cliId = $cliId;
        $this->cliRazaoSocial = $cliRazaoSocial;
        $this->cliNomeFantasia = $cliNomeFantasia;
        $this->cliCPFCNPJ = $cliCPFCNPJ;
        $this->cliEmail = $cliEmail;
        $this->cliTelefone1 = $cliTelefone1;
        $this->cliTelefone2 = $cliTelefone2;
        $this->cliCEP = $cliCEP;
        $this->cliLogradouro = $cliLogradouro;
        $this->cliNumero = $cliNumero;
        $this->cliComplemento = $cliComplemento;
        $this->cliBairro = $cliBairro;
        $this->cliMunicipio = $cliMunicipio;
        $this->cliUF = $cliUF;
        $this->cliAtivo = $cliAtivo;
        $this->rgtId = $rgtId;
    }
    
}

?>