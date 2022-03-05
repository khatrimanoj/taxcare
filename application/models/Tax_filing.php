<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Tax_filing extends CI_Model
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
			return $query->result_array();
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
			return $query->row_array();
		}
		else{
			return false;
		}
		

	}
		public function update_tax_filing_settings($id,$data){
		$this->db->where('doc_id', $id);
		$this->db->update('order_file_master', $data);
		//echo $this->db->last_query();exit;
		
	}
 
 		public function update_tax_rate_min_charge($id,$data){
 			//pr($data);exit;
		$this->db->where('id', $id);
		$this->db->update('min_pay_gst_settings', $data);
		//echo $this->db->last_query();exit;
		
	}
}
