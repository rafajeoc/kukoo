<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller da Agenda.
 * 
 * @since     1.0
 * @package   controllers/contabilidade
 * @copyright Kukoo
 */
class ControllerAgenda extends CI_Controller {
    
    
    /**
     * Monta a agenda.
     */
    public function agenda() {
        
        // Prepara o controller para utilização.
        list($ctlPadrao) = $this->prepararController(false, false, false);
        
        // Instancia os DAOs.
        list($usuarioDAO, $agendaDAO) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/contabilidade/SQLHelperAgenda')
        );
        
        // Pega o Usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $usuarioDAO->get_by_id($_SESSION['usrId']);
        
        // Verifica se a licença está ativa.
        $licencaAtiva = $ctlPadrao->verificarLicencaAtiva($_SESSION['escId'], 1);
        
        // Verifica se a licença de Contabilidade e Cadastros está ativa.
        if (!$licencaAtiva) {
            $data['licencaAtiva'] = 'N';
        } else {
            // Indica que a licença está ativa.
            $data['licencaAtiva'] = 'S';
        
            // Monta a agenda baseando-se no mês atual.
            $data['agenda'] = $agendaDAO->get(intval(date('n')));
        }
        
        // Carrega as views.
        $arrayViews = array('padrao/header', 'contabilidade/agenda', 'padrao/footer');
        $arrayMapeamentoDataCI = array(1, 1, 0);
        $ctlPadrao->carregarViews($arrayViews, $arrayMapeamentoDataCI, $data);
    }
    
    
    /**
     * Grava a obrigação no servidor.
     */
    public function gravarDados() {
        
        // Redireciona de volta para a agenda se for tentativa de acesso manual.
        if ($_FILES['obrigacaoUpload'] == NULL) {
            redirect(base_url().'agenda');
        }
        
        // Prepara o controller para utilização.
        list($ctlPadrao, $ctlUtilidadesCICtl) = $this->prepararController(false, false, true);
        
        
        // Faz a chamada do require_once para os seguintes scripts.
        $ctlUtilidadesCICtl->requireOnce(
            array(
                'models/models/contabilidade/obrigacao/ModelObrigacaoClienteOdt.php',
                'models/models/contabilidade/agenda/ModelAgendaObrigacao.php',
                'utilidades/UtilidadesMail.php'
            )
        );
        
        // Instancia os DAOs.
        list($usuarioDAO, $agendaDAO) = $ctlPadrao->carregarSQLHelper(
            array('sqlhelpers/administrativo/SQLHelperUsuario', 'sqlhelpers/contabilidade/SQLHelperAgenda')
        );
        
        // Pega o Usuário que está utilizando o sistema.
        $data['usuarioAtual'] = $usuarioDAO->get_by_id($_SESSION['usrId']);
        
        // Realiza o envio do arquivo para o servidor.
        $entId = $this->input->post('IdCliente');
        $entEmail = $this->input->post('EmailCliente');
        list($arquivoEnviadoComSucesso, $hashArquivo) = $this->enviarObrigacao($entId);
        
        // Prossegue com a gravação dos dados no banco de dados somente se o arquivo foi enviado com sucesso.
        if ($arquivoEnviadoComSucesso) {
            
            // Monta o objeto de Obrigação/Cliente Obrigação Data.
            $obreodId = $ctlPadrao->getProximoIdTabela($agendaDAO->getTabelaObrigacaoClienteOdt());
            $entodtId = intval($this->input->post('IdObrigacaoClienteOdt'));
            $obreodHashDoc = $hashArquivo;
            $obreodMesRef = intval(date('n'));
            $obreodCaminhoArq = hash('sha256', ($_SESSION['escId'].'_'.$entId)).'/'.$hashArquivo;
            $obrigacaoClienteOdt = new ModelObrigacaoClienteOdt($obreodId, $entodtId, $obreodHashDoc, $obreodMesRef,
            	$obreodCaminhoArq);
             
            // Monta o objeto de registro da Agenda.
            $agnobrId = $ctlPadrao->getProximoIdTabela($agendaDAO->getTabelaAgendaObrigacao());
            $agnobrStatusObr = 1;
            $agnobrDtHrEnvio = date('Y-m-d H:i:s');
            $agnobrDtHrAcesso = NULL;
            $agnobrDtHrAcesso2 = NULL;
            $agendaObrigacao = new ModelAgendaObrigacao($agnobrId, $obreodId, $agnobrStatusObr, $agnobrDtHrEnvio,
            	$agnobrDtHrAcesso, $agnobrDtHrAcesso2);
             
            // Grava os dados no banco de dados (somente inclusão).
            // Caso precise reenviar, é necessário acessar a tela de obrigações, no módulo Contabilidade,
            // remover a obrigação enviada e enviá-la novamente pela agenda.
            $saveOk = $agendaDAO->save($obrigacaoClienteOdt, $agendaObrigacao, 'i');
            
            // Se gravou corretamente no banco de dados, envia o e-mail.
            if ($saveOk) {
                $utilidadesMail = new UtilidadesMail();
//                $utilidadesMail->enviarObrigacao($entEmail, $obreodCaminhoArq);
            }
        }
        
        // Redireciona de volta para a agenda.
        redirect(base_url().'agenda');
    }
    
    
    /**
     * 
     */
    private function enviarObrigacao($entId) {
        
        /* Seta os parâmetros de envio para o servidor.
            A variável de diretório é montada com o caminho da pasta de uploads, com o hash do escritório + entidade.
            
            Ex.:
            hash = hash('sha256', '1_1')
            /home/ubuntu/workspace/uploads/hash/
        */
        $uploadOk = FALSE;
        $diretorio = '/home/ubuntu/workspace/uploads/'.hash('sha256', ($_SESSION['escId'].'_'.$entId)).'/';
        $hashArquivo = $this->calcularHashArquivo($_FILES['obrigacaoUpload']['name']);
        $_FILES['obrigacaoUpload']['name'] = $hashArquivo.'.pdf';
        $arquivo = $diretorio.basename($_FILES['obrigacaoUpload']['name']);
        $extensaoArquivo = pathinfo($arquivo, PATHINFO_EXTENSION);
        
        // Verifica se existe submit ou se é acesso manual.
        if (isset($_POST['enviarObrigacao'])) {
            
            // Verifica se é um arquivo de verdade ou se é um envio vazio.
            if ($_FILES['obrigacaoUpload']['size'] <= 0) {
                $_SESSION['msgRetorno'] = 'Favor enviar uma obrigação válida!';
            }
            // Verifica se é maior que 1.1MB.
            else if ($_FILES['obrigacaoUpload']['size'] > 1153433.6) {
                $_SESSION['msgRetorno'] = 'Arquivo de obrigação muito grande!';
            }
            // Prossegue com o envio.
            else {
                // Verifica se a extensão do arquivo é PDF.
                if (strtolower($extensaoArquivo) != 'pdf') {
                    $_SESSION['msgRetorno'] = 'Favor enviar uma obrigação com a extensão .pdf!';
                } else {
                    
                    // Envia o arquivo para o servidor.
                    if (move_uploaded_file($_FILES['obrigacaoUpload']['tmp_name'], $arquivo)) {
                        $_SESSION['msgRetorno'] = 'Obrigação enviada com sucesso!';
                        $uploadOk = TRUE;
                    } else {
                        $_SESSION['msgRetorno'] = 'Desculpe, ocorreu um erro interno. Favor enviar novamente!';
                    }
                }
            }
        }
        
        return array($uploadOk, $hashArquivo);
    }
    
    
    /**
     * 
     */
    private function calcularHashArquivo($nomeArquivo) {
        return hash('sha256', ($nomeArquivo.date('n')));
    }
    
}
