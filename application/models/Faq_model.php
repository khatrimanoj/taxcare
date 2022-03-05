
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Faq_model extends CI_Model
{

	public function insert($data)
	{
	    return $this->db->insert('faq_content', $data);    
	}
	
    public function update($faq_id,$data) {
	
		 $this->db->where('faq_id',$faq_id);
		
		 return $this->db->update('faq_content', $data);
		  //echo   $this->db->last_query();
	}
public function get_last_calculated_total()
	{
	    $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		return $query->row()->Count;
	    
	}
	public function getUserlist($filterArray,$per_page, $offset){
		$queryWhere = $filterArray['WHERE'];
		
		$query    	= "select SQL_CALC_FOUND_ROWS faq_content.*, faq_content.faq_id,faq_content.faq_content_answer ,faq_content.faq_question,faq_content.faq_status
		 from faq_content";
		$query .=" ORDER BY faq_id DESC LIMIT $offset, $per_page";
		$query = $this->db->query($query); 

		return  $query->result_array();		
	}
	
	public function getUsers($filterArray){
		$queryWhere = $filterArray['WHERE'];
		$query    	= "select * from users_details where " . implode(' AND ', $queryWhere) . " ";
		$query = $this->db->query($query); 

		return  $query->result_array();		
	}

	public function getUser($faq_id){
	
		$array = array('faq_content.faq_id' => $faq_id);
		$this->db->select('faq_content.faq_id,faq_content.faq_question, faq_content.faq_content_answer ,    faq_content.faq_status, faq_content.faq_status as user_faq_status');
			
		$this->db->from('faq_content');
		
		 
		
		$this->db->where($array);

		return  $this->db->get()->row_array();	
		
	}
	public function update_user_status($id, $status)
	{
		$data['status'] = $status;
		$this->db->where('id', $id);
		$this->db->update('faq_content', $data);
	}
		
	public function deleteUser($id)
	{
	    $this->db->where('id',$id);
	    $this->db->delete('faq_content');
	    
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
	
	 
	public function get_content_Id($id){
		 
	   return $this->db->get_where('faq_content',array('faq_id'=>$id))->row_array();


	}

}
