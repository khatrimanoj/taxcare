 <?php if($layout_type !='popup') { ?>  
	 <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->

                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Admin Manager</h4>
                    
                    </div>

                </div>
                <!-- End Breadcrumb-->
<?php } ?>
<?php $this->load->view('common/messages.php'); ?>
<!-- End Breadcrumb-->
<form action="<?php echo $form_url; ?>" method="POST" id='add_edit_user_form' >
  <input type='hidden' name='admin_id' value='<?php echo $admin_id;?>' >
	<div class="row">
		<div class="col-lg-10">
			<div class="card">
				<div class="card-body">
					<div class="card-title"><?php echo $form_title;?></div>
					<hr>                              
								<div class="row">
				 
						</div>
			 
				
			 
				 
			 
											<div class="col-lg-6">
							<div class="form-group">
								<label for="input-3">Password</label>
								<input type="password" id="password" class="form-control no-error" name="password" placeholder="Enter User Password" value="">
								<span class="form_error"><?php echo form_error('password'); ?></span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="input-3">Confirm Password</label>
								<input type="password" id="cpassword" class="form-control no-error" name="cpassword" placeholder="Enter Confirm Password" value="">
								<span class="form_error"><?php echo form_error('cpassword'); ?></span>
							</div>
						</div>
					 </div>
				 	 

					<div class="row">
			 
				<!-- 		 <div class="col-lg-6">
							 <div class="form-group" style="padding: 37px 0px 0px;">
								<input type="checkbox"  name="status" value="1" 
								<?php if(isset($status) && $status == 1){ echo 'checked';} ?>> Active?
							</div>
						</div> -->
							<div class="card-body">
					    
					<div class="form-group">
						<button type="submit" name="Submit" class="btn btn-primary px-5" value="Submit"><i class="icon-lock"></i> Submit</button>
						<span id="error_message" class="text-danger"></span>  
						<span id="success_message" class="text-success"></span>                    
					</div>
				</div>

					</div>
				</div>

			
			</div>
		</div>
	</div><!--End Row-->
</form>
 <?php if($layout_type !='popup') { ?>  
 <!--End Dashboard Content-->

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
<?php } ?>