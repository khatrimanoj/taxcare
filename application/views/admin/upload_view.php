
<!--Top header css-->    
<?php $this->load->view('common/header'); ?>
<!--Top header css-->    

<!--Start sidebar header-->
<?php $this->load->view('common/sidebar'); ?>
<!--End sidebar-wrapper-->

<!--Start top header-->
<?php $this->load->view('common/roundheader'); ?>
<!--Start top header-->

   <div class="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumb-->
                    <div class="row pt-2 pb-2">
                        <div class="col-sm-9">
                            <h4 class="page-title">Upload Document</h4>
                            <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                 </ol> -->
                        </div>

                    </div>
                    <!-- End Breadcrumb-->
                    <div class="row">
						<div class="col-lg-12">
						  <div class="card">
							<div class="card-header"><i class="fa fa-table"></i> Upload Document</div>
							<div class="card-body">
							 <form>
							 <div class="row">
							 <div class="col-md-3">
						   <div class="form-group">
							<label for="input-1">Caption</label>
							<input type="text" class="form-control" name="">
						   </div>
						   </div>
						 <div class="col-md-3">
						   <div class="form-group">
							<label for="input-1">Upload File</label>
						   <input type="file" class="form-control" name="">                         
								  
						   </div>
						   </div>
						  
							<div class="col-md-4">
						   <div class="form-group" style="margin-top: 30px;">
							<button type="submit" class="btn btn-primary px-5"><i class="fa fa-check-square-o" aria-hidden="true"></i> Submit</button>
						  </div>
						  </div>
						  
							</div></form>
						  </div>
					   
						 
							<div class="card-body">
							  <div class="table-responsive">
							  <table id="" class="table table-bordered">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Caption</th>
										<th>Document</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1.</td>
										<td></td>
										<td></td>
										<td><button class="btn btn-danger btn-sm">Delete</button></td>
									</tr>
									
							</tbody></table>
							</div>
							</div>
							
						  </div>
						</div>
					  </div><!-- End Row-->

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        

     


                        <?php $this->load->view('common/footer'); ?>


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


<script type="text/javascript">
    // $(document).ready(function() {   
        $('select[name="statename"]').on('change', function ()
        {

            var stateID = $(this).val();
        //alert(stateID);
        var url1 = '<?php echo base_url(); ?>';
        if (stateID) {
            $.ajax({
                url: url1 + 'Target/targetform_Ajax/' + stateID,
                type: "GET",
                dataType: "json",
                success: function (data) {

                    $('select[name="districtname"]').empty();
                    $('select[name="districtname"]').append('<option value="">--Select District--</option>');
                    $.each(data, function (key, value) {
                        // alert(value);
                        $('select[name="districtname"]').append('<option value="' + value.District_ID + '">' + value.District_Name + '</option>');
                    });
                }
            });
        } else {
            $('select[name="districtname"]').empty();
            $('select[name="districtname"]').append('<option value="">Select District</option>');
        }
    });
    //});
</script>
<!-- Get District DROPDOWN VALUE Based On State end-->

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

<!--<script>
$(document).ready(function(){
    base_url    =   $("head base").attr("href");
    $('.active').on('click',function(){
        var StateID  = $("#stateid").val();
        var DistrictID  = $("#districtid").val();
    // var id = $(this).attr('id');
    //alert(StateID);
    //alert(DistrictID);
         $.ajax({                      
                type: "post",
                data: {sid: StateID, did: DistrictID},                
                url: base_url+"Target/active/",
                async: true,
                success: function (response) {
                         console.log(response);       
                }
            });
    });
});
</script>-->
