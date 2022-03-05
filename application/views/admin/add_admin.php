<?php $this->load->view('common/header_new');?>
<style type="text/css">
 .center {
margin: auto;
width: 40%;
 border-radius: 5px solid;
 
}
.contact{

width: 250px;
height: 238px;
left: 551px;
top: 441px;

 
font-style: normal;
font-weight: 500;
font-size: 14px;
line-height: 34px;
 
color: #171717;
}
</style>
</head>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
            <?php $this->load->view('common/sidebar_top'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
         <?php $this->load->view('common/header_top'); ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        
        <?php $this->load->view('common/sidebar_new'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
                <div class="content-body">
            <div class="container-fluid">
                
<!--                                 <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add  Admin</h4>
                            
                        </div>
                    </div>
                    
                </div> -->

               
               <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                
                    <div class="authincation-content mt-3 mb-5">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    
                                    <span class="absClose">Close <i class="mdi mdi-close-circle"></i></span>
                                    
                                    <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">User Name</label>
                                                        <input type="text" name="firstName" class="form-control form-control-lg" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Full Name</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Firrm Name</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">  Designation</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label"> Mobile Number </label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">  Email ID</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" required="">
                                                    </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Active</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                         <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid70">Save</button>
                                        </div>
                                        </div>
                                                
                                                
                                            </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 
                    
                
                
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<?php $this->load->view('common/footer_new');?>

</body>

</html>