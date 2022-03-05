
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_banner_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List Users  ################
	public function get_banners($banneris_id, $var2) 
	{	
	 if (isset($banneris_id) && $banneris_id!='') {
		$this->db->where('id', $banneris_id);
		 
	}	
	 if (isset($pan_id) && $pan_id!='') {
		$this->db->where('user_pan', $pan_id);
		 
	}	
		$query = $this->db->get('gallery');
		 //  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}	
	
################################################################################
  
	 
 public function insertbanner($Data)
	{
		$this->db->insert('users_details', $Data);
		return $this->db->insert_id();
	}


	public  function checkpan($pan_no )
	{
		$query = $this->db->get('users_details');
			 if (isset($pan_id) && $pan_id!='') {
		$this->db->where('user_pan', $pan_id); 
		 
	 if($query->num_rows()> 0)  
		{
			return 1;
		}
		else{
			return 0;
		}
	 
	} 
		 
		 
	 
}
 
}
