<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Integration extends CI_Controller {
	
	 function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
        
        $this->load->model('Media_model'); 
        $this->load->model('Youtube_model');          
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('upload');

    }

     

    public function index()
{
   
$data['page_title'] = ' Integration  ';

if($this->input->get_post('imgchk' )) {
$image_chk = 1;
}else{
$image_chk = 0;
}
 
 
$data['result_list']  = $this->Media_model->getGalleryList($filterArray='',$per_page='', $offset='');
$data['youtube_list'] = $this->Youtube_model->getGalleryList($filterArray='',$per_page='', $offset='');

$data['title'] = 'Integration';
$this->load->view('admin/integrations', $data);

}
    public function edit_youtube($pageid)
    {    
      $data['title'] = 'Edit' ;       
        if ($pageid == '' ) {
            $data['messsage'] = 'No Record Found Or Invalid Request';
            //$this->load->view('NoRequestFound', $data);
        } else {
            $data['details'] = $this->Youtube_model->get_youtube($pageid);
                   //  pr($data['details'] );exit;
            $this->load->view('admin/youtube_edit', $data);
        }
    }
    ######### // ends applicant details ##############
    public function edit_banner($id)
    {    
      $data['title'] = 'Edit' ;       
        if ($id == '' ) {
            $data['messsage'] = 'No Record Found Or Invalid Request';
            //$this->load->view('NoRequestFound', $data);
        } else {$filterArray=array('id'=>$id);
            $data['details'] = $this->Media_model->get_banner($id);
                     
            $this->load->view('admin/banner_edit', $data);
        }
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
        $this->session->set_flashdata('error', 'Could not saved !');
		  }
      else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success','Saved successfully!');  
      }

      redirect(base_url('calendar/incometax')); 
    }

      /* Banner Image save and Edit */
    
    private function validate() {

    $this->form_validation->set_rules('bannertitle', 'Title', 'trim|required');
     
    if(isset( $_FILES['bannerimg']['name'])){
      $image_field = $_FILES['bannerimg']['name'];
    }else{
      $image_field ='';
    }

    if($image_field==''   && $this->input->post('act')!='/'){
       $this->form_validation->set_rules('bannerimg', 'Image', 'required');
      }
    
     
         $publish=''; $approve='';
        if ($this->form_validation->run() == TRUE) {

          $checkval=$this->input->post('check');
          if($checkval)
          {
            $chk=$checkval;
          }
          else
          {
            $chk=0;
          }
 
 
 


        
            $requestdata = array(
                "name"      => $this->input->post('bannertitle'),
                "link"    =>   $this->input->post('link'),
                "status"      => $chk,
               
            );
      

            if ($_FILES['bannerimg']['name'] != '') {
                if (!is_dir('download/gallery/')) {
                    mkdir('./download/gallery/', 0777, TRUE);
                }
                $config['upload_path'] = './download/gallery/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '5120';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('bannerimg')) {
                    
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('bannerimg', 'File upload error.');
                    $this->session->set_flashdata('error', $error_msg);
                    return false;
                } else {
                    if ($this->input->post('id') != '') {
                        $this->common->delete("setting_social_media", $this->input->post('id'), "bannerimg");
                    }
                    $upload_ques = $this->upload->data();
                     $this->resizeSmallImage($upload_ques['file_name']);
                    $requestdata['image'] = $upload_ques['file_name'];
                }
            }

         
          
            return $requestdata;
        } else {
            $error_msg = validation_errors();
            $this->session->set_flashdata('title', "Title Required.");
            $this->session->set_flashdata('error', $error_msg);
            return false;
        }
    }
##################
    private function validate_edit_banner() {

    $this->form_validation->set_rules('bannertitle', 'Title', 'trim|required');
     
    if(isset( $_FILES['bannerimg']['name'])){
      $image_field = $_FILES['bannerimg']['name'];
    }else{
      $image_field ='';
    }
    $bannerimage = $this->input->post('hdn_banner_image');
    if($image_field=='' && $bannerimage =='') {
       $this->form_validation->set_rules('bannerimg', 'Image', 'required');
      }
    
     
         $publish=''; $approve='';
        if ($this->form_validation->run() == TRUE) {

          $checkval=$this->input->post('check');
          if($checkval)
          {
            $chk=$checkval;
          }
          else
          {
            $chk=0;
          }
 
 
 


        
            $requestdata = array(
                "name"      => $this->input->post('bannertitle'),
                "link"    =>   $this->input->post('link'),
                "status"      => $chk,
               
            );
      

             if(isset($_FILES['bannerimg']['name']) && $_FILES['bannerimg']['name'] != '') {
                if (!is_dir('download/gallery/')) {
                    mkdir('./download/gallery/', 0777, TRUE);
                }
                $config['upload_path'] = './download/gallery/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '5120';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('bannerimg')) {
                    
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('bannerimg', 'File upload error.');
                    $this->session->set_flashdata('error', $error_msg);
                    return false;
                } else {
                    if ($this->input->post('id') != '') {
                        $this->common->delete("setting_social_media", $this->input->post('id'), "bannerimg");
                    }
                    $upload_ques = $this->upload->data();
                     $this->resizeSmallImage($upload_ques['file_name']);
                    $requestdata['image'] = $upload_ques['file_name'];
                }
                            $requestdata = array(
                "name"      => $this->input->post('bannertitle'),
                "link"    =>   $this->input->post('link'),
                "status"      => $chk,
                "image"=>$requestdata['image']
               
            );
            }

         
          
            return $requestdata;
        } else {
            $error_msg = validation_errors();
            $this->session->set_flashdata('title', "Title Required.");
            $this->session->set_flashdata('error', $error_msg);
            //pr($error_msg)   ;
            return false;
        }
    }

public function save_add_banner() {

 
     
    if(isset($_POST) && count($_POST) > 0) {
      $data['row'] =  $this->input->post(NULL); // get all post data    
      }
      
        $requestdata = $this->validate();
    
 
    
        $data['title'] = 'Add  ';

   
    
        if (!empty($requestdata)) {
            if ($this->Media_model->insertdata("setting_social_media", $requestdata)) {
                //echo " a";
        $message=array("1",);
        $this->session->set_flashdata('success', "File Successfully Uploaded");
        redirect(base_url('Integration'));    
            } else {
         $this->session->set_flashdata('error', $this->db->_error_message());   
          redirect(base_url('Integration'));         
            }
        }
    
   
 
    }
###################################################
    public function save_edit_banner() {
        $admin_detail   = get_admin_detail($_SESSION['ADMIN']['admin_id']);
      // pr($_FILES);exit;
        $this->form_validation->set_rules('bannertitle', 'Banner Title ', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required'); 

        $data['layout_type'] =   'popup';
        $errors = array();
        if ($this->form_validation->run() == FALSE) {
                $data['title'] = '  Edit   ';   
                $errors['validation_error'] = validation_errors();
                    echo json_encode($errors);  exit();
            
        }else {
            /* Server Side Script */

            $is_error = 0;
            $id                    = clean_data($this->input->post('id', TRUE));
            $data['bannertitle']   = clean_data($this->input->post('bannertitle', TRUE));
            $data['link']          = clean_data($this->input->post('link', TRUE));
            $data['status']        = clean_data($this->input->post('status', TRUE));
            $data['image']         = clean_data($this->input->post('hdn_banner_image', TRUE));
 
            //
     //pr($_FILES);
            if ((isset($_FILES['bannerimg']['name']) && $_FILES['bannerimg']['name'] != '')) {
                if (!is_dir('download/gallery/')) {
                    mkdir('./download/gallery/', 0777, TRUE);
                }
                $config['upload_path'] = './download/gallery/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '5120';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('bannerimg')) {
                   // echo 'error in uplpad';
                    $data['error'] = $this->upload->display_errors();
                   // pr($data['error']);
                    $this->session->set_flashdata('bannerimg', 'File upload error.');
                    $this->session->set_flashdata('error', $data['error']);
                    return false;
                } else {  //echo 'no error in uplpad';exit;
                    if ($this->input->post('id') != '') {
                       // $this->Media_model->deletedata("setting_social_media", array('id'=>$id));
                    }
                    $upload_ques = $this->upload->data();
                    // $this->resizeSmallImage($upload_ques['file_name']);
                    $data['image'] = $upload_ques['file_name'];
                }
            }
                $params_data = array(
                "name"        => $data['bannertitle'] ,
                "link"        => $data['link'] ,
                "status"      => $data['status'],
                "uploaded_by" => $admin_detail['admin_id'] ,
                "image"       => $data['image'] 
            );
      
            //
            //pr($params_data);exit;
            if(isset($id) && $id != 0 ) {
              $is_error = $this->Media_model->update_banner($id ,$params_data);
                
            }  
            

            if(!$is_error) {
                 $data['error'] = '  Record not  Saved try again !!.';
                  //echo json_encode($data); //exit;
                 $this->session->set_flashdata('error', "File Successfully Uploaded");
                 redirect(base_url('Integration'));  
                
                
            }else {     
                
                $data['success'] = '  Data Saved Successfully!!.';
                // echo json_encode($data);  //exit;
                 $this->session->set_flashdata('success', "File Successfully Uploaded");
                 redirect(base_url('Integration'));  
                 
            }

         }
    
    }
    ######################################################
    public function save_add_youtube() {

    //pr($this->input->post());
    //pr($_FILES);
    //exit;
    $data['id'] =  $this->input->post('id');
    if(isset($_POST) && count($_POST) > 0) {
      $data['row'] =  $this->input->post(NULL); // get all post data    
      }
      
        $requestdata = $this->validate_youtube();
    
 
    
        $data['title'] = 'Add  ';

   
    
        if (!empty($requestdata)) {
          if( isset($data['id']) && $data['id'] != 0 ) {
        $this->Media_model->updatedata("setting_youtube", $requestdata, array("id" => $data['id'])); 
        $this->session->set_flashdata('success', "File Successfully Uploaded");
        redirect(base_url('Integration'));    
                
      }else {
        $is_error = $this->Media_model->insertdata("setting_youtube", $requestdata);
        $data['id'] = $this->db->insert_id(); 
        $this->session->set_flashdata('success', "File Successfully Uploaded");
          redirect(base_url('Integration')); 
      } 
        } else{

          $this->session->set_flashdata('error', "Some error occured");
           redirect(base_url('Integration')); 
         }

    
   /**/

   /**/
    // redirect(base_url('Integration')); 
 }
     
 public function resizeSmallImage($filename){
    
   $config['image_library'] = 'gd2';
   if (!is_dir('download/small_thumbnail/')) {
        mkdir('./download/small_thumbnail/', 0777, TRUE);
      }
      $source_path    = './download/gallery/' . $filename;    
      $small_file_path  = './download/small_thumbnail/'; 
      $this->load->library('image_lib', $config);

      $config_img = array(
          'image_library'  => 'gd2',
          'source_image'   => $source_path,
          'new_image'      => $small_file_path,
          'maintain_ratio' => TRUE,
          'create_thumb'   => TRUE,
          'thumb_marker'   => '',
          'width'        => 250,
          'height'         => 250
      );
    //showData($config_img);die;
      $this->image_lib->initialize($config_img);
      
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }
      $this->image_lib->clear();
   }

  ############################################################
      
    private function validate_youtube() {

    $this->form_validation->set_rules('youtubetitle', 'Title', 'trim|required');
     
    if(isset( $_FILES['youtubeimg']['name'])){
      $image_field = $_FILES['youtubeimg']['name'];
    }else{
      $image_field ='';
    }

    if($image_field==''   && $this->input->post('act')!='/'){
       $this->form_validation->set_rules('youtubeimg', 'Image', 'required');
      }
    
     
         $publish=''; $approve='';
        if ($this->form_validation->run() == TRUE) {

          $checkval=$this->input->post('check');
          if($checkval)
          {
            $chk=$checkval;
          }
          else
          {
            $chk=0;
          }
 
 
 


        
            $requestdata = array(
                "name"      => $this->input->post('youtubetitle'),
                "link"    =>   $this->input->post('youtubeid'),
                "status"      => $chk,
               
            );
      

            if ($_FILES['youtubeimg']['name'] != '') {
                if (!is_dir('download/gallery/')) {
                    mkdir('./download/gallery/', 0777, TRUE);
                }
                $config['upload_path'] = './download/gallery/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '5120';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('youtubeimg')) {
                    
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('youtubeimg', 'File upload error.');
                    $this->session->set_flashdata('error', $error_msg);
                    return false;
                } else {
                    if ($this->input->post('id') != '') {
                        $this->common->delete("setting_youtube", $this->input->post('id'), "youtubeimg");
                    }
                    $upload_ques = $this->upload->data();
                     $this->resizeSmallImage($upload_ques['file_name']);
                    $requestdata['image'] = $upload_ques['file_name'];
                }
            }

         
          
            return $requestdata;
        } else {
            $error_msg = validation_errors();
            $this->session->set_flashdata('youtubetitle', "Title Required.");
            $this->session->set_flashdata('error', $error_msg);
            return false;
        }
    }  
    ###################################################

    public function save_edit_youtube() {
        $admin_detail   = get_admin_detail($_SESSION['ADMIN']['admin_id']);
      // pr($_FILES);exit;
        $this->form_validation->set_rules('youtubetitle', ' Title ', 'required');
        $this->form_validation->set_rules('youtubeid', 'youtube video id', 'required'); 

        $data['layout_type'] =   'popup';
        $errors = array();
        if ($this->form_validation->run() == FALSE) {
                $data['title'] = '  Edit   ';   
                $errors['validation_error'] = validation_errors();
                    echo json_encode($errors);  exit();
            
        }else {
            /* Server Side Script */

            $is_error = 0;
            $id                    = clean_data($this->input->post('id', TRUE));
            $data['bannertitle']   = clean_data($this->input->post('youtubetitle', TRUE));
            $data['link']          = clean_data($this->input->post('youtubeid', TRUE));
            $data['status']        = clean_data($this->input->post('status', TRUE));
            $data['image']         = clean_data($this->input->post('hdn_banner_image', TRUE));
 
            //
     //pr($_FILES);
            if ((isset($_FILES['youtubeimage']['name']) && $_FILES['youtubeimage']['name'] != '')) {
                if (!is_dir('download/gallery/')) {
                    mkdir('./download/gallery/', 0777, TRUE);
                }
                $config['upload_path'] = './download/gallery/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '5120';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('youtubeimage')) {
                   // echo 'error in uplpad';
                    $data['error'] = $this->upload->display_errors();
                   // pr($data['error']);
                    $this->session->set_flashdata('youtubeimage', 'File upload error.');
                    $this->session->set_flashdata('error', $data['error']);
                    return false;
                } else {  //echo 'no error in uplpad';exit;
                    if ($this->input->post('id') != '') {
                       // $this->Media_model->deletedata("setting_social_media", array('id'=>$id));
                    }
                    $upload_ques = $this->upload->data();
                    // $this->resizeSmallImage($upload_ques['file_name']);
                    $data['image'] = $upload_ques['file_name'];
                }
            }
                $params_data = array(
                "name"        => $data['bannertitle'] ,
                "link"        => $data['link'] ,
                "status"      => $data['status'],
                "uploaded_by" => $admin_detail['admin_id'] ,
                "image"       => $data['image'] 
            );
      
            //
            //pr($params_data);exit;
            if(isset($id) && $id != 0 ) {
              $is_error = $this->Media_model->update_youtube($id ,$params_data);
                
            }  
            

            if(!$is_error) {
                 $data['error'] = '  Record not  Saved try again !!.';
                  //echo json_encode($data); //exit;
                 $this->session->set_flashdata('error', "File Successfully Uploaded");
                 redirect(base_url('Integration'));  
                
                
            }else {     
                
                $data['success'] = '  Data Saved Successfully!!.';
                // echo json_encode($data);  //exit;
                 $this->session->set_flashdata('success', "File Successfully Uploaded");
                 redirect(base_url('Integration'));  
                 
            }

         }
    
    }
}
    
  