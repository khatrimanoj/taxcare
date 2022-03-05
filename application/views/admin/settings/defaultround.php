<?php //echo "<pre>";print_r($arid); die; ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Events</li>
     </ol> -->
            </div>

        </div>
        <!-- End Breadcrumb-->

        <?php $this->load->view('common/messages.php'); ?>
        <div class="card">
             <div class="card-header"><i class="fa fa-cog" aria-hidden="true"></i> Setting : Default Round</div>
             <div class="card-body">
                <form method="GET" id="" action="<?php echo base_url();?>admin/settings/setDefaultRound">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="input-1" class="card-title">Setting for Front Default Round : </label>
                            

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="input-1" class="card-title">Setting for Admin Default Round : </label>
                            

                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-6">
                         <?php foreach ($rdetails as $r) { ?>  
                            <div class="form-group">
                                <div class="radio">
                                <label><input type="radio" name='frid' value="<?php echo $r['id']; ?>" <?php if($r['id']==$frid[0]['round_id']){echo "checked";} ?>> <?php echo $r['name'] ?></label>
                                </div>   
                            </div>
                         <?php } ?>
                         <div class="form-group">
                                <div class="radio">
                                <label><input type="radio" name='frid' value="0" <?php if($frid[0]['round_id']=='0'){echo "checked";} ?>> For All Round</label>
                                </div>
                                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <?php foreach ($rdetails as $r) { ?>  
                            <div class="form-group">
                                <div class="radio">
                                <label><input type="radio" name='arid' value="<?php echo $r['id']; ?>" <?php if($r['id']==$arid[0]['round_id']){echo "checked";} ?>><?php echo "  ".$r['name'] ?></label>
                                </div>   
                            </div>
                         <?php } ?>
                    </div>   
                </div>


               
                    <hr>    
                    <div class="form-group">
                        <button type="submit" name="submitphcform" class="btn btn-primary px-5" value="submitphc"><i class="icon-lock"></i> Submit</button>
                        <button type="reset" name="submitphcform" class="btn btn-success px-5" value=""><i class="icon-lock"></i> Reset</button>

                    </div>
              
                </form>
            </div>
        </div>
    </div>


<!-- End container-fluid-->

</div><!--End content-wrapper-->


