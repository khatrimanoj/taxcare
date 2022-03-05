<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);?>
<!-- Start wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Dashboard 
                   
            </div>
        </div>

 <style type="text/css" media="screen">
 .card {
  border-radius: 10px;
  padding-right: 0px;
padding-left: 0px;
margin:0 0 10px 0;
}
  .span-tiles{
      color: #B9B9B9;
      font-family: Inter;
      font-size: 14px;
      font-style: normal;
      font-weight: 600;
      line-height: 14px;
      letter-spacing: 0px;
      text-align: left;

  }
  .h3-heading{
font-family: Inter;
font-size: 25px;
font-weight: 600;
line-height: 19px;
letter-spacing: 0px;
text-align: left;
Font style: Semi Bold;


  }
   .grey-bg {  
    background-color: #F5F7FA;
}
.completed-order {      
    background-image: url("<?php echo base_url('assets/img/OrderIconPurple.png'); ?>");
    background-repeat: no-repeat;
}
.circle {
  /* (A) SAME WIDTH & HEIGHT - SQUARE */
  width: 50px;
  height: 50px;
 
  /* (B) 50% RADIUS = CIRCLE */
  border-radius: 50%;
 
  /* (C) BACKGROUND COLOR */
  //background: #bcd6ff;
  background-image: url("<?php echo base_url('assets/img/background.png'); ?>");
}
.circle-order {
  /* (A) SAME WIDTH & HEIGHT - SQUARE */
  width: 50px;
  height: 50px;
 
  /* (B) 50% RADIUS = CIRCLE */
  border-radius: 50%;
 
  /* (C) BACKGROUND COLOR */
  //background: #bcd6ff;
  background-image: url("<?php echo base_url('assets/img/order-orangebg.png');?>");
}

.circle-admin {
  /* (A) SAME WIDTH & HEIGHT - SQUARE */
  width: 50px;
  height: 50px;
 
  /* (B) 50% RADIUS = CIRCLE */
  border-radius: 50%;
 
  /* (C) BACKGROUND COLOR */
  //background: #bcd6ff;
  background-image: url("<?php echo base_url('assets/img/admin-bg.png');?>");
}
.text-right{
      text-align: left !important;
    margin-left: 10px;
}

 </style>
 
 



<div class="row">
  

<div class="grey-bg container-fluid">
  <section id="minimal-statistics">

    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle">
                  <img src="http://127.0.0.1/admin/assets/img/Android.png"   alt="" style="margin-top: 7px;
margin-left: 6px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">1012769</h3>
                  <span class="span-tiles">Total Android Users</span>
                  <br>
                     <br> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
           <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-order">
                  <img src="http://127.0.0.1/admin/assets/img/OrderIconOrage.png"   alt="" style="margin-top:15px;
margin-left:15px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">45770</h3>
                  <span class="span-tiles">Total Orders</span><br>
                  <span class="span-tiles" style="color:#4BDE97">Rs. 10,000/-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
                        <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-order">
                  <img src="http://127.0.0.1/admin/assets/img/OrderIconOrage.png"   alt="" style="margin-top:15px;
margin-left:15px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">340709</h3>
                  <span class="span-tiles">Pending Orders</span><br>
                  <span class="span-tiles" style="color:#4BDE97">Rs. 6,0740/-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
             <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-admin">
                  <img src="http://127.0.0.1/admin/assets/img/iconoir_profile-circled.png"   alt="" style="margin-top:13px;
margin-left:13px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">340709</h3>
                  <span class="span-tiles">Sub-Admins</span><br>
                 <!--  <span class="span-tiles" style="color:#4BDE97">Rs. 6,0740/-</span> -->
                 <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    
  
     
  </section>
  
   
</div>
 
       </div>  
       <div class="row">
  

<div class="grey-bg container-fluid">
  <section id="minimal-statistics">

    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle">
                  <img src="http://127.0.0.1/admin/assets/img/IOs.png"   alt="" style="margin-top: 7px;
margin-left: 10px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">89339</h3>
                  <span class="span-tiles">Total iOS Users</span>
                  <br>
                     <br> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-order">
                  <img src="http://127.0.0.1/admin/assets/img/OrderIconOrage.png"   alt="" style="margin-top:15px;
margin-left:15px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">12877</h3>
                  <span class="span-tiles">Completed Orders</span><br>
                  <span class="span-tiles" style="color:#4BDE97">Rs. 6,0740/-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
       <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-order">
                  <img src="http://127.0.0.1/admin/assets/img/OrderIconOrage.png"   alt="" style="margin-top:15px;
margin-left:15px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">12877</h3>
                  <span class="span-tiles">Refund Orders</span><br>
                  <span class="span-tiles" style="color:#4BDE97">Rs. 3,560/-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="circle-admin">
                  <img src="http://127.0.0.1/admin/assets/img/Message icon.png"   alt="" style="margin-top:15px;
margin-left:10px;">
                 
                   
                </div>
                <div class="media-body text-right">
                  <h3 class="h3-heading">177</h3>
                  <span class="span-tiles">Messages</span><br>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    
  
     
  </section>
  
   
</div>
 
       </div>
        <!-- tiles  -->
  
 
          
       <!-- // tiles  -->
 
 <br> 
       
        <div class="row" >
          
              <div class="card" style="width: 98%; margin-left:15px;">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pending Orders</h3> 

                <div class="card-tools">   <a href=""> <i class="fas fa-download green-color"> Download </i>   </a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0" id="dashboardorders">
                    <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Order ID</th>
                      <th>Billing Name</th>
                      <th>Date</th>
                      <th>Total</th>
                      
                      <th>PAN</th>
                      <th>TYPE</th> 
                      <th>Status</th>
                     
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php for ($i=1; $i < 10; $i++) { 
                       
                       ?>
                    <tr>
                      <td> <?php echo $i; ?></td>
                      <td><a href="#"> 220102000<?php echo $i; ?></a></td>
                      <td>Mr. Bansal </td>
                      <td>1<?php echo $i; ?> Jan,2022 </td>
                      <td>Rs. 1500</td>
                       
                       <td>AKKPA56G788</td>
                       <td>ORIGINAL</td>
                       <td><span class="badge badge-warning">Pending</span></td>
                      
                      <td > <a href="#" class="nav-link rounded">
                      Assign                    </a>
                    </td>
                    </tr>
                     
                     
                    <?php } ?>
                     
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> -->
                <a href="javascript:void(0)" class="btn btn-sm btn-success float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
         
            </div>
         
<!-- // latest members  -->
         


    </div>
    <!-- End container-fluid-->

</div><!--End content-wrapper-->
<!--Start Back To Top Button-->
<script type="text/javascript">
   $(document).ready(function() {
       // $('#dashboardorders').DataTable({});
       $('#dashboardorders thead tr').clone(true).appendTo( '#dashboardorders thead' );
       $('#dashboardorders thead tr:eq(1) th').each( function (i) {
      
      var title = $(this).text();
      if(i>0 && i<8){
          
      $(this).html( '<input class="dashboadinput" type="text" placeholder="'+title+'" style="text-align:center;"/>' ); 
    
           $( 'input', this ).on( 'keyup change', function () {
               if ( table.column(i).search() !== this.value ) {
                   table
                       .column(i)
                       .search( this.value )
                       .draw();
               }
           } );
      }  
    if(i== 0 || i==8){
      
         $(this).html('');
      }
       } );
    
          var table = $('#institute_table').DataTable( {
            fixedHeader: true,
    
         
       } );
   } );
 
  
   /*$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#dashboardorders thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#dashboardorders thead');
 
    var table = $('#dashboardorders').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        paging: false,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input class="dashboadinput" type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
}); 
*/
  /*$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#dashboardorders tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#dashboardorders').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );*/
</script>