<?php $this->load->view('common/header_new');?>
<style type="text/css">
   #example_filter{
    display: none;
}    
 .modal-dialog {
        max-width:54%;margin-left: 30%;
    }
   span.btnactive{
     display: block;
     background: #BFEED7;
     color: #02532C;
     border-radius: 100px;
     padding: 5px 2px;
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
                                <h4>Settings/Query Data</h4>

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
                                              <button  data-toggle="modal" data-target="#myModal" class="btn btn-primary btnBannerimg btnblu"><i class="mdi mdi-plus"></i> Add Query</button>
                                                

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
                        <?php $this->load->view('common/messages.php');  ?>
                              <div id='error_div'></div>
                              <div id='message'></div>
                <div class="card mycardStyle">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table  id="example" class="myTbleStyl tblcenter mb-0" style="min-width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No.</th>
                                        <th >Name</th>
                                        <th >Type</th>
                                        <th>Status</th>
                                        <th >Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                          <?php 
                                           $i=1;
                                          // pr($records);
                                       foreach ($records as $record) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td style="width: 30%;text-align: left;"><?php echo $record['name']; ?>     </td>
                                        <td style="width: 10%;text-align: left;"> <?php echo $record['type']; ?> </td>
                                         
                                         <td> 
                                         <?php
                                        if ($record['status'] == 1) {
                                            echo $status_value ='<span class="btnactive text-center">Active</span>';
                                        } else 
                                        {
                                            echo $status_value = '<span class="pendingBtn text-center" >In-Active</ span>';
                                        }
                                        ?>
                                             
                                                
                                          </td>
                                        <td class="text-center" ><a href="#" data-id="<?php echo $record['id'];?>"   data-toggle="modal" data-target="#edit_query" class="editbtn text-center">Edit</a></td>  

                                    </tr>
                                     


                                      <?php $i++; } ?>




                                </tbody>

                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
       
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">

                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a> 
                                <?php  echo form_open_multipart('Querydata/add_save_data', ['id'=>'edit_page_form']);?>
                                  <input type="hidden" name="id" value="0">
                                   <div class="row">
                                       <div class="col-lg-6">
                                           <div class="form-group">
                                               <label class="text-label">Name</label>
                                                 <input required  type="text" name="Name" class="form-control form-control-lg"   >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Type</label>
                                                        <input required type="text" name="Type" class="form-control form-control-lg"   >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Section</label>
                                                        <input type="text" name="Section" class="form-control form-control-lg" required   >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Maximum Limit</label>
                                                        <input type="text" name="maxlimit" class="form-control form-control-lg" required  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Assesment Year</label>
                                                        <input type="text" name="Assesmentyr" class="form-control form-control-lg" required   >
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Descriptions</label>
                                                        <div class="input-group">
                                                            <textarea class="form-control" rows="4" id="comment" name="descriptions"> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                   
                                          <input class="form-check-input" type="checkbox" id="basic_checkbox_1" name="status"  value="1" >
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
                                    </form>
                                    
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </div>
            </div>
  <!-- edit Modal -->
  <div id="edit_query" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a>
                                            <div class="row" id="viewYouContent">

                                                
                                                 
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
            <script>
    $(document).ready(function() {
        $('.editbtn').click(function(e){
            e.preventDefault();
            var Page_id = $(this).data('id');
           //alert(Page_id);
            var url = "<?php echo base_url() .'Querydata/edit_querydata/' ?>"+Page_id; 
            $.ajax({
                url: url,
                type: 'POST',
                data: {Page_id:Page_id},
                success: function(data){ 
                    $('#viewYouContent').html(data); 
                   },
                beforeSend: function () {
                    $("#viewYouContent").html('Please wait...');
                },
                failure: function (data) {
                    alert('Failure!');
                }
            });
        });
    } );

</script>
        </body>

        </html>