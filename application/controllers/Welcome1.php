<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome1 extends CI_Controller {
	function __construct(){
        parent::__construct();

        $this->admin_info     =  $this->common->__check_session();
 

    }
	
	public function index()
	{
	  $data = null;
	  loadLayout('admin/welcome1', $data,'admin');

	}
	

}
