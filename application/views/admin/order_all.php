<?php $this->load->view('common/header_new');?>
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
                            <h4>Orders/Pending Orders</h4>
                            
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
                                            
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                                            </div>
                                        </div>
                                            </div>
                                   </div>
                                   <div class="col-md-8 ">
                                      <div class="row text-right">
                                          <div class="col-md-4 offset-md-4">
                                              <div class="form-group mb-0">
                                            <select class="form-control styleSelect form-control-lg">
                                                <option>Pending With</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group mb-0">
                                            <select class="form-control styleSelect form-control-lg">
                                                <option>Status</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
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
                                    <table id="example" class="display text-center myTbleStyl" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sr.No.</th>
                                                <th >Order ID</th>
                                                <th style="width: 33%; text-align: left;">Name</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>PAN</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>2201120001</td>
                                                <td style="width: 33%; text-align: left;">Nishant Bansal</td>
                                                <td>12-1-2022</td>
                                                <td>Rs. 500/-</td>
                                                <td>AZDPB6044R</td>
                                                <td>Original</td>
                                                <td><span class="pendingBtn">Pending</span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>2201120001</td>
                                                <td style="width: 33%; text-align: left;">Nishant Bansal</td>
                                                <td>12-1-2022</td>
                                                <td>Rs. 500/-</td>
                                                <td>AZDPB6044R</td>
                                                <td>Original</td>
                                                <td><span class="pendingBtn">Pending</span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>2201120001</td>
                                                <td style="width: 33%; text-align: left;">Nishant Bansal</td>
                                                <td>12-1-2022</td>
                                                <td>Rs. 500/-</td>
                                                <td>AZDPB6044R</td>
                                                <td>Original</td>
                                                <td><span class="pendingBtn">Pending</span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>2201120001</td>
                                                <td style="width: 33%; text-align: left;">Nishant Bansal</td>
                                                <td>12-1-2022</td>
                                                <td>Rs. 500/-</td>
                                                <td>AZDPB6044R</td>
                                                <td>Original</td>
                                                <td><span class="pendingBtn">Pending</span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>2201120001</td>
                                                <td style="width: 33%; text-align: left;">Nishant Bansal</td>
                                                <td>12-1-2022</td>
                                                <td>Rs. 500/-</td>
                                                <td>AZDPB6044R</td>
                                                <td>Original</td>
                                                <td><span class="pendingBtn">Pending</span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            
                                           
                                          
                                        </tbody>
                                        
                                    </table>
                                </div>

                                <span  class="btnDownloadexcel">
                                    <a href="#">Download in Excel</a>
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