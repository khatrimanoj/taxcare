<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_user_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List Users  ################
	public function get_users($google_id, $pan_id) 
	{	
	 if (isset($google_id) && $google_id!='') {
		$this->db->where('google_user_id', $google_id);
		 
	}	
	 if (isset($pan_id) && $pan_id!='') {
		$this->db->where('user_pan', $pan_id);
		 
	}	
		$query = $this->db->get('users_details');
		 //  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}	
	
##########################################
	 ########### List Users  ################
	public function get_linked_users($google_id, $status) 
	{	
	 if (isset($google_id) && $google_id!='') {
		$this->db->where('google_user_id', $google_id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('user_status', $status);
		 
	}	
		$query = $this->db->get('users_details');
		 //  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}
	##########################################
 	public function checkToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('users_details');

		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}
	#########################################
 	public function insertuser($userData)
	{
		$this->db->insert('users_details', $userData);
		$insert_id= $this->db->insert_id();
		$this->updateUserId($insert_id);
		return $insert_id;
	}

	public function updateUserId($user_auto_id){
		$this->db->where('user_auto_id', $user_auto_id);
		$this->db->update('users_details', array('user_id'=>$user_auto_id)); 
	}

	public function editUser($user_auto_id,$data){
		$this->db->where('user_auto_id', $user_auto_id);
		$this->db->update('users_details', $data); 
	}

	public function updateUser($google_id,$data)
	{
		$this->db->where('google_user_id', $google_id);
		$this->db->update('users_details', $data); 
		return true;
	}


	public  function checkpan($pan_no )
	{
	 	$this->db->select('user_pan');
		$this->db->from('users_details');
		$this->db->where('user_pan', $pan_no); 
		$query = $this->db->get(); 
		  if ($query->num_rows() >0) {

			return 1;
			    
			  }
			  else { return 0;  }	
	 
	}
 
	############### check if user is logged In ###########################

	public function is_logged_in($google_id, $device_id) 
	{
		$this->db->where('google_user_id', $google_id);
		// $this->db->where('user_device_id', $device_id);
		$query = $this->db->get('users_details');

		if($query->num_rows() == 1) {
			$user_data = array(
				'user_device_id'=>$device_id,
				'token'=>$this->token(32)
			);
			$this->updateUser($google_id,$user_data);
			return $query->row();
		}else{
			$user_data = array(
				'google_user_id'=>$google_id,
				'user_device_id'=>$device_id,
				'account_type'=>1,
				'token'=>$this->token(32),
				'user_created'=>date('Y-m-d H:i:s')
			);
			$this->insertuser($user_data);
		}
	}

 
############### Set user   logged In ###########################

	public function set_logged_in($google_id, $device_id) 
	{
		$this->db->where('google_user_id', $google_id);
		$this->db->where('user_device_id', $device_id);
		$data=array('is_logged_in'=>'1');
		$this->db->update('logs_users', $data);
      	    if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else{
        	return false;
        }
	}

	public function getUserByGoogleId($google_id){
		$this->db->where('google_user_id', $google_id);
		$query = $this->db->get('users_details');
		return $query->row();
	}

	public function getUser($user_id){
		$this->db->where('user_auto_id', $user_id);
		$query = $this->db->get('users_details');
		return $query->row();
	}

	public function token($length = 32) {
		// Create random token
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
		$max = strlen($string) - 1;
	
		$token = '';
	
		for ($i = 0; $i < $length; $i++) {
			$token .= $string[mt_rand(0, $max)];
		}	
	
		return $token; 
	}

	############### User Feed Back ###########################
	public function addFeedback($data)
	{
		$this->db->insert('users_feedback', $data);
		$insert_id= $this->db->insert_id();
		return $insert_id;
	}


}