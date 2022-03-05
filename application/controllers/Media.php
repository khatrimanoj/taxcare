
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

function __construct(){
    parent::__construct();
    $this->admin_info      =  $this->common->__check_session();
    $this->load->model('Media_model');
    $this->load->library('form_validation');	
    $this->load->library("pagination");
    

}

public function index(){
	// check user permission
	 
	if(!has_admin_permission_layout('VIEW_PHOTO_GALLERY')) { return; }
	$data['page_title'] = ' Tools  ';
   
 
  
	if($this->input->get_post('imgchk' )) {
		$image_chk = 1;
	}else{
		$image_chk = 0;
	}
 

	$queryWhere    = array();
	$queryWhere[]  =' WHERE 1';
 
	if($image_chk){
		$queryWhere[] = "  setting_social_media.image<>''";
	}
	 
	$filterArray['WHERE'] = $queryWhere;
    $per_page = 10;
	$offset = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $per_page ) : 0;
	$data['per_page']=$per_page;
	$data['offset']=$offset;
	$data['result_list']  = $this->Media_model->getGalleryList($filterArray,$per_page, $offset);
	//print_r($data['result_list']);exit;
	$total_rows = $this->Media_model->get_last_calculated_total();
	$data['pg']=ceil($total_rows/$per_page);
	$data['total_rows']=$total_rows;
    $data["links"] = my_pagination($total_rows,$per_page,"admin/media/");



	$data['page'] = $this->input->post_get('page');
	$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
	loadLayout('admin/media/view_list', $data, $data['layout_type']); 
	
}

public function add_gallery(){

    // check user permission
	if(!has_admin_permission_layout('ADD_PHOTO_GALLERY')) { return; }
	$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
	
	 
	
	$data['page_title'] = 'Add';
	if (has_admin_permission('VIDEO_GALLERY')){ 
		//$data['page_title'] .= " / Video";
	}
  
	 
    loadLayout('admin/media/add_gallery', $data, $data['layout_type']);   	
 
}



private function validate() {

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
		 
		if(isset( $_FILES['image']['name'])){
			$image_field = $_FILES['image']['name'];
		}else{
			$image_field ='';
		}
		if(isset( $_FILES['video']['name'])){
			$video_field = $_FILES['video']['name'];
		}else{
			$video_field ='';
		}
		

		if($image_field=='' && $video_field=='' && $this->input->post('act')!='/'){
			 $this->form_validation->set_rules('image', 'Image', 'required');
			// $this->form_validation->set_rules('video', 'Video', 'required');
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
        if(has_admin_permission('PUBLISH_PHOTO_GALLERY')) {
          $publish = $this->input->post('publish');
          if($publish){
            $publish =1;
          }else{
            $publish =0;
          }
        }
        if(has_admin_permission('STATE_APPROVE_PHOTO_GALLERY')) {
          $approve = $this->input->post('approve');
          if($approve){
            $approve =1;
          }else{
            $approve =0;
          }
        }

 


        
            $requestdata = array(
                "name" 			=> $this->input->post('title'),
                "link" 		=>   $this->input->post('link'),
				"status" 			=> $chk,
               
            );
			

            if ($_FILES['image']['name'] != '') {
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
                if (!$this->upload->do_upload('image')) {
                    
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('image', 'File upload error.');
                    $this->session->set_flashdata('error', $error_msg);
                    return false;
                } else {
                    if ($this->input->post('id') != '') {
                        $this->common->delete("setting_social_media", $this->input->post('id'), "image");
                    }
                    $upload_ques = $this->upload->data();
					           $this->resizeSmallImage($upload_ques['file_name']);
                    $requestdata['image'] = $upload_ques['file_name'];
                }
            }

         
           // print_r($requestdata);die;
            return $requestdata;
        } else {
            $error_msg = validation_errors();
            $this->session->set_flashdata('title', "Title Required.");
            $this->session->set_flashdata('error', $error_msg);
            return false;
        }
    }


public function GalleryInsert() {

	   if(!has_admin_permission_layout('ADD_PHOTO_GALLERY')) { return; }
	   
		if(isset($_POST) && count($_POST) > 0) {
			$data['row'] =  $this->input->post(NULL); // get all post data		
	    }
	    
        $requestdata = $this->validate();
		
		//echo $requestdata;
		
		//print_r($requestdata); die;
		
        $data['page_title'] = 'Add  ';

        if (has_admin_permission('VIDEO_GALLERY')){ 
			$data['page_title'] .= " / Video";
		}
  
		
        if (!empty($requestdata)) {
            if ($this->Media_model->insertdata("setting_social_media", $requestdata)) {
                //echo " a";
                $message=array("1",);
				$this->session->set_flashdata('success', "File Successfully Uploaded");
            } else {
				 $this->session->set_flashdata('error', $this->db->_error_message());				 
            }
        }
		
		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
		
		$urlParmas = '?';
		
		
		if($this->input->post_get('layout_type')){			
			$urlParmas .= '&layout_type='. $this->input->post_get('layout_type');
	 }
		if(!$requestdata) {	
			loadLayout('admin/media/add_gallery', $data, $data['layout_type']);   
		}else {
			if(previousPageURL()) {
			  redirect(previousPageURL());
			}
			redirect(base_url("media").$urlParmas);
		}
		
    }

private function getGallery() {

   	$queryWhere[] = "id = ". intval($this->input->post_get('id'));
		 
		
       return $this->Media_model->getGalleryItem($queryWhere);
		
}
 public function editGallery() {
 
	    /// check user permission
		if(!has_admin_permission_layout('EDIT_PHOTO_GALLERY')) { return; }


        $data['page_title'] = 'Update  ';
	 
  
        $data['row']  = $this->getGallery(); 

		//pr($data['row']);exit;
		if(!$data['row']) {
		  $this->session->set_flashdata('error', "Record not found");
		  redirect(base_url('media'));
		}
       
		$data['page'] = $this->input->post_get('page');
		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
	   loadLayout('admin/media/add_gallery', $data, $data['layout_type']); 
    }

    // Update Gallery
    public function GalleryUpdate() {
        $requestdata = $this->validate();
		//pr($this->input->post());exit;
		$data['page_title'] = 'Update  ';
		
		if (has_admin_permission('VIDEO_GALLERY')){ 
			//$data['page_title'] .= " / Video";
		}
  
					 
        if ($requestdata) {
		
            if ($this->Media_model->updatedata("setting_social_media", $requestdata, array("id" => $this->input->post('id')))) {
                $this->session->set_flashdata('success', "Record Update Successfully");
            } else {                
				$this->session->set_flashdata('error', "Record Update Successfully");
            }
        }
		
		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
		
		$urlParmas = '?';
		
		
		if($this->input->post_get('layout_type')){
			$urlParmas .= '&layout_type='. $this->input->post_get('layout_type');
			 

					
		}		
		
		if($this->input->post_get('page')){
				$urlParmas .= '&page=' . $this->input->post_get('page');
		}


		if(!$requestdata) {		
		
	    	 $data['row']  = $this->getGallery(); 
			 
			loadLayout('admin/media/add_gallery', $data, $data['layout_type']);   
		}else {
			if(previousPageURL()) {
			  redirect(previousPageURL());
			}
			redirect(base_url("media").$urlParmas);
		}
    }

    public function deleteGallery() {
      //echo "in";die;
	    $path = "download/gallery/";
       if ($this->input->get('id')) {

		
    		$queryWhere = array("id" => $this->input->get('id'));
    			
  			

          if ($this->input->get_post('id')) {
              $raw = $this->Media_model->getGalleryItem($queryWhere);
              if (file_exists(FCPATH.$path.$raw['image'])){
                
                $this->common->deleteImage("setting_social_media", $this->input->get_post('id'), "image",$path);
              }

                 $this->Media_model->deletedata("setting_social_media", $queryWhere);
                 $this->session->set_flashdata('success', "Record Deleted Successfully");  
            }else{
              $this->session->set_flashdata('error', "Something Wrong to Update data");
            }
      }
	  
        $urlParmas =  '?action=edit&id=' . $this->input->post('id');
		
		if($this->input->post_get('layout_type')){
			$urlParmas .= '&layout_type='. $this->input->post_get('layout_type');
			 
		}
		 
		if($this->input->post_get('page')){
			$urlParmas .= '&page='. $this->input->post_get('page');
		}
		if(previousPageURL()) {
			redirect(previousPageURL());
		}
        redirect(base_url("media").$urlParmas);
    }


 public function resizeSmallImage($filename){
		
     $config['image_library'] = 'gd2';
	 if (!is_dir('download/small_thumbnail/')) {
        mkdir('./download/small_thumbnail/', 0777, TRUE);
      }
      $source_path 		= './download/gallery/' . $filename;    
      $small_file_path  = './download/small_thumbnail/'; 
      $this->load->library('image_lib', $config);

      $config_img = array(
          'image_library'  => 'gd2',
          'source_image'   => $source_path,
          'new_image' 	   => $small_file_path,
          'maintain_ratio' => TRUE,
          'create_thumb'   => TRUE,
          'thumb_marker'   => '',
          'width' 		   => 250,
          'height'         => 250
      );
		//showData($config_img);die;
      $this->image_lib->initialize($config_img);
      
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }
      $this->image_lib->clear();
   }


}
