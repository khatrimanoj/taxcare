
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_faq_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List faqs  ################
	public function get_faqs($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('faq_id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('faq_status', $status);
		 
	}	
		$query = $this->db->get('faq_content');
		 // echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}		
	
################################################################################
  
	 
 public function insertfaqs($Data)
	{
		$this->db->insert('users_details', $Data);
		return $this->db->insert_id();
	}


 
}
