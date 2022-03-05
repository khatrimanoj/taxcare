<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appchanges_model extends CI_Model 
{
	 
	public function app_version($id, $var) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('setting_text');

		if($query->num_rows() == 1) {
			return $query->row();
		}
	}

 

 

	public function checkToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}

	 
 

	 
}
