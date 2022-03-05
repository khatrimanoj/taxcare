        <form method='POST' action="<?php echo base_url('settings/saveGolbalText'); ?>">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i>     Settings</div>
                        <div class="all_state mar-t-20">
            <div class="row ">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Title </th>
                                <th>Discription </th>
                                
                                                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($records as $record){ ?>
                            
                            <tr>
                                <input  type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">  
                                <td><?php echo $record['id']; ?></td>
                                <td style='text-align:left;'>
                                    <input type=text  readonly class="form-control" name='title[<?php echo $record['id']; ?>]' value='<?php echo $record['title']; ?>' style="width:100%"></td>
                                <td>
                                <input type="text"  class="form-control" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                                
                                    
                                        
                                    </textarea>
                                </td>
                                
                            </tr>   
                            <?php } ?>                                         
                            
                        </tbody>
                    </table>
                    <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" id="glb" class="btn btn-primary px-5 m-t-30">Submit</button>
                                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>

                                    
                    </div><!-- End Row-->
            </div>
            </div>
              </div>       
        </form>
        
     <div style="clear: both;">
         
     </div>





