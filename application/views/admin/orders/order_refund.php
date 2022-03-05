

    <!-- Start wrapper-->
     <div class="content-wrapper">
            <div class="container-fluid">

                <?php //echo "<pre>"; print_r($_SESSION); die; ?>

                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Order Management</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('welcome'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Refund</li>
                        </ol>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Order List</div>
                            
                          <div class="card-body">
                            	<form method='GET' action="<?php echo base_url('user'); ?>">
                            	<div class="row">
                                 
                                <div class="col-md-2">
                                    <?php $role_required = false; ?>
                                     <?php //$this->load->view('common/role_select_box.php'); ?>
                                   </div>
                                
								 
								  <!--   <div class="col-md-3">
									  <div class="form-group">
									 <label>User Name</label>
									   <input type="text" class="form-control no-error" name="searchtxt" placeholder="Type here for search" 
								value="<?php if(isset($searchtxt)){print($searchtxt);}; ?>" />
									 
									 </div>
								   </div> 
								 
								
								    <div class="col-md-3">
						           <div class="form-group" style="margin-top: 30px;">
						            <button type="submit" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-search"></i>Search</button>
						          </div>
						          </div>
          -->
            					</div>
            				</form>

                                <div class="table-responsive">
                                    <table id="order-datatabl" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>ORDER ID</th>
                                                <th>AMOUNT</th>
                                                <th>NAME</th>
                                                <th>PAN</th>
                                                <th>REMARK</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $i=0; ?>
                                              

                                           <?php
                                            foreach ($orders as $order) { ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?>.</td>
                                                    <td><?php echo $order['order_id']; ?></td>
                                                    <td><?php echo $order['order_amount']; ?></td>
                                                    <td><?php echo $order['name']; ?></td>
                                                    <td><?php echo $order['order_pan']; ?></td>
                                                    <td><?php echo $order['banktxnid']; ?></td>
                                                </tr>
												<?php $i++;
												}
											?>
                                        </tbody>
                                    </table>
                                     
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
    $('#order-datatabl thead tr').clone(true).appendTo( '#order-datatabl thead' );
       $('#order-datatabl thead tr:eq(1) th').each( function (i) {
      
      var title = $(this).text();
      if(i>0 && i<5){
          
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
    if(i== 0 || i==5){
      
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
            alert(uId+uId2);
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


 s