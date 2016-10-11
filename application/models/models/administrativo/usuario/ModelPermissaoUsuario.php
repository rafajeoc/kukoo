<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model das Permissões do Usuário.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelPermissaoUsuario {
    
    
    public $usrId;
    public $prmAdministrador;
    public $prmGerObrigacoes;
    public $prmGerClientes;
    public $prmGerProtocolos;
    
    
    /**
     * Monta o objeto de Permissões do Usuário.
     * 
     * @param  int $usrId             ID do Usuário.
     * @param  int $prmAdministrador  Indica se o Usuário é administrador.
     * @param  int $prmGerObrigacoes  Indica se o Usuário tem permissão para gerenciar obrigações.
     * @param  int $prmGerClientes    Indica se o Usuário tem permissão para gerenciar clientes.
     * @param  int $prmGerProtocolos  Indica se o Usuário tem permissão para gerenciar protocolos.
     */
    public function ModelPermissaoUsuario($usrId, $prmAdministrador, $prmGerObrigacoes, $prmGerClientes, $prmGerProtocolos) {
        $this->usrId = $usrId;
        $this->prmAdministrador = $prmAdministrador;
        $this->prmGerObrigacoes = $prmGerObrigacoes;
        $this->prmGerClientes = $prmGerClientes;
        $this->prmGerProtocolos = $prmGerProtocolos;
    }
    
}