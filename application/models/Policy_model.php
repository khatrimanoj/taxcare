<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Policy_model extends MY_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

	 

 

	public function getModule(){
		$query=$this->db->get('m_modules');
		$query=$query->result_array();
		return $query;
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
	public function update_page($id,$data){
		
		$this->db->where('page_id', $id);
		return $this->db->update('content_pages', $data);
		 //echo $this->db->last_query();exit;
		
	}
	public function get_legal_pages_Id($id){
		 
	   return $this->db->get_where('content_pages',array('page_id'=>$id))->row();


	}

		public function get_legal_pages(){
		$data=$this->db->get('content_pages');
		$data=$data->result_array();
		return $data;
	}

}
