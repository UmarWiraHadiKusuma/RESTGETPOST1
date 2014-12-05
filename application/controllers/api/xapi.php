<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package		CodeIgniter
* @subpackage	Rest Server
* @category		Controller
* @author 		Phil Sturgeon
* @link 		http://rest.co.uk/code/
*/

require APPPATH.'/libraries/REST_Controller.php';

class Xapi extends REST_Controller
{

	function __construct(){

		parent::__construct();

		$this->methods['user_get']['limit'] = 500;
		$this->methods['user_post']['limit'] = 100;
		$this->methods['user_delete']['limit'] = 50;

	}

	function user_get($id=null){
	
	if($id!=null){
		$datares1 = $this->db->get('data', array('id'=>$id));
		if ($datares1->num_rows() == 1) {
			$response = array(
						'status'=>true,
						'id'=>$datares1->row()->id,
						'namares'=>$datares1->row()->namares,
						'datares'=>$datares1->row()->datares,
						'd_sekarang'=>$datares1->row()->d_sekarang,
						'd_lalu'=>$datares1->row()->d_lalu
				);
			$this->response($response, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'data tidak ditemukan'), 500);
		}
	}else{
		$datares1 = $this->db->get('data');
		if ($datares1->num_row() > 0) {
			$response = array(
						'status'=>true,
						'data_resnya'=>$datares1->result_array(),
						);
			$this->response($response, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'data tidak ditemukan'), 500);
		}
	}	

}

	function user_post()
	{
		$data = array(
						'namares'=>$this->post('namares'),
						'datares'=>$this->post('datares'),
						'd_sekarang'=>$this->post('d_sekarang'),
						'd_lalu'=>$this->post('d_lalu')

					);
		if($this->db->insert('data', $data)){
			$this->response(array('status'=>false,'msg'=>'data tidak berhasil disimpan!.'), 500);

		}

	}

	function user_delete()
	{
//$this->some_model->deletesomething( $this->get('id') );
		$message = array('id' => $this->get('id'), 'message' => 'HAPUS');
		$this->response($message, 200);
	}

	function users_get()
	{

	//$users = $this->some_model->getSomething( $this->get('limit') );
		$users = array(
			array('id' => 1, 'name' => 'Umar ', 'email' => 'xapi.com'),
			array('id' => 2, 'name' => 'Sama aja', 'email' => 'xapi.com'),
			3 => array('id' => 3, 'name' => 'Hadi', 'email' => 'xapi.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);

		if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
        
	}

	public function send_post()
	{
		var_dump($this->request->body);

	}

	public function send_put()
	{
		var_dump($this->put('foo'));

	}
}






