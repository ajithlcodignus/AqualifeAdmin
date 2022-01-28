<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Orders</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding-top: 10px;">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content" >

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Orders</h3>
        </div>
        <div class="card-body">
          <?php if(!empty($current_order_details)) {
            ?>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Payment Amount</span>
                        <span class="info-box-number text-center text-muted mb-0"><?php echo $current_order_details["paymentAmount"]; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Mode of Payment</span>
                        <span class="info-box-number text-center text-muted mb-0"><?php echo $current_order_details["paymentMode"]; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Status</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $current_order_details["orderStatus"]; ?> <span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <h4>Address</h4>
                    <div class="post" style="border-bottom:none;">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm"  >
                        <span class="username">
                          <a href="#"><?php echo $current_order_details["userName"]." - ".$current_order_details["userMobile"] ?></a>
                        </span>
                        <span class="description">Order Placed - <?php echo date("Y/m/d H:i A",strtotime($current_order_details["entryDate"])) ?></span>
                      </div>
                    </div>



                    <div class="post">

                      <!-- /.user-block -->
                      <p>
                        <?php echo $current_order_details["houseName"].", ".$current_order_details["fullAddress"] ?>
                        <br>
                        <?php if(!empty($current_order_details["landmark"])) { echo $current_order_details["landmark"].", ";} echo $current_order_details["pinCode"] ?>
                      </p>


                    </div>
                  </div>

                  <?php if(!empty($current_order_details[TAG_DELIVERY_BOY_ID]))
                  {
                    ?>
                    <div class="col-12">
                      <h4>Delivery Boy</h4>
                      <div class="post" style="border-bottom:none;">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm"  >
                        <span class="username">
                          <a href="#"><?php echo $current_order_details[TAG_DELIVERY_BOY_NAME] ?></a>
                        </span>
                          <span class="description">Mobile - <?php echo $current_order_details[TAG_DELIVERY_BOY_MOBILE]; ?>, Email - <?php echo $current_order_details[TAG_DELIVERY_BOY_EMAIL_ID]; ?></span>
                        </div>
                      </div>



                      <div class="post">

                        <!-- /.user-block -->
                        <p>
                          <?php echo $current_order_details[TAG_DELIVERY_BOY_ADDRESS].", ".$current_order_details[TAG_DELIVERY_BOY_PLACE] ?>
                          <br>
                          <?php  echo $current_order_details[TAG_DELIVERY_BOY_PIN_CODE] ?>
                        </p>


                      </div>
                    </div>
                  <?php
                  }?>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">



                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Items</h3>
                  </div>

                  <?php if(!empty($current_order_details["itemsList"]))
                  {
                    ?>
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                          <th style="width: 10%">#</th>
                          <th style="width:80%">Item Name</th>
                          <th style="width: 10%">Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                       // print_r($current_order_details["itemsList"]);

                        $i=1; foreach ($current_order_details["itemsList"] as $row) {
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row->itemName; ?></td>
                            <td>
                              <?php echo $row->quantity; ?>
                            </td>

                          </tr>
                        <?php
                          $i++;
                        }
                        ?>


                        </tbody>
                      </table>
                    </div>
                  <?php
                  }
                  else
                    echo"No Items";?>

                </div>
              </div>
            </div>
          <?php
          } ?>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
