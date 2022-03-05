<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Gst_user_model');
		$this->load->library("pagination");
	}

	
	public function index(){
		redirect('users/usersList');
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
		$data['user_list']  = $this->User_model->getUsers($filterArray,$per_page, $offset);
		$total_rows = $this->User_model->get_last_calculated_total();
		$data['pg']=ceil($total_rows/$per_page);
		$data['total_rows']=$total_rows;
	    $data["links"] = my_pagination($total_rows,$per_page,"user/");
		//echo "pre";print_r($data["links"])
		$data['role_id'] = $role_id;
		loadLayout('admin/user_mgt/list_user', $data, 'admin');
	
	}

	public function usersList(){
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;

		// $data['roles'] = $this->User_model->getRoleList();

		
		$data['user_list']  = $this->Gst_user_model->getUsers($filterArray);
		
		//echo "pre";print_r($data["links"])
		$data['role_id'] = $role_id;
		//loadLayout('admin/users/users_list', $data, 'admin');
	     $data['title'] = ' Users ';
		 $this->load->view('admin/users_list', $data);
	
	}

    /** get a single User detail */
	public function getUserDetail($uId){ 
	
	    $data = $this->Gst_user_model->getGSTUser($uId);

		if(!empty($data)) {
		 $this->load->view('admin/users/users_view', $data);
		 return;
		}
		echo '<h3 class="text-danger">Record not found!</h3>';
		
	}
    
	public function add_edit_user($admin_id = 0){
	
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data	
			pr($data);	
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
			if( $data['admin_id'] != 0 ) {
			
				if($this->input->post('password')  == '') {
					unset($params_data['password']); // in case user don't want to change password 
				}
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

}
