<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Appchanges_model');
		$this->load->model('Api_user_model');
		$this->load->model('Api_banner_model');
		$this->load->model('Api_faq_model'); 
		$this->load->model('Api_order_model'); 
		$this->load->helper('url');
		$this->load->helper('text');

	}

	public function put_order()
	{
		header("Content-Type: application/json");
		header("Acess-Control-Allow-Origin: *");
		header("Acess-Control-Allow-Methods: POST"); 
		header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");



######################################
$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
$token = $this->input->get_request_header('Apli_key');
if(isset($_FILES['sendimage'])) {
	$fileName  =  $_FILES['sendimage']['name'];
	$tempPath  =  $_FILES['sendimage']['tmp_name'];
	$fileSize  =  $_FILES['sendimage']['size'];
}    
if(empty($fileName))
{
	 
	$response = array('status_code'=>0,'message' => 'Please select image','status' => false);
	$error = true;
}
else
{
    $upload_path = 'C:/xampp/htdocs/admin/upload/'; // set upload folder path 
    
    $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); 

    // allow valid image file formats
    if(in_array($fileExt, $valid_extensions))
    {               
        //check file not exist our upload folder path
    	if(!file_exists($upload_path . $fileName))
    	{
            // check file size '5MB'
    		if($fileSize < 5000000){
                move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
            }
            else{       
             
            	$response = array('status_code'=>0,'message' => 'Sorry, your file is too large, please upload 5 MB size','status' => false);
            	$error = true;
            }
        }
        else
        {       
        	 
        	$response = array('status_code'=>0,'message' => 'Sorry, file already exists check upload folder','status' => false);
        	$error = true;
        }
    }
    else
    {       
    	 
    	$response = array('status_code'=>0,'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed','status' => false);
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
}
