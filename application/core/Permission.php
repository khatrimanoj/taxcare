<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission {
    private $_db;

    public function __construct() {
//        parent::__construct();
        $this->CI = & get_instance();
        $this->CI->load->model("MY_model");
        global $db;
        $this->_db = $db;
    }

   public function isHavingState() {
        global $CURRENT_USER_ROLE;

// global $CURRENT_USER_STATE;
// global $CURRENT_USER_DISTRICT;
        if ($this->CI->Auth->is_logged_in()) {
            if ($CURRENT_USER_ROLE == 2) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @global type $CURRENT_USER_ROLE
     * @param type $user
     * @return boolean  return true in case of state District User
     */
   public function isHavingDistrict() {
        global $CURRENT_USER_ROLE;
// global $CURRENT_USER_STATE;
//global $CURRENT_USER_DISTRICT;
        if ($this->CI->Auth->is_logged_in()) {
            if ($CURRENT_USER_ROLE == 2) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @global type $CURRENT_USER_ROLE
     * @param type $user
     * @return boolean  return true in case of state District User
     */
   public function isDistrictUser() {


        if ($this->CI->Auth->is_logged_in()) {
            if ($CURRENT_USER_ROLE == 3) {
                return true;
            }
        }
        return false;
    }

    public function isStateUser() {
        global $CURRENT_USER_ROLE;
// global $CURRENT_USER_STATE;
//global $CURRENT_USER_DISTRICT;
        if ($this->CI->Auth->is_logged_in()) {
            if ($CURRENT_USER_ROLE == 2) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission) {
        global $USER_ROLES_PERMISSIONS, $CURRENT_USER_ROLE;

        if (isset($CURRENT_USER_ROLE)) {
            if ($CURRENT_USER_ROLE == 3) {
                return true;     // if superadmin  return true
            }
            if (isset($USER_ROLES_PERMISSIONS[$CURRENT_USER_ROLE])) {
                return in_array($permission, $USER_ROLES_PERMISSIONS[$CURRENT_USER_ROLE]);
            }
        }
        return false;
    }

}
