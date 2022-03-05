<?php $this->load->view('common/header_new');?>
<style type="text/css">
 #example_filter{
    display: none;
}
.w200{
    min-width: 300px;

}
.toolbtnwidth{
    min-width: 500px;
}

</style>
</head>

<body>

    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

         <?php $this->load->view('common/sidebar_top');?>
         <?php $this->load->view('common/header_top');?>
         <?php $this->load->view('common/sidebar_new');?>
        <!--**********************************
            Sidebar end
            ***********************************-->

        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Settings/App Changes</h4>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php $this->load->view('common/messages.php'); 
                            $Features = 'active';
                            $Calendar='';
                            $Payment='';
                            $Tools=''; 
                            $Pricing='';
                            $showtab= '';
                            if (($this->session->flashdata('Features'))) {
                                //$Features = 'active'; $Calendar=''; $Tools=''; $Payment=''; $Pricing='' ;
                                $showtab= 'ApppFeature';
                               // echo 'Features';
                            }
                            elseif(($this->session->flashdata('Calendar'))){
                                //$Features = ''; $Calendar='active'; $Tools=''; $Payment=''; $Pricing='' ;
                                $showtab= 'IncomeTax';
                               // echo 'Calendar';
                            } 
                            elseif(($this->session->flashdata('Payment'))){
                               // $Features = ''; $Calendar=''; $Tools=''; $Payment='active'; $Pricing='' ;
                                $showtab= 'PaymentGateway';
                                //echo 'Payment';
                            } 
                            elseif(($this->session->flashdata('Tools'))){
                               // $Features = ''; $Calendar=''; $Tools='active'; $Payment=''; $Pricing='' ;
                                $showtab= 'Tools';
                                 //echo 'Tools';
                            } 
                            elseif(($this->session->flashdata('Pricing'))){
                                //$Features = ''; $Calendar=''; $Tools=''; $Payment=''; $Pricing='active' ;
                                $showtab    = 'PricingPlan';
                                 //echo 'Pricing';
                            }
                            //echo $showtab.'Azad';?>
                            <div class="card p-0 minheight550">

                                <div class="card-body p-0">
                                   <div class="row">
                                     <div class="col-md-12">
                                        <div class="card p-0">

                                            <div class="card-body p-0">
                                                <!-- Nav tabs -->
                                                <div class="default-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link  <?php echo $Features;?>" data-toggle="tab" href="#ApppFeature" id="Feature">Application Features</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php echo $Calendar;?>" data-toggle="tab" href="#IncomeTax" id="Calender">Income Tax Calender</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link  <?php echo $Tools;?>" data-toggle="tab" href="#Tools" id='Toolssett'>Tools</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php echo $Payment;?>" data-toggle="tab" href="#PaymentGateway" id="Payment">Payment Gateway</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php echo $Pricing;?>" data-toggle="tab" href="#PricingPlan" id="Plan">Pricing Plan</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content formUIstyle">
                                                        <div class="tab-pane fade show active" id="ApppFeature" role="tabpanel">
                                                            <div class="p-5">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                     <form method='POST' action="<?php echo base_url('settings/saveGolbalText'); ?>">

                                                                        <?php foreach($appsetting as $record){ ?>
                                                                         <input  type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">
                                                                         <div class="row">

                                                                            <div class="col-md-7">
                                                                                <div class="form-group">
                                                                                    <label class="text-label"><?php echo $record['title']; ?></label>

                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-5">
                                                                             <div class="form-group">

                                                                                 <input type="text"  class="form-control form-control-lg"  name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">
                                                                             </div>
                                                                         </div>

                                                                     </div>
                                                                 <?php } ?>   




                                                             </div>








                                                         </div>
                                                         <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid40">Save</button>
                                                     </form>
                                                 </div>
                                             </div>
                                             <div class="tab-pane fade" id="IncomeTax">
                                                <div class="p-5">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                         <form method='POST' action="<?php echo base_url('Calendar/saveGolbalText'); ?>">
                                                            <?php foreach($calendar as $record){ ?>
                                                                <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id']; ?>">  
                                                                <div class="row">

                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <label class="text-label"> <?php echo $record['title'];?></label>

                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-5">
                                                                     <div class="form-group">
                                                                         <input type="text"  class="form-control form-control-lg" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>">                      

                                                                     </div>
                                                                 </div>

                                                             </div>
                                                         <?php } ?> 
                                                         <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu w200">Save</button>
                                                     </form> 





                                                 </div>








                                             </div>
                                         </div>
                                     </div>
                                     <div class="tab-pane fade" id="Tools">
                                        <form method='POST' action="<?php echo base_url('Tools/saveGolbalText'); ?>">
                                            <div class="p-5">
                                                <div class="row">
                                                    <div class="col-lg-4">

                                                     <?php $arrayName=array();
                                                     $arrayName[1]='Income Tax Payment'  ;
                                                     $arrayName[2]='Income Tax Calculator'  ;
                                                     $arrayName[3]='Tax Regime'  ;
                                                     $arrayName[4]='Income Tax Slab'  ;
                                                     $arrayName[5]='  HRA Calculator  '  ;
                                                     $arrayName[6]='  Rent Receipt  Calculator  '  ;
                                                     foreach($tools as $record){ ?>
                                                         <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">
                                                         <div class="row">

                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <label class="text-label"> <?php echo  $arrayName[$record['id']];?></label>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-5">
                                                             <div class="form-group">


                                                                <input type="text"  class="form-control form-control-lg w200" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>"> 
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php } ?> 

                                                <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu toolbtnwidth">Save</button>


                                            </div>








                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="PaymentGateway">
                                <div class="p-5">
                                    <div class="row">
                                        <div class="col-lg-4">
                                           <form method='POST' action="<?php echo base_url('Setting_payment/saveGolbalText'); ?>">
                                            <?php foreach($payments as $record){ ?>
                                                <input type="hidden" name="id[<?php echo $record['id']; ?>]" value="<?php echo $record['id'];?>">  
                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="text-label"> <?php echo $record['title']; ?></label>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-5">
                                                     <div class="form-group">
                                                        <input type="text"  class="form-control form-control-lg w200" name='description[<?php echo $record['id']; ?>]' value="<?php echo $record['description']; ?>"> 
                                                    </div>
                                                </div>

                                            </div>

                                        <?php } ?> 

                                        <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu toolbtnwidth">Save</button>
                                    </form>
                                </div>








                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="PricingPlan">
                        <div class="p-5">
                            <div class="row">
                                        <div class="col-lg-4">
                                           <form method='POST' action="<?php echo base_url('App_changes/save_tax_filing_price'); ?>">
                                            <?php  
                                               
                                            foreach($file_catery as $record){ ?>
                                                <input type="hidden" name="id[<?php echo $record['doc_id']; ?>]" value="<?php echo $record['doc_id'];?>">  
                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="text-label"> <?php echo $record['doc_name']; ?></label>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-5">
                                                     <div class="form-group">
                                                        <input type="text"  class="form-control form-control-lg w200" name='filing_cost[<?php echo $record['doc_id']; ?>]' value="<?php echo $record['filing_cost']; ?>"> 
                                                    </div>
                                                </div>

                                            </div>

                                        <?php } ?> 

                                        <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu toolbtnwidth">Save</button>
                                    </form>
                                </div>








                            </div>
                            <br><br>
                           
                            <button class="btn btn-primary btnBannerimg">GST Percentage And Minimum Tax Filing Price Settings </button>
                            <hr>
                            <!-- Min payment + GST settings -->
                                      <div class="row">
                                        <div class="col-lg-4">
                                           <form method='POST' action="<?php echo base_url('App_changes/save_min_price_tax_rate'); ?>">
                                            <?php  
                                               //pr($gst_min_pay );
                                            
                                                ?>
                                                <input type="hidden" name="setting_id" value="<?php echo $gst_min_pay['id'];?>"> 
                                                                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="text-label"> <?php echo 'GST(%)'; ?></label>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-5">
                                                     <div class="form-group">
                                                        <input type="text"  class="form-control form-control-lg w200" name="gst_percnt" value="<?php echo $gst_min_pay['gst_percent']; ?>"> 
                                                    </div>
                                                </div>

                                            </div> 
                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="text-label"> <?php echo 'Minimum Charge (Rs.)'; ?></label>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-5">
                                                     <div class="form-group">
                                                        <input type="text"  class="form-control form-control-lg w200" name="min_pay" value="<?php echo $gst_min_pay['min_charge_amount']; ?>"> 
                                                    </div>
                                                </div>

                                            </div>

                                        

                                        <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu toolbtnwidth">Save</button>
                                    </form>
                                </div>








                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
             <div class="text-center mt-3">
                <!-- <button type="submit" class="btn btn-primary btn-block btnBannerimg btnblu wid40">Save</button> -->
            </div>
        </div>


    </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>





</div>
</div>
</div>
        <!--**********************************
            Content body end
            ***********************************-->


            <!--**********************************
            Footer start
            ***********************************--> 
            <?php $this->load->view('common/footer_new');?>
            <script type="text/javascript">
            $(document).ready(function() {
                //console.log(<?php echo $showtab;?>);
                $('a[href="#<?php echo $showtab;?>"]').tab('show');
            dTable = $('#example').DataTable({
            destroy: true,
            // searching: false,
            bPaginate: true,
            bLengthChange: false,
            bFilter: true,
            bInfo: false

            });
            $('#searhbox').keyup(function(){  
            dTable.search($(this).val()).draw();   // this  is for customized searchbox with datatable search feature.
            })
            });
            </script>
        </body>

        </html>