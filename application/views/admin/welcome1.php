<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);?>
<!-- Start wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Welcome 
                    <span style='color:#6021d3;'><?php print_r($admin_detail['username']); ?></span></h4>
                   <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Welcome</li>
      </ol>  
            </div>
        </div>
         
        
 
 
         
        <!-- tiles  -->
  
<div class="row">

          <!-- ./col -->
         
       
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>COMPLETED </h3>  

                <p>Order : 728, Rs. 57850/-  </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> TOTAL   </h3>

             <p>Order : 465, Rs. 7862/-  </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>PENDING</h3>  

                <p>Order : 728, Rs. 57850/-  </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
                   <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>REFUNDED </h3>

                 <p>Order : 728, Rs. 57850/-  </p>
              </div>
              <div class="icon">
                <i class="ion ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </div>
         <div class="row">
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
               <h3>iOS</h3>

                <p>TOTAL USER 178</p>
              </div>
              <div class="icon">
                <i class="ion-social-apple" style="margin-top: -30px;"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Android </h3>

                <p>TOTAL USER - 150</p>
              </div>
              <div class="icon">

                <i class="ion-social-android" style="margin-top: -30px;"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>44</h3>

                <p>MESSAGES</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>5</h3>

                <p>ADMINS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
       <!-- // tiles  -->
 
 
       
        <div class="row" >
          
              <div class="card" style="width: 97%;">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3> 

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