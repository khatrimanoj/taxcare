<?php

class View {

    public $Page_TItle;
    public $layout;

    public function __construct() {
        
    }

    function adminView($page = null, $data = null) {
        $this->layout = & get_instance();
        $data['Page_Title'] = $this->layout->Page->getPageTitle();
         $this->layout->Page->setCoreTemplate(1);
     
        if (isset($data['error'])) {
            $content2 = $this->layout->load->view('admin/error/error', $data, TRUE);
        } else {
        $content2 = $this->layout->load->view('admin/' . $page, $data, TRUE);
        }
        $data['CSS'] = $this->layout->Page->getPageCSS();
        $data['JS'] = $this->layout->Page->getPageJS();
        $content1 = $this->layout->load->view('template/admin_header', $data, TRUE);
        $content3 = $this->layout->load->view('template/admin_footer', $data, TRUE);
        echo $content1 . $content2 . $content3;
    }
    function publicView($page = null, $data = null) {
        $this->layout = & get_instance();
        $data['Page_Title'] = $this->layout->Page->getPageTitle();
        $this->layout->Page->setCoreTemplate(2);
        $content2 = $this->layout->load->view($page, $data, TRUE);
        $data['CSS'] = $this->layout->Page->getPageCSS();
        $data['JS'] = $this->layout->Page->getPageJS();
        $content1 = $this->layout->load->view('template/public_header', $data, TRUE);
        $content3 = $this->layout->load->view('template/public_footer', $data, TRUE);
        echo $content1 . $content2 . $content3;
    }

    function Popup($page = null, $data = null) {
             $this->layout = & get_instance();
        $this->layout->load->view($page, $data);
    }

}

?>
