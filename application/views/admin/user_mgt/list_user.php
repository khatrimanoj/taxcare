
    <!-- Start wrapper-->
     <div class="content-wrapper">
            <div class="container-fluid">

                <?php //echo "<pre>"; print_r($_SESSION); die; ?>

                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">  Admin Manager</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('welcome'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Admins</li>
                        </ol>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Admins List</div>
                            
                          <div class="card-body">
                <div class="col-md-12" style="text-align: right;">
                                   <div class="form-group">
                                     
                                      

                                     <a href="<?php echo base_url('user/add_user'); ?>"  class="btn btn-sm btn-success">   

                                  <i class="fa fa-user-plus" aria-hidden="true"></i>  Add Admin
                                </a> 
                                  </div>
                                  </div>
          

                                <div class="table-responsive">
                                    <table id="default-datatabl" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>User Name</th>
                                                <th>Name</th>
                                                <th>Firm Name</th>
                                                <th>Designation</th>
                                                <th>Mobile</th>										
                                                <th>Email</th>
                                                <th>Status</th> 
												<th>Action</th>												
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                               $i=$offset; 
                                               $p=$this->input->get('page');
                                               $t=$per_page*$p;
                                               if($p==0){
                                                $p=1;
                                                $t=$per_page*$p;
                                               }
                                               if($p==$pg){
                                                $t=$total_rows;

                                               }?>
                                               <?php echo "Showing "."<b>".($i+1)."</b> to <b>".$t."</b> out of<b> ".$total_rows."</b>"; ?> 

                                           <?php
                                            foreach ($user_list as $ulist) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?>.</td>
                                                     <td><?php echo $ulist['username']; ?></td>
                                                    <td><?php echo $ulist['fname']; ?></td>
                                                    <td><?php echo $ulist['firm_name']; ?></td>
                                                    <td><?php echo $ulist['designation']; ?></td>
                                                    <td><?php echo $ulist['mobile']; ?></td>  
                                                    <td><?php echo $ulist['email']; ?></td>
                                                    <?php
                                                    if ($ulist['status'] == 1) {
                                                        $status_value ='<span class="label text-success">Active</span>';
                                                    } else 
                                                    {
                                                        $status_value = '<span class="label text-danger" >In-Active</ span>';
                                                    }
                                                    ?>
                                                    <td><?php echo $status_value; ?></td>
													<td>
                                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light m-1 viewUser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $ulist['admin_id']; ?>">View</button>
												<!-- 		<?php //if(has_admin_permission_layout('EDIT_USER')) { ?>
                                                        <a class="btn btn-warning btn-sm waves-effect waves-light m-1 edituser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $ulist['admin_id']; ?>" 
														href="<?php //echo base_url() . 'user/add_edit_user/'. $ulist['admin_id'] ;?>"
														>Edit</a>
														<?php //} ?> -->
                                                      
                                                    </td>                                              
                                                   
                                                   
                                                </tr>
												<?php $i++;
												}
											?>
                                        </tbody>
                                    </table>
                                     <div class="pagination"><?php echo $links[0]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Row-->
            </div>
            </div>
            <!-- End container-fluid-->


        <!-- Modal -->
        <div class="modal fade" id="largesizemodal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Admin Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="btn btn-sm alert-danger"> Close &times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='model_data_ajax'></div>
				</div>
			</div>
		</div>
        <!-- Modal -->




<script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {
    $('body').on('click', '.viewUser',function(e){
		    e.preventDefault();
			console.log('user view');
            var uId = $(this).val();
            var uId2 = $(this).attr('value');
           // alert(uId+uId2);
            var url = "<?php echo base_url() . 'user/getUserDetail/' ?>"+uId;
            $.ajax({
                type: "POST",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });

       $('body').on('click', '.edituser',function(e){
			e.preventDefault();
            var uId = $(this).attr('value');
            url = "<?php echo base_url() . 'user/add_edit_user/' ?>"+uId;
            $.ajax({
                type: "GET",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
       // change password //
       $('body').on('click', '.changepassword',function(e){
            e.preventDefault();
            var uId = $(this).attr('value');
            url = "<?php echo base_url() . 'user/change_password/' ?>"+uId;
            $.ajax({
                type: "GET",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
      
    });
	
	$('body').on('submit', '#add_edit_user_form',function(e){
		    e.preventDefault();
				//console.log( 'xyz' );
            var form = $('#add_edit_user_form');
		    var url = form.attr('action')+ '?layout_type=popup';
			console.log( url );
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize() ,
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
	//}
	
    /* Get District List Based On State ID code ended */

    </script>


 