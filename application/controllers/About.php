<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('User_model');	
		$this->load->library("pagination");
		//pr($this->admin_info );
	}

 
    /** get a single User detail */
	public function index(){ 
	$data['title'] = 'About Us '; 
	//loadLayout('admin/about/list_user', $data, 'admin');
	$this->load->view('admin/about-us', $data);	 
		
	}
    
 
 

}
