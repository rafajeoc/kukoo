<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller de cliente.
 *
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/administrativo
 * @copyright   Kukoo
 */
class ControllerCliente extends CI_Controller
{

    /**
     * Carrega a página de clientes.
     */
    public function carregarClientes()
    {
        // Inicia a sessão e carrega os SQL Helpers.
        session_start();
        require_once APPPATH . 'controllers/padrao/ControllerPadrao.php';
        $ctlPadrao = new ControllerPadrao();
        list($sqlHelperUsuario, $sqlHelperCliente) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/administrativo/SQLHelperCliente')
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

            // Pega a lista de clientes daquele escritório.
            $clientes = $sqlHelperCliente->get();
            $data['clientes'] = $clientes;
        }

        // Carrega as views.
        $arrayViews = array('padrao/header', 'administrativo/clientes', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }


    /**
     * Carrega a página dos dados de uma Cliente.
     *
     * @param   object $cliId Id da cliente para alteração ou indicativo de cliente nova.
     */
    public function carregarDadosCliente($cliId)
    {
        // Prepara o controller para utilização.
        list($ctlPadrao) = $this->prepararController(false, false, false);
        list($sqlHelperUsuario, $sqlHelperCliente) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/administrativo/SQLHelperCliente')
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

            // Pega o tipo da operação que está sendo realizada.
            $data['tipoOperacao'] = ($this->input->post('btnDadosCliente') != '') ? 'i' : 'a';

            // Se for alteração, carrega os dados da cliente.
            if ($data['tipoOperacao'] == 'a') {

                // Seta as variáveis para imprimir de forma correta na tela.
                $cliente = $sqlHelperCliente->get_by_id($this->uri->segment_array()[2]);
                $data['cliente'] = $cliente;
                $data['cliCPFSelecionado'] = (strlen($cliente[0]->cliCPFCNPJ) == 11) ? 'selected' : '';
                $data['cliCNPJSelecionado'] = (strlen($cliente[0]->cliCPFCNPJ) == 14) ? 'selected' : '';
                $data['cliId'] = $cliente[0]->cliId;
                $data['cliRazaoSocial'] = $cliente[0]->cliRazaoSocial;
                $data['cliNomeFantasia'] = $cliente[0]->cliNomeFantasia;
                $data['cliCPFCNPJ'] = substr_replace(substr_replace(substr_replace(
                    substr_replace($cliente[0]->cliCPFCNPJ, '.', 2, 0), '.', 6, 0), '/', 10, 0), '-', 15, 0);
                $data['cliEmail'] = $cliente[0]->cliEmail;
                $data['cliTelefone1'] = substr_replace(substr_replace(
                    substr_replace($cliente[0]->cliTelefone1, '(', 0, 0), ')', 3, 0), '-', 9, 0);
                $data['cliTelefone2'] = ($cliente[0]->cliTelefone2 != '')
                    ? substr_replace(substr_replace(substr_replace($cliente[0]->cliTelefone2, '(', 0, 0), ')', 3, 0), '-', 9, 0)
                    : '';
                $data['cliCEP'] = substr_replace($cliente[0]->cliCEP, '-', 5, 0);
                $data['cliLogradouro'] = $cliente[0]->cliLogradouro;
                $data['cliNumero'] = $cliente[0]->cliNumero;
                $data['cliComplemento'] = $cliente[0]->cliComplemento;
                $data['cliBairro'] = $cliente[0]->cliBairro;
                $data['cliMunicipio'] = $cliente[0]->cliMunicipio;
                $data['cliUF'] = $cliente[0]->cliUF;
                $data['cbClienteAtivoChecked'] = ($cliente[0]->cliAtivo == 1) ? 'checked' : 'unchecked';
            } //
            else {
                $data['cliCPFSelecionado'] = 'selected';
                $data['cliCNPJSelecionado'] = '';
                $data['cliId'] = $ctlPadrao->getProximoIdTabela($sqlHelperCliente->getTabelaCliente());
                $data['cliRazaoSocial'] = '';
                $data['cliNomeFantasia'] = '';
                $data['cliCPFCNPJ'] = '';
                $data['cliEmail'] = '';
                $data['cliTelefone1'] = '';
                $data['cliTelefone2'] = '';
                $data['cliCEP'] = '';
                $data['cliLogradouro'] = '';
                $data['cliNumero'] = '';
                $data['cliComplemento'] = '';
                $data['cliBairro'] = '';
                $data['cliMunicipio'] = '';
                $data['cliUF'] = '';
                $data['cbClienteAtivoChecked'] = 'checked';
            }
        }

        // Carrega as views.
        $arrayViews = array('padrao/header', 'administrativo/dadosCliente', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }


    /**
     * Grava os dados da cliente no banco de dados.
     */
    public function gravarDados()
    {
        // Prepara o controller para utilização.
        list($ctlPadrao, $ctlUtilidadesCIView, $ctlUtilidadesCICtl) = $this->prepararController(false, true, true);

        // Pega o tipo da operação.
        $tipoOperacao = $this->input->post('tipoOperacao');

        // Redireciona de volta para a listagem das clientes se for tentativa de acesso manual.
        if (!in_array($tipoOperacao, $this->arrayTipoOperacao)) {
            redirect(base_url() . 'clientes');
        }

        // Faz a chamada do require_once para os seguintes scripts.
        $ctlUtilidadesCICtl->requireOnce(
            array(
                'models/models/administrativo/cliente/ModelCliente.php',
                'models/models/administrativo/cliente/ModelClienteObrigacaoData.php'
            )
        );

        // Instancia os DAOs.
        list($modelUsuario, $sqlHelperCliente) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/administrativo/SQLHelperCliente')
        );

        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';

            // Pega os dados da cliente vindos do form.
            $formInputData = $this->input->post(NULL, TRUE);
            $cliId = $this->input->post('IdCliente');
            $cliRazaoSocial = mb_strtoupper($this->input->post('txtRazaoSocial'), 'UTF-8');
            $cliNomeFantasia = mb_strtoupper($this->input->post('txtNomeFantasia'), 'UTF-8');
            $cliCPFCNPJ = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('txtCPFCNPJ'));
            $cliEmail = mb_strtoupper($this->input->post('txtEmail'), 'UTF-8');
            $cliTelefone1 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('txtTelefone1'));
            $cliTelefone2 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('txtTelefone2'));
            $cliCEP = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('txtCEP'));
            $cliLogradouro = mb_strtoupper($this->input->post('txtLogradouro'), 'UTF-8');
            $cliNumero = $this->input->post('txtNumero');
            $cliComplemento = mb_strtoupper($this->input->post('txtComplemento'), 'UTF-8');
            $cliBairro = mb_strtoupper($this->input->post('txtBairro'), 'UTF-8');
            $cliMunicipio = mb_strtoupper($this->input->post('txtMunicipio'), 'UTF-8');
            $cliUF = mb_strtoupper($this->input->post('txtUF'), 'UTF-8');
            $cliAtivo = ($this->input->post('cbClienteAtivo') == 'on') ? 1 : 0;
            $rgtId = (int)$this->input->post('slcRegimeTributacao');

            // Cria o objeto de cliente.
            $cliente = $sqlHelperCliente->criarCliente($cliId, $cliRazaoSocial, $cliNomeFantasia, $cliCPFCNPJ, $cliEmail,
                $cliTelefone1, $cliTelefone2, $cliCEP, $cliLogradouro, $cliNumero, $cliComplemento, $cliBairro, $cliMunicipio,
                $cliUF, $cliAtivo, $rgtId);

            // Popula os arrays com os valores que estão na tabela de obrigações.
            $arrClienteObrigacaoDataInclusaoId = $ctlUtilidadesCIView->carregarPostContemString($formInputData, 'td_cliodt_i_');
            $arrClienteObrigacaoDataDiaLimite = $ctlUtilidadesCIView->carregarPostContemString($formInputData, 'td_dialimite_odt_');
            $arrClienteObrigacaoDataInclusao = array();
            $counterClienteObrigacaoDataInclusao = ($ctlPadrao->getProximoIdTabela($sqlHelperCliente->getTabelaClienteObrigacaoData()));

            foreach ($arrClienteObrigacaoDataInclusaoId as $clienteObrigacaoDataChave => $clienteObrigacaoDataValor) {
                // Monta o dia limite a partir dos valores da tabela HTML, e insere o objeto criado.
                $obrDataLimite = $arrClienteObrigacaoDataDiaLimite['td_dialimite_odt_' . $clienteObrigacaoDataValor];

                // Se possuir o caractere de '/', então é data limite.
                if (strpos($obrDataLimite, '/') !== false) {
                    $arrayDataObrigacao = explode('/', $obrDataLimite);
                    
                    $odtDiaLimite = intval($arrayDataObrigacao[0]);
                    $odtMesLimite = intval($arrayDataObrigacao[1]);
                    $odtAnoLimite = (count($arrayDataObrigacao) == 3) ? intval($arrayDataObrigacao[2]) : NULL;
                } // Senão, é dia limite - não tem valor para mês.
                else {
                    $odtDiaLimite = intval($obrDataLimite);
                    $odtMesLimite = null;
                    $odtAnoLimite = null;
                }

                $obrId = $clienteObrigacaoDataValor;
                $clienteObrigacaoData = new ModelClienteObrigacaoData($counterClienteObrigacaoDataInclusao, $cliId, $obrId, $odtDiaLimite,
                    $odtMesLimite, $odtAnoLimite, null, null, null);
                array_push($arrClienteObrigacaoDataInclusao, $clienteObrigacaoData);
                $counterClienteObrigacaoDataInclusao++;
            }

            // Se for inclusão, insere os dados no banco normalmente.
            if ($tipoOperacao == 'i') {
                $sqlHelperCliente->save($cliente, $arrClienteObrigacaoDataInclusao, null, $tipoOperacao);
            } // Senão, é alteração. Pode ter havido alteração nas obrigações ou não.
            else if ($tipoOperacao == 'a') {

                // Verifica quantas obrigações para esta cliente existem no banco.
                $quantidadeClienteObrigacaoData = $sqlHelperCliente->getQuantidadeClienteObrigacaoData($cliId);

                // Precisamos pegar a lista dos impostos e da obrigações específicas removidas,
                // para poder saber o que tirar do banco (caso precise).
                $arrClienteObrigacaoDataRemocaoId = $ctlUtilidadesCIView->carregarPostContemString($formInputData, 'tr_cliodt_d_');

                // Se existe alguma obrigação no array de exclusão, ou se a quantidade no array de inclusão
                // for diferente da quantidade do banco de dados, precisa atualizar as obrigações.
                // Senão, só atualiza as informações; não houve mudança nas obrigações.
                if ($quantidadeClienteObrigacaoData == count($arrClienteObrigacaoDataInclusaoId) &&
                    count($arrClienteObrigacaoDataRemocaoId) == 0
                ) {
                    $arrClienteObrigacaoDataInclusao = null;
                    $arrClienteObrigacaoDataRemocaoId = null;
                }

                // Salva as informações da cliente no banco de dados.
                $sqlHelperCliente->save($cliente, $arrClienteObrigacaoDataInclusao, $arrClienteObrigacaoDataRemocaoId, $tipoOperacao);
            }

            // Cria a pasta da cliente no servidor para o upload de arquivos caso ela não exista.
            $this->criarPastaCliente($cliId);

            // Redireciona de volta para a listagem das clientes.
            redirect(base_url() . 'clientes');
        }
    }


    /**
     * Carrega as clientes de forma básica para popular o select, apenas com código e razão social.
     */
    public function carregarClientesProtocolo()
    {
        // Prepara o controller para utilização.
        list($ctlPadrao) = $this->prepararController(false, false, false);
        list($sqlHelperCliente) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperCliente')
        );

        // Traz os dados das Clientes.
        $clientes = $sqlHelperCliente->carregarClientesProtocolo();
        echo json_encode($clientes);
    }


    /**
     * Cria a pasta da cliente no servidor para o upload de arquivos caso ela não exista.
     *
     * @param   int $cliId Id da Cliente
     */
    public function criarPastaCliente($cliId)
    {
        $diretorio = '/home/ubuntu/workspace/uploads/' . hash('sha256', ($_SESSION['escId'] . '_' . $cliId));
        if (!is_dir($diretorio)) {
            mkdir($diretorio);
        }
    }

}

?>
