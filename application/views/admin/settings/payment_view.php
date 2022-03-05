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
        <?php //echo "<pre>"; print_r($snddata);die; ?>
        <div class="card">
            <div class="card-header"><i class="fa fa-cog" aria-hidden="true"></i> Data Entry Allowed</div>
             <div class="card-body">
            <form method="POST" id="saveForm" action="<?php echo base_url();?>admin/settings/setting_save">
               <?php $color = array('#c5f9d5','#b9e2ff','#baecc2','#f9c5f5','#f9dfc5','#f9dfc5','#f9dfc5');
                      $headcolor = array('#87d49f','#8ac9f5','#4cde63','#f596ed','#f9df99','#f9df99','#f9df99');
                    $i =-1;  ?>

                <?php foreach ($module as $mod) {
                            $i++;
                  ?>

                     <div class="all_state" style="height: 300px; background:<?php echo $color[$i];?>;margin-bottom:10px; overflow-y: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background:<?php echo $headcolor[$i];?>;">
                                <th>Round</th>
                                <th>Module</th>
                                <th>Start Date  
                                <input type="text" class="state_txt form-control startdate_head" placeholder="" 
                                    name="" 
                                    value=""
                                    id="<?php echo 'start_date_module_id_'.$mod['module_id'];?>"
                                     autocomplete="off"  style="background: #ffffff; width:150px;display:inline-block;"
                                      > 
                                </th>
                                <th>End Date <input type="text" class="state_txt form-control enddate_head" placeholder="" 
                                    name="" value=""
                                    id="<?php echo 'end_date_module_id_'.$mod['module_id'];?>" 
                                    autocomplete="off" style="background: #ffffff; width:150px;display:inline-block;" ></th>
                                <th>States </th>
                                <th> <labeL>Select All <input id="check_all_state_<?php echo $mod['module_id'];?>" type="checkbox" /></label></th>
                            </tr>
                        </thead>
                        <tbody>
                       
                    </table>
                     </div>
                <?php } ?>
              
                            
                                
                         
   

               
                    <hr>    
                    <div class="form-group">
                        <button type="submit" name="submitphcform" class="btn btn-primary px-5" value="submitphc"><i class="icon-lock"></i> Submit</button>
                        <button type="reset" name="submitphcform" class="btn btn-success px-5" value=""><i class="icon-lock"></i> Reset</button>

                        <span id="error_message" class="text-danger"></span>  
                        <span id="success_message" class="text-success"></span>                    
                    </div>
              
                </form>
            </div>
        </div>
    </div>


<!-- End container-fluid-->

</div><!--End content-wrapper-->

<script type="text/javascript">
    
  $(function() {
     <?php foreach ($module as $mod) { ?>
       $("#check_all_state_<?php echo $mod['module_id'];?>").change(function(){  //"select all" change 
            var status = this.checked; // "select all" checked status
            $('.state_list_<?php echo $mod['module_id'];?>').each(function(){ //iterate all listed checkbox items
                this.checked = status; //change ".checkbox" checked status
            });
        });

        $('.state_list_<?php echo $mod['module_id'];?>').change(function(){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){ //if this item is unchecked
                $("#check_all_state_<?php echo $mod['module_id'];?>")[0].checked = false; //change "select all" checked status to false
            }
            
            //check "select all" if all checkbox items are checked
            if ($('.state_list_<?php echo $mod['module_id'];?>:checked').length == $('.state_list_<?php echo $mod['module_id'];?>').length ){ 
                $("#check_all_state_<?php echo $mod['module_id'];?>")[0].checked = true; //change "select all" checked status to true
            }
        });
        $('.state_list_<?php echo $mod['module_id'];?>').trigger("change");
    <?php } ?>
});
</script>

<script>
    $(function(){
        $('.enddate,.startdate,.enddate_head,.startdate_head').datepicker({
            format: 'yyyy-mm-dd'
        });

        $( ".startdate_head, .enddate_head" ).change(dateChanged)
         .on('changeDate', dateChanged);
    });

  function dateChanged(ev) {
    $(this).datepicker('hide');
    $("."+ $(this).attr('id') ).val( $(this).val()); 
   
}

</script>
