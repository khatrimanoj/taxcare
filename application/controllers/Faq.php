<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('Faq_model');	
		$this->load->library("pagination");
	}

	
	public function index(){
	 $data['page_title'] = 'Faq';
		$queryWhere    = array();	
		$role_id   = $this->input->get('role_id');
		
	     if (intval(trim($role_id)) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= $role_id";
	        }
		if (!count($queryWhere) > 0) {
	            $queryWhere[] = 1;
	        }	

		$filterArray['WHERE'] = $queryWhere;

		 

		$per_page = 40;
		$offset = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $per_page ) : 0;
		$data['per_page']=$per_page;
		$data['offset']=$offset;
		$data['records']  = $this->Faq_model->getUserlist($filterArray,$per_page, $offset);
		$total_rows = $this->Faq_model->get_last_calculated_total();
		$data['pg']=ceil($total_rows/$per_page);
		$data['total_rows']=$total_rows;
	    $data["links"] = my_pagination($total_rows,$per_page,"user/");
		//echo "pre";print_r($data["links"])
		$data['role_id'] = $role_id;
		//loadLayout('admin/faq/list_user', $data, 'admin');
	    $data['title'] = ' FAQ ';
          $this->load->view('admin/faqs', $data);
	
	}
 
    
	 
    public function edit_faq($pageid)
    {    
    	$data['title'] = 'Edit' ;       
        if ($pageid == '' ) {
            $data['messsage'] = 'No Record Found Or Invalid Request';
            $this->load->view('NoRequestFound', $data);
        } else {
            $data['details'] = $this->Faq_model->get_content_Id($pageid);
            //pr($data['details']);
             $this->load->view('admin/faqs_edit', $data);
                     
             }
    }
         
	
 

##########################################
public function add_faq($admin_id = 0){
	$data['title'] = 'Add Faq';
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data	
			//pr($data);	
	    }
		
		
		if($data['admin_id'] == 0 ) {
			// check user permission for add user
			if(!has_admin_permission_layout('ADD_USER',$this->input->post_get('layout_type'))) { return; }		
			$data['form_title'] = 'Add Faq';
		}
		else { 
			// Edit user is in popup
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->Faq_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Edit ';
			
		}
		
		
			
		$this->save_faq_data($data);
		
	}
	#############################################################
	private function save_faq_data($data){
	$data['page_title'] = 'Add Faq';
	  
		
		$this->form_validation->set_rules('question', 'Question  ', 'required');
		$this->form_validation->set_rules('answer', ' Answer ', 'required');

	 
	 

	 
		
		
		if ($this->form_validation->run() == FALSE) {
			 
			//loadLayout('admin/faq/add_user', $data,  $data['layout_type']);
			 $data['title'] = 'Add Faq  ';	
			 $this->load->view('admin/add_faq', $data);

			return;
	  	}else {
	    
	      // For State User
	      


	        /* Server Side Script */
			$data['question'] = clean_data($this->input->post('question', TRUE));
			$data['answer'] = clean_data($this->input->post('answer', TRUE));
 			$data['status'] = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'faq_question'    => $data['question'] ,
					'faq_content_answer	'   => $data['answer'] ,
		    		'faq_status'   =>  $data['status']  ,
		    		'date_added' => date('Y-m-d H:i')
		    	 
					);
			//pr($params_data ); exit;
			if( $data['admin_id'] != 0 ) {
			
		
				$is_error = $this->Faq_model->update($params_data,$data['admin_id'] );
				
			}else {
				$is_error = $this->Faq_model->insert($params_data);
				$data['admin_id'] = $this->db->insert_id();


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
 



	public function update_status(){

		$status = $this->input->post('status');
		$id 	= $this->input->post('id');
		$this->Faq_model->update_user_status($id, $status);

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
	 	$data['roles'] = $this->Faq_model->getRoleList();
		loadLayout('admin/faq/view_roles', $data, 'admin'); 
	}

 
	#############################################################
	public function save_edit_faq(){
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required'); 

		$data['layout_type'] =   'popup';
		
		 $errors = array();
		if ($this->form_validation->run() == FALSE) {
			    $data['title'] = '  Edit   ';				 
		        $errors['validation_error'] = validation_errors();
			        echo json_encode($errors);
			        exit();
			    
	  	}else {
	        /* Server Side Script */

	        $is_error = 0;
	        $page_id      = clean_data($this->input->post('id', TRUE));
			$data['question']   = clean_data($this->input->post('question', TRUE));
			$data['answer'] = clean_data($this->input->post('answer', TRUE));
		 	$data['status']     = clean_data($this->input->post('status', TRUE));

			$params_data = array(
					'faq_question'    => $data['question'] ,
					'faq_content_answer'  => $data['answer'] ,
			 		'faq_status'   => intval($data['status']),
			 		'date_added' => date('Y-m-d H:i')

					);
			if(isset($page_id) && $page_id != 0 ) {
				$is_error = $this->Faq_model->update($page_id ,$params_data);
				
			}  

			if(!$is_error) {
				 $data['error'] = '  Record not  Saved try again !!.';
				  echo json_encode($data); 
			  $this->session->set_flashdata('error', $this->db->_error_message());   
             redirect(base_url('Faq')); 
				 
				
			}else {		
				 
				$data['success'] = '  Data Saved Successfully!!.';
				 echo json_encode($data); 
			         $this->session->set_flashdata('success', "Data Saved Successfully");
       				 redirect(base_url('Faq'));  
				 
			}

	     }
	
	}
	############################################################

}
