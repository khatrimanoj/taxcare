<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appchanges extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Appchanges_model');
		$this->load->helper('url');
		$this->load->helper('text');
	}

   

   ########### Check App Version from ##################
	public function get_appversion() 
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
	    $version = $this->appchanges_model->app_version($id='3', $var);
		if($version) { 
			$response = array(
				'title' => $user->id,
				'description' => $user->token
			);
		}
		else {
			$response = array();
		}

		$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response));
	}
   #####################################################  
  
 
 
}
