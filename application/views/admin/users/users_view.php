
					<div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1">Username : </label>
                                     <?php echo $user_name; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                <label for="input-2">Mobile Number : </label>
                                <?php echo $user_mobile ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Google Id : </label>
                                   <?php echo $google_id; ?>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1">Pan Number : </label>
                                     <?php echo $user_pan; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Register from</label>
                                   <?php echo $user_platform; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">loaction from ip address</label>
                                   <?php echo $user_ip_address; ?>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Email Id : </label>
                                   <?php echo $user_email;?>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
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
						