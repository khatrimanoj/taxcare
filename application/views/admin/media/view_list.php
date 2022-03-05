    

<?php if(!isset($layout_type) || $layout_type != 'popup') { ?>   
<div class="content-wrapper">
    <div class="container-fluid">
        <!--Start Dashboard Content-->
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title"> <?php echo $page_title; ?>  </h4>
               
            </div>

        </div>
<?php } ?>  
		  <?php $this->load->view('common/messages.php');  ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>    <?php echo $page_title; ?></div>
						
                    <div class="card-body" >
                        <div style="text-align: right;">
					<a href="<?php echo base_url('media/add_gallery');?>" class="btn btn-sm btn-success">   

                                  <i class="ion-plus-round" aria-hidden="true"></i>    <?php echo $page_title; ?>
                                </a>
                  </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th >S.No.</th>
                                        <th width="200px" class='img'>Image</th>  
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <?php if(has_admin_permission('EDIT_PHOTO_GALLERY')){ ?>
                                        <th>Action</th>
                                        <?php  } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                   <?php
                                   $i=$offset; 
                                   $p=$this->input->get('page');
                                   $t=$per_page*$p;
                                   if($p==0){
                                    $p=1;
                                    $t=$per_page*$p;
                                   }
                                   if($p==$pg){
                                    $t=$total_rows;

                                   }
                                    if($t>$total_rows){
                                        $t=$total_rows;
                                   }

                                   ?>
                                   <?php echo "Showing "."<b>".($i+1)."</b> to <b>".$t."</b> out of<b> ".$total_rows."</b>"; ?> 
                                                                      
                                             
                                   <?php //print_r($result_list);
                                    foreach ($result_list as $row) {
                                        $i++;
                                     //   if($row['video'] && !has_admin_permission('VIDEO_GALLERY')){

                                           // continue; // skip row which content video and user does have video permission
                                       // }
                                        ?>
                                        <tr>
                                            <td colspan=""><?= $i ?></td>


                                            <td class='img'>
                                                <?php if($row['name']){ ?>
                                                <a  target="_blank" href="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="fancybox" ><img id="myImg" src="<?php echo base_url('download/gallery/' . $row['image']); ?>" class="img-responsive" width="75px" height="75px"></a>
                                            <?php } ?>
                                            </td>
                                            
                                           
                                            
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['link'] ?></td>
                                                                             
                                            <td><?= $row['date_added'] ?></td>

                                            <td>

                                                <?php if ($row['status'] == 1) { 
                                                   echo '<span class="text-success"> Active</span>';
                                                }else { 
                                                    echo '<span class="text-danger">Inactive</span>';
                                                } ?>

                                            </td>
                                             
                                           
                                          
                                            <td>                                             
                                              <?php if(has_admin_permission('EDIT_PHOTO_GALLERY')){?>                                           
                                       
                                                <a href="<?php echo base_url('media/EditGallery'); ?>?action=edit&id=<?php echo $row['id']; ?>&<?php echo currentPageURLAdd(); ?>" class="btn btn-primary btn-sm editImage"><i class="fa fa-pencil"></i></a>
                                               <br> <br> 
                                             
                                                <a href="<?php echo base_url('media/deleteGallery'); ?>?id=<?php echo $row['id']; ?>&<?php echo currentPageURLAdd(); ?>" class="btn btn-danger btn-sm deleteImage" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>	
                                              <?php } ?>

                                            </td>
                                        </tr>
									<?php } ?>
									<?php if(empty($result_list)) { ?>
									<tr>
                                        <th colspan="9" class='error'>No record Found!</th>
									</tr>
									<?php } ?>
                                </tbody>
                            </table>
                            <div class="pagination"><?php echo $links[0]; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->
<?php if(!isset($layout_type) || $layout_type != 'popup') { ?>  
    </div>
</div>
<!-- End container-fluid-->
<?php } ?>



