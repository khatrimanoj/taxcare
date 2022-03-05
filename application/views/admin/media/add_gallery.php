<?php if(!isset($layout_type) || $layout_type != 'popup') { ?>  
	  <div class="content-wrapper">
  
			<div class="container-fluid">

                <!--Start Dashboard Content-->

                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">   <?php echo $page_title; ?></h4>

                        
                    </div>

                </div>
        <?php } ?>  
            	<?php
                    if ($this->input->get('action') == 'edit') {
                        $required = '';
                        $action = base_url() . "media/GalleryUpdate";
                    } else {
                        $required = 'required=""';
                        $action = base_url() . "media/GalleryInsert";
                    }
                    $attr = array("id" => "myformImage");
                    echo form_open_multipart($action, $attr);
                    ?>
					
                   <?php $this->load->view('common/messages.php');  ?>
				   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body" style="padding-bottom:0px;"></div>
                                    <div class="card-title" style="padding-left:10px;"><?php echo $page_title;?>
								 
									<input type="hidden" name="id" value="<?php echo isset($row['id']) && $row['id'] != '' ? $row['id'] : ""; ?>">  
									
								    <?php if(isset($layout_type)) {  ?>
                                        <input type="hidden" name="layout_type"
                                        value="<?php echo $layout_type;  ?>"> 
                                    <?php } ?>


                                    <?php echo previousPageInput(); ?>
									 
                               
                                                            
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="input-1">Title </label>
                                                <input name="title" type="text" required="" class="form-control" id="title" placeholder="Enter Title" value="<?php echo isset($row['name'])&&$row['name']!=''?$row['name']:"";?>" >
                                            </div>
                                            <div class="error"><?php echo $this->session->flashdata('name'); $this->session->set_flashdata('name', '');?></div>
                                        </div>
                                    </div>
                                         <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="input-1">Link </label>
                                                <input name="link" type="text" required="" class="form-control" id="link" placeholder="http://youtube.com/v=kskksks" value="<?php echo isset($row['link'])&&$row['link']!=''?$row['link']:"";?>" >
                                            </div>
                                            <div class="error"><?php echo $this->session->flashdata('link'); $this->session->set_flashdata('link', '');?></div>
                                        </div>
                                    </div>

                         
                                       <div class="row">
			                            <div class="col-md-4 col-xs-12">
			                                <div class="form-group">
			                                    <label>Upload Photo</label>
			                                    <div class="form-group">
			                                        <input <?php //echo $required; ?> id="<?php if(empty($row)){echo 'file-1';}?>" name="image"   type="file" class="file" data-overwrite-initial="false" data-min-file-count="<?php if(empty($row)){echo '1';}?>">
													<span class="error">Max allowed file Size : 5 MB</span> 
                    
                                                    <div class="error"><?php echo $this->session->flashdata('image'); $this->session->set_flashdata('image', '');?></div>
			                                    </div>
												

			                                </div>
			                            </div>
			                            <div class="col-sm-4">
			                                <?php if (isset($row['image']) && $row['image'] != '') { ?><a href="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="fancybox"><img src="<?php echo base_url('download/gallery/'.$row['image']); ?>" class="img-responsive" width="150"></a><?php } ?>
			                            </div>
			                        </div>
                                    

                                   
                                   
                                    <div class="row">
                                        
                                         <div class="col-lg-6">
                                             <div class="form-group" style="padding: 10px 0px 0px;">
												<label>
													<input type="checkbox" id="" name="check" value="1" <?php echo isset($row['status'])&&$row['status']=='1'?"checked":"";?>> Active?
												</label>
                                            </div>
                                        </div>

                                    </div>
                                <?php   if(has_admin_permission('STATE_APPROVE_PHOTO_GALLERY')) { ?>
                                   <div class="row">
                                        
                                         <div class="col-lg-6">
                                             <div class="form-group" style="padding: 10px 0px 0px;">
												<label>
													<input type="checkbox" id="" name="approve" value="1" <?php echo isset($row['approve'])&&$row['approve']=='1'?"checked":"";?>> Approve?
												</label>
                                            </div>
                                        </div>

                                    </div>
                                   
                                <?php }   ?>
                                </div>
                                <input type="hidden" name="act" value=<?php echo $required; ?> />
                                <div class="card-body" style="padding-top:0px;padding-bottom:0px;">                                     
									<div>
									
									    <div class="bar" style="background:green; height:20px; width:0px; " >
										 <div class='percent_value'></div>
										 <div id='loading_status' ></div>
										</div>
									       <div class='laoding alert alert-success'></div> 
									</div>
									<hr> 
                                    <div class="form-group">
                                        <button type="submit" name="submitphcform" id="submitphcform" class="btn btn-primary px-5" value=""><i class="icon-lock"></i> Submit</button>
                                        <?php if(previousPageURL()){ ?>
                                        <a type="button"  class="btn px-5 back btn-secondary" style='margin-left:50px;'
                                        href="<?php echo previousPageURL();?>" >
                                            <i class="icon-back"></i> Back</a>
                                        <?php } ?>
                                    </div>
                                   
                                  
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->
                </form>
                <!--End Dashboard Content-->
<?php if(!isset($layout_type) || $layout_type != 'popup') { ?>  
            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
       
       
    <!-- Get CHC DROPDOWN VALUE BAsed On District Ended -->
 <?php /* <script type="text/javascript">

  $(function() {
             $("form").submit(function() {
                        $(this).submit(function() {
                            return false;
                        });
                        return true;
                    }); 
       });
</script>  */ ?>
<?php } ?>
<script type="text/javascript">

$( document ).ready(function() {
    $("form").submit(function() {
        var image = $("#file-1").val();
        var video = $("#video").val();
        
       if( image== "" && video== ""  ){
            alert('Either you choose "upload photo" or "upload video".')
            return false;
       }else{

            
             return true;
       }
     });
});
 
</script>