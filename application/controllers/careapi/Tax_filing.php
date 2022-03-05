<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_filing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_tax_filing','TaxFiling'); 
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

 		$settings = $this->TaxFiling->get_min_charge_and_gst($var1='', $var2='');
 		if(!empty($settings)){		 
			$datapay = array(
				'min_chanrge' => $settings->min_charge_amount,
				'gst_percent' => $settings->gst_percent,
				//'is_gst_enable'  =>$settings->enable_gst,
				);
		 
  }
 		 
 		$filing_category     = $this->TaxFiling->get_tax_filing_category($doc_id='', $status='');
	    if(!empty($filing_category)){
		foreach($filing_category as $info){
			$data[] = array(
				'Doc_type_id' => $info->doc_id,
				'Doc_name'    => $info->doc_name,
				'upload_type'  =>$info->upload_type,
				'filing_cost'  => $info->filing_cost,
				//'Added_on'    => $info->doc_added,
				'doc_status' => $info->doc_status,	
				);
		}
		$status = 1;
		$message = 'Records found';
		$response = array('status'=>$status,'message'=>$message,'data'=>$data,'gst_min_pay'=>$datapay);
	}
	else {
		$status = 0;
		$message = 'No record found';
		$response = array('status'=>$status,'message' => $message);
	}


	$this->output
	->set_status_header(200)
	->set_content_type('application/json')
	->set_output(json_encode($response));
  } 

}
