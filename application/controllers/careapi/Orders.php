<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_order_model'); 
		$this->load->model('Api_user_model');
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
		$request  = json_decode(file_get_contents('php://input'), true);
		$data = array();
		$status = 0;
		$error=0;
		$message = 'Please check your parameters.';
		if(!$request['user_id']){
			$error=1;
			$message = 'User id required.';
		}

		$order_info = $this->Api_order_model->get_orders($request['user_id']);
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
			$status = 1;
			$message ='User orders lists';
		} else {
			$message = 'No record found.';
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

############################# GET a ORDER Details ################
   public function get_order_details()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$token = $this->input->get_request_header('Apli_key');
		$request  = json_decode(file_get_contents('php://input'), true);
		$data = array();
		$status = 0;
		$error=0;
		$message = 'Please check your parameters.';
		if(!isset($request['user_id']) || ($request['user_id'] < 1)) {
			$error=1;
			$message = 'User id required.';
		}

		// if(!$request['user_id']){
		// 	$error=1;
		// 	$message = 'User id required.';
		// }

		// $order_id = $request['order_id'];
		// $user_id = $request['user_id'];
		

		if(!$error){
		// $order_info = $this->Api_order_model->getOrder($request['user_id']);
		$user_info = $this->Api_user_model->getUser($request['user_id']);
		$order_docs = $this->Api_order_model->getUserDodumentList($request['user_id']);
		if(!empty($user_info)){
				$data['user_info'] = array(
					'google_user_id' => $user_info->google_user_id,
					'user_id' => $user_info->user_id,
					'user_name' => $user_info->user_name,
					'user_dob' => $user_info->user_dob,
					'user_email' => $user_info->user_email,
					'user_mobile' => $user_info->user_mobile,
					'profile_pic' => $user_info->profile_pic,
					'user_pan' => $user_info->user_pan
				);

			$data['user_docs'] = $order_docs;
			$status = 1;
			$message ='User order details lists';
		} else {
			$message = "No record found";
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
##################################### 



	############################# GET a ORDER Details ################
   public function getUserOrder()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$request  = json_decode(file_get_contents('php://input'), true);
		
		$user_id = $request['user_id'];
		$token = $this->input->get_request_header('Apli_key');
		$error  = false;
		$status = 0;
		$data = array();

		if(!(int)$user_id)
		{   $error = true;
				$message = 'User id is mandatory';
		}
		 
		if(!$error){
			$order_info = $this->Api_order_model->getUserOrder($user_id);
			if($order_info){
				$data = $order_info;
				$status =1;
				$message = 'Order detail record found.';
			}else{
				$message = 'User has no order yet';
			}
			
			
		} else {
			$message = 'No record found.';
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
		'file_status'=>0,
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
       			'file_status'=>0,
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

  public function createOrder(){
  	$this->load->library('PaytmChecksum');
      $mid = 'JAOtVV68890719191024';
      $pkey ="_U7iU@8qnYBKRL_O";
     	header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$data_received  = json_decode(file_get_contents('php://input'), true);
      
       $error=0;
       $message = '';

       if(!$data_received['user_id']) {
       		$error =1;
       		$message = 'User id required';
       }
       if(!$data_received['amount']) {
       		$error =1;
       		$message = 'Amount is required';
       }
       $user_id = $data_received['user_id'];
       $amount = $data_received['amount'];

      if(!$error){
          $paytmParams = array();
          $user_info = $this->Api_user_model->getUser($user_id);
          $financial_years = date('n') > 3 ? date('Y').'-'.date('y')+1 : (date('Y') - 1).'-'.date('y');
          	$order_data = array(
          		'google_id'=>$user_info->google_user_id,
          		'user_id'=>$data_received['user_id'],
          		'order_amount'=>$data_received['amount'],
          		'assmnt_year'=>$financial_years,
          		'fincl_year'=>$financial_years,
          		'customer_name'=>$user_info->user_name,
          		'applied_for'=>$user_info->account_type,
          		'payment_status'=>'0',
          		'order_status'=>0,
          		'order_date'=>date('Y-m-d H:i:s')
          	);

          	// print_r($order_data);exit;
          	$order_id = $this->Api_order_model->addOrder($order_data); 
          	if($order_id > 0){
          		$this->Api_order_model->updateOrderDoc($user_id,array('order_id'=>$order_id));
          	}
          // $orderId =  rand(100,100000);
          $paytmParams['body'] = array(
              'requestType'   =>'Payment',
              'mid'           =>$mid,
              'websiteName'   =>'DEFAULT',
              'orderId'       =>$order_id,
              'callbackUrl'   =>'https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id,
              'txnAmount'     => array(
                  'value'     =>$amount,
                  'currency'  =>'INR'
              ),
              'userInfo'=> array(
                  'custId'    =>$user_id
              )
          );
          $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams['body'], JSON_UNESCAPED_SLASHES),$pkey);
          $paytmParams['head'] = array(
              'signature'=>$checksum
          );
          $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
          /* for Staging */
          $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
              "content-type: application/json"
            )
          ));
          $gateway_result = curl_exec($curl);
          $initiateTransaction = json_decode($gateway_result);
          $data = array(
              'user_id'=>$user_id,
              'order_id'=>$order_id,
              'amount'=>$amount,
              'callbackUrl'=>'https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id,
              'mid'=>$mid,
              'checksum'=>$checksum,
              'is_production'=>1,
              'initiateTransaction'=>$initiateTransaction
              );
         
              $status = 1;
              $message='Your transaction is initiated.';
          
        
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
  
  public function getStagingPaytmCheksum(){
  	$this->load->library('PaytmChecksum');
      $mid = 'XIrGSD22365833879963';
      $pkey ="Y2m8L%ZcsrkO&oAu";
     	header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$data_received  = json_decode(file_get_contents('php://input'), true);
      
       $error=0;
       $message = '';

       if(!$data_received['user_id']) {
       		$error =1;
       		$message = 'User id required';
       }
       if(!$data_received['amount']) {
       		$error =1;
       		$message = 'Amount is required';
       }
       $user_id = $data_received['user_id'];
       $amount = $data_received['amount'];

      if(!$error){
          $paytmParams = array();
          $user_info = $this->Api_user_model->getUser($user_id);
          // print_r($user_info);exit;
          $financial_years = date('n') > 3 ? date('Y').'-'.date('y')+1 : (date('Y') - 1).'-'.date('y');
          	$order_data = array(
          		'google_id'=>$user_info->google_user_id,
          		'user_id'=>$data_received['user_id'],
          		'order_amount'=>$data_received['amount'],
          		'assmnt_year'=>$financial_years,
          		'fincl_year'=>$financial_years,
          		'customer_name'=>$user_info->user_name,
          		'applied_for'=>$user_info->account_type,
          		'payment_status'=>'0',
          		'order_status'=>0,
          		'order_date'=>date('Y-m-d H:i:s')
          	);


          	// print_r($order_data);exit;
          	$order_id = $this->Api_order_model->addOrder($order_data); 
          	if($order_id > 0){
          		$this->Api_order_model->updateOrderDoc($user_id,array('order_id'=>$order_id));
          	}
          // $orderId =  rand(100,100000);
          $paytmParams['body'] = array(
              'requestType'   =>'Payment',
              'mid'           =>$mid,
              'websiteName'   =>'DEFAULT',
              'orderId'       =>$order_id,
              'callbackUrl'   =>'https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id,
              'txnAmount'     => array(
                  'value'     =>$amount,
                  'currency'  =>'INR'
              ),
              'userInfo'=> array(
                  'custId'    =>$user_id
              )
          );
          $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams['body'], JSON_UNESCAPED_SLASHES),$pkey);
          $paytmParams['head'] = array(
              'signature'=>$checksum
          );
          $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
          /* for Staging */
          $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
              "content-type: application/json"
            )
          ));
          $gateway_result = curl_exec($curl);
          $initiateTransaction = json_decode($gateway_result);
          $data = array(
              'user_id'=>$user_id,
              'order_id'=>$order_id,
              'amount'=>$amount,
              'callbackUrl'=>'https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id,
              'mid'=>$mid,
              'checksum'=>$checksum,
              'is_production'=>1,
              'initiateTransaction'=>$initiateTransaction
              );
         
              $status = 1;
              $message='Your transaction is initiated.';
          
        
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

  public function updateOrderStatus(){
  	header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$data_received  = json_decode(file_get_contents('php://input'), true);
      
       $error=0;
       $message = '';

       if(!$data_received['order_id']) {
       		$error =1;
       		$message = 'Order id required';
       }

       if(!$data_received['payment_status']) {
       		$error =1;
       		$message = 'Order Status required';
       }
       $order_id = $data_received['order_id'];
       $payment_status = $data_received['payment_status'];

       if($payment_status == 1){
       		$order_status =3;
       		$file_status='1';
       }else{
       		$order_status =1;
       		$file_status='0';
       }

       if(!$error){
	       	$update_data = array(
	       		'payment_status'=>$payment_status,
	       		'order_status'=>$order_status
	       	);

	       	$this->Api_order_model->updateOrderStatus($order_id,$update_data);
	       	$file_data = array(
	       		'file_status'=>$file_status
	       	);
	       	$this->Api_order_model->updateFileStatus($order_id,$file_data);

	       	$status = 1;
	       	$message = "Your Payment Status updated successfully";

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

  public function getPaymentSuccess(){
  	header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$data_received  = json_decode(file_get_contents('php://input'), true);
      
       $error=0;
       $message = '';

       if(!$data_received['user_id']) {
       		$error =1;
       		$message = 'User id required';
       }
       $user_id = $data_received['user_id'];

       if(!$error){
	       	$orders = $this->Api_order_model->getPaymentSuccess($user_id);
	       	if($orders){
	       		foreach($orders as $order) {
	       			$data[] = array(
	       				'user_id'=>$order->user_id,
	       				'order_pan'=>$order->order_pan,
	       				'order_id'=>$order->order_id,
	       				'order_amount'=>$order->order_amount,
	       				'order_date'=>date('d M Y',strtotime($order->order_date))
	       			);
	       		}
	       		$message = "User Payment list ";
	       	}else{
	       		$message = "User has no payment done yet";
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

    public function updateITRPassword(){
    	header("Access-Control-Allow-Origin: *");
  		header("Access-Control-Request-Headers: GET,POST");
  		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
  		$token = $this->input->get_request_header('Apli_key');
  		$data = array();
  		$status = 0;
  		$data_received  = json_decode(file_get_contents('php://input'), true);
        
         $error=0;
         $message = '';

         if(!$data_received['user_id']) {
         		$error =1;
         		$message = 'User id required';
         }

         if(!isset($data_received['itr_password'])) {
         		$error =1;
         		$message = 'ITR password required';
         }
         $user_id = $data_received['user_id'];
         $itr_password = $data_received['itr_password'];

         if(!$error){
  	       	$update_data = array(
  	       		'itr_paswd'=>$itr_password
  	       	);

  	       	// $this->Api_order_model->updateOrderStatus($user_id,$update_data);
  	       	$status = 1;
  	       	$message = "Your ITR password updated successfully";

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

      public function getUserOrderStatus(){
      	header("Access-Control-Allow-Origin: *");
    		header("Access-Control-Request-Headers: GET,POST");
    		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
    		$token = $this->input->get_request_header('Apli_key');
    		$data = array();
    		$status = 0;
    		$data_received  = json_decode(file_get_contents('php://input'), true);
          
           $error=0;
           $message = '';

           if(!$data_received['user_id']) {
           		$error =1;
           		$message = 'User id required';
           }
           $user_id = $data_received['user_id'];

           if(!$error){
    	       	$order = $this->Api_order_model->getUserOrderSuccessByFinancialYear($user_id);
    	       	if($order){
    	       			$data = array(
    	       				'order_id'=>$order->order_id,
    	       				'order_status'=>$order->order_status_name,
    	       				'financial_year'=>$order->fincl_year,
    	       				'order_amount'=>$order->order_amount,
    	       				'order_date'=>date('d M Y',strtotime($order->order_date))
    	       			);
    	       		
    	       		$message = "User Order Status ";
    	       		$status = 1;
    	       	}else{
    	       		$message = "User has no order placed yet";
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

}
