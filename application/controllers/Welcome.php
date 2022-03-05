<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
        parent::__construct();

        $this->admin_info     =  $this->common->__check_session();
 

    }
	
	public function index()
	{
	  $this->load->model('Order_model');
	  $data = null;
	  $data['title'] = 'Admin Dashboard';
	  $data['order_list'] = $this->Order_model->getOrdersby_status($status ='1');
	  
	  $this->load->view('admin/superadmin_dasboard', $data);
	  

	}
	

}
