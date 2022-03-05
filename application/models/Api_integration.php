<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_integration extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List faqs  ################
	public function get_youtube($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('status', $status);
		 
	}	
		$query = $this->db->get('setting_youtube');
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}		
	
################################################################################
 	public function get_banners($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('status', $status);
		 
	}	
		$query = $this->db->get('setting_social_media');
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}		
	

}
