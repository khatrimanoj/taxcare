<?php

function loadLayout($page = null, $data = null, $type = null) {
	//echo $page ;exit;
    $layout = & get_instance();
    if ($type == 'admin') {
        $layout->load->view('common/header',$data);
		$layout->load->view('common/sidebar',$data);
		$layout->load->view('common/roundheader',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/footer',$data);
    } else if ($type == 'public') {
        $layout->load->view('common/front_header',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/front_footer',$data);
    } else if ($type == 'popup') {
        $layout->load->view($page, $data);
      } else {
        $layout->load->view('common/front_header',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/front_footer',$data);
    }
}

// check if user has permission return true otherwise stop further script execution
function has_admin_permission_layout($permission_name, $type = ''){
//echo $permission_name. $type;exit;
/*	if($type == '' ) {
		$type = 'admin';
	}	
	if(!has_admin_permission($permission_name)) {
		if ($type == 'admin') {
		  loadLayout('common/admin_permission_denied', null , $type);
		}
		if ($type == 'popup') {
		  loadLayout('common/admin_permission_denied', null , $type); 
		}
		
		 return false;
    }*/	
    return true;

}
############  pre formated print #############

  function pr($arg){
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
	}

	############################################

	   if (!function_exists('log_it')) {
    function log_it($msgs) {
      //Start writing log in file 
  //$log_text = " IP-".$_SERVER['REMOTE_ADDR'].", BROWSER-".$_SERVER['HTTP_USER_AGENT'].",  TO-".$user_email.", MESSAGE- ".$msgs.", CONSOLE- ".$console."##\n";
      $filename = 'assets/logs/'."logs_it_".date("dmY").".txt";
      if (file_exists($filename))
       {    
        $fh = fopen($filename, "a") or die("Could not open log file.");
       } 
      else
       {     
        $fh = fopen($filename, "w") or die("Could not open log file.");
       }   
        fwrite($fh, date("d-m-Y, H:i:s")." - $msgs\n") or die("Could not write file!");
        fclose($fh);
      //end writing log
    }
//ends 
}

   if (!function_exists('get_status'))
    {  function get_status($status_id)
      {
        $CI =& get_instance();
        $CI->load->model('Common_model');

          $status = $CI->Common_model->get_status_name($status_id);
          return $status->name;
          //pr( $regional);exit;
       }
       
    }
