<?php $this->load->view('common/header_new');?>
<style type="text/css">
 .center {
margin: auto;
width: 40%;
height: 85%;
border-radius: 5px solid;
padding: 10px;
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
                            <h4>About Us</h4>
                            
                        </div>
                    </div>
                    
                </div>

                 
                 
                 <div class="row">
                    <div class="col-12" align="text-center">
                        <div class="card center">
                           
                            <div class="card-body">
                                <center> <img src="<?php echo base_url('assets/images/Ellipselogo.png')?>" alt=""></center>
                                <div class="table myTbleStyl">
                                    <p class="contact">
                                        Contact Us
                                        <br>

                                        Sh. Monish Kumar Bansal   <br>
                                        Project Head   <br>
                                        Overseas Apps Private Limited   <br>
                                        Head Office:   <br>
                                        514-Aggarsen Nagar, Sri Ganganagar <br>
                                        Rajasthan-335001 <br>
                                        +91-8826938959
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


<?php $this->load->view('common/footer_new');?>

</body>

</html>