<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

	public function addNotification($data) {
		$this->db->insert('notifications', $data);
		$insert_id= $this->db->insert_id();
		return $insert_id;
	}

	public function addUserNotification($data) {
		$this->db->insert('user_notifications', $data);
		$insert_id= $this->db->insert_id();
		return $insert_id;
	}

	########### GET USER Notifications ################
	public function getUserNofications($user_id) {
		$this->db->where('un.user_id', $user_id);
		$this->db->join('notifications n', 'n.notification_id = un.notification_id');
		$query = $this->db->get('user_notifications un'); 
		return $query->result_array();
	}


	public function deleteNotification($notification_id) {
		$this->db->where('notification_id', $notification_id);
		$this->db->delete('notifications');

		$this->db->where('notification_id', $notification_id);
		$this->db->delete('user_notifications');
		return true;
	}

	public function deleteUserNotification($user_id,$notification_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('notification_id', $notification_id);
		$this->db->delete('user_notifications');
		return true;
	}

	public function checkUserBookmark($user_id,$bookmark_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('bookmark_id', $bookmark_id);	
		$query = $this->db->get('query_data_bookmark');
		if($query->num_rows()> 0) {
			return true;
		}else{
			return false;
		}
	}

	public function getUserBookmark($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->join('query_data', 'query_data.id =query_data_bookmark.bookmark_id');
		$query = $this->db->get('query_data_bookmark');
		return $query->result();
	}

	public function getUserBookmarks($user_id) {
		$this->db->where('query_data_bookmark.user_id', $user_id);
		$this->db->join('query_data_bookmark', 'query_data.id = query_data_bookmark.bookmark_id',"LEFT");
		$query = $this->db->get('query_data');
		 // echo $this->db->last_query();exit;
		
		return $query->result();
	}

	
}
