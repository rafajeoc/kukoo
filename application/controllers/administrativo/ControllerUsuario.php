<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller do Usuário.
 * 
 * @since     1.0
 * @package   controllers/administrativo
 * @copyright Kukoo
 */
class ControllerUsuario extends CI_Controller {
    
    
    /**
     * Carrega a página dos Usuários.
     */
    public function usuarios() {
        
        // Inicia a sessão e carrega os DAOs.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario')
        );
        
        // Pega o Usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $modelUsuario->get_by_id($_SESSION['usrId']);
        
        // Verifica se a licença está ativa.
        $licencaAtiva = $controllerPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            // Variável de licença expirada.
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';
            
            // Pega a lista de Usuários daquele escritório.
            $usuarios = $modelUsuario->get();
            $data['usuarios'] = $usuarios;
        }
        
        // Carrega as views.
        $arrayViews = array('padrao/header', 'administrativo/usuarios', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    /**
     * Carrega a página dos dados do Usuário.
     * 
     * @param  (CI)any $id  ID da rota do CodeIgniter; pode ser o ID do usuário, ou 'novo' para inclusão.
     */
    public function dadosUsuario($usrId) {
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario')
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
            $data['tipoOperacao'] = ($this->input->post('btnDadosUsuario') != '') ? 'i' : 'a';
            
            // Se for alteração, carrega os dados do usuário.
            if ($data['tipoOperacao'] == 'a') {
                
                // Seta as variáveis para imprimir de forma correta na tela.
                $usuario = $modelUsuario->get_by_id($this->uri->segment_array()[2]);
                $data['usrId'] = $usuario->usrId;
                $data['usrNome'] = mb_strtoupper($usuario->usrNome, 'UTF-8');
                $data['usrCPF'] = substr_replace(substr_replace(substr_replace($usuario->usrCPF, '.', 3, 0), '.', 7, 0), '-', 11, 0);
                $data['usrEmail'] = mb_strtoupper($usuario->usrEmail, 'UTF-8');
                $data['cbAdministradorChecked'] = ($usuario->prmAdministrador == 1) ? 'checked' : 'unchecked';
                $data['cbGerObrigacoesChecked'] = ($usuario->prmGerObrigacoes == 1) ? 'checked' : 'unchecked';
                $data['cbGerClientesChecked'] = ($usuario->prmGerClientes == 1) ? 'checked' : 'unchecked';
                $data['cbGerProtocolosChecked'] = ($usuario->prmGerProtocolos == 1) ? 'checked' : 'unchecked';
                $data['cbDptFiscalChecked'] = ($usuario->dptFiscal == 1) ? 'checked' : 'unchecked';
                $data['cbDptContabilChecked'] = ($usuario->dptContabil == 1) ? 'checked' : 'unchecked';
                $data['cbDptPessoalChecked'] = ($usuario->dptPessoal == 1) ? 'checked' : 'unchecked';
                $data['cbDptCertAlvChecked'] = ($usuario->dptCertAlv == 1) ? 'checked' : 'unchecked';
                $data['cbDptDecFisChecked'] = ($usuario->dptDecFis == 1) ? 'checked' : 'unchecked';
                $data['cbDptDecCtbChecked'] = ($usuario->dptDecCtb == 1) ? 'checked' : 'unchecked';
                $data['cbDptDecPesChecked'] = ($usuario->dptDecPes == 1) ? 'checked' : 'unchecked';
                $data['cbUsuarioAtivoChecked'] = ($usuario->usrAtivo == 1) ? 'checked' : 'unchecked';
            }
            // Se for inclusão, carrega as variáveis com valores nulos e vazios (com exceção do ID).
            else {
                $data['usrId'] = $controllerPadrao->getProximoIdTabela($modelUsuario->getTabelaUsuario());
                $data['usrNome'] = '';
                $data['usrCPF'] = '';
                $data['usrEmail'] = '';
                $data['cbAdministradorChecked'] = 'unchecked';
                $data['cbGerObrigacoesChecked'] = 'unchecked';
                $data['cbGerClientesChecked'] = 'unchecked';
                $data['cbGerProtocolosChecked'] = 'unchecked';
                $data['cbDptFiscalChecked'] = 'unchecked';
                $data['cbDptContabilChecked'] = 'unchecked';
                $data['cbDptPessoalChecked'] = 'unchecked';
                $data['cbDptCertAlvChecked'] = 'unchecked';
                $data['cbDptDecFisChecked'] = 'unchecked';
                $data['cbDptDecCtbChecked'] = 'unchecked';
                $data['cbDptDecPesChecked'] = 'unchecked';
                $data['cbUsuarioAtivoChecked'] = 'unchecked';
                
            }
        }
        
        // Se a licença estiver ativa, carrega as views.
        $arrayViews = array('padrao/header', 'administrativo/dadosUsuario', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $controllerPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    /**
     * Grava os dados do usuário no banco de dados.
     */
    public function gravarDados() {
        
        // Pega o tipo da operação.
        $tipoOperacao = $this->input->post('tipoOperacao');
        
        // Redireciona de volta para a listagem dos usuários se for tentativa de acesso manual.
        if (($tipoOperacao != 'i') && ($tipoOperacao != 'a')) {
            redirect(base_url().'usuarios');
        }
        
        // Inicia a sessão e carrega o DAO.
        session_start();
        require_once APPPATH.'models/models/administrativo/usuario/ModelUsuario.php';
        require_once APPPATH.'models/models/administrativo/usuario/ModelPermissaoUsuario.php';
        require_once APPPATH.'models/models/administrativo/usuario/ModelDepartamentoUsuario.php';
        require_once APPPATH.'models/models/administrativo/usuario/ModelDetLoginUsuario.php';
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        $controllerPadrao = new ControllerPadrao();
        list($modelUsuario) = $controllerPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario')
        );
       
        // Pega os dados do usuário vindos do form.
        $usrId = $this->input->post('IdUsuario');
        $usrNome = mb_strtoupper($this->input->post('txtNomeCompleto'), 'UTF-8');
        $usrCPF = preg_replace('/[^\p{L}\p{N}\s]/u', '', $this->input->post('txtCPF'));
        $usrEmail = mb_strtoupper($this->input->post('txtEmail'), 'UTF-8');
        $prmAdministrador = ($this->input->post('cbAdmin') == 'on') ? 1 : 0;
        $prmGerObrigacoes = ($this->input->post('cbGerenciamentoObrigacoes') == 'on') ? 1 : 0;
        $prmGerClientes = ($this->input->post('cbGerenciamentoClientes') == 'on') ? 1 : 0;
        $prmGerProtocolos = ($this->input->post('cbGerenciamentoProtocolos') == 'on') ? 1 : 0;
        $dptFiscal = ($this->input->post('cbDptFiscal') == 'on') ? 1 : 0;
        $dptContabil = ($this->input->post('cbDptContabil') == 'on') ? 1 : 0;
        $dptPessoal = ($this->input->post('cbDptPessoal') == 'on') ? 1 : 0;
        $dptCertAlv = ($this->input->post('cbDptCertAlv') == 'on') ? 1 : 0;
        $dptDecFis = ($this->input->post('cbDptDecFis') == 'on') ? 1 : 0;
        $dptDecCtb = ($this->input->post('cbDptDecCtb') == 'on') ? 1 : 0;
        $dptDecPes = ($this->input->post('cbDptDecPes') == 'on') ? 1 : 0;
        $usrAtivo = ($this->input->post('cbUsuarioAtivo') == 'on') ? 1 : 0;
        
        // Só gera a senha se for inclusão de novo usuário.
        $usrSenha = ($tipoOperacao == 'i')
            ? $this->gerarSenha() 
            : $modelUsuario->getSenhaUsuario($usrId);
        
        // Monta os objetos para gravar no banco de dados.
        $usuario = $modelUsuario->criarUsuario($usrId, $usrNome, $usrCPF, $usrEmail, $usrSenha, $usrAtivo);
        $permissaoUsuario = $modelUsuario->criarPermissaoUsuario($usrId, $prmAdministrador, $prmGerObrigacoes, $prmGerClientes, $prmGerProtocolos);
        $departamentoUsuario = $modelUsuario->criarDepartamentoUsuario($usrId, $dptFiscal, $dptContabil, $dptPessoal, $dptCertAlv, $dptDecFis, $dptDecCtb,
        	$dptDecPes);
        
        // Gera os detalhes de login do Usuário para inclusão: ID, data/hora do último login, IP do último login, número de tentativas, e se está logado.
        // Não gera para alteração, pois neste caso a tabela é atualizada pelo ControllerLogin.
        $detLoginUsuario = ($tipoOperacao == 'i')
            ? $modelUsuario->criarDetLoginUsuario($usrId, null, '', 0)
            : null;
        
        // Insere ou altera o usuário no banco de dados, dependendo do tipo de operação.
        $modelUsuario->save($usuario, $permissaoUsuario, $departamentoUsuario, $detLoginUsuario, $tipoOperacao);
        
        // Redireciona de volta para a listagem dos usuários.
        redirect(base_url().'usuarios');
    }
    
    
    /**
     * Gera a senha de forma randômica para um usuário.
     * 
     * @return  O hash para ser gravado no banco de dados.
     */
    public function gerarSenha() {
        
        // Strings iniciais.
        $caracteres = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890';
        $senha = '';
        
        // Randomiza a senha com base na string de caracteres informada acima.
        for ($i = 0; $i < 8; $i++) {
            $senha .= $caracteres[mt_rand(0, strlen($caracteres - 1))];
        }
        
        // Retorna o hash da senha para gravar no banco.
        return hash('sha256', $senha);
    }
    
    
    /**
     * 
     */
    public function alterarSenha() {
        
    }
    
}

?>
