<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_orders extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Order_model');	
		$this->load->library("pagination");
	}

	
	public function index(){
		 $data['title'] = ' Orders ';
		 $this->load->view('admin/order_all', $data);
	
	}

	public function all(){
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;
		$data['orders']  = $this->Order_model->getOrders($filterArray);
		
		 
		$data['role_id'] = $role_id;
		loadLayout('admin/orders/orders_list', $data, 'admin');
	
	}

	public function completed(){
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
	    $queryWhere[] = " od.appl_status=1";
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;
		$data['orders']  = $this->Order_model->getOrders($filterArray);
		
		 
		$data['role_id'] = $role_id;
		loadLayout('admin/orders/order_completed', $data, 'admin');
	
	}


	public function pending(){
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
	    $queryWhere[] = " od.appl_status=2";
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;
		$data['orders']  = $this->Order_model->getOrders($filterArray);
		
		 
		$data['role_id'] = $role_id;
		loadLayout('admin/orders/order_pending', $data, 'admin');
	
	}

	public function refund(){
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
	     $queryWhere[] = " od.appl_status=4";
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;
		$data['orders']  = $this->Order_model->getOrders($filterArray);
		
		 
		$data['role_id'] = $role_id;
		loadLayout('admin/orders/order_refund', $data, 'admin');
	
	}


    /** get a single User detail */
	public function OrderDetail($order_id){ 
		$data['order']  = $this->Order_model->getOrder($order_id);
		// echo "<pre>";
		// print_r($data);exit;
		loadLayout('admin/orders/order_view', $data, 'admin');
		
	}
    
 


	
	private function save_order($data){
		$ordr_id = 'YYMMDD10001';
	
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['username'] != $this->input->post('username')))  {
		
			$this->form_validation->set_rules('username', 'User Name', 'required|is_unique[tbl_admin_login.username]'); 
		}
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['mobile'] != $this->input->post('mobile'))) {
			 
			$this->form_validation->set_rules('mobile', 'Mobile', 'max_length[10]|min_length[10]|xss_clean|is_unique[tbl_admin_login.mobile]');
			
		}
		
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['email'] != $this->input->post('email'))) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[tbl_admin_login.email]');
		}
		
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $this->input->post('password')  != '' ) ) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		}
		
		$this->form_validation->set_rules('fname', 'Full Name', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');

		if($this->input->post('role_id') == 1 ||  $this->input->post('role_id') == 2 
			|| $this->input->post('role_id') == 7 ||  $this->input->post('role_id') == 8 
		
		) { 
			 
		}
		if( $this->input->post('role_name') == 2  ||  $this->input->post('role_id') == 8 ) { 
			 
		}

		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
		
		
		if ($this->form_validation->run() == FALSE) {
			
			loadLayout('admin/user_mgt/add_edit_user', $data,  $data['layout_type']);
			return;
	  	}else {
	    
	      // For State User
	        if($this->input->post('role_id') == 1  || $this->input->post('role_id') == 7)
	        {
	        	$State_ID=$this->input->post('State_ID');
	        	$District_ID=0;

	        }
			// For District User
	        elseif($this->input->post('role_id') == 2  || $this->input->post('role_id') == 8)
	        {
	        	$State_ID=$this->input->post('State_ID');
	        	$District_ID=$this->input->post('District_ID');

	        }
	        else
	        {
	        	$State_ID=0;
	        	$District_ID=0;
	        }


	        /* Server Side Script */
		
			$params_data = array(
					'fname'    => $this->input->post('fname'),
					'mobile'  => $this->input->post('mobile'),
					'password' => md5($this->input->post('password')),
					'username' => $this->input->post('username'),
					'role_id' 	   => $this->input->post('role_id'),
					'email'    => $this->input->post('email'),
					'status'   => intval($this->input->post('status'))
					);
	 
	 

	     }
	
	}
	
 



 

  



	 
 

}
