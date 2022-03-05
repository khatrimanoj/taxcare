<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal_doc extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Policy_model');	
		$this->load->library("pagination");
	}
	public function index(){
		 
		$data['records']=$this->Policy_model->get_legal_pages($pageid='');
		$data['content']='';
		$data['title'] = ' Legal Docments ';
		$this->load->view('admin/Legal_doc', $data);
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

	  ##      page  Details ####
    public function edit_page($pageid)
    {    
    	$data['title'] = 'Edit' ;       
        if ($pageid == '' ) {
            $data['messsage'] = 'No Record Found Or Invalid Request';
            $this->load->view('NoRequestFound', $data);
        } else {
            $data['details'  ] = $this->Policy_model->get_legal_pages_Id($pageid);
                     
            $this->load->view('admin/Legal_doc_edit', $data);
        }
    }
    ######### // ends applicant details ##############

    public function save_edit_page(){
		$this->form_validation->set_rules('page_title', 'Page Title ', 'required');
		$this->form_validation->set_rules('descriptions', 'Descriptions', 'required'); 

		$data['layout_type'] =   'popup';
		
		 $errors = array();
		if ($this->form_validation->run() == FALSE) {
			    $data['title'] = '  Edit   ';	
			     // $json_response['form_errors'] = $this->form_validation->error_array();
			     // exit(json_encode($json_response));

			     $errors['validation_error'] = validation_errors();
			        echo json_encode($errors);
			        exit();
			    // echo validation_errors();
				// $this->load->view('admin/superadmin/admin_lists', $data);
				 // return;
	  	}else {
	        /* Server Side Script */

	        $is_error = 0;
	        $page_id      = clean_data($this->input->post('page_id', TRUE));
			$data['page_title']   = clean_data($this->input->post('page_title', TRUE));
			$data['page_content'] = clean_data($this->input->post('descriptions', TRUE));
		 	$data['status']       = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'page_title'    => $data['page_title'] ,
					'page_content'  => $data['page_content'] ,
			 		'page_status'   => intval($data['status']),
			 		'page_added_on' => date('Y-m-d H:i')

					);
			if(isset($page_id) && $page_id != 0 ) {
				$is_error = $this->Policy_model->update_page($page_id ,$params_data);
				
			} // Add new Page 
			/*else {
				$is_error = $this->User_model->insert_user($params_data);
				$data['admin_id'] = $this->db->insert_id(); 
			}
			*/

			if(!$is_error) {
				 $data['error'] = '  Record not  Saved try again !!.';
				  echo json_encode($data); 
				 // $this->load->view('admin/superadmin/admin_lists', $data);
				
			}else {		
				// $this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
				$data['success'] = '  Data Saved Successfully!!.';
				 echo json_encode($data); 
				// if( $data['layout_type'] == 'popup') {	
				// 	$userDetail =  $this->User_model->getUser($data['admin_id']);
				// 	if(empty($userDetail)) {
				// 		echo '<h3 class="text-danger">Record not found!</h3>';
				// 		return;
				// 	}
				// 	$data = array_merge($data, $userDetail);				
				// 	$this->load->view('admin/superadmin/admin_lists', $data);
				// }else {
				// 	redirect( $_SERVER['HTTP_REFERER']);
				// }
			}

	     }
	
	}
 
}
