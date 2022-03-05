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
 
 #admin_list_filter{     display: none;  }   

 .orderlink{    color: #000; }
 
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
                            <table id="admin_list" class="myTbleStyl tblcenter mb-0" style="min-width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No.</th>
                                        <th >User Name</th>
                                        <th >Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Firm</th>
                                        <th>Status</th>
                                       <!--  <th >Action</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                   <?php $i=0; foreach ($user_list as $ulist) { ?>
                                    <tr>
                                       <td class="text-center"><?php echo $i+1; ?>.</td>
                                       <td><?php echo $ulist['username']; ?></td>
                                       <td><?php echo $ulist['fname']; ?></td>
                                        <!-- <td><?php echo $ulist['firm_name']; ?></td> -->
                                       <td><?php echo $ulist['mobile']; ?></td>
                                       <td><?php echo $ulist['email']; ?></td>
                                       <td><?php echo $ulist['designation']; ?></td>
                                        <?php
                                        if ($ulist['status'] == 1) {
                                            $status_value ='<span class="btnactive text-center text-success">Active</span>';
                                        } else 
                                        {
                                            $status_value = '<span class="pendingBtn text-center text-danger" >In-Active</ span>';
                                        }
                                        ?>
                                        <td><?php echo $status_value; ?></td>
                                    </tr>
                                    <?php $i++; } ?>
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
                              <?php $this->load->view('common/messages.php'); ?>
                              <div id='error_div'></div>
                              <div id='message'></div>
                                <div class="auth-form formUIstyle">
                                    <a href="#">
                                    <span class="absClose" data-dismiss="modal">Close <i class="mdi mdi-close-circle"></i></span>
                                    </a>
                                    <form method="POST" action="<?php echo base_url('user/save_add_user');?>" id="add_edit_user_form">
                                       <input type='hidden' name='admin_id' value='0'>
                                      <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">User Name</label>
                                                        <input type="text" name="username" class="form-control form-control-lg" required="" value="<?php if(isset($username)){print($username);}; ?>" > 
                                                        <span class="form_error"><?php echo form_error('username'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Full Name</label>
                                                        <input type="text" name="fname" class="form-control form-control-lg"  value="<?php if(isset($fname)){print($fname);}; ?>"> 
                                                        <span class="form_error"><?php echo form_error('fname'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Firrm Name</label>
                                                        <input type="text" name="firmname" class="form-control form-control-lg" required="" value="<?php if(isset($firm_name)){print($firm_name);}; ?>"> 
                                                        <span class="form_error"><?php echo form_error('firm_name'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Designation</label>
                                                        <input type="text" name="designation" class="form-control form-control-lg" required=""  value="<?php if(isset($designation)){print($designation);}; ?>"> 
                                                        <span class="form_error"><?php echo form_error('designation'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Mobile Number </label>
   <input type="number" name="mobile" class="form-control form-control-lg" required="" maxlength="10" value="<?php if(isset($mobile)){print($mobile);}; ?>" onkeydown="return event.keyCode !== 69"> <span class="form_error"><?php echo form_error('mobile'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">  Email ID</label>
                                                        <input type="email" name="email" class="form-control form-control-lg" required="" value="<?php if(isset($email)){print($email);}; ?>"> 
                                                        <span class="form_error"><?php echo form_error('email'); ?></span>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" value="1" type="checkbox" name="status" id="basic_checkbox_1" <?php if(isset($status) && $status == 1){ echo 'checked';} ?>>
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Active</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                         <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid70">Save</button>
                                            <span id="error_message" class="text-danger"></span> 
                                            <span id="success_message" class="text-success"></span>
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
            dTable = $('#admin_list').DataTable({
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
      <script type="text/javascript">
         $('body').on('submit', '#add_edit_user_form',function(e){
                e.preventDefault();
                  //console.log( 'xyz' );
                  var form = $('#add_edit_user_form');
                var url = form.attr('action');
               console.log( url );
                  $.ajax({
                      type: "POST",
                      url: url,
                      data: form.serialize() ,
                      success: function (data) {
                          // $("#model_data_ajax").html(data);
                          var myObj = JSON.parse(data); 
                          if(myObj.validation_error){
                              $('#error_div').html('<div class="alert alert-danger alert-message"> <span> '+myObj.validation_error+'</span> </div>');
                          }
                          if(myObj.success){
                              $('#success_message').html('<div class="alert alert-success alert-message"> <span> '+myObj.success+'</span> </div>');
                              setTimeout(function () {
                                      location.reload(true);
                                    }, 3000);
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