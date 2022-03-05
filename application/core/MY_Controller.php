<?php

defined('BASEPATH') OR exit('No direct script access allowed');
    include APPPATH . 'core/Authentication.php';
    include APPPATH . 'core/Permission.php';

    include APPPATH . 'core/Page.php';
    include APPPATH . 'core/Template.php';

class MY_Controller extends CI_Controller {

    public $Auth;
    public $Page;
    public $View;

    public function __construct() {
        parent::__construct();
        $this->Auth = new Authentication();
        $this->User = new Permission();
        $this->Page = new Page();
        $this->View = new View();
    }

}
