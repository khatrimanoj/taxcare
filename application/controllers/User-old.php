<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('User_model');	
		$this->load->library("pagination");
	}

	
	public function index(){
	 
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;

		$data['roles'] = $this->User_model->getRoleList();

		$per_page = 40;
		$offset = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $per_page ) : 0;
		$data['per_page']=$per_page;
		$data['offset']=$offset;
		$data['user_list']  = $this->User_model->getUserlist($filterArray,$per_page, $offset);
		$total_rows = $this->User_model->get_last_calculated_total();
		$data['pg']=ceil($total_rows/$per_page);
		$data['total_rows']=$total_rows;
	    $data["links"] = my_pagination($total_rows,$per_page,"user/");
		//echo "pre";print_r($data["links"])
		$data['role_id'] = $role_id;

		//loadLayout('admin/user_mgt/list_user', $data, 'admin');
		  $data['title'] = ' Admins ';
          $this->load->view('admin/admin_lists', $data);
	
	}
    /** get a single User detail */
	public function getUserDetail($uId){ 
	
	    $data = $this->User_model->getUser($uId);
		if(!empty($data)) {
		 $this->load->view('admin/user_mgt/view_user', $data);
		 return;
		}
		echo '<h3 class="text-danger">Record not found!</h3>';
		
	}
    
	public function add_edit_user($admin_id = 0){
	
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data	
			//pr($data);	
	    }
		
		
		if($data['admin_id'] == 0 ) {
			// check user permission for add user
			if(!has_admin_permission_layout('ADD_USER',$this->input->post_get('layout_type'))) { return; }		
			$data['form_title'] = 'Add User';
		}
		else { 
			// Edit user is in popup
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->User_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Edit User';
			
		}
		
		$data['form_url'] = base_url('user/add_edit_user');

		$data['roles']  = $this->User_model->getRoleList();
			
		$this->save_user($data);
		
	}

##########################################
public function add_user($admin_id = 0){
		$data['title'] = 'Add User  ';	
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data	
			//pr($data);	
	    }
		
		
		if($data['admin_id'] == 0 ) {
			// check user permission for add user
			if(!has_admin_permission_layout('ADD_USER',$this->input->post_get('layout_type'))) { return; }		
			$data['form_title'] = 'Add User';
		}
		else { 
			// Edit user is in popup
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->User_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Edit User';
			
		}
		
		$data['form_url'] = base_url('user/add_user');

		$data['roles']  = $this->User_model->getRoleList();
			
		$this->save_add_user($data);
		
	}
	#############################################################
	private function save_add_user($data){
		
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
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $this->input->post('designation')  != '' ) ) {
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			}
		
		$this->form_validation->set_rules('fname', 'Full Name', 'required');
		$this->form_validation->set_rules('firmname', 'Firm Name', 'required');

	 
	 

		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
		
		
		if ($this->form_validation->run() == FALSE) {
			    $data['title'] = 'Add User  ';	
				$this->load->view('admin/add_admin', $data);
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
			$data['fname'] = clean_data($this->input->post('fname', TRUE));
			$data['mobile'] = clean_data($this->input->post('mobile', TRUE));
			$data['password'] =$this->input->post('password');
			$data['username'] = clean_data($this->input->post('username', TRUE));
			$data['fname'] = clean_data($this->input->post('fname', TRUE));
			$data['firm_name'] = clean_data($this->input->post('firmname', TRUE));
			$data['designation'] = clean_data($this->input->post('designation', TRUE)); 
			$data['email'] = clean_data($this->input->post('email', TRUE));
			$data['status'] = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'fname'    => $data['fname'] ,
					'mobile'   => $data['mobile'] ,
					'username' => $data['username'] ,
					'role_id'  => '5',
					'password' => md5($data['password'] ),
					'firm_name'=> $data['firmname'] ,
					'designation' =>$data['designation'] ,
					'email'    => $data['email'] ,
					'status'   => intval($data['status'] )
					);
			if( $data['admin_id'] != 0 ) {
			
		
				$is_error = $this->User_model->update_user($params_data,$data['admin_id'] );
				
			}else {
				$is_error = $this->User_model->insert_user($params_data);
				$data['admin_id'] = $this->db->insert_id();


			}
			

			if(!$is_error) {
				$this->session->set_flashdata('error', 'Data could not Saved!.');			
				loadLayout('admin/user_mgt/add_user', $data, $data['layout_type']);
				
			}else {		
				$this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
				
				if( $data['layout_type'] == 'popup') {	
					$userDetail =  $this->User_model->getUser($data['admin_id']);
					if(empty($userDetail)) {
						echo '<h3 class="text-danger">Record not found!</h3>';
						return;
					}
					$data = array_merge($data, $userDetail);				
					loadLayout('admin/user_mgt/add_user', $data, $data['layout_type']);
				}else {
					redirect( $_SERVER['HTTP_REFERER']);
				}
			}

	     }
	
	}
	############################################################
	private function save_user($data){
	
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['username'] != $this->input->post('username')))  {
		
			$this->form_validation->set_rules('username', 'User Name', 'required|is_unique[tbl_admin_login.username]'); 
		}
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['mobile'] != $this->input->post('mobile'))) {
			 
			$this->form_validation->set_rules('mobile', 'Mobile', 'max_length[10]|min_length[10]|xss_clean|is_unique[tbl_admin_login.mobile]');
			
		}
		
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['email'] != $this->input->post('email'))) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[tbl_admin_login.email]');
		}
		
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $this->input->post('designation')  != '' ) ) {
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			}
		
		$this->form_validation->set_rules('fname', 'Full Name', 'required');
		$this->form_validation->set_rules('firmname', 'Firm Name', 'required');

	 
	 

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
			$data['fname'] = clean_data($this->input->post('fname', TRUE));
			$data['mobile'] = clean_data($this->input->post('mobile', TRUE));
			$data['username'] = clean_data($this->input->post('username', TRUE));
			$data['fname'] = clean_data($this->input->post('fname', TRUE));
			$data['firm_name'] = clean_data($this->input->post('firmname', TRUE));
			$data['designation'] = clean_data($this->input->post('designation', TRUE)); 
			$data['email'] = clean_data($this->input->post('email', TRUE));
			$data['status'] = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'fname'    => $data['fname'] ,
					'mobile'  => $data['mobile'] ,
					'username' => $data['username'] ,
					//'role_id' 	   => $data['fname'] ,
					'firm_name' => $data['firmname'] ,
					'designation' => $data['designation'] ,
					'email'    => $data['email'] ,
					'status'   => intval($data['status'] )
					);
			if( $data['admin_id'] != 0 ) {
			
		
				$is_error = $this->User_model->update_user($params_data,$data['admin_id'] );
				
			}else {
				$is_error = $this->User_model->insert_user($params_data);
				$data['admin_id'] = $this->db->insert_id();


			}
			

			if(!$is_error) {
				$this->session->set_flashdata('error', 'Data could not Saved!.');			
				loadLayout('admin/user_mgt/add_edit_user', $data, $data['layout_type']);
				
			}else {		
				$this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
				
				if( $data['layout_type'] == 'popup') {	
					$userDetail =  $this->User_model->getUser($data['admin_id']);
					if(empty($userDetail)) {
						echo '<h3 class="text-danger">Record not found!</h3>';
						return;
					}
					$data = array_merge($data, $userDetail);				
					loadLayout('admin/user_mgt/add_edit_user', $data, $data['layout_type']);
				}else {
					redirect( $_SERVER['HTTP_REFERER']);
				}
			}

	     }
	
	}
	
	public function unique_user_name(){

	    $username = $this->input->post('username');
	    $check = $this->db->get_where('tbl_admin_login', array('username' => $username), 1);
				if ($check->num_rows() > 0) 
				{
	        $this->form_validation->set_message('username', 'This name already exists in our database');
	        return FALSE;
	    }
	    return TRUE;
	}



	public function update_status(){

		$status = $this->input->post('status');
		$id 	= $this->input->post('id');
		$this->User_model->update_user_status($id, $status);

	}

	/*
	public function deleteUser(){

	$this->db->delete('tbl_admin_login', array('admin_id' =>$this->input->post('did')));
	echo $this->session->set_flashdata('success','Record Deleted Successfully');
	redirect('view_user');
	}
	*/
	public function roles(){
	
		// check user permission
		if(!has_admin_permission_layout('VIEW_ROLES')) { return; }
		
		$data['page_title'] = 'User Roles';	
	 	$data['roles'] = $this->User_model->getRoleList();
		loadLayout('admin/user_mgt/view_roles', $data, 'admin'); 
	}



	public function roles_permission($role_id){ 
		// check user permission
		if(!has_admin_permission_layout('EDIT_ROLE_PERMISSIONS')) { return; }
		$data['page_title'] = 'User Role Permissions';	
		$data['role_id'] = $role_id;
		$data['roles_permission'] = $this->User_model->getRolePermission($role_id);
		$data['role_detail'] = $this->User_model->getRole($role_id); 
		loadLayout('admin/user_mgt/role_permissions', $data, 'admin'); 
	}

	public function roles_permission_save(){ 

		$role_id = $this->input->post_get('role_id');
		$data['role_id'] = $role_id;

		if($this->User_model->saveRolePermissions($role_id)) {		
	       $this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
	    }else {
  		     $this->session->set_flashdata('error', 'User Data not Saved Successfully!!.');
	    }
        redirect( $_SERVER['HTTP_REFERER']);	
	}

	##########################  change password ##########################################
public function change_password_admin()
	{
	
	    $data['admin_id'] = $this->session->userdata['ADMIN']['admin_id'];
	
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->User_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data['form_url'] = base_url('Change-Password');
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Change Password';
			
		
		
		$data['form_url'] = base_url('user/change_password');

		$data['roles']  = $this->User_model->getRoleList();
			
		$this->save_change_password($data);
		
	}
#################################################################
public function change_password($admin_id = 0){
	
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data	
			//pr($data);	
	    }
		
		
		if($data['admin_id'] == 0 ) {
			// check user permission for add user
			if(!has_admin_permission_layout('ADD_USERs',$this->input->post_get('layout_type'))) { return; }		
			$data['form_title'] = 'Change Password';
		}
		else { 
			// Edit user is in popup
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->User_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Change Password';
			
		}
		
		$data['form_url'] = base_url('user/change_password');

		$data['roles']  = $this->User_model->getRoleList();
			
		$this->save_change_password($data);
		
	}
	#############################################################
	private function save_change_password($data){
		     $data['title'] = ' Change Password ';
	    	
			$this->form_validation->set_rules('newpassword', 'Password', 'trim|required');
			$this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|matches[newpassword]');
		 
	 
	 

		$data['layout_type'] =  'admin';
		
		
		if ($this->form_validation->run() == FALSE) {
			
			//loadLayout('admin/user_mgt/change_password', $data,  $data['layout_type']);
			$data['title'] = ' Change Password ';
			$this->load->view('admin/change_passrd', $data);
			return;
	  	}else {
	  		$is_error = 0;

	  		$pass=$this->input->post('old_password');
	  		   $npass=$this->input->post('newpassword');
	  		   $rpass=$this->input->post('re_password');
	  		   
  		       $this->db->select('*');
  		       $this->db->from('tbl_admin_login');
  		       $this->db->where('admin_id', $this->session->userdata['ADMIN']['admin_id']);
  		       $this->db->where('password',md5($pass));
  		       $query = $this->db->get();
  		       if($query->num_rows()==1){
  		           $data = array(
  		                          'password' => md5($npass)
  		                       );
  		           $this->db->where('admin_id', $this->session->userdata['ADMIN']['admin_id']);
  		           $is_error = $this->db->update('tbl_admin_login', $data);
  		       }
	  		 
			

			if(!$is_error) {
				$this->session->set_flashdata('error', 'Old Password does not matched.');			
				$this->load->view('admin/change_passrd', $data);
				
			}else {		
				$this->session->set_flashdata('success', 'Password changed Successfully!!.'); 
				redirect( $_SERVER['HTTP_REFERER']);
			}

	     }
	
	}
	############################################################

}
