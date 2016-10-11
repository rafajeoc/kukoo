<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe que implementa o Controller das utilidades de View.
 *
 * @author      Rafael Cantoni Augusto
 * @since       1.0
 * @package     controllers/padrao
 * @copyright   Kukoo
 */
class ControllerUtilidadesCIView extends CI_Controller
{


    /* ------------------------------------------------------------------------------------------------------------- */
    /* ---------------------------------------------- FUNÇÕES DIVERSAS --------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */

    /**
     * Carrega as views passadas por parâmetro.
     *
     * @param   array $arrayViews Array de views a serem carregadas.
     * @param   array $arrayMapeamentoCI Array que indica quais views serão carregadas com a variável 'data' do CI.
     * @param   array $dataCI Variável 'data' do CI.
     */
    public function carregarViews($arrayViews, $arrayMapeamentoDataCI, $dataCI)
    {

        // Para cada uma das views passadas por parâmetro, verifica se será carregada com a variável 'data' (CI) ou não.
        for ($i = 0; $i < count($arrayViews); $i++) {
            if ($arrayMapeamentoDataCI[$i] === 0) {
                $this->load->view($arrayViews[$i]);
            } else {
                $this->load->view($arrayViews[$i], $dataCI);
            }
        }
    }


    /**
     * Carrega os valores do array de post em um array que contenham o "name" passado no parâmetro.
     * Ex.: txtNome -> carregará todos os valores dos inputs que contenham a string "txtNome" em
     *                 alguma posição do "name".
     *
     * @param   array $formInputData Array de inputs via post da página anterior.
     * @param   string $stringContem A string de parâmetro cujos campos serão carregados.
     * @return  array
     */
    public function carregarPostContemString($formInputData, $stringContem)
    {

        $arrayValores = array();

        // Percorre cada elemento do array de inputs e adiciona no array de retorno somente se houver correspondência.
        foreach ($formInputData as $chave => $valor) {
            if (strpos($chave, $stringContem) !== false) {
                $arrayValores[$chave] = $valor;
            }
        }

        // Retorna o array de valores correspondidos.
        return $arrayValores;
    }

}