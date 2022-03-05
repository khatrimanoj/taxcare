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
.message{ min-width: 550px; }
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
                                <h4>   Settings/Legal Docments</h4>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card radiusBnone mb-3">

                                <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-4">
                                       <span>
                                       <button class="btn btn-primary btnBannerimg">Documents   </button>
                                       <!-- <a href="#" class="btnBannerimg">Banner Images</a> -->
                                       </span>
                                   </div>
                                <div class="col-md-8 ">
                                  <div class="row text-right">
                                      <div class="col-md-4 offset-md-8">
                                          <span>
                                              <!-- <button class="btn btn-primary btnBannerimg btnblu"><i class="mdi mdi-plus"></i> Add Query</button>
 -->
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
                                        <th class="text-left">Title</th>
                                        <th >Date</th>
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
                                        <td  class="text-left" >   <?php echo $record['page_title']; ?></td>
                                        <td  > <?php echo $record['page_added_on']; ?> </td>
                                         
                                        <td> 
                                         <?php
                                        if ($record['page_status'] == 1) {
                                            echo $status_value ='<span class="btnactive text-center">Active</span>';
                                        } else 
                                        {
                                            echo $status_value = '<span class="pendingBtn text-center" >In-Active</ span>';
                                        }
                                        ?>
                                             
                                                
                                          </td>
                                        <td class="text-center" >
<a href="#" data-toggle="modal" data-target="#myModal"  class="editbtn text-center pagecontent" role="button" data-id="<?php echo $record['page_id'];?>" >Edit</a>

                                        </td>

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
                                            <div class="row" id="viewContent">

                                                
                                                
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
        $('.pagecontent').click(function(e){
            e.preventDefault();
            var Page_id = $(this).data('id');
            //alert(Page_id);
            var url = "<?php echo base_url() .'Legal_doc/edit_page/' ?>"+Page_id; 
            $.ajax({
                url: url,
                type: 'POST',
                data: {Page_id:Page_id},
                success: function(data){ 
                    $('#viewContent').html(data); 
                   },
                beforeSend: function () {
                    $("#viewContent").html('Please wait...');
                },
                failure: function (data) {
                    alert('Failure!');
                }
            });
        });
    } );

</script>
 <script type="text/javascript">
         $('body').on('submit', '#edit_page_form',function(e){
                e.preventDefault();
               //   $('#btn_edit').hide();
                  // $('#showloading').show();
                  var form = $('#edit_page_form');
                var url = form.attr('action');
             
                  $.ajax({
                      type: "POST",
                      url: url,
                      data: form.serialize() ,
                      success: function (data) {
                          // $("#model_data_ajax").html(data);
                          var myObj = JSON.parse(data);
                           //alert(myObj.error); 
                          if(myObj.error){
                              $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.error+'</span> </div>');
                          }
                          if(myObj.validation_error){
                              $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.validation_error+'</span> </div>');
                          }
                          if(myObj.success){
                              $('#success_message').html('<div class="alert alert-success alert-message"> <span> '+myObj.success+'</span> </div>');
                              setTimeout(function () {
                                      location.reload(true);
                                    }, 1000);
                          }
                      },
                       beforeSend: function () {
                          $("#model_data_ajax").html('Please wait...');
                       },
                      failure: function (data) {
                          alert('Failure!');
                      }
                  });

                 });
      </script>
        </body>

        </html>