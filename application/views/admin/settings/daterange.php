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
             <div class="card-header"><i class="fa fa-cog" aria-hidden="true"></i> Setting : Daily Reporting Allowed Date Range</div>
             <div class="card-body">
                <form method="POST" id="saveForm" action="<?php echo base_url();?>admin/settings/daterange_save">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="input-1">Setting for : </label>
                            <?php echo getRoundName();?>

                        </div>
                    </div>
                </div>

                 <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1">Start Date </label>
                                <input  required="" name="startdate" type="text" class="form-control" id="startdate" placeholder="Enter start date" value="<?php echo isset($settings['startdate']) && $settings['startdate'] != '' ? $settings['startdate'] : ""; ?>" >

                            </div>
                        </div>
                    </div>
   
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1">End Date </label>
                                <input  required="" name="enddate" type="text" class="form-control " id="enddate" placeholder="Enter end date" value="<?php echo isset($settings['enddate']) && $settings['enddate'] != '' ? $settings['enddate'] : ""; ?>" >

                            </div>
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


<script>
    $(function(){
        $('#enddate,#startdate').datepicker({
            format: 'yyyy-mm-dd'
        });
       
    });

</script>
