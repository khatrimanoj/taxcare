<?php $this->load->view('common/header_new');?>
<style type="text/css">
 #example_filter{
    display: none;
 }   
 span.btnactive{
  display: block;
  background: #BFEED7;
  color: #02532C;
  border-radius: 100px;
  padding: 5px 2px;
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
                            <h4>Settings/Integrations</h4>
                            
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->load->view('common/messages.php');  ?>
                              <div id='error_div'></div>
                              <div id='message'></div>
                        <div class="card radiusBnone mb-3">
                          
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-md-4">
                                       <span>
                                       <button class="btn btn-primary btnBannerimg">Banner Images</button>
                                       <!-- <a href="#" class="btnBannerimg">Banner Images</a> -->
                                       </span>
                                   </div>
                                   <div class="col-md-8 ">
                                      <div class="row text-right">
                                          <div class="col-md-4 offset-md-8">
                                              <span>
                                              <button data-toggle="modal" data-target="#addbnner" class="btn btn-primary btnBannerimg btnblu"><i class="mdi mdi-plus"></i> Add Banner</button>
                                        
                                       </span>
                                          </div>
                                          
                                      </div>
                                   </div>
                               </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
               <!-- Modal  -->
               <div id="addbnner" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a>
                            <?php  echo form_open_multipart('Integration/save_add_banner');?>
  
                               <input type='hidden' name='admin_id' value='0'>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Title</label> 
                                                        <input type="text" name="bannertitle" class="form-control form-control-lg" 
                                                        required="" value="<?php if(isset($bannertitle)){print($bannertitle);}; ?>" > 
                                                        <span class="form_error"><?php echo form_error('bannertitle'); ?></span>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Link</label>
                                                        <input type="text" name="link" class="form-control form-control-lg" required=""  placeholder="https://www.w3schools.com/" value="<?php if(isset($link)){print($link);}; ?>"> 
                                                        <span class="form_error"><?php echo form_error('link'); ?></span>
                                                    </div>
                                                </div>
                                              
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                <div class="custom-fileUP">
                            <input required type="file" class="custom-file-inputUI" placeholder="Upload ITR" name="bannerimg" accept="image/*" >
                                                <label class="custom-file-labelbg">Upload Banner  Image </label>
                                                </div>
                                                </div>
                                                </div>
                                          
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1" name="check" value="1">
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
                 <div class="row">
                    <div class="col-12">
                        <div class="card mycardStyle">
                           
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="myTbleStyl tblcenter mb-0" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sr.No.</th>
                                                <th style="width: 33%;">Image</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th style="text-align:center;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php  
                                             $i=0;
                                             foreach ($result_list as $row) {   $i++;   ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $i ;?></td>
                                                <td style="width: 33%;">      
                                                <?php if($row['name']){ ?>
                                                <a  target="_blank" href="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="fancybox" ><img id="myImg" src="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="img-responsive" width="75px" height="75px"></a>
                                            <?php } ?></td>
                                                <td style="text-align: left;"><?= $row['name'] ?></td>
                                                <td><?= $row['date_added'] ?></td>
                                                <td>

                                                <?php if ($row['status'] == 1) { 
                                                   echo '<span class="btnactive text-center"> Active</span>';
                                                }else { 
                                                    echo '<span class="pendingBtn text-center">Inactive</span>';
                                                } ?>

                                                <td class="text-center" >
                                                 <a href="#" data-toggle="modal" data-target="#editbanner"  class="editbtn text-center pagecontent" role="button" data-id="<?php echo $row['id'];?>" >Edit</a>


                                                </td>
                                                
                                            </tr>
                                              
                                      <?php } ?>
                                             
                                             
                                            
                                           
                                            
                                           
                                            
                                           
                                          
                                        </tbody>
                                        
                                    </table>
                                </div>

                                
                                </div>

                            </div>
                        </div>
                    </div>
        <!-- Modal -->
             <div id="editbanner" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a> 
                             <div id="banner_content"> </div>
                                    
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- edit you tube  -->

            <div id="edityoutube" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a> 
                             <div id="youtube_content"> </div>
                                    
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </div>
            </div>
                    <!-- //Add Modal -->
                <div id="youTube" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                 
                        <div class="modal-body">
                            
                             <div class="col-xl-12">
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                </a> 
                                 <!-- <form method="POST" action="<?php //echo base_url('Integration/save_add_youtube');?>" id="add_youtube"> -->
                                   <?php  echo form_open_multipart('Integration/save_add_youtube');?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Title</label>
                                                        <input type="text" name="youtubetitle"  required="" class="form-control form-control-lg" >
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Youtube Vide ID</label>
                                                        <input type="text" name="youtubeid" class="form-control form-control-lg" required=""  placeholder="v=ftIPUowtX2Q">
                                                    </div>
                                                </div>
                                              
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                <div class="custom-fileUP">
                                                <input type="file" class="custom-file-inputUI" placeholder="Upload ITR" name="youtubeimg"  accept="image/*">
                                                <label class="custom-file-labelbg">Upload Youtube Thumb Pic </label>
                                                </div>
                                                </div>
                                                </div>
                                          
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1" name="check" value="1">
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
                     <div class="row">
                    <div class="col-lg-12">
                        <div class="card radiusBnone mb-3">
                          
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-md-4">
                                       <span>
                                        <button class="btn btn-primary btnBannerimg">Youtube Images</button>
                                       <!-- <a href="#" class="btnBannerimg">Youtube Images</a> -->
                                       </span>
                                   </div>
                                   <div class="col-md-8 ">
                                      <div class="row text-right">
                                          <div class="col-md-4 offset-md-8">
                                              <span>
                                               <button  data-toggle="modal" data-target="#youTube" class="btn btn-primary btnBannerimg btnblu"><i class="mdi mdi-plus"></i> Add Youtube</button>
                                       
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
                                    <table id="" class="myTbleStyl mb-0 tblcenter" style="min-width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sr.No.</th>
                                                <th style="width: 33%;">Image</th>
                                                <th >Title</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th style="text-align:center;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php  
                                             $i=0;
                                             foreach ($youtube_list as $row) {   $i++;   ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $i ;?></td>
                                                <td style="width: 33%;">      
                                                <?php if($row['image']){ ?>
                                                <a  target="_blank" href="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="fancybox" ><img id="myImg" src="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="img-responsive" width="75px" height="75px"></a>
                                            <?php } ?>
                                        </td>
                                                <td style="text-align: left;"><?= $row['name'] ?></td>
                                                <td><?= $row['date_added'] ?></td>
                                                <td>

                                            <?php if ($row['status'] == 1) { 
                                                   echo '<span class="btnactive text-center"> Active</span>';
                                                }else { 
                                                    echo '<span class="pendingBtn text-center">Inactive</span>';
                                                } ?>

                                                <td class="text-center" >
                               <a href="#" data-toggle="modal" data-target="#edityoutube"  class="editbtn text-center youtubecontent" role="button" data-id="<?php echo $row['id'];?>" >Edit</a>
                                                </td>
                                                
                                            </tr>
                                              
                                             <?php } ?>
                                            
                                           
                                            
                                           
                                            
                                           
                                          
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
           // alert(Page_id);
            var url = "<?php echo base_url() .'Integration/edit_banner/' ?>"+Page_id; 
            $.ajax({
                url: url,
                type: 'POST',
                data: {Page_id:Page_id},
                success: function(data){ 
                  //  alert(data);
                    $('#banner_content').html(data); 
                   },
                beforeSend: function () {
                    $("#banner_content").html('Please wait...');
                },
                failure: function (data) {
                    alert('Failure!');
                }
            });
        });
    } );

</script>
<script type="text/javascript">
         $('body').on('submit', '#add_banner',function(e){
                e.preventDefault();
                  //console.log( 'xyz' );
                  var form = $('#add_banner');
                var url = form.attr('action');
               console.log( url );
                  $.ajax({
                      type: "POST",
                      url: url,
                      data: form.serialize() ,
                      success: function (data) {
                       // alert(data);
                          // $("#model_data_ajax").html(data);
                          /*var myObj = JSON.parse(data); 
                          if(myObj.validation_error){
                              $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.validation_error+'</span> </div>');
                          }
                          if(myObj.success){
                              $('#success_message').html('<div class="alert alert-success alert-message"> <span> '+myObj.success+'</span> </div>');
                              setTimeout(function () {
                                      location.reload(true);
                                    }, 3000);
                          }*/
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
        <script>
    $(document).ready(function() {
        $('.youtubecontent').click(function(e){
            e.preventDefault();
            var Page_id = $(this).data('id');
           // alert(Page_id);
            var url = "<?php echo base_url() .'Integration/edit_youtube/' ?>"+Page_id; 
            $.ajax({
                url: url,
                type: 'POST',
                data: {Page_id:Page_id},
                success: function(data){ 
                    $('#youtube_content').html(data); 
                   },
                beforeSend: function () {
                    $("#youtube_content").html('Please wait...');
                },
                failure: function (data) {
                    alert('Failure!');
                }
            });
        });
    } );

</script>
<script type="text/javascript">
         $('body').on('submit', '#add_youtube',function(e){
                e.preventDefault();
                  //console.log( 'xyz' );
                  var form = $('#add_youtube');
                var url = form.attr('action');
               console.log( url );
                  $.ajax({
                      type: "POST",
                      url: url,
                      data: form.serialize() ,
                      success: function (data) {
                         /* // $("#model_data_ajax").html(data);
                          var myObj = JSON.parse(data); 
                          if(myObj.validation_error){
                              $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.validation_error+'</span> </div>');
                          }
                          if(myObj.success){
                              $('#success_message').html('<div class="alert alert-success alert-message"> <span> '+myObj.success+'</span> </div>');
                              setTimeout(function () {
                                      location.reload(true);
                                    }, 3000);
                          }*/
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
      <!-- save edit data  -->
       <script type="text/javascript">
        $('#btn_edit').on('click',function(e){
            e.preventDefault();
                  $('#btn_edit').hide();
                   $('#showloading').show();
                  var form = $('#edit_page_form');
                  var url = form.attr('action');
                  var formData = new FormData(this);
                  $.ajax({
                      type: "POST",
                      url: $(this).attr('action'),
                     // data: form.serialize() ,
                     data: formData ,
                     cache:false,
                       contentType: false,
                        processData: false,
                      success: function (data) {
                          // $("#model_data_ajax").html(data);
                         // var fileUpload = $("#bannerimgid").get(0).files;
                          //var myObj = JSON.parse(data);
                           //alert( data); 
                         // if(myObj.error){
                            //  $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.error+'</span> </div>');
                         // }
                         // if(myObj.validation_error){
                           //   $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.validation_error+'</span> </div>');
                       //   }
                        //if(myObj.success){
                              $('#success_message').html('<div class="alert alert-success alert-message"> Record Updated </div>');
                              setTimeout(function () {
                                      location.reload(true);
                                    }, 3000);
                         // }
                      },
                    error: function() {
                    alert('Error occurs!');
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