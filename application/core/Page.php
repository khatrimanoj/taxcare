<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page {

    public $page_title = '';
    public $CSS = array();
    public $JS = array();
    public $breadcrumb = array();
    public $RequestData = array();

//    public function __construct() {
//        parent::__construct();
//    }


     function setRequestData($RequestData) {
        $this->RequestData = $RequestData;
        return $RequestData;
    }

    function getRequestData() {
        return $this->RequestData;
    }

    function setPageTitle($title) {
        $this->page_title = $title . '  | ' . $this->page_title;
        return $title;
    }

    function getPageTitle() {
        return $this->page_title;
    }

    function setPageBreadcrumb($breadcrumb) {
        return $this->breadcrumb = $breadcrumb;
    }

    function getPageBreadcrumb() {
        return $this->breadcrumb;
    }

    function setPageCSS($CSS_URL) {
//    if (is_array($CSS_URL)) {
//
//        } else {
        array_push($this->CSS, $CSS_URL);
   //        }


        return $this->CSS;
    }

    function setPageJS($JS_URL) {
     array_push($this->JS, $JS_URL);
        return $this->JS;
    }

    function getPageCSS() {



        return $this->CSS;
    }

    function getPageJS() {
        return $this->JS;
    }

    function setCoreTemplate($Template = null, $type2 = null) {
        if ($Template == 1) {
            $CSS_Array['CORE'] = array(
                '1' => base_url('assets/css/core/vendors.bundle.css'),
                '2' => base_url('assets/css/core/style.bundle.css'),
                '3' => base_url('assets/css/core/css.css')
            );

            $JS_Array['CORE'] = array(
                '1' => base_url('assets/js/core/vendors.bundle.js'),
                '2' => base_url('assets/js/core/scripts.bundle.js'),
                '3' => base_url('assets/js/core/js.js'),
                '4' => base_url('assets/js/public/core/toastr.js')


            );
            array_push($this->CSS, $CSS_Array);
            array_push($this->JS, $JS_Array);
        } else if ($Template == 2) {
            $CSS_Array['CORE'] = array(
                '1' => base_url('assets/css/public/core/bootstrap.min.css'),
                '2' => base_url('assets/css/public/core/animate.css'),
                '3' => base_url('assets/css/public/core/css-plugin-collections.css'),
                '4' => base_url('assets/css/public/core/menuzord-boxed.css'),
                '5' => base_url('assets/css/public/core/style-main.css'),
                '6' => base_url('assets/css/public/core/preloader.css'),
                '7' => base_url('assets/css/public/core/custom-bootstrap-margin-padding.css'),
                '8' => base_url('assets/css/public/core/responsive.css'),
                '9' => base_url('assets/css/public/core/theme-skin-color-set1.css'),
                '10' => base_url('assets/css/public/core/utility-classes.css')
            );
           $JS_Array['CORE'] = array(
           
                '4' => base_url('assets/js/public/core/jquery-plugin-collection.js'),
                '5' => base_url('assets/js/public/core/custom.js')
            );
            array_push($this->CSS, $CSS_Array);
            array_push($this->JS, $JS_Array);
        }


        return true;
    }

    public function getFacilityFilter() {
        $_REQUEST = $this->getRequestData();
        $CI = & get_instance();
        $Filter_Array = array();
        global $CURRENT_USER_STATE, $CURRENT_USER_DISTRICT;
//State data  and District filter
        if (isset($_REQUEST['state'])) {
            $state = $_REQUEST['state'];
              if (trim($state) != '0') {
                $Filter_Array['STATE'] = ' hf.State_ID =' . $state;
            }
        }
        if ($CI->User->isHavingState()) {
            $state = $CURRENT_USER_STATE;
            if (trim($state) != '0') {
                $Filter_Array['STATE'] = ' hf.State_ID=' . $state;
            }
        }
        $district = 0;
        if (isset($_REQUEST['district'])) {
            $district = $_REQUEST['district'];
            if (trim($district) != '0') {
                $Filter_Array['DISTRICT'] = ' hf.District_ID=' . $district;
            }
        }
        if ($CI->User->isHavingDistrict()) {
            $district = $CURRENT_USER_DISTRICT;
            if (trim($district) != '0') {
                $Filter_Array['DISTRICT'] = ' hf.District_ID=' . $district;
            }
        }
 //State data  and District filter  end 

        $taluka = 0;
        if (isset($_REQUEST['taluka'])) {
            $taluka = $_REQUEST['taluka'];
            if (trim($taluka) != '0') {
                $Filter_Array['Taluka_ID'] = ' hf.Taluka_ID=' . $taluka;
            }
        }
        $healthBlock = 0;
        if (isset($_REQUEST['healthBlock'])) {
            $healthBlock = $_REQUEST['healthBlock'];
            if (trim($healthBlock) != '0') {
                $Filter_Array['HealthBlock_ID'] = ' hf.HealthBlock_ID=' . $healthBlock;
            }
        }


        return $Filter_Array;
    }

}

function addCSS($cssPath) {
    $layout_CSS = & get_instance();
    $layout_CSS->Page->setPageCSS($cssPath);

    return true;
}

function addJS($JSPath) {
    $layout_JS = & get_instance();
    $layout_JS->Page->setPageJS($JSPath);
 
//    echo 'Function call';
    return true;
}
function array_flatten($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result[] = $value;
        }
    }

  

    return $result;
}
