                   <?php  // pr($details);  exit;
                    if(isset($details)&&!empty($details)) { ?>
                        <div class="col-xl-12">
                          <?php  echo form_open_multipart('Querydata/add_save_data', ['id'=>'edit_page_form']);?>
                             <input type="hidden" name="id" value="<?php echo $details->id; ?>">
                                <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Name</label>
                                                        <input required  type="text" name="Name" class="form-control form-control-lg"  value="<?php echo $details->name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Type</label>
                                                        <input required type="text" name="Type" class="form-control form-control-lg"  value="<?php echo $details->type; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Section</label>
                                                        <input type="text" name="Section" class="form-control form-control-lg" required   value="<?php echo $details->section; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Maximum Limit</label>
                                                        <input type="text" name="maxlimit" class="form-control form-control-lg" required  value="<?php echo $details->max_limit; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Assesment Year</label>
                                                        <input type="text" name="Assesmentyr" class="form-control form-control-lg" required   value="<?php echo $details->assmnt_year; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Descriptions</label>
                                                        <div class="input-group">
  <textarea class="form-control" rows="4" id="comment" name="descriptions"><?php echo $details->description; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <?php  $checked ='' ; if($details->status ==1) {  $checked ='checked' ; }?>
                                                    <input class="form-check-input" value="1" name="status"  type="checkbox" id="basic_checkbox_1"  <?php echo $checked;?> >
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1">Active</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                         <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid70">Save</button>
                                        </div>
                                        </div>
                                    </div>
                                        <?php }  else {  
                    ?>
                    <table class="table-bordered" id="applicantDetailsbasic" width="100%" style="padding:5px!important;" border="0">
                       <tr>
                        <td><strong>NO Record Found</strong></td>
                    </tr>
                </table>

                <?php   } ?>