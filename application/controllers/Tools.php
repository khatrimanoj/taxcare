<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools extends CI_Controller {
	
	 function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
        
        $this->load->model('Tools_model'); 
        $this->load->helper('form');
        
    }

     

    public function index()
    {

      // check user permission
      if(!has_admin_permission_layout('EDIT_SETTINGS')) { return; }
      
      $data['page_title'] = 'Data Entry Allowed'; 

      
    
  		$data['module']=$this->Tools_model->getModule();
      $data['states']=$this->State_district_block_model->getStates();
      $settingsArray =$this->Tools_model->getSettings();

      $settings = array();
      foreach($settingsArray as $val) {
    
        $settings['module_id_'.$val['module_id']]  = $val; 
        
      }
      $data['settings']= $settings; 

      loadLayout('admin/Setting_payment/settings', $data, 'admin');
      
    }
    
    
 
 
    

 
    
 
    public function globalText(){
      
      $data['records']=$this->Tools_model->getGlobalText();
      loadLayout('admin/payment/settings_global_text_view', $data, 'admin');

    }

    public function saveGolbalText(){
        
      $this->db->trans_start();
      foreach($this->input->post('id') as $id) {
         $data=array(
         // 'title'=>$this->input->post('title')[$id],
          'description'=>$this->input->post('description')[$id]
        );
        $this->Tools_model->updateGlobalText($id,$data);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'Could not saved !');
		  }
      else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success','Saved successfully ');
        $this->session->set_flashdata('Tools', true); 
      }

      redirect(base_url('App-Changes')); 
    }
    
}
    
  