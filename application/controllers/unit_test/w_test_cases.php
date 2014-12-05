<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Allen Taylor
 * @link		http://philsturgeon.co.uk/code/
*/


require APPPATH.'/libraries/REST_Controller.php'; 

class W_test_cases extends REST_Controller{
	function __construct(){
		parent::__construct();
		//set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('w_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
	}


	function digest_get(){
		$this->response("welcome", 200);
	}
}
?>