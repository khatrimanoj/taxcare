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
                            <h4>Orders / Complete Orders </h4>
                            
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
                                          <div class="col-md-4 offset-md-4">
                                              <div class="form-group mb-0">
                                            <select class="form-control styleSelect form-control-lg">
                                                <option>Rating</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>  
                                        </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group mb-0">
                                            <select class="form-control styleSelect form-control-lg">
                                                <option>Completed By</option>
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
                                                <th >Name</th>
                                                 <th>PAN</th>
                                                 <th>Amount</th>
                                                <th>Completion Date</th> 
                                                <th>Completed By</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($orders as $order) { ?>
                                            <tr>
                                                <td class="text-center"><?=$i?></td>
                                                <td><span><a  href="<?php echo base_url('Order/orderDetail/'.$order['order_auto_id']);?>"><?=$order['order_id']?></a></span></td>
                                                <td ><?=$order['customer_name']?></td>
                                                <td><?=$order['order_pan']?></td>
                                                 <td><i class="fa fa-inr"></i><?=$order['order_amount']?></td>
                                                <td><?=date('d-M-Y',strtotime($order['order_date']))?></td>   
                                                <td>Neeraj Goyal</td>
                                                <td>5 Star</td>
                                            </tr>
                                             <?php $i++; } ?>
                                            
                             
                                    
                               
                                            
                                            
                                            
                                           
                                          
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