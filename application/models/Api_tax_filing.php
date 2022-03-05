<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_tax_filing extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

 ########### List tax filing category   ################
	public function get_tax_filing_category($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('doc_id', $id);
		 
	}	
	 if (isset($status) && $status!='') {
		$this->db->where('doc_status', $status);
		 
	}	$query = $this->db->get('order_file_master');
		
		if($query->num_rows()> 0) {
			return $query->result();
		}
		else{
			return false;
		}
		

	}		
	
 ########### Setting MIN And GST    ################
	public function get_min_charge_and_gst($id, $status) 
	{	
	 if (isset($id) && $id!='') {
		$this->db->where('doc_id', $id);
		 
	}	
	 	$query = $this->db->get('min_pay_gst_settings');
		
		if($query->num_rows()> 0) {
			return $query->row();
		}
		else{
			return false;
		}
		

	}
 
}
