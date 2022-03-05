<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
require APPPATH . 'libraries/Rest_lib.php';

     

class Item extends Rest_lib {

    

      /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function __construct() {

       parent::__construct();

       $this->load->database();

    }

       

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index_get($id = 0)

    {

        if(!empty($id)){

            $data = $this->db->get_where("items", ['id' => $id])->row_array();

        }else{

            $data = $this->db->get("items")->result();

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

        $this->db->insert('items',$input);

     

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

        $this->db->update('items', $input, array('id'=>$id));

     

        $this->response(['Item updated successfully.'], Rest_lib::HTTP_OK);

    }

     

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index_delete($id)

    {

        $this->db->delete('items', array('id'=>$id));

       

        $this->response(['Item deleted successfully.'], Rest_lib::HTTP_OK);

    }

        
}

 