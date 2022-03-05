<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Integrations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_integration');		
		$this->load->helper('url');
		$this->load->helper('text');
		//error_reporting(0);

	}
 

################### Get banners #######################################

public function get_banners()
{
	header("Access-Control-Allow-Origin: *");

	$token = $this->input->get_request_header('Apli_key');

	$bannerinfo = $this->Api_integration->get_banners($para1='',$para2='');
 
	$userdetails = array();
	if(!empty($bannerinfo)){
		foreach($bannerinfo as $info){
			$response[] = array(
				'id' => $info->id,
				'name' => $info->name,
				'link'=>$info->link,
				'image' => $info->image,
				'status' => $info->status,	
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

 
	public function get_youtube()
{
	header("Access-Control-Allow-Origin: *");

	$token = $this->input->get_request_header('Apli_key');

	$bannerinfo = $this->Api_integration->get_youtube($para1='',$para2='1');
 
	$userdetails = array();
	if(!empty($bannerinfo)){
		foreach($bannerinfo as $info){
			$response[] = array(
				'id' => $info->id,
				'name' => $info->name,
				'link' => $info->link,
				'image'=>$info->image,
				'type' => $info->type,	
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

}
