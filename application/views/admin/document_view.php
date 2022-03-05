    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    

    
<div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Upload Document</h4>
            </div>

        </div>
        <!-- End Breadcrumb-->
        <div class="row">
		  <div class="col-lg-12">
		      <div class="card">
			     <div class="card-header"><i class="fa fa-table"></i> Upload Document</div>
                    <?php $this->load->view('common/messages.php'); ?>
				    <div class="card-body">
					   <form method='POST' id="saveForm" action="<?php echo base_url('admin/document/save'); ?>" enctype="multipart/form-data">
						  <div class="row">
						      <div class="col-md-4">
						          <div class="form-group">
							         <label for="input-1">Caption</label>
							         <input type="text" class="form-control" name="caption" value="" required="" >
						          </div>
						      </div>
						      <div class="col-md-4">
						          <div class="form-group">
							         <label for="input-1">Upload File</label>
						              <input type="file" class="form-control" name="document" value="" required="">   
                                      <!--<input required="" id="file-1" name="document" class="file" data-overwrite-initial="false" data-min-file-count="1" type="file"> -->                     
								  </div>
						      </div>
                               <?php if(isset($ministry_list) && is_array($ministry_list)){?>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="input-1">Selct Ministry</label>
                                 <?php
                                    echo form_dropdown('ministry_id', $ministry_list, '' , "class='form-control' required='' "); 
                                    ?>
                                </div>
                              </div>
                            <?php }else{ ?>
                                <input type="hidden" id="" name="ministry_id" value=" <?php if(isset($ministry_list)){ echo $ministry_list; } ?>" >
                            <?php } ?>
						      <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="checkbox" id="" name="check" value="1" <?php echo isset($row['status'])&&$row['status']=='1'?"checked":"";?> > Active?
                                    </div>
                                    
						          <div class="form-group">
							         <button type="submit" name="submit" class="btn btn-primary px-5"><i class="fa fa-check-square-o" aria-hidden="true"></i> Submit</button>
						          </div>

						      </div>
						  
						  </div>
                        </form>
					</div>
                    <?php if(isset($row) && count($row)>0){ ?>
					   						 
					<div class="card-body ">
					   <div class="table-responsive container">
					       <table id="" class="table table-bordered">
							 <thead>
							     <tr>
								    <th>S.No</th>
									<th>Caption</th>
									<th>Document</th>
                                    <th>Status</th>
									<th>Action</th>
								 </tr>
							 </thead>
                             <tbody class="row_position">
                             <?php $i = 0; ?>
                             <?php foreach ($row as $rows) { $i++; ?>
                            
								 <tr id="<?php echo $rows['id']; ?>">
								    <td><?php echo $i; ?></td>
									<td><?php if(isset($rows['caption']))echo $rows['caption']; ?></td>
									<td><a target="__blank" href="<?php echo base_url() . 'download/document/'.$rows['document'] ?>"><?php if(isset($rows['document']))echo $rows['document']; ?></a></td>
                                    <td><?php if ($rows['status'] == 1) { 
                                                   echo '<span class="text-success"> Active</span>';
                                                }else { 
                                                    echo '<span class="text-danger">Inactive</span>';
                                                } ?>
                                    </td>
									<td>
                                       <!--<i id="<?php echo $rows['id']; ?>" class="fa fa-pencil btn btn-primary btn-sm"></i>&nbsp;&nbsp;-->
                                       <i id="<?php echo $rows['id']; ?>" class="fa fa-trash-o btn btn-danger btn-sm deleteDoc" ></i>&nbsp;&nbsp;
                                            
                                    </td>
								 </tr>
								<?php } ?>	
                                </tbody>
							</table>
						</div>
					</div>
					<?php } ?>		
				</div>
			</div>
		</div><!-- End Row-->

    </div>
            <!-- End container-fluid-->

</div><!--End content-wrapper-->
<script type="text/javascript">

    $( ".row_position" ).sortable({

        delay: 150,

        stop: function() {

            var selectedData = new Array();

            $('.row_position>tr').each(function() {

                selectedData.push($(this).attr("id"));

            });

            updateOrder(selectedData);

        }

    });


    function updateOrder(data) {

        $.ajax({

            url:"<?php echo base_url() . 'admin/document/update_sorting/' ?>",

            type:'post',

            data:{position:data},

            success:function(){

                alert('your change successfully saved');

            }

        })

    }

</script>

<script>
$(document).ready(function () {
        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>



<script>
    $(function () {
        var timeout = 2000; // in miliseconds (3*1000)
        $('.alert').delay(timeout).fadeOut(100);
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#final_submit").on("click", function () {
            if (confirm('Are you confirmed and submit the data finally ? Once the data is freezed it cannot be modified')) {

            } else {
                return false;
            }

        });
    });
</script>
<script type="text/javascript">
    $(".deleteDoc").click(function () {

        var id = $(this).attr("id");
        //alert(id);

        swal({
            title: "DELETE?",
            text: "Are you sure you want to delete this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "DELETE",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: "<?php echo base_url('admin/document/deleteDocument') ?>",
                    type: 'POST',
                    data: {id: id},
                    error: function () {
                        return false;
                    },
                    success: function (data) {
                        //alert(data);
                        swal("Deleted!", "The record has been deleted.", "success");
                        location.reload();
                    }
                });
            }
            else
            {
                swal("Cancelled", "The record is safe!!", "error");
            }
        });

    });
</script>