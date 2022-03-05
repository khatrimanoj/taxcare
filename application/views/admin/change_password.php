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
                                <h4>  Change Password</h4>

                            </div>
                        </div>

                    </div>

 


       
<div class="row">
                    <div class="col-12" align="text-center">
                        <div class="card center">
                           
                            <div class="card-body">
                                <center> <img src="http://127.0.0.1/taxcare/assets/images/Ellipselogo.png" alt=""></center>
                                <div class="table myTbleStyl">
                                    <p class="contact">
                       <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    
                                    <form action="index.html">
                                        <div class="form-group">
                                            <label><strong>User ID</strong></label>
                                            <input type="email" class="form-control form-control-lg" placeholder="Enter User ID">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control form-control-lg" placeholder="Enter your Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu">Sign in</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                                    </p>        
                                    
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
            <script type="text/javascript">
                $(document).ready(function() {
                    dTable = $('#example').DataTable({
                        destroy: true,
       // searching: false,
       bPaginate: true,
       bLengthChange: false,
       bFilter: true,
       bInfo: false

   });
                    $('#searhbox').keyup(function(){  
        dTable.search($(this).val()).draw();   // this  is for customized searchbox with datatable search feature.
    })
                });
            </script>
        </body>

        </html>