<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ministry{
    
   private $CI;

   function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->database();
   }

    public function getMinistriesList($include_all = false){
  
    /* 
        $CI->db->select('*');
        $CI->db->from('m_ministries');
		if($include_all == false) {
			$CI->db->where('is_line_ministry',1);
		}
		$CI->db->where('status',1);
        $CI->db->order_by("sort_order", "asc");

        $query = $CI->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        
    }*/
    
    }    

    
   
	
}