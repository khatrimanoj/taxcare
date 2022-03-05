
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class loginmodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('encryption');
    }
   
    public function getlogin($credentials){
        $this->db->select('*');
        $this->db->from("tbl_admin_login");
        $this->db->where('username = ' . "'" . $credentials['username']. "'");
        $this->db->where('password = ' . "'" . $credentials['password'] . "'");
        $this->db->where('status = ' . "'" . 1 . "'");
        $this->db->limit(1);
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            $row            =   $query->row_array();
            $update_array   =   array(
                "last_login"    =>  $row['login'],
                "login"         =>  date("Y-m-d H:i:s")
            );
            //var_dump($update_array);die;
            $this->db->update("tbl_admin_login",$update_array);
            $this->db->where("admin_id",$row['admin_id']);
            $this->setUserLoginSession($row);
          
            return true;
        }else{
            return false;
        }
    }
    private function setUserLoginSession($row){

        $session_array = array(
            'admin_id' => $row['admin_id'],
            'role_id' => $row['role_id'],
          
        );

        $this->session->set_userdata('ADMIN', $session_array);
        return true;
    }

    public function mysettings($id){
        $this->db->select('*');
        $this->db->from('tbl_admin_login');
        $this->db->where('id = ' . "'" .intval( $id). "'");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function updateinfo($data,$id,$tbl_name){
        $this->db->where('id', $id);
        $this->db->update($tbl_name ,$data);
        return true;
    }

    public function remember_enter($admin_id){        
       
        $row = $this->common->getadmindetails($admin_id);
        if($row){

            $data = array(
                'admin_id' => $row['admin_id'],
                'match_hash' => md5($row['admin_id'].'_'.$row['password']),  
           );
            $this->db->insert('admin_remember',$data);
            $n = $this->db->insert_id();
            setcookie('remember_me',
              $this->encryption->encrypt($n.','.date("Y-m-d H:i:s")),time()+ (2629746),'/','','',TRUE);
            return true;
        }
        return false;          
               
    }
   
    public function remember_me_check(){
        
        $this->load->helper('cookie');

        $encrypted_remember_me = isset($_COOKIE['remember_me'])? $_COOKIE['remember_me']: '';
        $remember_me = $this->encryption->decrypt($encrypted_remember_me);
       
        if(!$remember_me) {            
            return false;        
        }
        $remember_id = substr($remember_me, 0, strpos($remember_me,',')+1);

        if(isset($remember_id) && $remember_id != '') {
            $this->db->where('remember_id',$remember_id);
            $query=$this->db->get('admin_remember');
            $remember_row= $query->row();
            if($query->num_rows()>0){
                $user_record = $this->common->getadmindetails($remember_row->admin_id);              
            }
        } 

        if(!isset( $user_record)) {
            return false;
        }
        if( $remember_row->match_hash != 
         md5($user_record['admin_id'].'_'.$user_record['password'])){
            return false;
         }
         $this->setUserLoginSession($user_record);
         return true;
       
    }	
	
}
?>