<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model de Usuário.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelUsuario {
    
    
    public $usrId;
    public $usrNome;
    public $usrCPF;
    public $usrEmail;
    public $usrSenha;
    public $usrAtivo;
    
    
    /**
     * Constrói o objeto de Usuário.
     * 
     * @param  int    $usrId     ID do Usuário.
     * @param  string $usrNome   Nome do Usuário.
     * @param  string $usrCPF    CPF do Usuário.
     * @param  string $usrEmail  Endereço de e-mail do Usuário.
     * @param  string $usrSenha  Senha do Usuário.
     * @param  int    $usrAtivo  Indica se o Usuário está ativo no sistema.
     */
    public function ModelUsuario($usrId, $usrNome, $usrCPF, $usrEmail, $usrSenha, $usrAtivo) {
        $this->usrId = $usrId;
        $this->usrNome = $usrNome;
        $this->usrCPF = $usrCPF;
        $this->usrEmail = $usrEmail;
        $this->usrSenha = $usrSenha;
        $this->usrAtivo = $usrAtivo;
    }
    
      
}

?>