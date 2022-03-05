<?php  

class Logs extends CI_Controller 
{   
    function __construct()
    {
        parent::__construct();
        $this->admin_info      =  $this->common->__check_session();
         
         $this->load->model('ProductModel');  
        $this->load->helper('form');
        
		$this->load->library('session');
		$this->load->library("pagination");
    }
    
    public function target()
    {

		// check user permission
		if(!has_admin_permission_layout('LOG_TARGET')) { return; }

		$data['IS_ENTRY_ALLOWED'] = is_entry_allowed(1);  // here 1 for target module id

		$data['page_title'] = 'Target';
        
		
		
	 
		
        
        $queryWhere='';
         
    
    	$filterArray['WHERE'] = $queryWhere;
		
		$per_page = 100;
		$offset = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $per_page ) : 0;

 	    $data['blocks'] = $this->ProductModel->lists($filterArray, $round_id, $per_page, $offset);
        //echo "<pre>";print_r($data['blocks'] );die;
		$total_rows = $this->ProductModel->get_last_calculated_total();
		$config = array();
         $config['enable_query_strings'] = true;
         $config['reuse_query_string'] = true;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config["base_url"] = base_url() . "admin/logs/";
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $per_page;
        $config['num_links'] = 5;
       
       
        //$config["uri_segment"] = 3;
	    
        $this->pagination->initialize($config);

       
       
        $data["links"] = explode('&nbsp;', $this->pagination->create_links() );

 
		loadLayout('admin/logs/target', $data, 'admin');
    }
	
	public function target_csv(){
		
		// check user permission
		//if(!has_admin_permission_layout('LOG_TARGET')) { return; }
		
		 
		
	    $queryWhere='';
 
    	$filterArray['WHERE'] = $queryWhere;		
 
 	    $rows = $this->ProductModel->lists($filterArray, $round_id);
		
	    header("Content-type: text/x-csv");
		header("Content-Disposition: attachment; filename=target_status_". date('Y-m-d-h-i-s').".csv");
	    ob_get_clean();
		flush();
		echo '"ID","Product Name","MRP","Price","Available",';
		echo '"Created Date","Updated Date","Log Status"'.PHP_EOL;
                
		foreach($rows as $row){
			flush();
			echo '"'.addslashes($row['id']).'",';
			echo '"'.addslashes($row['name']).'",';
			echo '"'.addslashes($row['mrp']).'",';
			echo '"'.addslashes($row['price']).'",';
			echo '"'.addslashes($row['available']).'",';
			echo '"'.addslashes($row['Created_Date']).'",';
			echo '"'.addslashes($row['Updated_Date']).'",';
			echo '"'.addslashes($row['created_on']).'",';
			echo '"'.addslashes($row['updated_on']).'",';
			echo '"'.addslashes($row['status']).'"';
			echo PHP_EOL;                    
		}
	}
	

  
}
