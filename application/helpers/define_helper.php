<?php


global $USER_ROLES, $USER_PERMISSIONS, $USER_ROLES_PERMISSIONS, $ALLOWED_ENTRY_SETTINGS;

$USER_ROLES = getADMIN_ROLES();

$USER_PERMISSIONS = getADMIN_TotalPermissions();

$USER_ROLES_PERMISSIONS = getADMIN_ROLES_PERMISSIONS();

 



function getADMIN_ROLES()
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->db->select('m_role.role_id, m_role.role_name');      
        $CI->db->from('m_role');
        $query =  $CI->db->get(); 
        $roles = array();
        foreach ($query->result() as $row)
        {    
             $roles[$row->role_id] = $row->role_name;              
        }
        return $roles;
    }

    function getADMIN_TotalPermissions()
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->db->select('m_permission.permission_name, m_permission.permission_description');      
        $CI->db->from('m_permission');
        $query =  $CI->db->get(); 
        $permission = array();
        foreach ($query->result() as $row)
        {    
             $permission[$row->permission_name] = $row->permission_description;              
        }
        return $permission;
    }


function getADMIN_ROLES_PERMISSIONS()
    {
        $CI =& get_instance();
        $CI->load->database();
        
        $CI->db->select('rp.role_id, rp.permission_id, p.permission_name');
        $CI->db->from('role_permissions rp');
        $CI->db->join('m_permission p', 'rp.permission_id = p.permission_id', 'left');
        $CI->db->order_by('rp.role_id','asc');        
        $query = $CI->db->get(); 
        $role_permissions = array();
        foreach ($query->result() as $row)
        {    
             $role_permissions[$row->role_id][] = $row->permission_name;              
        }
        return $role_permissions;
         
    }
// check if user has permission
function has_admin_permission($permission_name){

    global $USER_PERMISSIONS;
    global $USER_ROLES_PERMISSIONS ;
 

    if(!isset($_SESSION['ADMIN']['role_id'])) {       
        return false;
    }

    $role_id = $_SESSION['ADMIN']['role_id'];
    if(!isset($USER_PERMISSIONS[$permission_name])) {        
        return false;
    }  
    if(!isset($USER_ROLES_PERMISSIONS[$role_id])) {        
        return false;
    } 
    if(!in_array($permission_name, $USER_ROLES_PERMISSIONS[$role_id])) {
         
        return false;
    }

    return true;

}

function getAllowedSettings(){
    $CI =& get_instance();
    $CI->load->database();
    $CI->load->library('round');

    $round_id = $CI->round->getRound();

    $CI->db->select('*');
    $CI->db->from('settings');
    $CI->db->where('round_id',$round_id);        
    $query = $CI->db->get(); 

    $settings = array();
    foreach ($query->result() as $row)
    {    
         $settings[$row->round_id.'_'.$row->module_id.'_'.$row->State_ID] = array(
              'round_id' => $row->round_id,
              'module_id' => $row->module_id,
              'start_date' => $row->start_date,
              'end_date'  => $row->end_date,
            
        );
    }
    return $settings;
}

function is_entry_allowed($module_id) {
 
    global $ALLOWED_ENTRY_SETTINGS;

    if($_SESSION['ADMIN']['role_id']==3){
        return true;  // entry allowed for admin;
    }
    
  

    $CI =& get_instance();
    $CI->load->library('round');
    $round_id = $CI->round->getRound();

     $key = $round_id.'_'.$module_id;
    if(isset($ALLOWED_ENTRY_SETTINGS[$key])) {
        $start_date = $ALLOWED_ENTRY_SETTINGS[$key]['start_date'];
        $end_date = $ALLOWED_ENTRY_SETTINGS[$key]['end_date'];
        $today =   date("Y-m-d");
        return ( ( $today >= $start_date ) && ( $today <= $end_date ) );
     }

  return false;
}
