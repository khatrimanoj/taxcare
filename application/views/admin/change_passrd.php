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

                <div class="row page-titles mx-0">

                    <div class="col-sm-6 p-md-0">

                        <div class="welcome-text">

                            <h4>Change Password</h4>

                            

                        </div>

                    </div>

                    

                </div>



                 

                

                 <div class="row">

                    <div class="col-12" align="text-center">

                       

                         

                        <div class="card center">
                             <center><?php $this->load->view('common/messages.php'); ?></center>

                           

                            

                                

                                 

                                    

                                        <div class="authincation-content">

                        <div class="row no-gutters">

                            <div class="col-xl-12">

                                <div class="auth-form formUIstyle">

                                    

                                    <form action="<?php echo base_url('Change-Password');?>" method="POST">

                                        <div class="form-group">

                                            <label><strong>Old Password</strong></label>

                                            <input type="password" class="form-control form-control-lg" placeholder="Enter Old Password" autocomplete="false" name="old_password" required>

                                        </div>

                                        <div class="form-group">

                                            <label><strong>New Password</strong></label>

                                            <input type="password" class="form-control form-control-lg" placeholder="Enter New Password" name="newpassword" required>

                                        </div>

                                            <div class="form-group">

                                            <label><strong>Confirm Password</strong></label>

                                            <input type="text" class="form-control form-control-lg" placeholder="Enter Confirm Password" name="re_password" required>

                                        </div>

                           <!--              <div class="form-row d-flex justify-content-between mt-4 mb-2">

                                            <div class="form-group">

                                                <div class="form-check ml-2">

                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">

                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Remember me</label>

                                                </div>

                                            </div>

                                            

                                        </div> -->

                                        <div class="text-center">

                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu">Save</button>

                                        </div>

                                    </form>

                                    

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