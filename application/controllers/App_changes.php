<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_changes extends CI_Controller {
	
	 function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
        
        $this->load->model('Settings_model'); 
        $this->load->model('Calendar_model');
        $this->load->model('Payment_model');
        $this->load->model('Tools_model');
        $this->load->model('Tax_filing','TaxFiling'); 
        $this->load->helper('form');
        
    }

     

    public function index()
    {

      // check user permission
      if(!has_admin_permission_layout('EDIT_SETTINGS')) { return; }
      
       $data['page_title']  = 'Settings/App Changes'; 
       $data['appsetting']  = $this->Settings_model->getGlobalText();
       $data['calendar']    = $this->Calendar_model->getGlobalText();
       $data['payments']    = $this->Payment_model->getGlobalText();
       $data['tools']       = $this->Tools_model->getGlobalText();
       $data['gst_min_pay'] = $this->TaxFiling->get_min_charge_and_gst($var1='', $var2='');
       $data['file_catery']   = $this->TaxFiling->get_tax_filing_category($var1='', $var2='');
       $data['tab_edit']    = "active";
       $data['tab_designation'] = "";
       $data['tab_dept_n_post'] = "";
       $data['tab_branch'] = "";
       $data['tab_pending_request'] = "";

      //loadLayout('admin/settings/appchanges/add_edit_appchanges', $data, 'admin');
        $data['title'] = ' App Changes ';
        $this->load->view('admin/app_changes', $data);
      
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
        
      $this->db->trans_start();
      foreach($this->input->post('id') as $id) {
         $data=array(
          'title'=>$this->input->post('title')[$id],
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
        $this->session->set_flashdata('success','Global Text set successfully!');  
      }

      redirect(base_url('calendar/incometax')); 
    }
       

        public function save_tax_filing_price(){
      // pr($this->input->post());exit;
      $this->db->trans_start();
      foreach($this->input->post('id') as $id) {
         $data=array(
          'filing_cost'=>$this->input->post('filing_cost')[$id],
          //'doc_name'=>$this->input->post('description')[$id]
        );
         //pr($data);
        $this->TaxFiling->update_tax_filing_settings($id,$data);
      }
//exit;
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'Could not saved !');
      }
      else {
        $this->db->trans_commit();
         $this->session->set_flashdata('Pricing', true); 
        $this->session->set_flashdata('success','Saved successfully!');  
      }

      redirect(base_url('App-Changes')); 
    }

### save MIN + GST RATE ####
       public function save_min_price_tax_rate(){
       // pr($this->input->post());exit;
      $this->db->trans_start();
         $id = $this->input->post('setting_id');
         $data=array(
          'gst_percent'=>$this->input->post('gst_percnt'),
          'min_charge_amount'=>$this->input->post('min_pay')
        );
        
         //pr($data);exit;
       
      $this->TaxFiling->update_tax_rate_min_charge($id,$data);
//exit;
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'Could not saved !');
      }
      else {
        $this->db->trans_commit();
         $this->session->set_flashdata('Pricing', true); 
        $this->session->set_flashdata('success','Saved successfully!');  
      }

      redirect(base_url('App-Changes')); 
    }
}
    
  