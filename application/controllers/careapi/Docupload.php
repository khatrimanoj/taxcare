<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docupload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_order_model'); 
		$this->load->model('Api_user_model'); 
		$this->load->helper('url');
		$this->load->helper('text');
		//error_reporting(0);

	}
########### Check if User is Logged IN  ##################

	public function tax_filing_category() 
	{  
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
 		
 		$token = $this->input->get_request_header('Apli_key');
 		
		$filing_category = $this->TaxFiling->get_tax_filing_category($doc_id='', $status='');
	    if(!empty($filing_category)){
		foreach($filing_category as $info){
			$response[] = array(
				'Doc_type_id' => $info->doc_id,
				'Doc_name'    => $info->doc_name,
				'upload_type'  =>$info->upload_type,
				'filing_cost'  => $info->filing_cost,
				'Added_on'    => $info->doc_added,
				'doc_status' => $info->doc_status,	
				'status_code'=>1
			);
		}
	}
	else {
		$response = array('status_code'=>0,'message' => 'No record found.');
	}


	$this->output
	->set_status_header(200)
	->set_content_type('application/json')
	->set_output(json_encode($response));
  } 

    public function uploadDocument(){
       $data = array();
       $status = 0;
       $error=0;
       $message = '';
       if(!$this->input->post('doc_id')) {
       		$error =1;
       		$message = 'Document Categoty id required';
       }

       // if(!$this->input->post('order_id')) {
       // 		$error =1;
       // 		$message = 'Order id required';
       // }

       if(!$this->input->post('user_id')) {
       		$error =1;
       		$message = 'User id required';
       }

       if(!$error){
	       	$config = array(
	       	'upload_path' => "upload/",             //path for upload
	       	'allowed_types' => "jpg|png|jpeg|pdf",   //restrict extension
	       	// 'max_size' => '100',
	       	// 'max_width' => '1024',
	       	// 'max_height' => '768',
	       	'file_name' => $this->input->post('doc_id').'_'.date('ymdhis')
	       	);
	       	$this->load->library('upload',$config);
	       	 
	       	if($this->upload->do_upload('doc_file')) {
	       		$data_image = array('upload_data' => $this->upload->data()); 
	       		$path = $config['upload_path'].'/'.$data_image['upload_data']['orig_name'];
	       		$upload_data = array(
	       			'doc_master_id'=>$this->input->post('doc_id'),
	       			'order_id'=>0,
	       			'order_no'=>'',
	       			'order_user_id'=>$this->input->post('user_id'),
	       			'order_file_or_text'=>$data_image['upload_data']['orig_name'],
	       			'order_file_type'=>1,
	       			'file_status'=>'0',
	       			'upload_file_type'=>1,
	       			'date_upload'=>date('Y-m-d H:i:s')
	       		);
	       		$message = 'image uploaded successfully'; 
	       		$status =1;

	       		$this->Api_order_model->insert_image($upload_data);
	       		$doc_datas = array();
	       		$doc_datas = $this->Api_order_model->getUserDodumentListByCategoryId($this->input->post('user_id'),$this->input->post('doc_id'));

	       		// foreach($doc_datas as $key =>$doc_data){
	       		// 	if($doc_data->order_file_or_text){
	       		// 		$doc_datas[$key]->order_file_or_text = base_url('upload/').$doc_data->order_file_or_text;
	       		// 	}
	       		// }
	       		$data = $doc_datas;

	       	} else {
	       		$message = $this->upload->display_errors(); 
	       		
	       	}
       }

	  $response = array(
			'status'=>$status,
			'message'=>$message,
			'data'=>$data
		);

	  $this->output
	  ->set_status_header(200)
	  ->set_content_type('application/json')
	  ->set_output(json_encode($response));
  	}

  	public function deleteDocument(){
  		header("Access-Control-Allow-Origin: *");
  			header("Access-Control-Request-Headers: GET,POST");
  			header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
  			$token = $this->input->get_request_header('Apli_key');
  			$data = array();
  			$status = 0;
  			$data_received  = json_decode(file_get_contents('php://input'), true); 
  			$error=0; 
  			$message = ''; 
  			if(!$data_received['order_file_id']) {
  	       		$error =1;
  	       		$message = 'Order Document id required';
  	    }

  	     if(!$error){
  	       		$this->Api_order_model->deleteOrderDocument($data_received['order_file_id']);
  	       		$message = 'Document deleted successfully'; 
  	       		$status =1;
  		   }

  		  $response = array(
  				'status'=>$status,
  				'message'=>$message,
  				'data'=>$data
  			);

  		  $this->output
  		  ->set_status_header(200)
  		  ->set_content_type('application/json')
  		  ->set_output(json_encode($response));
  	}

  	public function insertAgricultureDetail(){
  			header("Access-Control-Allow-Origin: *");
  			header("Access-Control-Request-Headers: GET,POST");
  			header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
  			$token = $this->input->get_request_header('Apli_key');
  			$data = array();
  			$status = 0;
  			$data_received  = json_decode(file_get_contents('php://input'), true);
  	      
  	       $error=0;
  	       $message = '';

  	       if(!$data_received['doc_id']) {
  	       		$error =1;
  	       		$message = 'Document Categoty id required';
  	       }

  	       //  if(!isset($data_received['order_id'])) {
  	       // 		$error =1;
  	       // 		$message = 'Order id required';
  	       // }

  	       if(!$data_received['user_id']) {
  	       		$error =1;
  	       		$message = 'User id required';
  	       }

  	       if(!$data_received['net_agriculture']) {
  	       		$error =1;
  	       		$message = 'Document input namerequired';
  	       }

  	       if(!$error){
  	       		$upload_data = array(
  	       			'doc_master_id'=>$data_received['doc_id'],
  	       			'order_id'=>0,
  	       			'order_no'=>'',
  	       			'order_user_id'=>$data_received['user_id'],
  	       			'net_agriculture'=>$data_received['net_agriculture'],
  	       			'order_file_type'=>2,
  	       			'file_status'=>0,
  	       			'upload_file_type'=>1,
  	       			'date_upload'=>date('Y-m-d H:i:s')
  	       		);
  	       		
  	       		$this->Api_order_model->insert_image($upload_data); 
  	       		$doc_datas = $this->Api_order_model->getUserDodumentListByCategoryId($data_received['user_id'],$data_received['doc_id']);
  	       		$data = $doc_datas;
  	       		$message = 'Agriculture Detail insert successfully'; 
  	       		$status =1;
  		   }

  		  $response = array(
  				'status'=>$status,
  				'message'=>$message,
  				'data'=>$data
  			);

  		  $this->output
  		  ->set_status_header(200)
  		  ->set_content_type('application/json')
  		  ->set_output(json_encode($response));
  	}

  	public function insertFreelanceIncome(){
  			header("Access-Control-Allow-Origin: *");
  			header("Access-Control-Request-Headers: GET,POST");
  			header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
  			$token = $this->input->get_request_header('Apli_key');
  			$data = array();
  			$status = 0;
  			$data_received  = json_decode(file_get_contents('php://input'), true);
  	      
  	       $error=0;
  	       $message = '';

  	       if(!$data_received['doc_id']) {
  	       		$error =1;
  	       		$message = 'Document Categoty id required';
  	       }

  	       // if(!$data_received['order_id']) {
  	       // 		$error =1;
  	       // 		$message = 'Order id required';
  	       // }

  	       if(!$data_received['user_id']) {
  	       		$error =1;
  	       		$message = 'User id required';
  	       }

  	       if(!$data_received['gross_receipt']) {
  	       		$error =1;
  	       		$message = 'Gross Profit input required';
  	       }

  	        if(!$data_received['net_profit']) {
  	       		$error =1;
  	       		$message = 'Net Profit input required';
  	       }

  	       if(!$error){
  	       		$upload_data = array(
  	       			'doc_master_id'=>$data_received['doc_id'],
  	       			'order_id'=>0,
  	       			'order_no'=>'',
  	       			'order_user_id'=>$data_received['user_id'],
  	       			'gross_receipt'=>$data_received['gross_receipt'],
  	       			'net_profit'=>$data_received['net_profit'],
  	       			'order_file_type'=>2,
  	       			'file_status'=>0,
  	       			'upload_file_type'=>1,
  	       			'date_upload'=>date('Y-m-d H:i:s')
  	       		);
  	       		$this->Api_order_model->insert_image($upload_data); 
  	       		$doc_datas = $this->Api_order_model->getUserDodumentListByCategoryId($data_received['user_id'],$data_received['doc_id']);
  	       		$data = $doc_datas;
  	       		$message = 'Freelance Income insert successfully'; 
  	       		$status =1;
  		   }

  		  $response = array(
  				'status'=>$status,
  				'message'=>$message,
  				'data'=>$data
  			);

  		  $this->output
  		  ->set_status_header(200)
  		  ->set_content_type('application/json')
  		  ->set_output(json_encode($response));
  	}


}
