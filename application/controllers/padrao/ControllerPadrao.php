<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das funcionalidades padrão.
 *
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/padrao
 * @copyright   Kukoo
 */
class ControllerPadrao extends CI_Controller
{

    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------ ATRIBUTOS E CONSTRUTOR ------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */

    /**
     * Instância do SQLHelper para funcionalidades padrão.
     *
     * @var object
     */
    private $sqlHelperPadrao;

    /**
     * Instância do SQLHelper para funcionalidades de segurança.
     *
     * @var object
     */
    private $sqlHelperSeguranca;

    /**
     * Construtor da classe ControllerPadrao.
     */
    public function __construct()
    {
        parent::__construct();

        // Se já houver instância, é porque o model já foi carregado para aquele escopo.
        if ($this->sqlHelperPadrao == NULL) {
            $arrayHelpers = array('sqlhelpers/padrao/SQLHelperPadrao');
            list($this->sqlHelperPadrao) = $this->carregarSQLHelper($arrayHelpers);
        }
    }

    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------ FUNÇÕES GET ------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------- */

    /**
     * Função get do atributo $sqlHelperPadrao.
     *
     * @return object
     */
    public function getSqlHelperPadrao()
    {
        return $this->sqlHelperPadrao;
    }

    /**
     * Função get do atributo $sqlHelperSeguranca.
     *
     * @return object
     */
    public function getSqlHelperSeguranca()
    {
        return $this->sqlHelperSeguranca;
    }

    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */

    /**
     * Carrega os SQL Helpers passados por parâmetro, e retorna um array com os objetos carregados.
     * A ordem em que os SQL Helpers forem passados na chamada será a ordem em que a função devolverá os objetos.
     *
     * @param   array $arraySQLHelpers Array de SQL Helpers a serem carregados.
     * @return  array
     */
    public function carregarSQLHelper($arraySQLHelpers)
    {
        // Chama a function carregarSQLHelper do ControllerUtilidadesCIModel.
        require_once APPPATH . 'controllers/padrao/ControllerUtilidadesCIModel.php';
        $ctlUtilCIModel = new ControllerUtilidadesCIModel();
        return $ctlUtilCIModel->carregarSQLHelper($arraySQLHelpers);
    }

    /**
     * Carrega as views passadas por parâmetro.
     *
     * @param $arrayViews        Array de views a serem carregadas.
     * @param $arrayMapeamentoCI Array que indica quais views serão carregadas com a variável 'data' do CI.
     * @param $dataCI            Variável 'data' do CI.
     */
    public function carregarViews($arrayViews, $arrayMapeamentoDataCI, $dataCI)
    {
        // Chama a function carregarViews do ControllerUtilidadesCIView.
        require_once APPPATH . 'controllers/padrao/ControllerUtilidadesCIView.php';
        $ctlUtilCIView = new ControllerUtilidadesCIView();
        $ctlUtilCIView->carregarViews($arrayViews, $arrayMapeamentoDataCI, $dataCI);
    }

    /**
     * Função que retorna, em um array, todos os inputs com os seus valores que possuírem a string $stringContem
     * no name do input.
     *
     * @param $formInputData Conjunto de inputs vindos do form.
     * @param $stringContem  String que será buscada nos names dos inputs.
     * @return array
     */
    public function carregarPostContemString($formInputData, $stringContem)
    {
        // Chama a function carregarPostContemString do ControllerUtilidadesCIView.
        require_once APPPATH . 'controllers/padrao/ControllerUtilidadesCIView.php';
        $ctlUtilCIView = new ControllerUtilidadesCIView();
        return $ctlUtilCIView->carregarPostContemString($formInputData, $stringContem);
    }

    /**
     * Verifica se a licença está ativa para o conjunto escritório/módulo passado por parâmetro.
     * Retorna TRUE se estiver ativa e FALSE se estiver inativa.
     *
     * @param $escId ID do escritório.
     * @param $modId ID do módulo.
     * @return mixed
     */
    public function verificarLicencaAtiva($escId, $modId)
    {
        list($this->sqlHelperSeguranca) = $this->carregarSQLHelper(
            array('sqlhelpers/padrao/seguranca/SQLHelperSeguranca')
        );
        return $this->sqlHelperSeguranca->verificarLicencaAtiva($escId, $modId);
    }

    /**
     * Retorna o próximo ID da tabela passada por parâmetro.
     *
     * @param   string $nomeTabela Nome da tabela a ser buscado o próximo ID.
     * @return  int
     */
    public function getProximoIdTabela($nomeTabela)
    {
        return $this->sqlHelperPadrao->getProximoIdTabela($nomeTabela);
    }

    /**
     * Retorna a quantidade de registros da tabela passada por parâmetro.
     *
     * @param   string $nomeTabela Nome da tabela a ser buscada a quantidade de registros.
     * @return  int
     */
    public function getQuantidadeRegistrosTabela($nomeTabela)
    {
        return $this->sqlHelperPadrao->getQuantidadeRegistrosTabela($nomeTabela);
    }
}

?>
