<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'libraries/Rest_lib.php';     
class Api extends Rest_lib {
	
	 function __construct()
    {
      parent::__construct();
   
      header('Access-Control-Allow-Origin: *');

      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

       $this->load->database();

       $this->load->model("ProductModel", "product");
 
    }
    
    public function saveproduct_post(){

      $this->product->save();

      $data["result"] = "success";

      $this->response($data, 200);      

   }

   public function listproducts_post(){

      $data["products"] = $this->product->lists();
       

      $this->response($data, 200);

   }

   public function deleteproduct_post(){

      $json = file_get_contents('php://input');

      $product = json_decode($json);

      $this->product->delete($product->id);

      $data["result"] = "success";

      $this->response($data, 200);

   }

   public function getproduct_post(){

      $json = file_get_contents('php://input');
      //pr($json);
      $product = json_decode($json);
      //pr($product);
      $id = $product->id;
      // $id = $this->uri->segment(3);
      
      $data["product"] = $this->product->getbyid($id);

      $this->response($data, 200);     

   }
#################################################
      public function index_get($id = 0)

   {

        if(!empty($id)){

            $data = $this->db->get_where("products", ['id' => $id])->row_array();

        }else{

            $data = $this->db->get("products")->result();

        }

     

        $this->response($data, Rest_lib::HTTP_OK);

   }

      

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index_post()

    {

        $input = $this->input->post();

        $this->db->insert('products',$input);

     

        $this->response(['Item created successfully.'], Rest_lib::HTTP_OK);

    } 

     

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index_put($id)

    {

        $input = $this->put();

        $this->db->update('products', $input, array('id'=>$id));

     

        $this->response(['Item updated successfully.'], Rest_lib::HTTP_OK);

    }

     

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index_delete($id)

    {

        $this->db->delete('products', array('id'=>$id));

       

        $this->response(['Item deleted successfully.'], Rest_lib::HTTP_OK);

    }

}

 