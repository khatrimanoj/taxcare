<?php $this->load->view('common/header_new');?>
<script src="<?= base_url('assets/js/xlsx.full.min.js'); ?>"></script>
<style type="text/css">
 #example_filter{
    display: none;
 }   
 .orderlink{
    color: #000;
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
                            <h4>Users Details </h4>
                            
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
                                    <!--         <select class="form-control styleSelect form-control-lg">
                                                <option>Pending With</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select> -->
                                        </div>
                                          </div>  
                                          <div class="col-md-4" style="float: right;">
                                              <div class="form-group mb-0">
                                            <select class="form-control styleSelect form-control-lg" style="color:#B9B9B9">
                                                <option>Location</option>
                                                <option>Delhi</option>
                                                <option>Uttar Pradesh</option>
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
                                              <!--   <th>Sr. No</th> -->
                                                <th>Name</th>
                                                <th>PAN</th>
                                                <th>Gmail</th>
                                                <th>Mobile Number</th>
                                                <th>Platform</th>
                                                <th>Date Of Addition</th>
                                                <th>Location</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php 
                                            $i=1;
                                            foreach ($user_list as $ulist) {
                                                
                                           ?>
                                            <tr>
                                                <!-- <td class="text-center"><?php echo $i; ?></td> -->
                                                <td><?php echo $ulist['user_name']; ?></td>
                                                <td><?php echo $ulist['user_pan']; ?></td>
                                                <td><?php echo $ulist['user_email']; ?></td>
                                                <td><?php echo $ulist['user_mobile']; ?></td>
                                                <td><?php echo $ulist['user_platform']; ?></td>
                                                <td><?php echo $ulist['user_created']; ?></td>
                                                <td><?php echo $ulist['user_ip_address']; ?></td>
                                               
                                                
                                            </tr>
                                                <?php $i++;} ?>
                                    
                              
                                            
                                  
                                           
                                          
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
        <!--**********************************
            Footer start
        ***********************************--> 
<?php $this->load->view('common/footer_new');?>
    <script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('example');
        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'Users.' + type);
    }
    const export_button = document.getElementById('btnDownloadexcel');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
</script>
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