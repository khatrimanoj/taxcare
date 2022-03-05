<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_user_model');
 		$this->load->helper('url');
		$this->load->helper('text');
		error_reporting(0);

	}
########### Check if User is Logged IN  ##################

	public function is_logged_in() 
	{  
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');

		$logininfo = json_decode(file_get_contents('php://input'), true);

		$google_id = $logininfo['google_user_id'];
		$device_id = $logininfo['user_device_id'];
		$error = false;
		if(!$google_id)
		{   $error = true;
		$response = array('status_code'=>0,'message' => 'Google_id is mandatory');
		}

		$device_id = isset($device_id)?$device_id:'';

		// elseif(!$device_id)
		// {   $error = true;
		// $response = array('status_code'=>0,'message' => 'User device_id is mandatory'  );
		// }

		if(!$error){

		$this->Api_user_model->is_logged_in($google_id, $device_id);
		$userlogin = $this->Api_user_model->getUserByGoogleId($google_id);

		if(isset($userlogin) && !empty($userlogin)){
			$response = array(
				'google_user_id' => $userlogin->google_user_id,
				'user_device_id' => $userlogin->user_device_id,
				'user_id' => $userlogin->user_id,
				'is_logged_in'   => ($userlogin->user_pan != NULL & !empty($userlogin->user_pan))?1:0,
				'last_login_time'=> '',
				'token'=>$userlogin->token,
				'status_code'=>1
			);
		}
		else {
			$response = array('status_code'=>0,'message'=>'No record found.');
		}
	}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response));
	}


########### Check if User is Logged IN  ##################
	public function set_logged_in() 
	{  
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');

		$logininfo = json_decode(file_get_contents('php://input'), true);
		$google_id = $logininfo['google_user_id'];
		$device_id = $logininfo['user_device_id'];

		$set_status = $this->Api_user_model->set_logged_in($google_id, $device_id);
		if(isset($set_status) && !empty($set_status)){
			$response = array(
				'IS_SET_LOGGED_IN' => '1',
				'status_code'=>1
			);
		}
		else {
			$response = array('status_code'=>0,'message'=>'No record found or error occured.');
		}

		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response));
	}

############## Get users details #################################

	public function get_users()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
		
		$token = $this->input->get_request_header('Apli_key');

		$userinfo = $this->Api_user_model->get_users($para1='',$para2='');
		$userdetails = array();
		if(!empty($userinfo)){
			foreach($userinfo as $info){
				$response[] = array(
					'user_id' => $info->user_id,
					'google_id' => $info->google_id,
					'user_platform'=>$info->user_platform,
					'user_id' => $info->user_id,
					'user_status' => $info->user_status,
					'user_name' => $info->user_name,
					'user_dob' => $info->user_dob,
					'user_email' => $info->user_email,
					'user_mobile ' => $info->user_mobile,
					'profile_pic' => $info->profile_pic,
					'user_pan' => $info->user_pan,
					'account_type ' => $info->account_type,	
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

############## Get users details #################################
	public function get_user_details()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');

		$request_info = json_decode(file_get_contents('php://input'), true);

		$google_id = $request_info['google_user_id'];
		if (isset($google_id) && $google_id!='') 
		{
			$google_id    = $request_info['google_user_id'];
			$showinfo = true;

		} 
		else
		{
			$response = array('status_code'=>0,'message' => 'Please Enter Google Id');
			$showinfo = FALSE;

		}

		if (isset($request_info['pan_no'])) 
		{
			$pan_no    = $request_info['pan_no'];
		} 
		else {
			$pan_no ='';

		}
		if($showinfo){
			$userinfo = $this->Api_user_model->get_users($google_id,$pan_no );
			$userdetails = array();
			if(!empty($userinfo)){
				foreach($userinfo as $info){
					$response = array(
					'user_id' => $info->user_id,
					'google_user_id' => $info->google_user_id,
					'user_device_id' => $info->user_device_id,
					'user_platform'=>$info->user_platform,
					'user_id' => $info->user_id,
					'user_status' => $info->user_status,
					'user_name' => $info->user_name,
					'user_dob' => $info->user_dob,
					'user_email' => $info->user_email,
					'user_mobile ' => $info->user_mobile,
					'profile_pic' => $info->profile_pic,
					'user_pan' => $info->user_pan,
					'account_type ' => $info->account_type,	
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

	############## Get linked profiles users   #################################

	public function get_linked_profiles(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$data_received  = json_decode(file_get_contents('php://input'), true);
        $error = 0;
        $google_id = $data_received['google_user_id'] ;
		if(!$google_id)
			{   $error = 1;
				$message = 'Google_id is  mandatory';
			}
		if(!$error){
		$userinfo = $this->Api_user_model->get_linked_users($google_id,$status='');

		// array_map(function ($key, $value) {
		// 	if($value==null){
		// 		$value ="";
		// 	}
		//     return [$key => $value];
		// }, array_keys($userinfo), $userinfo);

		// print_r($userinfo);exit;
		
		$userdetails = array();
		if(!empty($userinfo)){
			foreach($userinfo as $info){
				$data[] = array(
					'user_id' => $info->user_id,
					'google_id' => $info->google_user_id,
					'user_platform'=>$info->user_platform,
					'user_id' => $info->user_id,
					'user_status' => $info->user_status,
					'user_name' => $info->user_name,
					'user_dob' => $info->user_dob,
					'user_email' => $info->user_email,
					'user_mobile ' => $info->user_mobile,
					'profile_pic' => $info->profile_pic,
					'user_pan' => $info->user_pan,
					'account_type' => $info->account_type ,	
					'status_code'=>1
				);
			}
			$status = 1;
			$message = 'Users List found';
		} else {
			$message = 'No record found';
		}

		$response = array(
			'status'=>$status,
			'message'=>$message,
			'data'=>$data
		);

	}	
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response));
	}
// 

####################################################
	public function save_user(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
		header("Access-Control-Allow-Headers: authorization, Content-Type");

		$token = $this->input->get_request_header('Authorization');
		$data = array();
		$status = 0;
		$error = 0;
		//$isValidToken = $this->Api_user_model->checkToken($token);

		$data_received  = json_decode(file_get_contents('php://input'), true);
		// pr($data_received );exit;
	
		if(!$data_received['google_user_id']) {   
			$error = 1; 
			$message = 'Google_id is  mandatory'; 
		}
		if(!$data_received['user_platform']) {   
			$error = 1;
			$message = 'User Platform is  mandatory';
		}
		if(!isset($data_received['user_id'])) {   
			$error = 1;
			$message = 'User id is mandatory';
		}
		if(!$data_received['user_dob']) {	
			$error = 1; 
			$message = 'Please Enter Date of Birth'; 
		} 
		if(!isset($data_received['user_email'])) {
			$error = 1; 
			$message = 'Please Enter email address'; 
		}
		
		if(!$data_received['user_pan']) {	
			$error = 1; 
			$message = 'Please enter PAN'; 
		}

		$checkpan = $this->is_pan_exist($data_received['user_pan']);
		if($checkpan==1)
		{
			$error = 1;
			$message = 'The PAN provided is already registered with us.';
		}

		if(!$error){
			if($data_received['user_id']){
				$userinfo = array( 
				
					'user_platform' => $data_received['user_platform'],
					'user_ip_address' => $data_received['user_ip_address'], 
					'user_status'   => '1',  	
					'user_name'     => $data_received['user_name'],
					'user_dob'      => $data_received['user_dob'],
					'user_email'    => $data_received['user_email'],
					'user_mobile'   => $data_received['user_mobile'],
					'profile_pic'   => $data_received['profile_pic'],
					'user_pan'      => $data_received['user_pan']
				);
				$this->Api_user_model->editUser($data_received['user_id'],$userinfo);
				$message = 'Record updated successfully';
			}else{
				$userinfo = array( 
					'google_user_id'     => $data_received['google_user_id'],
					'user_platform' => $data_received['user_platform'],
					'user_id' => $data_received['user_id'],
					'user_ip_address' => $data_received['user_ip_address'], 
					'user_status'   => '1',  	
					'user_name'     => $data_received['user_name'],
					'user_dob'      => $data_received['user_dob'],
					'user_email'    => $data_received['user_email'],
					'user_mobile'   => $data_received['user_mobile'],
					'profile_pic'   => $data_received['profile_pic'],
					'user_pan'      => $data_received['user_pan'], 
					'account_type'      => 2,
					'user_created'  =>  date('Y-m-d H:i:s')

				);
				$id = $this->Api_user_model->insertuser($userinfo);
				$message = 'Record added successfully';
			}
			
			$status = 1;
			
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
 
 

 ## check if PAN Exists ### 
	public function is_pan_exist()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		$status = 0;
		$data = array();
		$request = json_decode(file_get_contents('php://input'), true);
		$pan = $request['pan'];
		if(!$pan) {
			$message = 'Please Provide PAN'; 
		}else {
			$is_pan_exits = $this->Api_user_model->checkpan($pan); 
			$status = 1;
			$message = 'PAN is already exists';
			$data = $is_pan_exits; 
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
	public function updateUserDeviceToken()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		$status = 0;
		$data = array();
		$request = json_decode(file_get_contents('php://input'), true);
		$user_id = $request['user_id'];
		$device_token = $request['device_token'];
		if(!$user_id) {
			$message = 'User id required'; 
		}elseif(!$device_token){
			$message = 'Device token is mandatory';
		}else {
			$is_pan_exits = $this->Api_user_model->editUser($user_id,array('device_token'=>$device_token)); 
			$status = 1;
			$message = 'User token updated successfully';
			$user_info = $this->Api_user_model->getUser($user_id);
			$data = $user_info; 
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
	public function userFeedback()
	{
		header("Access-Control-Allow-Origin: *");

		$token = $this->input->get_request_header('Apli_key');
		$status = 0;
		$data = array();
		$request = json_decode(file_get_contents('php://input'), true);
		$user_id = isset($request['user_id'])?$request['user_id']:0;
		$user_rating = isset($request['user_rating'])?$request['user_rating']:0;
		$user_feedback = isset($request['user_feedback'])?$request['user_feedback']:"";
		
		if(!$user_id) {
			$message = 'User id required'; 
		}elseif(!$user_rating){
			$message = 'User rating is mandatory';
		}elseif(empty($user_feedback)){
			$message = 'User feedback is mandatory';
		}else {
			$feedback_data = array(
				'user_id'=>$user_id,
				'feedback_star'=>(int)$user_rating,
				'feedback_message'=>$user_feedback,
				'feedback_status'=>0,
				'feedback_date'=>date('Y-m-d H:i:s')
			);
			$is_pan_exits = $this->Api_user_model->addFeedback($feedback_data); 
			$status = 1;
			$message = 'Your feedback submitted successfully';
			// $user_info = $this->Api_user_model->getUser($user_id);
			// $data = $user_info; 
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
