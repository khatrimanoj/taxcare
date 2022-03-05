
    <!-- Start wrapper-->
     <div class="content-wrapper">
            <div class="container-fluid">

                <?php //echo "<pre>"; print_r($_SESSION); die; ?>

                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Order Management</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('welcome'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Order</li>
                        </ol>
                    </div>

                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Order Information</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th>Order ID</th>
                              <td>123451212</td>
                            </tr>
                            <tr>
                              <th>Order Date</th>
                              <td>11 Jan 2022</td>
                            </tr>
                            <tr>
                              <th>Order Time</th>
                              <td>15:22</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th>NAME</th>
                              <td>Manoj</td>

                              <th>Mobile</th>
                              <td>9650665544</td>
                            </tr>
                            <tr>
                              <th>PAN</th>
                              <td>UUSSDD12213</td>

                              <th>Email</th>
                              <td>secrect@gmail.com</td>
                            </tr>
                            <tr>
                              <th>Password</th>
                              <td>********</td>

                              <th>Type</th>
                              <td>ORIGINAL</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <p></p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Payment Information</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th>Status</th>
                              <td>Pending</td>
                            
                              <th>Payment Refrence</th>
                              <td>SBI001234</td>
                           
                              <th>Amount</th>
                              <td>10000</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                 
                </div>
            </div>
            </div>
            <!-- End container-fluid-->
