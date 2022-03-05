<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar extends CI_Controller {
	
	 function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
        
        $this->load->model('Calendar_model'); 
        $this->load->helper('form');
        
    }

     

    public function index()
    {

      // check user permission
      if(!has_admin_permission_layout('EDIT_SETTINGS')) { return; }
      
      $data['page_title'] = 'Data Entry Allowed'; 

      
    
  		 
       
      $settingsArray =$this->Calendar_model->getSettings();

      $settings = array();
      foreach($settingsArray as $val) {
    
        $settings['module_id_'.$val['module_id']]  = $val; 
        
      }
      $data['settings']= $settings; 

      loadLayout('admin/Setting_payment/settings', $data, 'admin');
      
    }
    
    
     public function setting_save() //for save,update and freeze
    { 
      // check user permission
      if(!has_admin_permission_layout('EDIT_SETTINGS')) { return; }
      $module=$this->Calendar_model->getModule();

      $states= $this->State_district_block_model->getStates();
      
      $settingsArray =$this->Calendar_model->getSettings($rid);
      extract($_POST);
      $records=array();

      


      $this->db->trans_begin();  // START TRANSACTION
      $is_insert_successful = false;  // flag to rollback if any of transaction failed

      $is_insert_successful = $this->Calendar_model->emptytableByRound();



      foreach ($module as $mod) {
        foreach($states as $st){
            if(isset($_POST['module_id_'.$mod['module_id'].'_State_ID_'.$st['State_ID']]))
            {
              $state_id=intval($_POST['module_id_'.$mod['module_id']]);
              $startdate=$this->input->post('start_date_module_id_'.$mod['module_id']);
              $enddate=$this->input->post('end_date_module_id_'.$mod['module_id']);
              // if start date and end date not inserted move to next itration

              if($startdate == ''  || $enddate == '') { continue; }

              $module_id= $mod['module_id'];
              //$round_id =$this->round->getRound();                              
              $data = array('round_id' => $round_id,
                          'module_id' => $module_id,
                          'start_date ' => $startdate,
                          'end_date' => $enddate,
                          
                        );
             $is_insert_successful = $this->Calendar_model->insertData($data);

            }

            if($is_insert_successful == false) {
              break; // break first loop
            }
          }

           if($is_insert_successful == false) {
                break; // break second loop
            }
        }
          

        // if all inserted correctly commit otherwise rollback 
        if ($is_insert_successful=== FALSE)
        {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Could not saved data!');
        }
        else
        {
                $this->db->trans_commit();
                $this->session->set_flashdata('Calendar', true); 
                $this->session->set_flashdata('success','Data saved successfully!');
        }


      redirect(base_url('admin/Setting_payment'));      

    }

 
 
    

 
    
 
    public function incometax(){
      $data['title']='Income Tax Calendar';
      $data['records']=$this->Calendar_model->getGlobalText();
      loadLayout('admin/incometax/income_tax_view', $data, 'admin');

    }

    public function saveGolbalText(){
       // print_r($this->input->post());exit;
      $this->db->trans_start();
      foreach($this->input->post('id') as $id) {
         $data=array(
          //'title'=>$this->input->post('title')[$id],
          'description'=>$this->input->post('description')[$id]
        );
        $this->Calendar_model->updateGlobalText($id,$data);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'Could not saved Global text!');
		  }
      else {
        $this->db->trans_commit();
        $this->session->set_flashdata('Calendar', true); 
        $this->session->set_flashdata('success','Saved successfully!');  
      }

      redirect(base_url('App-Changes')); 
    }
    
}
    
  