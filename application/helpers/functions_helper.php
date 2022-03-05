<?php

/**
 * get state Name based on State Id
 * @param type $stateId
 * @return type
 */
function getStatesName($State_ID) {
	$CI =& get_instance();
    $CI->load->model('State_district_block_model');
	return $CI->State_district_block_model->getStateName($State_ID);
	
}
/*
*
*/
 
 

 
 

 


function get_admin_detail($admin_id) {
       $CI =& get_instance();

        $query = " SELECT  tbl_admin_login.*, m_role.role_name
        FROM  tbl_admin_login 
        left join m_role on tbl_admin_login.role_id=m_role.role_id 
        where tbl_admin_login.admin_id = '" . $admin_id . "'   ";
        $query = $CI->db->query($query);
        return   $query->row_array();

}


function isDistrict_belongToState($districtId, $stateId) {
       $CI =& get_instance();

         $query = 'SELECT count(*) as cnt FROM  m_district WHERE  State_ID = '.$stateId.' and District_ID = '.$districtId;
      
        $query = $CI->db->query($query);
        return   $query->row_array();

}
 
 
 
// get all Role list 
function get_role_list() {
    $CI =& get_instance();
   $query = "SELECT role_name,role_id FROM m_role";

    $query = $CI->db->query($query);
    $result = $query->result_array();
    $role = array();
     $role[0]='--Select Role--';
    foreach ($result as $row) {
    	 $role[$row['role_id']]= $row['role_name'];
    }
    return $role;
}
 
/**
 * Get Current Page
 * @return type
 */

function currentPageURLAdd(){

	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
		$link = "https"; 
	else
		$link = "http"; 	  
	// Here append the common URL characters. 
	$link .= "://"; 	  
	// Append the host(domain name, ip) to the URL. 
	$link .= $_SERVER['HTTP_HOST']; 
	// Append the requested resource location to the URL 
	$link .= $_SERVER['REQUEST_URI']; 		  
	// Print the link 
	//echo $link;die;
    return 'previous='. base64_encode( $link);
}

function previousPageURL(){
    
    if(isset($_REQUEST['previous'])){
       return base64_decode($_REQUEST['previous']);
    }
    return false;
}

function previousPageInput(){    
    if(isset($_REQUEST['previous'])){
       return '<input type="hidden" value="'.$_REQUEST['previous'].'" name="previous" >';
    }
    return false;
}
function previousPageParam(){
   
   if(isset($_REQUEST['previous'])){
       return 'previous='.$_REQUEST['previous'];
    }
    return false;
}
function my_pagination($total_rows,$per_page,$path){
    $CI =& get_instance();
    $CI->load->library('pagination');
    $config = array();
    $config['enable_query_strings'] = true;
    $config['reuse_query_string'] = true;
    $config['page_query_string'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config["base_url"] = base_url() . $path;
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $per_page;
    $config['num_links'] = 5;
    $config['use_page_numbers'] = TRUE;
    //echo "<pre>";print_r($config); die;
    $CI->pagination->initialize($config);
    $links= explode('&nbsp;', $CI->pagination->create_links());
    return $links;
    //echo "<pre>";print_r($links);die;
}

function get_class_based_on_percent($percent) {
	$percent = intval($percent);
	 if($percent < 50){
	   return 'bg-danger';
	 }
	 
	 if($percent < 70){
	   return 'bg-warning';
	 }
	 
	 if($percent < 90){
	   return 'bg-info';
	 }
	 
	 if($percent >= 90){
	   return 'bg-success';
	 }
	 return  'bg-danger';
}


function get_color_based_on_percent($percent) {
	$percent = intval($percent);
	 if($percent < 50){
	   return '#d9534f';
	 }
	 
	 if($percent < 70){
	   return '#f0ad4e';
	 }
	 
	 if($percent < 90){
	   return '#ded75b';
	 }
	 
	 if($percent >= 90){
	   return '#5cb85c';
	 }
	 return '#d9534f';
}
function setScrollText($id){
    $CI =& get_instance();
    $CI->load->model('Settings_model');
	return $CI->Settings_model->getGlobalTextById($id);
	
}

if (!function_exists('clean_data'))
    { function clean_data($string)
        { $CI     = & get_instance();
          $string = $CI->security->xss_clean($string);    
          $string = strip_tags($string);
          $string = html_escape($string); 
          //$string = htmlspecialchars($string);
          $string = remove_invisible_characters($string); 
          $string = stripslashes($string);  
          $string = trim($string);// trim 12 12 added   db _escape_ str //###  htmlentities($string);
          return  $string;
        }

     }
