<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_order_model'); 
		$this->load->helper('url');
		$this->load->helper('text');
		//error_reporting(0);

	}

 ################### Get Orders  #######################################

	public function get_orders()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');

		$order_info = $this->Api_order_model->get_orders($para1='',$para2='');
		$response = array();
		if(!empty($order_info)){
			foreach($order_info as $info){
				$response[] = array(
					'google_id' => $info->google_id,
					'User_id' => $info->user_id,
					'Order_id' => $info->order_id,
					'assmnt_year' => $info->assmnt_year,
					'customer_name' => $info->customer_name,
					'fincl_year' => $info->fincl_year,
					'applied_for' => $info->applied_for,
					'order_pan' => $info->order_pan,
					'itr_paswd' => $info->itr_paswd,
					'order_status' => $info->order_status,
					'order_ip' => $info->order_ip,
					'order_assgn_to' => $info->order_assgn_to, 
					'order_type' => $info->order_type,
					'order_date_of_filing' => $info->order_date_of_filing,
					'order_amount'=> $info->order_amount,
					'payment_status'=> $info->payment_status ,  
					'order_amount'=> $info->appl_date_submit,
					'order_amount'=> $info->order_date,
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

############################# GET a ORDER Details ################
   public function get_order_details()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$request  = json_decode(file_get_contents('php://input'), true);

		$order_id = $request['order_id'];
		$google_id = $request['google_user_id'];
		$token = $this->input->get_request_header('Apli_key');
		$error  = false;
		if(!$order_id)
		{   $error = true;
		$response = array('status_code'=>0,'message' => 'Order_id is mandatory');
		}
		elseif(!$google_id)
		{   $error = true;
		$response = array('status_code'=>0,'message' => 'Google id is mandatory'  );
		}

		if(!$error){

		$order_info = $this->Api_order_model->get_orders($order_id,$google_id,$var3='');
		$response = array();
		if(!empty($order_info)){
			foreach($order_info as $info){
				$response[] = array(
					'google_id' => $info->google_id,
					'User_id' => $info->user_id,
					'Order_id' => $info->order_id,
					'assmnt_year' => $info->assmnt_year,
					'customer_name' => $info->customer_name,
					'fincl_year' => $info->fincl_year,
					'applied_for' => $info->applied_for,
					'order_pan' => $info->order_pan,
					'itr_paswd' => $info->itr_paswd,
					'order_status' => $info->order_status,
					'order_ip' => $info->order_ip,
					'order_assgn_to' => $info->order_assgn_to, 
					'order_type' => $info->order_type,
					'order_date_of_filing' => $info->order_date_of_filing,
					'order_amount'=> $info->order_amount,
					'payment_status'=> $info->payment_status ,  
					'order_amount'=> $info->appl_date_submit,
					'order_amount'=> $info->order_date,
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
##################################### 



	############################# GET a ORDER Details ################
   public function get_order_summary()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$request  = json_decode(file_get_contents('php://input'), true);
		
		$google_id = $request['google_user_id'];
		$token = $this->input->get_request_header('Apli_key');
		$error  = false;

		if(!$google_id)
		{   $error = true;
		$response = array('status_code'=>0,'message' => 'Google id is mandatory'  );
		}
		 
		if(!$error){

		$order_info = $this->Api_order_model->get_orders($order_id='',$google_id,$var3='');
		$response = array();
		if(!empty($order_info)){
			foreach($order_info as $info){
				$response[] = array(
					'google_id' => $info->google_id,
					'User_id' => $info->user_id,
					'Order_id' => $info->order_id,
					'assmnt_year' => $info->assmnt_year,
					'customer_name' => $info->customer_name,
					'fincl_year' => $info->fincl_year,
					'applied_for' => $info->applied_for,
					'order_pan' => $info->order_pan,
					'itr_paswd' => $info->itr_paswd,
					'order_status' => $info->order_status,
					'order_ip' => $info->order_ip,
					'order_assgn_to' => $info->order_assgn_to, 
					'order_type' => $info->order_type,
					'order_date_of_filing' => $info->order_date_of_filing,
					'order_amount'=> $info->order_amount,
					'payment_status'=> $info->payment_status ,  
					'order_amount'=> $info->appl_date_submit,
					'order_amount'=> $info->order_date,
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
#####################################
############# Save Orders ##############
	public function put_order()
	{
		header("Content-Type: application/json");
		header("Acess-Control-Allow-Origin: *");
		header("Acess-Control-Allow-Methods: POST"); 
		header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

		$token = $this->input->get_request_header('Apli_key');

		define('UPLOAD_PATH_FILE','C:/xampp/htdocs/taxcare/upload/'); // local
		//define('UPLOAD_PATH_FILE','/taxcare/upload/'); // Server 


$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
$token = $this->input->get_request_header('Apli_key');
if(isset($_FILES['sendimage'])) {
	$fileName  =  $_FILES['sendimage']['name'];
	$tempPath  =  $_FILES['sendimage']['tmp_name'];
	$fileSize  =  $_FILES['sendimage']['size'];
}    
if(empty($fileName))
{

	$response = array('status_code'=>200,'message' => 'Please select image','status' => false);
	$error = true;
}
else
{
$upload_path = UPLOAD_PATH_FILE; // set upload folder path 

$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); 

if(in_array($fileExt, $valid_extensions))
{               

	if(!file_exists($upload_path . $fileName))
	{
// check file size '5MB'
		if($fileSize < 5000000){
move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
}
else{       

	$response = array('status_code'=>200,'message' => 'Sorry, your file is too large, please upload 5 MB size','status' => false);
	$error = true;
}
}
else
{       

	$response = array('status_code'=>200,'message' => 'Sorry, file already exists check upload folder','status' => false);
	$error = true;
}
}
else
{       

	$response = array('status_code'=>200,'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed','status' => false);
	$error = true;    
}
}

// if no error caused, continue ....
if(!isset($error))
{
	$data = array(
		'order_file_name'=>$fileName,
		'order_no'=>'23011989',
		'date_upload'=>date('Y-m-d H:i', time()),
		'file_status'=>'1',
		'uploaded_by_id'=>'111'
	);
	$this->Api_order_model->insert_image($data);

	$response = array('status_code'=>1,'message' => 'Image Uploaded Successfully', 'status_code' => true); 
}
######################################
$this->output
->set_status_header(200)
->set_content_type('application/json')
->set_output(json_encode($response));

}


public function orderInputType(){
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

       if(!$data_received['user_id']) {
       		$error =1;
       		$message = 'User id required';
       }

       if(!$data_received['order_text_name']) {
       		$error =1;
       		$message = 'Document input namerequired';
       }

       if(!$error){
       		$message = 'Categoty input insert successfully'; 
       		$status =1;
       		$upload_data = array(
       			'doc_master_id'=>$data_received['doc_id'],
       			'order_no'=>'',
       			'order_user_id'=>$data_received['user_id'],
       			'order_file_or_text'=>$data_received['order_text_name'],
       			'order_file_type'=>2,
       			'file_status'=>2,
       			'upload_file_type'=>1,
       			'date_upload'=>date('Y-m-d H:i:s')
       		);
       		$this->Api_order_model->insert_image($upload_data); 
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
