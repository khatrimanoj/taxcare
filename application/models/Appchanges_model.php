<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appchanges_model extends CI_Model 
{
########### Check Version Setting ################
	public function app_version($id, $var) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('setting_text');

		if($query->num_rows() == 1) {
			return $query->row();
		}
	}





	public function checkToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}


########### List calander  ################
	public function get_tax_calendar($id, $var2) 
	{	
		if (isset($id) && $id!='') {
			$this->db->where('id', $id);

		}	

		$query = $this->db->get('incometax_calendar');
//  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	} 
// ends //// 
########### List faqs  ################
	public function get_payment_settings($id, $var2) 
	{	
		if (isset($id) && $id!='') {
			$this->db->where('id', $id);

		}	
		if (isset($var2) && $var2!='') {
			$this->db->where('title', $var2);

		}	
		$query = $this->db->get('setting_paytm');
//  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}

########### Check Version Setting ################
	public function app_features($id, $var) 
	{
		//$this->db->where('id', $id);
		$query = $this->db->get('setting_text');

		//if($query->num_rows() == 1) {
			return $query->result_array();
		//}
	}
########### List tools  ################
	public function get_tools($id, $var2) 
	{	
		if (isset($id) && $id!='') {
			$this->db->where('id', $id);

		}	

		$query = $this->db->get('setting_tools');
//  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	} 
// ends //// 

	 ########### List faqs  ################
	public function get_query_data($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('status', $status);
		 
	}	
		$query = $this->db->get('query_data');
		 // echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}

	public function addUserBookmark($data) {
		$this->db->insert('query_data_bookmark', $data);
		$insert_id= $this->db->insert_id();
		return $insert_id;
	}	

	public function deleteUserBookmark($user_id,$bookmark_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('bookmark_id', $bookmark_id);
		$this->db->delete('query_data_bookmark');
		return true;
	}

	public function checkUserBookmark($user_id,$bookmark_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('bookmark_id', $bookmark_id);	
		$query = $this->db->get('query_data_bookmark');
		if($query->num_rows()> 0) {
			return true;
		}else{
			return false;
		}
	}

	public function getUserBookmark($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->join('query_data', 'query_data.id =query_data_bookmark.bookmark_id');
		$query = $this->db->get('query_data_bookmark');
		return $query->result();
	}

	public function getUserBookmarks($user_id) {
		$this->db->where('query_data_bookmark.user_id', $user_id);
		$this->db->join('query_data_bookmark', 'query_data.id = query_data_bookmark.bookmark_id',"LEFT");
		$query = $this->db->get('query_data');
		 echo $this->db->last_query();exit;
		
		return $query->result();
	}

	
}
