<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gallery_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

	public function getPhotos($filterArray,$limit=0,$start=0){
      
		$queryWhere = $filterArray['WHERE'];
		$this->db->limit($limit, $start);
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM gallery  WHERE " . implode(' AND ', $queryWhere). "";
		$query .=" ORDER BY id DESC LIMIT $start, $limit";
		
		$query = $this->db->query($query);
		return  $query->result_array();
		 // $data['result']=$result;
		//return $result;
    }
	public function get_last_calculated_total()
	{
	    $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		return $query->row()->Count;
	    
	}
     public function getGalleryList($filterArray,$per_page, $offset){
		
		$queryWhere = $filterArray['WHERE'];
		
		$query    	= "select SQL_CALC_FOUND_ROWS gallery.*  from gallery

 
		" . implode(' AND ', $queryWhere) . " ";
		$query .=" ORDER BY id DESC LIMIT $offset, $per_page";
//echo $query;die;
		$query = $this->db->query($query); 

		return  $query->result_array();

	}
	// get info for already edit
	public function insertdata($tbl_name,$value){
		
        if($this->db->insert($tbl_name, $value)){
            return true;
        }else{
            return false;
        }
    }
	
	//Fetch
	 public function getGalleryItem($filterArray){
		
		 $query    	= "select *  from gallery
		WHERE  " . implode(' AND ', $filterArray) . " ";
        //echo $query;die;
		$query = $this->db->query($query); 

		return  $query->row_array();

	}
	
	//Update
	 public function updatedata($tbl_name,$values,$condition=""){
        if($condition!=''){
            foreach($condition as $key=>$value){
                $this->db->where($key, $value);
            }
        }
        $this->db->update($tbl_name ,$values);
        return true;
    }
	
	 //Delete
    public function deletedata($tbl_name,$condition=""){

        if($condition!=''){
            foreach($condition as $key=>$value){
                $this->db->where($key, $value);
            }
        }
        $this->db->delete($tbl_name);
        
        return true;
    }
	
	//Status Active
	public function active($id){
		$this->db->set('status','1');
		$this->db->where('id',$id);
		
		if($this->db->update("gallery")){	
			return true;
		}else{
		   return true;
		}
    }

	//Status InActive
	public function inactive($id){
		$this->db->set('status','0');
		$this->db->set('publish','0');
		$this->db->where('id',$id);
		
		if($this->db->update("gallery")){	
			return true;
		}else{
		   return true;
		}
    }	
	
	//Status Publish
	public function publish($id){
		$this->db->set('publish','1');
		$this->db->where('id',$id);
		
		if($this->db->update("gallery")){	
			return true;
		}else{
		   return true;
		}
    }

	//Status Un Publish
	public function unpublish($id){
		$this->db->set('publish','0');
		$this->db->where('id',$id);
		
		if($this->db->update("gallery")){	
			return true;
		}else{
		   return true;
		}
    }
	
	//Check Status
	public function checkStatus($id){
		 
		$this->db->select('*');
		$this->db->from("gallery");
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			return $query->row_array();
		} else{
			return false;
		}
    }
	
	//Fetch Video Gallery For Front
	public function record_count_video(){
        $sql    =   $this->db->query("select * from `gallery` where status='1' and publish='1' and type='2'");
        return $sql->num_rows();
    }
    public function fetch_data_video($limit, $start,$stateID,$districtID){
        $query  =   "select * from `gallery` where 1  ";
        
	 
		
		$query   .= " and status='1' and publish='1' and type='2' order by id desc";
		if($start!==0){
            $query  .=   " limit $start , $limit";
        }else{
            $query  .=   " limit $limit";
        }
		
        $sql    =   $this->db->query($query);
        return $sql->result_array();
    }
	
	//Fetch Photo Gallery For Front
	  public function record_count_photo(){
      $sql    =   $this->db->query("select * from `gallery` where status='1' and publish='1' and type='1'");
      return $sql->num_rows();
    }

  

}
