<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
   
   function index(){
        if(isset($_COOKIE['remember_me'])){
            setcookie('remember_me', '', time()-7000000, '/');
        }
        $this->session->sess_destroy();
        redirect(base_url());
    }
}