<?php 

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_user_model');
		$this->load->model('Notification_model');
 		$this->load->helper('url');
		$this->load->helper('text');
		error_reporting(0);
	}

	public function delete($notification_id=0){
		 $session = session();
		if($notification_id == 0){
			$session->setFlashdata('error', 'Notification not found');
		    return redirect()->to(base_url('admin/notification/list'));
		}
		$notification = new NotificationModel();
		// $userNotification->where('id',$notification_id);
		$del_res = $notification->delete(['id' => $notification_id]);

		// var_dump($del_res);
		$session->setFlashdata('message', 'Notification deleted successfully.');
		return redirect()->to(base_url('admin/notification/list'));

	}

	public function send(){
		header("Access-Control-Allow-Origin: *");
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$error = 0;
		$request = json_decode(file_get_contents('php://input'), true);
		if(!isset($request['user_id']) && ($request['user_id'] < 1)){
			$error= 1;
			$message= "User id token required";

		}

		if(!isset($request['title']) && empty($request['title'])){
			$error= 1;
			$message= "Title is required";

		}

		if(!isset($request['message']) && empty($request['message'])){
			$error= 1;
			$message= "Message is required";

		}

		$user_info = $this->Api_user_model->getUser($request['user_id']);
		// print_r($user_info);exit;
		if($user_info->device_token == null || empty($request['user_id'])){
			$error= 1;
			$message= "User device token is not updated";
		}

		if(!$error){
			$title = $request['title'];
			$message = $request['message'];
			$image = isset($request['image'])?$request['image']:"";
			// $device_token = $request['device_token'];
			$userToken[] = $user_info->device_token;

			$notification_data = array(
				'title'=>$request['title'],
				'message'=>$request['message'],
				'image'=>$request['image']
			);

			$notification_id = $this->Notification_model->addNotification($notification_data);
			$add_user_noti = array(
				'notification_id'=>$notification_id,
				'user_id'=>$request['user_id']
			);
			$this->Notification_model->addUserNotification($add_user_noti);

			$results = $this->sendGCM($notification_data, $userToken);
			$data = json_decode($results);
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

	function sendGCM($data, $id) {
	    $url = 'https://fcm.googleapis.com/fcm/send';
	    $registrationIds = $id;

	    // prep the bundle
	    $msg = array
	    (
	    	'message' 	=> $data['message'],
	    	'title'		=> $data['title'],
	    	'subtitle'	=> 'This is a subtitle. subtitle',
	    	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	    	'vibrate'	=> 1,
	    	'sound'		=> 1,
	    	'largeIcon'	=> $data['image'],
	    	'smallIcon'	=> ''
	    );

	    $fields = array
	    (
	    	'registration_ids' 	=> $registrationIds,
	    	'data'			=> $msg
	    );

	    $headers = array (
	            'Authorization: key=' . "f6pGB2kE1kNHpNSYe0TKxy:APA91bGM88KkkbZTK5m5tSjNpGBOe21365rLl3opLRXZaacSYB9XOAAyjiTBmvCiqhauQH9AdXR-Ti6J0a1mIb6Az33Qjq_yS9WHdnrGtLazpYAqYXkJPU5eCV1r_8n0HjZ9bLHVdqxk",
	            'Content-Type: application/json'
	    );
	     // print_r($fields);exit;
	   

	    $ch = curl_init();
	    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	    curl_setopt( $ch,CURLOPT_POST, true );
	    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	    $result = curl_exec($ch );

	    curl_close( $ch );
	     return $result;

	}

	public function getUserNofications(){
		header("Access-Control-Allow-Origin: *");
		$token = $this->input->get_request_header('Apli_key');
		$data = array();
		$status = 0;
		$error = 0;
		$request = json_decode(file_get_contents('php://input'), true);
		if(!isset($request['user_id']) && ($request['user_id'] < 1)){
			$error= 1;
			$message= "User id token required";

		}
		
		if(!$error){
			$data = $this->Notification_model->getUserNofications($request['user_id']);
			if($data){
				$status = 1;
				$message = "User List Found";
			}else{
				$message = "User Notificationi List not Found";
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
