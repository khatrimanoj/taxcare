<?php $this->load->view('common/header_new');?>
<style type="text/css">
 #example_filter{
    display: none;
 }   

</style>
</head>

<body>
 
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
 
	<?php $this->load->view('common/sidebar_top');?>
         <?php $this->load->view('common/header_top');?>
         <?php $this->load->view('common/sidebar_new');?>
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
                            <h4>Mailbox / Compose </h4>
                            
                        </div>
                    </div>
                    
                </div>
               
               <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                
                    <div class="authincation-content mt-3 mb-5">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    
                                    
                                    
                                    <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">To</label>
                                                        <input type="text" name="firstName" class="form-control form-control-lg" >
                                                    </div>
                                                </div>
                                          
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Subject</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg" required="">
                                                    </div>
                                                </div>
                                             
                                            
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Message</label>
                                                        <div class="input-group">
                                                            <textarea class="form-control" rows="4" id="comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                      <!--                            <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Active</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div> -->
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


        <!--**********************************
            Footer start
        ***********************************--> 
<?php $this->load->view('common/footer_new');?>
        
</body>

</html>