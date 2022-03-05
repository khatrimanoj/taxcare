
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Query_data_model extends CI_Model
{

	public function insert($data)
	{
	    return $this->db->insert('query_data', $data);    
	}
	
    public function update($admin_id,$data) {
	
		 $this->db->where('id',$admin_id);
		
		 return $this->db->update('query_data', $data);
		 
	}
public function get_last_calculated_total()
	{
	    $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		return $query->row()->Count;
	    
	}
	public function getUserlist($filterArray,$per_page, $offset){
		 
		
		$query    	= "select * from query_data  ";
	 
		$query = $this->db->query($query); 

		return  $query->result_array();		
	}
	
	public function getUsers($filterArray){
		$queryWhere = $filterArray['WHERE'];
		$query    	= "select * from users_details where " . implode(' AND ', $queryWhere) . " ";
		$query = $this->db->query($query); 

		return  $query->result_array();		
	}

	public function getUser($admin_id){
	
		$array = array('tbl_admin_login.admin_id' => $admin_id);
		$this->db->select('tbl_admin_login.admin_id,tbl_admin_login.username, tbl_admin_login.fname, tbl_admin_login.mobile, tbl_admin_login.email, tbl_admin_login.status, tbl_admin_login.status as user_status, tbl_admin_login.role_id, m_role.role_name,tbl_admin_login.firm_name,tbl_admin_login.designation ');
			
		$this->db->from('tbl_admin_login');
		
		$this->db->join('m_role', 'tbl_admin_login.role_id = m_role.role_id', 'left');
		
		$this->db->where($array);

		return  $this->db->get()->row_array();	
		
	}
 
		
	public function deleteUser($id)
	{
	    $this->db->where('id',$id);
	    $this->db->delete('query_data');
	    
	    //echo $this->db->last_query();die;
	    if($this->db->affected_rows() > 0)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	            
	        
	    }
	}
	
 

 
 
		
 public function get_a_query($id){
		 
	   return $this->db->get_where('query_data',array('id'=>$id))->row();


	 
	}

}
