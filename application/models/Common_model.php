
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Common_model extends CI_Model
{

	  public function get_status_name($id)
        {
			 $this->db->select('name');
			 $this->db->from('order_status_master');
			 $this->db->where('id',$id); 
			 $query=$this->db->get();
			 $val=$query->row();
			 return $val;
       }
	
     
}
