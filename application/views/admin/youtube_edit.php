    <?php  //echo 'azad';
   // pr($details);
                    if(isset($details)&&!empty($details)) {
                   $details= array_shift($details); 
                  // pr($details);?>
        <?php  echo form_open_multipart('Integration/save_edit_youtube', ['id'=>'edit_page_form']);?>
        <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
        <input type="hidden" name="hdn_banner_image" value="<?php echo $details['image']; ?>">
                           <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Title</label>
                                                        <input type="text" name="youtubetitle" class="form-control form-control-lg" value="<?php echo $details['name']; ?>" required="">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="text-label">Youtube Vide ID</label>
                                                        <input type="text" name="youtubeid" class="form-control form-control-lg" required=""  placeholder="v=ftIPUowtX2Q" value="<?php echo $details['link']; ?>">
                                                    </div>
                                                </div>
                                              
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                <div class="custom-fileUP">
                                                <input type="file" class="custom-file-inputUI" placeholder="Upload ITR"  accept="image/*" name="youtubeimage">
                                                <label class="custom-file-labelbg">Upload Youtube Thumb Pic </label>
                                                </div>
                                                </div>
                                                <?php if($details['image'] ){ ?>
                                                <a  target="_blank" href="<?php echo base_url('download/gallery/' .$details['image'] );?>" class="fancybox" >
                                                    <img id="myImg" src="<?php echo base_url('download/gallery/' . $details['image']); ?>" class="img-responsive" width="75px" height="75px">
                                                </a>
                                            <?php } ?>
                                                </div>
                                          
                                                 <div class="col-lg-12">
                                                <div class="form-row d-flex justify-content-between mt-0 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                     <?php  $checked ='' ;if($details['status']==1) {  $checked ='checked' ; }?>
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