<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das utilidades de Model.
 * 
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/padrao
 * @copyright   Kukoo
 */
class ControllerUtilidadesCIModel extends CI_Controller {
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    /**
     * Carrega os SQLHelpers passados por parâmetro, e retorna um array com o objeto de cada um.
     * A ordem em que os SQLHelpers forem passados na chamada será a ordem em que a função devolverá os objetos.
     * 
     * @param   array  $arraySQLHelper     Array de DAOs a serem carregados.
     * @return  array
     */
    public function carregarSQLHelper($arraySQLHelper) {
        
        $arraySQLHelperRetorno = array();
        
        // Para cada um dos DAOs do parâmetro:
        foreach ($arraySQLHelper as $arraySQLHelperItem) {
            
            // Carrega o DAO passado por parâmetro.
            $this->load->model($arraySQLHelperItem);
            
            /* Só carrega SQLHelpers válidos do sistema - senão, cria objeto nulo.
                Além disso, seta o hash de tabela do respectivo SQLHelper e adiciona no array somente se forem
                tabelas específicas do ambiente do escritório; para as gerais não seta TabHash. */
            if ($arraySQLHelperItem == 'sqlhelpers/administrativo/SQLHelperUsuario') {
                $sqlHelper = $this->SQLHelperUsuario;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/administrativo/SQLHelperCliente') {
                $sqlHelper = $this->SQLHelperCliente;
                //$sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/tributacao/SQLHelperObrigacaoTri') {
                $sqlHelper = $this->SQLHelperObrigacaoTri;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/contabilidade/SQLHelperAgenda') {
                $sqlHelper = $this->SQLHelperAgenda;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/contabilidade/SQLHelperObrigacaoCtb') {
                $sqlHelper = $this->SQLHelperObrigacaoCtb;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/protocolo/SQLHelperProtocolo') {
                $sqlHelper = $this->SQLHelperProtocolo;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/padrao/seguranca/SQLHelperSeguranca') {
                $sqlHelper = $this->SQLHelperSeguranca;
                $sqlHelper->setTabHash($_SESSION['h']);
            } else if ($arraySQLHelperItem == 'sqlhelpers/administrativo/SQLHelperEscritorio') {
                $sqlHelper = $this->SQLHelperEscritorio;
            } else if ($arraySQLHelperItem == 'sqlhelpers/padrao/seguranca/SQLHelperEH') {
                $sqlHelper = $this->SQLHelperEH;
            } else if ($arraySQLHelperItem == 'sqlhelpers/padrao/SQLHelperPadrao') {
                $sqlHelper = $this->SQLHelperPadrao;
            } else {
                $sqlHelper = null;
            }
            
            // Coloca o SQLHelper carregado no array.
            array_push($arraySQLHelperRetorno, $sqlHelper);
        }
        
        return $arraySQLHelperRetorno;
    }
    
    
}