    <?php   //pr($details);
if(isset($details)&&!empty($details)) { ?>
       
  <div id='success_message' class="message"></div>
        
 
     <div id='error_div' class="message"></div>
                     
                             
 <div class="col-lg-12">
<form method="POST" action="<?php echo base_url('Legal_doc/save_edit_page');?>" id="edit_page_form">
 <input type='hidden' name='page_id' value="<?php echo $details->page_id; ?>">
  <div class="col-lg-12">
    <div class="form-group">
        <label class="text-label"> Title  </label>
        <input type="text" name="page_title" class="form-control form-control-lg" required="" id="page_title" value="<?php echo $details->page_title; ?>">
    </div>
</div>

<div class="col-lg-12">
    <div class="form-group">
        <label class="text-label">Descriptions</label>
        <div class="input-group">
            <textarea class="form-control" rows="4" id="descriptions" name="descriptions" ><?php echo $details->page_content; ?></textarea>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-row d-flex justify-content-between mt-0 mb-2">
        <div class="form-group">
            <div class="form-check ml-2"><?php  $checked ='' ;if($details->page_status==1) {  $checked ='checked' ; }?>
                <input class="form-check-input" type="checkbox" id="basic_checkbox_1" name="status"  <?php echo $checked;?>  value="1">
                <label class="form-check-label textlightn" for="basic_checkbox_1">Active ? </label>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-12">
   <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid70" id="btn_edit">Save</button>
    <span style="display:none;color:red" id="showloading"> Processing Please Wait...</span>
</div>
</div>
</form>
</div>
 
<?php }  else {  
                    ?>
                    <table class="table-bordered" id="applicantDetailsbasic" width="100%" style="padding:5px!important;" border="0">
                       <tr>
                        <td><strong>NO Record Found</strong></td>
                    </tr>
                </table>

                <?php   } ?>