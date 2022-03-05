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
                        <h4>Orders/Pending Orders</h4>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Order Information</h4>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table tblNocaps table-bordered mb-0">
                                 <tbody>
                                    <tr>
                                       <th scope="row" class="text-dark">Order ID</th>
                                       <td><?=$order['order_id']?></td>
                                    </tr>
                                    <tr>
                                       <th scope="row" class="text-dark">Order Date</th>
                                       <td><?=date('d-M-Y',strtotime($order['order_date']))?></td>
                                    </tr>
                                    <tr>
                                       <th scope="row" class="text-dark">Status</th>
                                       <td><?=$order['order_status_name']?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">User Information</h4>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-6 pr-0">
                                 <div class="table-responsive">
                                    <table class="table tblNocaps table-bordered mb-0">
                                       <tbody>
                                          <tr>
                                             <th scope="row" class="text-dark">Name</th>
                                             <td><?=$order['customer_name']?></td>
                                          </tr>
                                          <tr>
                                             <th scope="row" class="text-dark">Pan</th>
                                             <td><?=$order['order_pan']?></td>
                                          </tr>
                                          <tr>
                                             <th scope="row" class="text-dark">Password</th>
                                             <td><?=$order['order_pan']?></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="col-md-6 pl-0">
                                 <div class="table-responsive">
                                    <table class="table tblNocaps table-bordered mb-0">
                                       <tbody>
                                          <tr>
                                             <th scope="row" class="text-dark">Mobile No.</th>
                                             <td><?=$order['user_mobile']?></td>
                                          </tr>
                                          <tr>
                                             <th scope="row" class="text-dark">Email ID</th>
                                             <td class="small-text"><?=$order['user_email']?></td>
                                          </tr>
                                          <tr>
                                             <th scope="row" class="text-dark">Type</th>
                                             <td><?=$order['order_type']==1?'Orignal':'Revised'?></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Payment Information</h4>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table tblNocaps table-bordered mb-0">
                                 <tbody>
                                    <tr>
                                       <th scope="row" class="text-dark" width="16%">Pending With</th>
                                       <td width="16%"><?=$order['customer_name']?></td>
                                       <th scope="row" width="18%" class="text-dark">Payment Reference</th>
                                       <td width="16%">123456789</td>
                                       <th scope="row" width="16%" class="text-dark">Amount</th>
                                       <td width="16%"><i class="fa fa-inr"></i><?=$order['order_amount']?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card p-0 minheight550">
                        <div class="card-body p-0">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="card p-0">
                                    <div class="card-body p-0">
                                       <!-- Nav tabs -->
                                       <div class="default-tab">
                                          <ul class="nav nav-tabs" role="tablist">
                                             <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Details">Details</a>
                                             </li>
                                             <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Activity">Activity</a>
                                             </li>
                                          </ul>
                                          <div class="tab-content formUIstyle">
                                             <div class="tab-pane fade show active" id="Details" role="tabpanel">
                                                <div class="pl-3 pt-4 pb-3 pr-2">
                                                   <div class="row">
                                                      <div class="col-lg-4">
                                                         <div class="row">
                                                            <div class="col-md-12">
                                                               <div class="form-group mb-3">
                                                                  <select class="form-control bg-transparent styleSelect form-control-lg wid60">
                                                                     <option value="0">--select--</option>
                                                                     <?php foreach($order_statuses as $order_status) { ?>
                                                                     <option value="<?=$order_status['id']?>"><?=$order_status['name']?></option>
                                                                  <?php } ?>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-12 mt-3 mb-3">
                                                               <div class="row">
                                                                  <div class="col-md-6">
                                                                     <div class="form-group mb-3">
                                                                        <div class="custom-fileUP">
                                                                           <input type="file" class="custom-file-inputUI" placeholder="Upload ITR">
                                                                           <label class="custom-file-labelbg">Upload JSON</label>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                     <div class="form-group mb-3">
                                                                        <div class="custom-fileUP">
                                                                           <input type="file" class="custom-file-inputUI" placeholder="Upload ITR">
                                                                           <label class="custom-file-labelbg">Upload ITR</label>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                               <div class="form-group">
                                                                  <div class="input-group">
                                                                     <textarea class="form-control" rows="4" placeholder="Remarks"></textarea>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                             <div class="col-md-12">
                                                               
                                                                  <span class="btnDownloadexcel">
                                                                    <a href="#">Send Notification</a>
                                                                </span>
                                                               
                                                            </div>
                                                            
                                                         </div>
                                                      </div>
                                                      <div class="col-md-8 text-right">
                                                         <div class="row">
                                                             
                                                             <div class="col-md-12">
                                                                 <ul class="btnsUI" id="MyDiv">
                                                            <li class="btnActiveTarget">
                                                               <button class="btn btnWhiteDefault">Comptation</button>
                                                            </li>
                                                            <li>
                                                               <button class="btn btnWhiteDefault">Recomptation 1</button>
                                                            </li>
                                                            <li>
                                                               <button class="btn btnWhiteDefault">Recomptation 1</button>
                                                            </li>
                                                            <li>
                                                               <button class="btn btnWhiteDefault">New User</button>
                                                            </li>
                                                         </ul>
                                                             </div>
                                                              <div class="col-md-12 text-left mt-4">
                                                                <div class="tblSaldetail">
                                                                    
                                                                    <div class="table-responsive">
                                                      <table class="table tblNocaps table-borderless table-bordered mb-0">
                                 <tbody>
                                    <tr>
                                       <th scope="row" class="text-dark" width="26%">Salary Details</th>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                      <td>File 1</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" class="text-dark">Interest Details</th>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                       <td>File 1</td>
                                      <td>File 1</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" class="text-dark">Freelance Net Receipts</th>
                                       <td>123456</td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    <tr>
                                       <th scope="row" class="text-dark">Freelance Net Profit</th>
                                       <td>123456</td>
                                        <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                 </tbody>
                              </table>
                                                  </div>
                                                                </div>
                                                              </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="tab-pane fade" id="Activity">
                                                <div class="pl-3 pt-4 pb-3 pr-2">
                                                  <div class="table-responsive">
                                                      <table class="table tblNocaps table-borderless text-center">
  
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">Date</th>
                                                          <th scope="col">Time</th>
                                                          <th scope="col">By</th>
                                                          <th scope="col">Type</th>
                                                          <th scope="col">IP Address</th>
                                                          <th scope="col">Activity</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td scope="row">11-12-2021</td>
                                                          <td>21:23</td>
                                                          <td>Neeraj Goyal</td>
                                                          <td>Admin</td>
                                                          <td>111.123.123.23</td>
                                                          <td>Order Placed</td>
                                                        </tr>
                                                       <tr>
                                                          <td scope="row">11-12-2021</td>
                                                          <td>21:23</td>
                                                          <td>Neeraj Goyal</td>
                                                          <td>Admin</td>
                                                          <td>111.123.123.23</td>
                                                          <td>Order Placed</td>
                                                        </tr>
                                                       <tr>
                                                          <td scope="row">11-12-2021</td>
                                                          <td>21:23</td>
                                                          <td>Neeraj Goyal</td>
                                                          <td>Admin</td>
                                                          <td>111.123.123.23</td>
                                                          <td>Order Placed</td>
                                                        </tr>
                                                        
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-12 mt-5">
                                          <div class="text-center mt-3">
                                             <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid40">Save</button>
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