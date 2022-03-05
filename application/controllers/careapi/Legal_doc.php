<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal_doc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_legal_doc_model','Legal_doc'); 
		$this->load->helper('url');
		$this->load->helper('text');
		//error_reporting(0);

	}
########### Check if User is Logged IN  ##################

	public function get_legal_docs() 
	{  
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');

		$request  = json_decode(file_get_contents('php://input'), true);

		$page_id  = $request['Page_Id'];
        $error = false;
 	    if(!$page_id)
		{   
		$error = true;
		$response = array('status_code'=>0,'message' => 'Page id is mandatory'  );
		}
 	
 		if(!$error){
		$filing_category = $this->Legal_doc->get_legal_docs($page_id, $status='');
	    if(!empty($filing_category)){
		foreach($filing_category as $info){
			$response[] = array(
				'page_id' => $info->page_id,
				'page_title'    => $info->page_title,
				'page_status '  =>$info->page_status ,
				'page_content'  => $info->page_content ,
				'page_status' => $info->page_status,	
				'status_code'=>1
			);
		}
	}
	else {
		$response = array('status_code'=>0,'message' => 'No record found.');
	}
}

	$this->output
	->set_status_header(200)
	->set_content_type('application/json')
	->set_output(json_encode($response));
  } 

}
