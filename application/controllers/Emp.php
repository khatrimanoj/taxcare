<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'libraries/Rest_lib.php';     
class Emp  extends Rest_lib {
	
	 function __construct()
    {
      parent::__construct();
   
      header('Access-Control-Allow-Origin: *');

      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

       $this->load->database();

       $this->load->model("ProductModel", "product");
 
    }
    
     
     public function index_get($id = 0){
        if(!empty($id)){
            $empData = $this->db->get_where("employee", ['id' => $id])->row_array();
        }else{
            $empData = $this->db->get("employee")->result();
        }     
        $this->response($empData, Rest_lib::HTTP_OK);
    }    
    public function index_post(){
        $postData = $this->input->post();
        $this->db->insert('employee',$postData);     
        $this->response(['Employee created successfully.'], Rest_lib::HTTP_OK);
    }    
    public function index_put($id){
        $putData = $this->put();
        $this->db->update('employee', $putData, array('id'=>$id));
     
        $this->response(['Employee updated successfully.'], Rest_lib::HTTP_OK);
    }    
    public function index_delete($id){
        $this->db->delete('employee', array('id'=>$id));       
        $this->response(['Employee deleted successfully.'], Rest_lib::HTTP_OK);
    }       

}

 