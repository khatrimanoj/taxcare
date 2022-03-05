<?php $this->load->view('common/header_new');?>
<style type="text/css">
   #example_filter{
    display: none;
}   
    .modal-dialog {
        max-width:54%;margin-left: 30%;
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
                                <h4> Admin Details </h4>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card radiusBnone mb-3">

                                <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-4">
                                     <div class="form-group mysearch mb-0">
                                         <div class="input-group ">

                                            <input type="text" class="form-control" placeholder="Search" id="searhbox">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 ">
                                  <div class="row text-right">
                                      <div class="col-md-4 offset-md-8">
                                          <span>
                                              <button data-toggle="modal" data-target="#myModal" class="btn btn-primary btnBannerimg btnblu"><i class="mdi mdi-plus"></i>  Add New </button>


                                          </span>
                                      </div>

                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card mycardStyle">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="myTbleStyl tblcenter mb-0" style="min-width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No.</th>
                                        <th >User Name</th>
                                        <th >Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                       <!--  <th >Action</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td style="width: 20%;">Neerajgoyal</td>
                                        <td style="width: 10%;text-align: left;">Neeraj Goyal </td>
                                          <td class="text-center" > 9810923432 </td>
                                           <td class="text-center" > neerajgotalfca@gmail.com </td>
                                       
                                        <td class="text-center" > neeraj@123 </td>
                                         <td><span class="pendingBtn text-center">Active</span></td>

                                    </tr>
                                     







                                </tbody>

                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
       

  <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                      <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">User Name</label>
                                                        <input type="text" name="firstName" class="form-control form-control-lg">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Full Name</label>
                                                        <input type="text" name="lastName" class="form-control form-control-lg">
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