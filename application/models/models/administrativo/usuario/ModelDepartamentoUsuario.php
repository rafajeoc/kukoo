<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model dos Departamentos do Usuário.
 * 
 * @since     1.0
 * @package   models/administrativo
 * @copyright Kukoo
 */
class ModelDepartamentoUsuario {
    
    
    public $usrId;
    public $dptFiscal;
    public $dptContabil;
    public $dptPessoal;
    public $dptCertAlv;
    public $dptDecFis;
    public $dptDecCtb;
    public $dptDecPes;
    
    
    /**
     * Monta o objeto de Departamentos do Usuário.
     * 
     * @param  int     $usrId        ID do Usuário.
     * @param  boolean $dptFiscal    Indica se usuário tem visualização de assuntos do departamento fiscal.
     * @param  boolean $dptContabil  Indica se usuário tem visualização de assuntos do departamento contábil.
     * @param  boolean $dptPessoal   Indica se usuário tem visualização de assuntos do departamento pessoal.
     * @param  boolean $dptCertAlv   Indica se usuário tem visualização de certidões e alvarás.
     * @param  boolean $dptDecFis    Indica se usuário tem visualização de declarações do dep. fiscal.
     * @param  boolean $dptDecCtb    Indica se usuário tem visualização de declarações do dep. contábil.
     * @param  boolean $dptDecPes    Indica se usuário tem visualização de declarações do dep. pessoal.
     */
    public function ModelDepartamentoUsuario($usrId, $dptFiscal, $dptContabil, $dptPessoal, $dptCertAlv, $dptDecFis, $dptDecCtb, $dptDecPes) {
        $this->usrId = $usrId;
        $this->dptFiscal = $dptFiscal;
        $this->dptContabil = $dptContabil;
        $this->dptPessoal = $dptPessoal;
        $this->dptCertAlv = $dptCertAlv;
        $this->dptDecFis = $dptDecFis;
        $this->dptDecCtb = $dptDecCtb;
        $this->dptDecPes = $dptDecPes;
    }
    
}