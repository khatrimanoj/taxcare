<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appchanges extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Appchanges_model');
		$this->load->model('Api_banner_model');
		$this->load->model('Api_faq_model'); 
		$this->load->model('Api_order_model'); 
		$this->load->model('Api_integration'); 
		
		$this->load->helper('url');
		$this->load->helper('text');
		//error_reporting(0);

	}


########### Check App Version from ##################

	public function get_appversion() 
	{ 
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');

		$appsetting = $this->Appchanges_model->app_version($id='3', $var='') ;
		$appsettingdata = array(
			'Version' => $appsetting->description
		);

		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($appsettingdata));
	}
 

################### Get FAQs #######################################

public function get_faqs()
{
	header("Access-Control-Allow-Origin: *");

	$token = $this->input->get_request_header('Apli_key');

	$bannerinfo = $this->Api_faq_model->get_faqs($para1='',$para2='1');
 
	$userdetails = array();
	if(!empty($bannerinfo)){
		foreach($bannerinfo as $info){
			$response[] = array(
				'faq_id' => $info->faq_id,
				'faq_question' => $info->faq_question,
				'faq_content_answer' => $info->faq_content_answer,
				'faq_status'=>$info->faq_status,
				'date_added' => $info->date_added,	
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

################### Tax Calandar #######################################

public function get_tax_calandar()
{
	header("Access-Control-Allow-Origin: *");
	
	$token = $this->input->get_request_header('Apli_key');

	$calander = $this->Appchanges_model->get_tax_calendar($para1='',$para2=''); 
 
	$userdetails = array();
	if(!empty($calander)){
		foreach($calander as $info){
			$response[] = array(
				'id' => $info->id,
				'title' => $info->title,
				'description' => $info->description,
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
 

################### Get payment settings  #######################################

	public function get_payment_settings()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		
		$payment = $this->Appchanges_model->get_payment_settings($para1='',$para2='');
		$userdetails = array();
		if(!empty($payment)){
			foreach($payment as $info){
				$response[] = array(
					'Record id' => $info->id,
					'title' => $info->title,
					'description' => $info->description,
					'date_added'=>$info->date_added,
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

########### Check App Version from ##################

	public function get_app_features() 
	{ 
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');

		$appsetting = $this->Appchanges_model->app_features($id='', $var='') ;
		if(!empty($appsetting)){
		foreach($appsetting as $info){
		$response[]  = array(
			 'id'    => $info['id'],
			 'title' => $info['title'], 
			 'value' => $info['description'],
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




public function get_tools()
{
	header("Access-Control-Allow-Origin: *");
	
	$token = $this->input->get_request_header('Apli_key');

	$calaender = $this->Appchanges_model->get_tools($para1='',$para2='');
 
	$userdetails = array();
	if(!empty($calaender)){
		foreach($calaender as $info){
			$response[] = array(
				'id' => $info->id,
				'title' => $info->title,
				'link' => $info->description,
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
 
 ############## get Query data #########
public function get_query_data()
{
	header("Access-Control-Allow-Origin: *");
	
	$token = $this->input->get_request_header('Apli_key');

	$calaender = $this->Appchanges_model->get_query_data($para1='',$para2='');
 
	$userdetails = array();
	if(!empty($calaender)){
		foreach($calaender as $info){
			$response[] = array(
				'id' => $info->id,
				'name' => $info->name,
				'type' => $info->type,
				'section' => $info->section,
				'max_limit' => $info->max_limit,
				'assmnt_year' => $info->assmnt_year,
				'description' => $info->description,
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

	public function get_automation_status() 
	{ 
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');

		$appsetting = $this->Appchanges_model->app_version($id='4', $var='') ;
		$appsettingdata = array(
			'Automation_status' => $appsetting->description
		);

		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($appsettingdata));
	}

	## update user token ### 
	public function getUserBookmarks()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		$status = 0;
		$data = array();
		$request = json_decode(file_get_contents('php://input'), true);
		$user_id = $request['user_id'];
		if(!$request['user_id']) {
			$message = 'User id required';
		}else {
			$status = 1;
			$message = 'User bookmarks List';
			$bookmarks = array();
			$bookmarks = $this->Appchanges_model->get_query_data($para1='',$para2='');
			foreach($bookmarks as $bkey => $bookmark){
				$is_bookmark = $this->Appchanges_model->checkUserBookmark($user_id,$bookmark->id);
				if($is_bookmark){
					$bookmarks[$bkey]->is_bookmark = 1;
				}else{
					$bookmarks[$bkey]->is_bookmark = 0;
				}

			}
			
			$data = $bookmarks; 
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

	## update user token ### 
	public function addUserBookmark()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		$status = 0;
		$data = array();
		$request = json_decode(file_get_contents('php://input'), true);
		$user_id = $request['user_id'];
		$bookmark_id = $request['bookmark_id'];
		if(!$request['user_id']) {
			$message = 'User id required'; 
		}elseif(!$bookmark_id){
			$message = 'Bookmark id is mandatory';
		}else {
			$add_boomark = array(
				'user_id'=>$user_id,
				'bookmark_id'=>$bookmark_id
			);
			$is_bookmark = $this->Appchanges_model->checkUserBookmark($user_id,$bookmark_id); 
			if($is_bookmark){
				$this->Appchanges_model->deleteUserBookmark($user_id,$bookmark_id); 
			}else{
				$this->Appchanges_model->addUserBookmark($add_boomark);
			}
			$status = 1;
			$message = 'User bookmark updated successfully';
			$bookmarks = array();
			$bookmarks = $this->Appchanges_model->getUserBookmark($user_id);
			$data = $bookmarks; 
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
