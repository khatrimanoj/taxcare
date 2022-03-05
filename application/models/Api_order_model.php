
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Api_order_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	
	}

	public function addOrder($data){
		$this->db->insert('order_details', $data);
		return $this->db->insert_id();
	}

	public function updateOrderDoc($user_id,$data){
		$this->db->where('order_user_id', $user_id);
		$this->db->where('file_status', '0');
		$this->db->update('order_files', $data);
		return true;
	}

	public function updateFileStatus($order_id,$data){
		$this->db->where('order_id', $order_id);
		$this->db->update('order_files', $data);
		return true;
	}

	public function updateOrderStatus($order_id,$data){
		$this->db->where('order_auto_id', $order_id);
		$this->db->update('order_details', $data);
		return true;
	}

 ########### List Users  ################
	public function get_orders($order_id, $google_id,$var3) 
	{	
	 if (isset($order_id) && $order_id!='') {
		$this->db->where('order_id', $order_id);
		 
	}	
	 if (isset($google_id) && $google_id!='') {
		$this->db->where('google_id',$google_id);
		 
	}
	 if (isset($pan_id) && $pan_id!='') {
		$this->db->where('user_pan', $pan_id);
		 
	}	
		$query = $this->db->get('order_details');
		 //  echo $this->db->last_query();exit;
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}	

	 ########### List Success Orders ################
	public function getPaymentSuccess($user_id) {
		$this->db->where('user_id', $user_id); 
		$this->db->where('payment_status', '1'); 
		$query = $this->db->get('order_details');
		if($query->num_rows()> 0) {
			return $query->result();
		}
	}



	
	################################################################################
	public function getOrder($order_id)
	{	
	$this->db->select('order_details.*,order_status_master.name as order_status_name');

	 if (isset($order_id) && $order_id!='') {
		$this->db->where('order_auto_id ', $order_id);
		 
	}	
	//  if (isset($google_id) && $google_id!='') {
	// 	$this->db->where('google_id',$google_id);
		 
	// }
	//  if (isset($pan_id) && $pan_id!='') {
	// 	$this->db->where('user_pan', $pan_id);
		 
	// }	

	$this->db->join('order_status_master', 'order_details.order_auto_id =order_status_master.id');
		

		$query = $this->db->get('order_details');
		return $query->row();
	}

	################################################################################
	public function getUserOrder($user_id)
	{	
	$financial_years = date('n') > 3 ? date('Y').'-'.date('y')+1 : (date('Y') - 1).'-'.date('y');
	$this->db->select('order_details.order_auto_id,order_details.user_id,order_details.order_id,users_details.user_name,users_details.user_mobile,users_details.user_email,users_details.user_pan,order_details.fincl_year,order_details.order_amount,order_details.order_date,order_status_master.name as order_status_name'); 
	$this->db->where('order_details.user_id ', $user_id);
	$this->db->where('order_details.fincl_year ', $financial_years);

	//  if (isset($google_id) && $google_id!='') {
	// 	$this->db->where('google_id',$google_id);
		 
	// }
	//  if (isset($pan_id) && $pan_id!='') {
	// 	$this->db->where('user_pan', $pan_id);
		 
	// }	

	$this->db->join('order_status_master', 'order_details.order_auto_id =order_status_master.id');
	$this->db->join('users_details', 'users_details.user_auto_id =order_details.user_id');
		

		$query = $this->db->get('order_details');
		return $query->result();
	}	
  
	 
 public function insertorder($Data)
	{
		$this->db->insert('users_details', $Data);
		return $this->db->insert_id();
	}


  public function insert_image($Data)
	{
		$this->db->insert('order_files', $Data);
		return $this->db->insert_id();
	}


  public function deleteOrderDocument($order_file_id) {
  		$this->db->where('order_file_id', $order_file_id);
		$this->db->delete('order_files');
		return true;
	}


	public function getUserDodumentList($user_id){
		$this->db->select('ofm.doc_id,ofm.doc_name,ofm.upload_type,ofm.filing_cost,ofm.display_order,of.order_file_id,of.order_file_or_text');
		$this->db->where('of.order_user_id', $user_id); 
		$this->db->where('of.file_status <>', '1'); 
		$query = $this->db->from('order_files of'); 
		$this->db->join('order_file_master ofm', 'of.doc_master_id =ofm.doc_id',"LEFT");
		$query = $this->db->get();
		// echo $this->db->last_query();
		if($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function getUserDodumentListByCategoryId($user_id,$category_id){
		$this->db->select('ofm.doc_id,ofm.doc_name,ofm.upload_type,ofm.filing_cost,ofm.display_order,of.order_file_id,of.order_file_or_text');
		$this->db->where('of.order_user_id', $user_id); 
		$this->db->where('of.doc_master_id', $category_id); 
		$this->db->where('of.file_status <>', '1'); 
		$query = $this->db->from('order_files of'); 
		$this->db->join('order_file_master ofm', 'of.doc_master_id =ofm.doc_id',"LEFT");
		$query = $this->db->get();
		// echo $this->db->last_query();
		if($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}



	public function getUserDodumentListByOrderId($order_id){
		$this->db->select('ofm.doc_id,ofm.doc_name,ofm.upload_type,ofm.filing_cost,ofm.display_order,of.order_file_id,of.order_file_or_text');
		$this->db->where('order_id', $order_id); 
		$query = $this->db->from('order_files of'); 
		$this->db->join('order_file_master ofm', 'of.doc_master_id =ofm.doc_id');
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function getUserOrderSuccessByFinancialYear($user_id){
		$financial_years = date('n') > 3 ? date('Y').'-'.date('y')+1 : (date('Y') - 1).'-'.date('y');
		$this->db->select('of.*,osm.name as order_status_name');
		$this->db->where('of.user_id', $user_id); 
		$this->db->where('of.fincl_year', $financial_years); 
		$query = $this->db->from('order_details of'); 
		$this->db->join('order_status_master osm', 'of.order_status =osm.id');
		$query = $this->db->get();
		// echo $this->db->last_query();
		if($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

 
}
 