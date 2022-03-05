    <?php  //echo 'azad';
     //pr($details);exit;
                    if(isset($details)&&!empty($details)) {
                   
                  // pr($details);?>
        <?php  echo form_open_multipart('Faq/save_edit_faq', ['id'=>'edit_page_form']);?>
        <input type="hidden" name="id" value="<?php echo $details['faq_id']; ?>">
            <div class="row">
                                              <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Question</label>
                                                        <div class="input-group">
<textarea required class="form-control" rows="2" name="question" id="question"><?php echo $details['faq_question']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                                  <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Answer</label>
                                                        <div class="input-group">
  <textarea required class="form-control" name="answer" rows="4" id="comment"><?php echo $details['faq_content_answer']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                          
                                       
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                                                   <div class="form-check ml-2">
                                                     <?php  $checked ='' ;if($details['faq_status']==1) {  $checked ='checked' ; }?>
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1"  <?php echo $checked;?>  name="status" value="1">
                                                    <label class="form-check-label textlightn" for="basic_checkbox_1" >Active</label>
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
                                    </form>
                                    <?php }  else {  
                    ?>
                    <table class="table-bordered" id="applicantDetailsbasic" width="100%" style="padding:5px!important;" border="0">
                       <tr>
                        <td><strong>NO Record Found</strong></td>
                    </tr>
                </table>

                <?php   } ?>


                                                      