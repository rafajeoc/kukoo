<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
		$this->arrayTipoOperacao = array('i', 'a');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
	
	
	// ------------------------------------------------------------------------------------------------------------- //
	// ------------------------------------------- PERSONALIZAÇÃO KUKOO -------------------------------------------- //
	// ------------------------------------------------------------------------------------------------------------- //
	
	/**
	 * Array de tipos de operação (i = inclusão / a = alteração).
	 * 
	 * @var array
	 */
	public $arrayTipoOperacao;
	
	
	/**
	 * Prepara o controller para utilização.
	 * 
	 * @param	boolean $bUtilMdl	Indica se o controller de utilidades de Model será carregado.
	 * @param	boolean $bUtilView	Indica se o controller de utilidades de View será carregado.
	 * @param	boolean $bUtilCtl	Indica se o controller de utilidades de Controller será carregado.
	 * 
	 * @return	Um array com o controller padrão e os controllers de utilidades selecionados.
	 */
	public function prepararController($bUtilMdl, $bUtilView, $bUtilCtl) {
		
		// Inicia a sessão e declara o array de retorno.
		session_start();
		$arrayRetorno = array();
		
		// Faz o require_once do controller padrão e faz o push no array.
        require_once APPPATH.'controllers/padrao/ControllerPadrao.php';
        array_push($arrayRetorno, new ControllerPadrao());
        
        // Faz o require_once dos controllers de utilidades de acordo com os parâmetros passados.
        if ($bUtilMdl) {
        	require_once APPPATH.'controllers/padrao/ControllerUtilidadesCIModel.php';
        	array_push($arrayRetorno, new ControllerUtilidadesCIModel());
        }
        
        if ($bUtilView) {
        	require_once APPPATH.'controllers/padrao/ControllerUtilidadesCIView.php';
        	array_push($arrayRetorno, new ControllerUtilidadesCIView());
        }
        
        if ($bUtilCtl) {
        	require_once APPPATH.'controllers/padrao/ControllerUtilidadesCIController.php';
        	array_push($arrayRetorno, new ControllerUtilidadesCIController());
        }
		
		// Retorna os controllers carregados.
		return $arrayRetorno;
	}

}
