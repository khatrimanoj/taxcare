<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('User_model');	
		$this->load->library("pagination");
	}

	
	public function inbox(){
	 
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		$data['title']='Inbox Message';
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
		 
		$data['role_id'] = $role_id;
		//loadLayout('admin/email/inbox_view', $data, 'admin');

		$this->load->view('admin/inbox', $data);
	
	}
	public function compose(){
		$data['title']='Compose Message';
		//loadLayout('admin/compose', $data, 'admin');
		$this->load->view('admin/compose', $data);
	} 

public function sent(){ 
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
		 
		$data['role_id'] = $role_id;

		//loadLayout('admin/email/sent_view', $data, 'admin');
		$data['title'] = 'Sent ';
		$this->load->view('admin/sent', $data);
}
}
