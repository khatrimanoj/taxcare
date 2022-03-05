    <!-- Start wrapper-->
     <div class="content-wrapper">
            <div class="container-fluid">
                <?php //echo "<pre>"; print_r($_SESSION); die; ?>
                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">User Management</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('welcome'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View User</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> User List</div>
                            
                          <div class="card-body">
                            	<form method='GET' action="<?php echo base_url('user'); ?>">
                            	<div class="row d-none">
                                 
                                <div class="col-md-2">
                                    <?php $role_required = false; ?>
                                     <?php $this->load->view('common/role_select_box.php'); ?>
                                   </div>
                                
								 
								    <div class="col-md-3">
									  <div class="form-group">
									 <label>User Name</label>
									   <input type="text" class="form-control no-error" name="searchtxt" placeholder="Type here for search" value="<?php if(isset($searchtxt)){print($searchtxt);}; ?>" />
									 
									 </div>
								   </div>
								 
								
								    <div class="col-md-3">
						           <div class="form-group" style="margin-top: 30px;">
						            <button type="submit" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-search"></i>Search</button>
						          </div>
						          </div>
          
            					</div>
            				</form>
                                <div class="table-responsive">
                                    <table id="default-datatabl" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>PAN</th>
                                                <th>EMAIL</th>
                                                <th>MOBILE</th>		
                                                <th>ANDROID OR IOS</th>                             
                                                <th>DATE OF ADDITION</th>	
                                                <th>IP ADDRESS</th>							
                                                <th>Status</th> 
												<th>Action</th>												
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $i=0;
                                            foreach ($user_list as $ulist) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?>.</td>
                                                    <td><?php echo $ulist['user_name']; ?></td>
                                                    <td><?php echo $ulist['user_pan']; ?></td>
                                                    <td><?php echo $ulist['user_email']; ?></td>
                                                    <td><?php echo $ulist['user_mobile']; ?></td>         
                                                    <td><?php echo $ulist['user_platform']; ?></td>         
                                                    <td><?php echo $ulist['user_created']; ?></td>         
                                                    <td><?php echo $ulist['user_ip_address']; ?></td>         
                                           
                                                    <?php
                                                    if ($ulist['user_status'] == 1) {
                                                        $status_value ='<span class="label text-success">Active</span>';
                                                    } else 
                                                    {
                                                        $status_value = '<span class="label text-danger" >In-Active</ span>';
                                                    }
                                                    ?>
                                                    <td><?php echo $status_value; ?></td>
													<td>
                                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light m-1 viewUser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $ulist['user_auto_id']; ?>">View</button>
                                                    </td>
                                                </tr>
												<?php $i++;
												}
											?>
                                        </tbody>
                                    </table>
                                     <div class="pagination"></div>
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
                        <h5 class="modal-title">User Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
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
       $('#default-datatabl thead tr').clone(true).appendTo( '#default-datatabl thead' );
       $('#default-datatabl thead tr:eq(1) th').each( function (i) {
      
      var title = $(this).text();
      if(i>0 && i<9){
          
      $(this).html( '<input class="dashboadinput" type="text" placeholder="'+title+'" style="text-align:center;"/>' ); 
    
           $( 'input', this ).on( 'keyup change', function () {
               if ( table.column(i).search() !== this.value ) {
                   table
                       .column(i)
                       .search( this.value )
                       .draw();
               }
           } );
      }  
    if(i== 0 || i==9){
      
         $(this).html('');
      }
       } );
    
          var table = $('#institute_table').DataTable( {
            fixedHeader: true,
    
         
       } );
    $('body').on('click', '.viewUser',function(e){
		    e.preventDefault();
			console.log('user view');
            var uId = $(this).val();
            var uId2 = $(this).attr('value');
            // alert(uId+uId2);
            var url = "<?php echo base_url() . 'users/getUserDetail/' ?>"+uId;
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
      
    });
	
	$('body').on('submit', '#add_edit_user_form',function(e){
		    e.preventDefault();
				console.log( 'xyz' );
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
    <script>
  $(function () {
    $("#default-datatabl").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel"]
    }).buttons().container().appendTo('#default-datatabl_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
 