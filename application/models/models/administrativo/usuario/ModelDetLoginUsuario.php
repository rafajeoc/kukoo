<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model dos Detalhes de Login do Usuário.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelDetLoginUsuario {
    
    
    public $usrId;
    public $dluUltimoLogin;
    public $dluIpUltLogin;
    public $dluLogado;
    
    
    /**
     * Monta o objeto de Departamentos do Usuário.
     * 
     * @param  int     $usrId           ID do Usuário.
     * @param  boolean $dluUltimoLogin  Quando foi realizado o último login com sucesso.
     * @param  boolean $dluIpUltLogin   IP do último login.
     * @param  boolean $dluLogado       Indica se o Usuário está logado.
     */
    public function ModelDetLoginUsuario($usrId, $dluUltimoLogin, $dluIpUltLogin, $dluLogado) {
        $this->usrId = $usrId;
        $this->dluUltimoLogin = $dluUltimoLogin;
        $this->dluIpUltLogin = $dluIpUltLogin;
        $this->dluLogado = $dluLogado;
    }
    
}