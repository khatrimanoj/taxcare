
					<div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1">User Name : </label>
                                     <?php echo $username; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                <label for="input-2">Name :</label>
                                <?php echo $mobile ?>
                                </div>
                            </div>                                      
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Firm Name:</label>
                                   <?php echo $firm_name; ?>
                                </div>
                            </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Designaton :</label>
                                   <?php echo $designation; ?>
                                </div>
                            </div>
                        </div>
                   

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Email Id : </label>
                                   <?php echo $email;?>
                                </div>
                            </div>
                       <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Mobile : </label>
                                   <?php echo $mobile;?>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                 <div class="form-group" style="padding: 5px 0px 0px;">
                                     <label for="input-3">Status : </label>
                                    <?php
                                        if ($user_status == 1) {
                                            echo $status_value ='<span class="label text-success">Active</span>';
                                        } else 
                                        {
                                            echo $status_value = '<span class="label text-danger" >In-Active</ span>';
                                        }
                                        ?>
                                </div>
                            </div>

                        </div>
						<?php if(has_admin_permission_layout('EDIT_USER')) { ?>
						<div class="row">
                            <div class="col-lg-6">
						   <button type="button" class="btn btn-warning btn-sm waves-effect waves-light m-1 edituser" value="<?php echo $admin_id;?>" >Edit</button>
						   </div>
                       <div class="col-lg-6">
                           <button type="button" class="btn btn-info btn-sm waves-effect waves-light m-1 changepassword" value="<?php echo $admin_id;?>" >Change Password</button>
                           </div>
						</div>
						<?php } ?>
						