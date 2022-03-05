
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('loginmodel','',TRUE);
	    $this->table        =   "tbl_ip";
        

        // Load session library
        $this->load->library('session');
        
        // Load the captcha helper
        $this->load->helper('captcha');
        $this->load->helper('cookie');
    }
	
    public function index(){
             
        if(isset($_SESSION['ADMIN']['admin_id']) || $this->loginmodel->remember_me_check()) {
            redirect(base_url('welcome'));
        }
        $data['page_title'] =   "Login Page";
		
        // Pass captcha image to view
        if($this->config->item('captcha_enabled')){
            $data['captcha'] =  $this->captcha();
		}
/*        $this->load->view('common/loginheader');
        $this->load->view('login',$data);
        $this->load->view('common/loginfooter'); */
        $this->load->view('login_admin');
        
    }

    
	public function getlogin(){
        
        if(isset($_SESSION['ADMIN']['admin_id'])) {
            redirect(base_url('welcome'));
        }

        $data['remember_me']=$this->input->post('remember_me');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_validatelogin');

        $captcha_error = false;
        if($this->config->item('captcha_enabled')){

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            $this->session->unset_userdata('captchaCode');  // delete session data
            if( $inputCaptcha == '' || $inputCaptcha != $sessCaptcha ) {

                $captcha_error = true;
            }
        }

        if($captcha_error) {

            $message="captcha is not matched";
            $this->session->set_flashdata('message', $message);
        }
        else if($this->form_validation->run() == FALSE ){
            $message    = "Invalid Login Details";
            $this->session->set_flashdata('message', $message);          
           
        }
        else{

            if($this->input->post('remember_me')){
               $admin_id=$_SESSION['ADMIN']['admin_id'];
               $this->loginmodel->remember_enter($admin_id);    
            }
            redirect(base_url('welcome'));
        }
      
            
        if($this->config->item('captcha_enabled')){
                $data['captcha'] =  $this->captcha();
        }

/*        $this->load->view('common/loginheader');
        $this->load->view('login',$data);
        $this->load->view('common/loginfooter');
*/
         $this->load->view('login_admin');
         
    }

    //Validating user request for login
    public function validatelogin(){
       
        $credentials      =   array(
            "username"=>$this->input->post('username'),
            "password"=>md5($this->input->post('password'))
        );
		
        return $this->loginmodel->getlogin($credentials);
    }


    
    
    private function captcha(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            // 'font_path'     => 'system/fonts/texb.ttf',
            'font_path'     => realpath('system/fonts/texb.ttf'),
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 18,
            'pool' => '23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'        => array(
                'background' => array(16, 56, 135),
                'border' => array(9, 48, 176),
                'text' => array(255, 255, 255),
                'grid' => array(81, 108, 164)
                )
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image

        return $captcha;
    }

    function refresh_captcha(){

        $captcha = $this->captcha();
        echo $captcha['image'];
    }

	
}