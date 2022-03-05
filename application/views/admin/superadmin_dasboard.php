<?php $this->load->view('common/header_new');?>
<script src="<?= base_url('assets/js/xlsx.full.min.js'); ?>"></script>
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
                            <h4>Dashboard</h4>
                            
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/flat-color-icons_android-os.svg">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">1000000</div>
                                    <div class="stat-text">Total Android Users</div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconOrng d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/icon-file.svg">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">478 520</div>
                                    <div class="stat-text">Total Orders</div>
                                    <small class="text-success cstmClassSucc"> Rs. 10,000/-</small>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconLghtBlu d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/icon-mail.svg">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">154 872</div>
                                    <div class="stat-text"><span class="">Pending Orders</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconSkblu d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/iconoir_profile-circled.png">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">167</div>
                                    <div class="stat-text">Messages</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconSkbluappl d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/Vector.png">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">50000</div>
                                    <div class="stat-text">Total IOS Users</div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconOrng1 d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/icon-file.png">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">478 520</div>
                                    <div class="stat-text">Complete Orders</div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon iconSkblu d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/icon-mail.png">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">154 872</div>
                                    <div class="stat-text">Refund Orders</div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <img src="<?php echo base_url();?>assets/images/card/icon-mail.svg">
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-digit">167</div>
                                    <div class="stat-text">Messages</div>
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
                                                <th>Sr.No.</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>PAN</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            $i=1;
                                            foreach ($order_list as $list) {
                                                
                                           ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                               <td>
                                                <span>
                                                    <a  href="<?php echo base_url('Order/orderDetail/'.$list['order_id']);?>">
                                                         <?php   echo $list['order_id']; ?>  
                                                    </a>
                                                </span>
                                                 </td>
                                                <td><?php echo $list['customer_name']; ?>  </td>
                                                <td><?php echo $list['order_date']; ?> </td>
                                                <td>Rs. <?php echo $list['order_amount']; ?> /-</td>
                                                <td><?php echo $list['order_pan']; ?></td>
                                                <td><?php echo $list['order_type']; ?></td>
                                                <td><span class="pendingBtn"><?php echo get_status($list['order_status']); ?></span></td>
                                                <td>...</td>
                                                
                                            </tr>
                                            <?php $i++; }  ?> 
  
                                        </tbody>
                                        
                                    </table>
                                </div>
                                 <span  class="btnDownloadexcel" id="btnDownloadexcel">
                                    <a href="#">Download in Excel</a>
                                </span>

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
    <script type="text/javascript">
        $(document).ready(function() {
$('#example').DataTable( {
    destroy: true,
    searching: false,
    bPaginate: true,
    bLengthChange: false,
    bFilter: true,
    bInfo: false

});
});
    </script>
    <script>

    function html_table_to_excel(type)
    {
        var data = document.getElementById('example');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('btnDownloadexcel');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>
</body>

</html>