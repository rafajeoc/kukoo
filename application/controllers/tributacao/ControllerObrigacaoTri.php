<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o controller das obrigações.
 * 
 * @author    Rafael Cantoni Augusto
 * @since     1.0
 * @package   controllers/tributacao
 * @copyright Kukoo
 */
class ControllerObrigacaoTri extends CI_Controller {
    
    
    /**
     * Chama a página de listagem de obrigações.
     */
    public function obrigacoes() {
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario, $modelObrigacao) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/tributacao/SQLHelperObrigacaoTri')
        );
        
        // Pega o Usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
        
        // Verifica se a licença está ativa.
        $licencaAtiva = $controllerPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';
        
            // Pega a lista de obrigacoes.
            $data['obrigacoes'] = $modelObrigacao->get();
        }
        
        // Carrega as views.
        $arrayViews = array('padrao/header', 'tributacao/obrigacoes', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    /**
     * Chama a página de dados da obrigação.
     * 
     * @param   
     */
    public function dadosObrigacao($obrId)
    {
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario, $modelObrigacao) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/tributacao/SQLHelperObrigacaoTri')
        );
        
        // Pega o Usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
        
        // Verifica se a licença está ativa.
        $licencaAtiva = $controllerPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';
            
            // Pega o tipo da operação que está sendo realizada.
            $data['tipoOperacao'] = ($this->input->post('btnDadosObrigacao') != '') ? 'i' : 'a';
            
            // Se for alteração, carrega os dados da obrigação.
            if ($data['tipoOperacao'] == 'a') {
            
                // Seta as variáveis para imprimir de forma correta na tela.
                $obrigacao = $modelObrigacao->get_by_id($obrId);
                
                $data['obrId'] = $obrigacao->obrId;
                $data['obrNome'] = $obrigacao->obrNome;
                $data['obrTipoObr'] = $obrigacao->obrTipoObr;
                $data['obrPeriodo'] = $obrigacao->obrPeriodo;
                $data['obrTipoData'] = $obrigacao->obrPeriodo . strval($obrigacao->obrRepeticao);
                $data['obrDptResp'] = $obrigacao->obrDptResp;
                
                if ($obrigacao->obrPeriodo == 'M' && $obrigacao->obrRepeticao == 1) {
                    $data['obrDataLimite'] = $obrigacao->odtDiaLimite;
                } else {
                    $data['obrDataLimite'] = $obrigacao->odtDiaLimite.'/'.$obrigacao->odtMesLimite.'/'.$obrigacao->odtAnoLimite;
                }
                
                $data['obrDataMovelChecked'] = ($obrigacao->obrDataMovel == 1) ? 'checked' : 'unchecked';
            }
            // Se for inclusão, carrega as variáveis com valores vazios e nulos.
            else {
                $data['obrId'] = $controllerPadrao->getProximoIdTabela($modelObrigacao->getTabelaObrigacao());
                $data['obrNome'] = '';
                $data['obrTipoObr'] = 'E'; // Novas obrigações sempre vão como específicas
                $data['obrTipoData'] = 'M1';
                $data['obrPeriodo'] = '';
                $data['obrRepeticao'] = '';
                $data['obrDptResp'] = '11';
                $data['obrDataLimite'] = '';
                $data['obrDataMovelChecked'] = 'unchecked';
            }
            
        }
        
        // Carrega as views.
        $arrayViews = array('padrao/header', 'tributacao/dadosObrigacao', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    /**
     * Grava os dados da obrigação no banco de dados.
     */
    public function gravarDados()
    {
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'models/models/tributacao/ModelObrigacao.php';
        require_once APPPATH.'models/models/tributacao/ModelObrigacaoData.php';
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelObrigacao) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/tributacao/SQLHelperObrigacaoTri')
        );
        
        // Pega o tipo de operação.
        $tipoOperacao = $this->input->post('tipoOperacao');
        
        // Pega os dados do imposto vindos do form.
        $obrId = $this->input->post('IdObrigacao');
        $obrNome = mb_strtoupper($this->input->post('txtNomeObrigacao'), 'UTF-8');
        $obrTipoObr = $this->input->post('tipoObrigacao');
        
        if ((string)$this->input->post('slcTipoDataObrigacao') == 'M1') {
            $obrPeriodo = 'M';
            $obrRepeticao = 1;
        } else if ((string)$this->input->post('slcTipoDataObrigacao') == 'M3') {
            $obrPeriodo = 'M';
            $obrRepeticao = 3;
        } else if ((string)$this->input->post('slcTipoDataObrigacao') == 'A1') {
            $obrPeriodo = 'A';
            $obrRepeticao = 1;
        } else {
            $obrPeriodo = (string)$this->input->post('slcPeriodoObrigacao');
            $obrRepeticao = (int)$this->input->post('slcRepeticaoObrigacao');
        }
        
        $obrDptResp = intval((string)$this->input->post('slcDeptoResponsavel'));
        $obrDataLimite = $this->input->post('txtDataLimiteObrigacao');
        
        // Se possuir o caractere de '/', então é data limite.
        if (strpos($obrDataLimite, '/') !== false) {
            $arrayDataObrigacao = explode('/', $obrDataLimite);
            $odtDiaLimite = intval($arrayDataObrigacao[0]);
            $odtMesLimite = intval($arrayDataObrigacao[1]);
            $odtAnoLimite = intval($arrayDataObrigacao[2]);
        } else {
            $odtDiaLimite = intval($obrDataLimite);
            $odtMesLimite = NULL;
            $odtAnoLimite = NULL;
        }
        
        $obrDataMovel = ($this->input->post('cbDataMovelObrigacao') == 'on') ? 1 : 0;
        
        // Grava no banco de dados conforma a operação.
        if ($obrTipoObr == 'E') {
            $obrigacao = $modelObrigacao->criarObrigacao($obrId, $obrNome, $obrTipoObr, $obrPeriodo, $obrRepeticao, $obrDptResp, $obrDataMovel);
        } else {
            $obrigacao = null;
        }
        $obrigacaoData = $modelObrigacao->criarObrigacaoData($obrId, $odtDiaLimite, $odtMesLimite, $odtAnoLimite);
        $modelObrigacao->save($obrigacao, $obrigacaoData, $tipoOperacao);
        
        // Redireciona de volta para a listagem dos obrigacoes.
        redirect(base_url().'obrigacoes');
    }
    
    
    /**
     * Apaga uma obrigação específica do banco de dados.
     * 
     * @param   int $obrId  Id da obrigação.
     */
    public function apagarObrigacao($obrId)
    {
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'models/models/tributacao/ModelObrigacao.php';
        require_once APPPATH.'models/models/tributacao/ModelObrigacaoData.php';
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelObrigacao) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/tributacao/SQLHelperObrigacaoTri')
        );
        
        // Remove a obrigação.
        $modelObrigacao->remove($obrId);
        
        // Redireciona de volta para a listagem dos obrigacoes.
        redirect(base_url().'obrigacoes');
    }
    
    
    /**
     * Carrega os obrigacoes de determinado regime de tributação.
     * 
     * @param  int $idRegimeTributacao  O ID do regime de tributação para buscar os obrigacoes.
     */
    public function carregarObrigacoesRegimeTributacao($idRegimeTributacao)
    {
        // Verifica se os parâmetros estão preenchidos.
        if (isset($_POST['idRegimeTributacao']) && !empty($_POST['idRegimeTributacao'])) {
            session_start();
            require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
            $controllerPadrao = new ControllerPadrao();
            list($modelObrigacao) = $controllerPadrao->carregarSQLHelper(
                array('sqlhelpers/tributacao/SQLHelperObrigacaoTri')
            );
            $obrigacoes = $modelObrigacao->carregarObrigacoesRegimeTributacao($idRegimeTributacao);
            echo json_encode($obrigacoes);
        }
    }
    
}