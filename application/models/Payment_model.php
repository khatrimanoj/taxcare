<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends MY_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

	 

 
 
	

 

	public function insertData($data){
		
		$this->db->insert('settings', $data);
		
		if ($this->db->trans_status() === FALSE)
        {
                return false;
        }
        
		return true;
	}

	public function getSettings($round_id){
		$this->db->where('round_id', $round_id);
		$query =  $this->db->get('settings');   

		$data= $query->result_array();
		return $data;
	}


  
 
 
	public function getGlobalText(){
		$data=$this->db->get('setting_paytm');
		$data=$data->result_array();
		return $data;
	}
	public function updateGlobalText($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('setting_paytm', $data);
		
	}
	public function getGlobalTextById($id){
	   return $this->db->get_where('setting_paytm',array('id'=>$id))->row();


	}

	

}
