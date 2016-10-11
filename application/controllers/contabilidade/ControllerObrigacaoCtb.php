<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o controller das obrigações.
 * 
 * @author    Rafael Cantoni Augusto
 * @since     1.0
 * @package   controllers/contabilidade/obrigacao
 * @copyright Kukoo
 */
class ControllerObrigacaoCtb extends CI_Controller {
    
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    
    /**
     * Lista todas as obrigações enviadas aos clientes.
     */
    public function listarObrigacoes() {
    
    	// Prepara o controller para utilização.
    	list($ctlPadrao) = $this->prepararController(false, false, false);
    	list($sqlHelperUsuario, $sqlHelperObrigacaoCtb) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/contabilidade/SQLHelperObrigacaoCtb')
        );
        
        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $sqlHelperUsuario->get_by_id($_SESSION['usrId']);
        
        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            $data['licencaAtiva'] = 'S';
            
            // Busca as obrigações enviadas aos clientes.
            $data['obrigacoesEnviadas'] = $sqlHelperObrigacaoCtb->get();
        }
    	
    	// Carrega as views.
        $arrayViews = array('padrao/header', 'contabilidade/obrigacoes_enviadas', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    
    /**
     * Apaga uma obrigação enviada a uma entidade do banco de dados.
     * 
     * @param	int	$obreodId	ID da obrigação.
     */
    public function apagarObrigacaoEnviada($cliId, $obrcodId) {
    	
    	// Prepara o controller para utilização.
        list($ctlPadrao) = $this->prepararController(false, false, false);
        
        // Instancia os SQL Helpers.
        list($sqlHelperObrigacaoCtb) = $ctlPadrao->carregarSQLHelper(
        	array('sqlhelpers/contabilidade/SQLHelperObrigacaoCtb')
        );
        
        // Remove a obrigação das tabelas relacionadas a ela e remove o arquivo do servidor.
        $hashArquivo = $sqlHelperObrigacaoCtb->getHashArquivo($obrcodId);
        $diretorio = '/home/ubuntu/workspace/uploads/'.hash('sha256', ($_SESSION['escId'].'_'.$cliId)).'/';
        $sqlHelperObrigacaoCtb->remove($obrcodId);
        unlink($diretorio . $hashArquivo . '.pdf');
        
        // Redireciona de volta para a tela de obrigações enviadas.
        redirect(base_url().'obrigacoes-enviadas');
    }
    
    
    /**
     * Realiza o download do arquivo com os hashes passados por parâmetro.
     * 
     * @param   string $hashEntidade    Hash da entidade.
     * @param   string $hashArquivo     Hash do arquivo.
     */
    public function baixarArquivo($hashEntidade, $hashArquivo) {
        
        // Inclui o script de utilidades e realiza o download.
        require_once APPPATH.'utilidades/UtilidadesDownload.php';
        $utilidadesDownload = new UtilidadesDownload();
        $utilidadesDownload->baixarArquivo($hashEntidade, $hashArquivo);
        
    }
    
}

?>
