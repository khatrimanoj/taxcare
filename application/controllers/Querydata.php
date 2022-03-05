<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Querydata extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Query_data_model');	
		$this->load->library("pagination");
	}

	
	public function index(){
	 $data['page_title'] = 'Query Data';
   $data['records']    = $this->Query_data_model->getUserlist($filterArray='',$per_page='', $offset='');
	 $data['title']      = ' Query Data ';
   $this->load->view('admin/querydata', $data);
	
	}
    
      public function edit_querydata($id)
    {    
      $data['title'] = 'Edit' ;       
        if ($id == '' ) {
            $data['messsage'] = 'No Record Found Or Invalid Request';
            } else {
            $data['details'  ] = $data['records']  = $this->Query_data_model->get_a_query($id);
                     
            $this->load->view('admin/querydata_edit', $data);
        }
    }
 	public function add_save_data(){
		$data['page_title'] = 'Add Faq';
		$this->form_validation->set_rules('Name', 'Name  ', 'required');
		$this->form_validation->set_rules('Type', ' Type ', 'required');
		$this->form_validation->set_rules('Section', ' Section ', 'required');
		if ($this->form_validation->run() == FALSE) {
		   $data['title'] = 'Add Faq  ';	
			 $this->load->view('admin/querydata_edit', $data);
			return;
	  	}else {
	    
	      // For State User
	         /* Server Side Script */
	    $data['id'] =  clean_data($this->input->post('id', TRUE));
			$data['Name'] = clean_data($this->input->post('Name', TRUE));
			$data['Type'] = clean_data($this->input->post('Type', TRUE));
			$data['Section']      = clean_data($this->input->post('Section', TRUE));
			$data['maxlimit']     = clean_data($this->input->post('maxlimit', TRUE));
			$data['Assesmentyr']  = clean_data($this->input->post('Assesmentyr', TRUE));
			$data['Section']      = clean_data($this->input->post('Section', TRUE));
 			$data['descriptions'] = clean_data($this->input->post('descriptions', TRUE));
 			$data['status'] = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'name'     => $data['Name'] ,
					'type	'    => $data['Type'] ,
		    	'section'  =>  $data['Section']  ,
		    	'max_limit'=> $data['maxlimit'] ,
		    	'assmnt_year' => $data['Assesmentyr'] ,
		    	'description' => $data['descriptions'] ,
		    	'status' => $data['status'] ,
		    	'date_added' => date('Y-m-d H:i')
		    	 
					);
			//pr($params_data ); exit;
			if( $data['id'] != 0 ) {
			
		
				$is_error = $this->Query_data_model->update($data['id'] ,$params_data);
				
			}else {
				$is_error = $this->Query_data_model->insert($params_data);
				$data['id'] = $this->db->insert_id();


			}
			

			if(!$is_error) {
				$this->session->set_flashdata('error', 'Data could not Saved!.');
				 $this->load->view('admin/add_faq', $data);
				//loadLayout('admin/faq/add_faq', $data, $data['layout_type']);
				
			}else {		
				$this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
				
				if( $data['layout_type'] == 'popup') {	
					$userDetail =  $this->Faq_model->getUser($data['admin_id']);
					if(empty($userDetail)) {
						echo '<h3 class="text-danger">Record not found!</h3>';
						return;
					}
					$data = array_merge($data, $userDetail);				
					//loadLayout('admin/faq/add_faq', $data, $data['layout_type']);
					 $this->load->view('admin/add_faq', $data);
				}else {
					redirect( $_SERVER['HTTP_REFERER']);
				}
			}

	     }
	
	}
}
