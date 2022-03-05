<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require APPPATH . 'libraries/Rest_lib.php';    
class Test extends CI_Controller {
	
	 function __construct()
    {
      parent::__construct();
    
       $this->load->database();
       header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
       $this->load->model("ProductModel", "product");
 
    }
    
    public function saveproduct_post(){

      $this->product->save();

      $data["result"] = "success";

      $this->response($data, 200);      

   }

   public function listproducts_post(){

      $data["products"] = $this->product->lists();
      
       pr($data["products"]);

      $this->response($data, 200);

   }

   public function deleteproduct_post(){

      $json = file_get_contents('php://input');

      $product = json_decode($json);
      
       
      $id = $product['id'];
      $this->product->delete($id['id']);

      $data["result"] = "success";

      //$this->response($data, 200);

   }

   public function getproduct_post(){

      $json = file_get_contents('php://input');

      $product = json_decode($json);
     // pr($product);

      $data["product"] = $this->product->getbyid($product->id);

       //pr($data["product"]);   

   }
 

}

 