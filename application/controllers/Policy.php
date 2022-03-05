<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Policy_model');	
		$this->load->library("pagination");
	}

	
	 
	public function privacy(){
		$data['title']='Privacy Policy';
		$data['records']=$this->Policy_model->getGlobalTextById($pageid=1);
		$data['content']='';
		loadLayout('admin/policy/compose_view', $data, 'admin');
	} 
		public function terms_condition(){
		$data['title']='Terms & Condition';
		$data['records']=$this->Policy_model->getGlobalTextById($pageid=2);
		loadLayout('admin/policy/compose_view', $data, 'admin');
	}

		public function refund(){
		$data['title']='Refund  Policy';
		$data['records']=$this->Policy_model->getGlobalTextById($pageid=3);

		loadLayout('admin/policy/compose_view', $data, 'admin');
	}
 		public function eriddata(){
		$data['title']='ERI  Data';
		$data['records']=$this->Policy_model->getGlobalTextById($pageid=4);
		 
		loadLayout('admin/policy/compose_view', $data, 'admin');
	}
 
}
