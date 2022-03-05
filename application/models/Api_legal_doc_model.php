
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_legal_doc_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List faqs  ################
	public function get_legal_docs($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('page_id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('page_status', $status);
		 
	}	
		$query = $this->db->get('content_pages');
		
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}		
	
 
}