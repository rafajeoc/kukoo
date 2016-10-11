<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller das funcionalidades de Protocolo.
 *
 * @since     1.0
 * @package   controllers/protocolo
 * @copyright Kukoo
 */
class ControllerProtocolo extends CI_Controller
{

    /**
     * Carrega a página dos protocolos.
     */
    public function protocolos()
    {
        list($ctlPadrao) = $this->prepararController(false, false, false);
        list($sqlHelperUsuario, $sqlHelperProtocolo, $sqlHelperCliente) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/protocolo/SQLHelperProtocolo', 'sqlhelpers/administrativo/SQLHelperCliente')
        );

        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $sqlHelperUsuario->get_by_id($_SESSION['usrId']);

        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);

        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';

            // Pega a lista de protocolos daquele escritório.
            $data['protocolos'] = $sqlHelperProtocolo->get();

            // Pega a quantidade de clientes daquele escritório, para desbloquaer o botão de inclusão ou não.
            $data['clientes'] = $ctlPadrao->getQuantidadeRegistrosTabela($sqlHelperCliente->getTabelaCliente());
        }

        // Carrega as views.
        $arrayViews = array('padrao/header', 'protocolo/protocolos', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }


    /**
     * Carrega a página dos dados de um Protocolo.
     *
     * @param  (CI)any $proId  Indica se é um Protocolo novo ou passa o ID do Protocolo para alteração.
     */
    public function dadosProtocolo($proId)
    {
        list($ctlPadrao) = $this->prepararController(false, false, false);
        list($sqlHelperUsuario, $sqlHelperProtocolo) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/protocolo/SQLHelperProtocolo')
        );

        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $sqlHelperUsuario->get_by_id($_SESSION['usrId']);

        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);

        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';

            // Pega o tipo da operação que está sendo realizada.
            $data['tipoOperacao'] = ($this->input->post('btnDadosProtocolo') != '') ? 'i' : 'a';

            // Se for alteração, carrega os dados do usuário.
            if ($data['tipoOperacao'] == 'a') {
                $protocolo = $sqlHelperProtocolo->get_by_id($proId);
                $data['proId'] = $protocolo->proId;
                $data['cliId'] = $protocolo->cliId;
                $data['proAssunto'] = $protocolo->proAssunto;
                $data['proDescricao'] = $protocolo->proDescricao;
            } // Se for inclusão, carrega as variáveis com valores nulos e vazios (com exceção do ID).
            else {
                $data['proId'] = $ctlPadrao->getProximoIdTabela($sqlHelperProtocolo->getTabelaProtocolo());
                $data['cliId'] = 0;
                $data['proAssunto'] = '';
                $data['proDescricao'] = '';
            }
        }

        // Carrega as views.
        $arrayViews = array('padrao/header', 'protocolo/dadosProtocolo', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }


    /**
     * Grava os dados do Protocolo no banco de dados.
     */
    public function gravarDados()
    {
        // Prepara o controller para utilização.
        list($ctlPadrao, $ctlUtilidadesCICtl) = $this->prepararController(FALSE, FALSE, TRUE);

        // Pega o tipo da operação.
        $tipoOperacao = $this->input->post('tipoOperacao');

        // Redireciona de volta para a listagem dos protocolos se for tentativa de acesso manual.
        if (!in_array($tipoOperacao, $this->arrayTipoOperacao)) {
            redirect(base_url() . 'protocolos');
        }

        // Faz a chamada do require_once para os seguintes scripts.
        $ctlUtilidadesCICtl->requireOnce(
            array('models/models/protocolo/ModelProtocolo.php')
        );

        // Instancia os DAOs.
        list($modelUsuario, $sqlHelperProtocolo) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/protocolo/SQLHelperProtocolo')
        );

        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);

        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';

            // Pega as variáveis vindas do form.
            $proId = $this->input->post('IdProtocolo');
            $cliId = (int)$this->input->post('slcRazaoSocial');
            $proDtHrEmissao = $this->input->post('DtHrEmissao');
            $proImpresso = 0;
            $proAssunto = mb_strtoupper($this->input->post('txtAssunto'), 'UTF-8');
            $proDescricao = mb_strtoupper($this->input->post('txtDescricao'), 'UTF-8');

            // Cria o objeto de protocolo e grava os dados no banco de dados.
            $protocolo = $sqlHelperProtocolo->criarProtocolo($proId, $cliId, $proDtHrEmissao, $proImpresso, $proAssunto, $proDescricao);
            $sqlHelperProtocolo->save($protocolo, $tipoOperacao);

            // Redireciona para a listagem de protocolos.
            redirect(base_url() . 'protocolos');
        }
    }


    /**
     * Apaga um protocolo do banco de dados.
     *
     * @param   int $proId Id do protocolo.
     */
    public function apagarProtocolo($proId)
    {
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH . 'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($sqlHelperProtocolo) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/protocolo/SQLHelperProtocolo')
        );

        // Remove o protocolo.
        $sqlHelperProtocolo->remove($proId);

        // Redireciona de volta para a listagem dos protocolos.
        redirect(base_url() . 'protocolos');
    }
    
    
    /**
     * Imprime um protocolo.
     * 
     * @param   int $proId  Id do protocolo.
     */
    public function imprimirProtocolo($proId)
    {
        list($ctlPadrao) = $this->prepararController(false, false, false);
        list($sqlHelperUsuario, $sqlHelperProtocolo) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/protocolo/SQLHelperProtocolo')
        );

        // Pega o usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $sqlHelperUsuario->get_by_id($_SESSION['usrId']);

        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);

        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';

            // Carrega os dados do protocolo.
            $protocolo = $sqlHelperProtocolo->get_by_id($proId);
            $data['proId'] = $protocolo->proId;
            $data['cliId'] = $protocolo->cliId;
            $data['proAssunto'] = $protocolo->proAssunto;
            $data['proDescricao'] = $protocolo->proDescricao;
        }

        // Carrega as views.
        $arrayViews = array('protocolo/imprimirProtocolo');
        $arrayMapeamentoDataCI = array(1);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }

}