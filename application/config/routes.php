<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the 'welcome' class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Rota default (que vai ser a index)
    $route['default_controller'] = 'ControllerComercial/index';

// Rota do erro 404
    $route['404_override'] = '';

// Transforma hífen em underline
	$route['translate_uri_dashes'] = FALSE;


/* ---------------------------------------------------------------------------------------------- */
/* -------------------------------------- ROTAS --- INÍCIO -------------------------------------- */
/* ---------------------------------------------------------------------------------------------- */

// Login
    $route['acessar-escritorio'] = 'padrao/ControllerLogin/loadLoginEscritorio';
    $route['validar-escritorio'] = 'padrao/ControllerLogin/realizarLoginEscritorio';
    $route['acessar-usuario'] = 'padrao/ControllerLogin/loadLoginUsuario';
    $route['validar-usuario'] = 'padrao/ControllerLogin/realizarLoginUsuario';
    $route['sair'] = 'padrao/ControllerLogin/logoff';

// Geral
    $route['dashboard'] = 'geral/ControllerDashboard/index';

// Administrativo
    $route['clientes'] = 'administrativo/ControllerCliente/carregarClientes';
    $route['dados-cliente/(:any)'] = 'administrativo/ControllerCliente/carregarDadosCliente/$1';
    $route['gravar-dados-cliente'] = 'administrativo/ControllerCliente/gravarDados';
    $route['carregar-clientes-protocolo'] = 'administrativo/ControllerCliente/carregarClientesProtocolo';
    $route['usuarios'] = 'administrativo/ControllerUsuario/usuarios';
    $route['dados-usuario/(:any)'] = 'administrativo/ControllerUsuario/dadosUsuario/$1';
    $route['gravar-dados-usuario'] = 'administrativo/ControllerUsuario/gravarDados';
    $route['alterar-senha'] = 'administrativo/ControllerUsuario/alterarSenha';

// Tributação
    $route['obrigacoes'] = 'tributacao/ControllerObrigacaoTri/obrigacoes';
    $route['dados-obrigacao/(:any)'] = 'tributacao/ControllerObrigacaoTri/dadosObrigacao/$1';
    $route['gravar-dados-obrigacao'] = 'tributacao/ControllerObrigacaoTri/gravarDados';
    $route['apagar-obrigacao/(:any)'] = 'tributacao/ControllerObrigacaoTri/apagarObrigacao/$1';
    $route['carregar-obrigacoes-regime/(:any)'] = 'tributacao/ControllerObrigacaoTri/carregarObrigacoesRegimeTributacao/$1';

// Contabilidade
    $route['agenda'] = 'contabilidade/ControllerAgenda/agenda';
    $route['enviar-obrigacao'] = 'contabilidade/ControllerAgenda/gravarDados';
    $route['obrigacoes-enviadas'] = 'contabilidade/ControllerObrigacaoCtb/listarObrigacoes';
    $route['apagar-obrigacao-enviada/(:any)/(:any)'] = 'contabilidade/ControllerObrigacaoCtb/apagarObrigacaoEnviada/$1/$2';
    $route['baixar-arquivo/(:any)/(:any)'] = 'contabilidade/ControllerObrigacaoCtb/baixarArquivo/$1/$2';

// Protocolo
    $route['protocolos'] = 'protocolo/ControllerProtocolo/protocolos';
    $route['dados-protocolo/(:any)'] = 'protocolo/ControllerProtocolo/dadosProtocolo/$1';
    $route['gravar-dados-protocolo'] = 'protocolo/ControllerProtocolo/gravarDados';
    $route['apagar-protocolo/(:any)'] = 'protocolo/ControllerProtocolo/apagarProtocolo/$1';
    $route['imprimir-protocolo/(:any)'] = 'protocolo/ControllerProtocolo/imprimirProtocolo/$1';

// Suporte
    $route['problemas-de-escritorio'] = 'suporte/ControllerSuporte/loadProblemasEscritorio';
    $route['problemas-de-usuario'] = 'suporte/ControllerSuporte/loadProblemasUsuario';
    $route['suporte-escritorio'] = 'suporte/ControllerSuporte/loadEsqueciEscritorio';
    $route['suporte-usuario'] = 'suporte/ControllerSuporte/loadEsqueciUsuario';

/* ---------------------------------------------------------------------------------------------- */
/* -------------------------------------- ROTAS ------ FIM -------------------------------------- */
/* ---------------------------------------------------------------------------------------------- */