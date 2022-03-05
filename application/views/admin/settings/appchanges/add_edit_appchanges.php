<?php if(!isset($layout_type) || $layout_type != 'popup') { ?>  
    <link href="<?php echo base_url();?>assets/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/js/bootstrap4-toggle.min.js"></script>
	  <style type="text/css">
       

#tablinks a.active {
border-bottom: 3px solid #2F49D1;
}


.shadow-sm{box-shadow: none !important;
}


.nav-pills .nav-link.active {
color: black;
background-color: white;
border-radius: 0.5rem 0.5rem 0 0;
font-weight: 600
}

.tab-content{
margin-left: 20px;
}

.nav-pills .nav-link{
text-transform: capitalize;
margin-right: 30px;
font-size: 15px;
font-weight: 500;
}
.title{
color: #767676;

}
 
    .mt-5, .my-5 {
  margin-top: 0px !important;
}
.footer{
    position: inherit;
}   
.table td, .table th{
    border: 0px;
}   .form-control{
    background-color: #E5E5E5;
}
      </style>
      <div class="content-wrapper">
  
			<div class="container-fluid">

                <!--Start Dashboard Content-->

                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-11">
                        <h4 class="page-title">   <?php echo $page_title; ?></h4>

                         <?php $this->load->view('common/messages.php'); ?>
                    </div>

                </div>
         <?php } ?>  
            	
                   
					
                  
				   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container card shadow d-flex justify-content-center mt-5" id="tablinks">
     <!-- nav options -->
     <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
         <li class="nav-item"> 
            <a class="nav-link active title" id="pills-appfeature-tab" data-toggle="pill" href="#pills-appfeature" role="tab" aria-controls="pills-appfeature" aria-selected="true">
                <span class="title">Application Features</span>
            </a> 
        </li>

         <li class="nav-item"> 
            <a class="nav-link" id="pills-calendar-tab" data-toggle="pill" href="#pills-calendar" role="tab" aria-controls="pills-calendar" aria-selected="false">
                <span class="title">Income Tax Calendar</span>
            </a> 
        </li>
         <li class="nav-item"> 
            <a class="nav-link" id="pills-tools-tab" data-toggle="pill" href="#pills-tools" role="tab" aria-controls="pills-tools" aria-selected="false">
                <span class="title">Tools</span>
            </a> 
        </li>


     <li class="nav-item"> 
        <a class="nav-link" id="pills-payment-tab" data-toggle="pill" href="#pills-payment" role="tab" aria-controls="pills-payment" aria-selected="false">
            <span class="title">Payment Gateway</span>
        </a> 
    </li>
          <li class="nav-item"> 
            <a class="nav-link" id="pills-priceplan-tab" data-toggle="pill" href="#pills-priceplan" role="tab" aria-controls="pills-priceplan" aria-selected="false">
                <span class="title">Pricing Plan</span>
            </a> 
        </li>

     </ul> <!-- content -->
     <div class="tab-content" id="pills-tabContent p-3">
       
        <!-- ist card -->
                 <div class="tab-pane fade active show col-sm-8" id="pills-appfeature" role="tabpanel" aria-labelledby="pills-appfeature-tab">
             
           <?php //$this->load->view('admin/incometax/settings_global_text_view',  FALSE); ?>    
             <form method='POST' action="<?php echo base_url('settings/saveGolbalText'); ?>">
            <div class="row">
                <div class="col-lg-12">
                    
                      
             
            
              
                    <table class="table">
               
                        <tbody>
                            <?php foreach($appsetting as $record){ ?>
                            
                            <tr>
                                <input  type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">  
                                
                                <td style='text-align:left;'>
                                  
                                  <?php echo $record['title']; ?></td>
                                <td>
                                <input type="text"  class="form-control" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                                
                                    
                                        
                                    </textarea>
                                </td>
                                
                            </tr>   
                            <?php } ?>                                         
                            
                        </tbody>
                    </table><?php $checked='checked'; ?>
                    <input type="checkbox" <?php echo $checked;?> data-toggle="toggle" data-width="100" data-height="15" data-onstyle="success" data-offstyle="danger">
                    <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" id="glb" class="btn btn-primary px-5 m-t-30">Submit</button>
                                    </div>
                </div>
                
             
        

                                    
                   
               
          
            </div>
                </div>     
        </form> 

         </div> 

         <!-- 2nd card -->
         <div class="tab-pane fade  " id="pills-calendar" role="tabpanel" aria-labelledby="pills-calendar-tab">
             
        <form method='POST' action="<?php echo base_url('Calendar/saveGolbalText'); ?>">
            
               
             <div class="row">
            
            <div class="col-md-11">
           
                    <table class="table">
               
                        <tbody>
                            <?php foreach($calendar as $record){ ?>
                            
                            <tr>
                                <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id']; ?>">  
                               
                                <td  >
                                    <?php echo $record['title'];?></td>
                                <td>    
                                <input type="text"  class="form-control" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                            
                                  
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
        </form>
         </div> 

         <!-- 3nd card -->
         <div class="tab-pane fade secone" id="pills-tools" role="tabpanel" aria-labelledby="pills-tools-tab">
              <form method='POST' action="<?php echo base_url('Tools/saveGolbalText'); ?>">
             
                    
                        
            <div class="row ">
            <div class="col-md-10">
             
                    <table class="table">
                   
                        <tbody>
                            <?php $arrayName=array();
                            $arrayName[1]='Income Tax Payment'  ;
                              $arrayName[2]='Income Tax Calculator'  ;
                               $arrayName[3]='Tax Regime'  ;
                                 $arrayName[4]='Income Tax Slab'  ;
                                  $arrayName[5]='  HRA Calculator  '  ;
                                    $arrayName[6]='  Rent Receipt  Calculator  '  ;
                            foreach($tools as $record){ ?>
                            
                            <tr>
                                <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">  
                                
                                <td style='text-align:left;'>
                                    <?php echo  $arrayName[$record['id']];?> 
                                </td>
                                <td>    
                                <input type="text"  class="form-control" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                            
                                  
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

                                    
                     
             
             
                     
        </form>
         </div>

         <!-- 4 -->

         <div class="tab-pane fade third" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
             <form method='POST' action="<?php echo base_url('Setting_payment/saveGolbalText'); ?>">
            <div class="row">
                <div class="col-lg-8">
                   
                        
                        <div class="all_state mar-t-20">
            <div class="row ">
            <div class="col-md-12">
                 
                
                    <table class="table">
     
                        <tbody>
                            <?php foreach($payments as $record){ ?>
                            
                            <tr>
                                <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">  
                                
                                <td style='text-align:left;'>
                                    <?php echo $record['title']; ?> </td>
                                <td>    
                                <input type="text"  class="form-control" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                            
                                  
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

                                    
                      <!-- End Row-->
            </div>
            </div>
             </div>        
        </form>
         </div>

         <!-- 5 -->
         <div class="tab-pane fade five" id="pills-priceplan" role="tabpanel" aria-labelledby="pills-priceplan-tab">
                 Price Plan TAB 
                 Contents
                 
         </div>
      
     </div>
 </div>
</div></div></div></div>
                        </div>
                    </div><!--End Row-->
               
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