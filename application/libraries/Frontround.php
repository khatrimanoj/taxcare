<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontround{
    
    function __construct(){
		
		$CI	=& get_instance();

	}

    public function getroundList(){
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('m_round');
        $CI->db->order_by("sort_order", "asc");

        $query = $CI->db->get();

        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;

        }
    }
    
    private function getDefaultFrontRound(){
        $CI =& get_instance();
        $CI->db->select('round_id');
        $CI->db->from('settings_default_round');
        $CI->db->where('round_type','FRONT');
        $query = $CI->db->get();

        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;

        }
    }

    public function setDefaultFrontRound(){
       $default_round = $this->getDefaultFrontRound();
       $_SESSION['FRONT_ROUND_CHOICE'] = $default_round[0]['round_id'];
    }

    public function setFrontRound($round_id){
        
       $_SESSION['FRONT_ROUND_CHOICE'] = $round_id;
       return true;
    }
    
    public function getFrontRound(){

       if(isset($_SESSION['FRONT_ROUND_CHOICE'])) {
        return $_SESSION['FRONT_ROUND_CHOICE'];
       }

       // set default round choice and return back
       $this->setDefaultFrontRound();
       return $_SESSION['FRONT_ROUND_CHOICE'];
    }
	
	 public function getRoundDetail(){
		
		    $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('m_round');
        $CI->db->where ("id", $this->getFrontRound());
        $query = $CI->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }
	
	
}