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
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($output['current_order_details'])) {
                        ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Payment Amount</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?php echo $output['current_order_details']["paymentAmount"]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Mode of
                                                        Payment</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?php echo $output['current_order_details']["paymentMode"]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Status</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?php echo $output['current_order_details']["orderStatus"]; ?>
                                                        <span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (!empty($orderId)) { ?>
                                            <div class="col-12 col-sm-3">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Pdf Bill</span>


                                                        <a href="<?= base_url() ?>admin/order_bill_pdf?orderId=<?= $orderId ?>" class="btn btn-success btn-xs">
                                                            PRINT BILL</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">





                                            <div class="post">

                                                <!-- /.user-block -->
                                                <p>


                                                </p>


                                            </div>
                                        </div>

                                        <?php if (!empty($output['current_order_details'][TAG_DELIVERY_BOY_ID])) {
                                        ?>
                                            <div class="col-12">
                                                <h4>Delivery Boy</h4>
                                                <div class="post" style="border-bottom:none;">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm">
                                                        <span class="username">
                                                            <a href="#"><?php echo $output['current_order_details'][TAG_DELIVERY_BOY_NAME] ?></a>
                                                        </span>
                                                        <span class="description">Mobile -
                                                            <?php echo $output['current_order_details'][TAG_DELIVERY_BOY_MOBILE]; ?>,
                                                            Email -
                                                            <?php echo $output['current_order_details'][TAG_DELIVERY_BOY_EMAIL_ID]; ?></span>
                                                    </div>
                                                </div>



                                                <div class="post">

                                                    <!-- /.user-block -->
                                                    <p>
                                                        <?php echo $output['current_order_details'][TAG_DELIVERY_BOY_ADDRESS] . ", " . $output['current_order_details'][TAG_DELIVERY_BOY_PLACE] ?>
                                                        <br>
                                                        <?php echo $output['current_order_details'][TAG_DELIVERY_BOY_PIN_CODE] ?>
                                                    </p>


                                                </div>
                                            </div>
                                        <?php
                                        } ?>


                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Customer Details</h3>
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th style="width:30%">Shop Name</th>

                                                    <td><?= $output['current_order_details']["shopName"]  ?></td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Customer Name</th>

                                                    <td><?php echo $output['current_order_details']["userName"] ?>
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Customer Phone</th>

                                                    <td><?= $output['current_order_details']["userMobile"]  ?></td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Date And Time</th>

                                                    <td><?php echo date("Y/m/d H:i A", strtotime($output['current_order_details']["entryDate"])) ?></td>

                                                </tr>

                                                <tr>


                                                    <th style="width:30%"> Address</th>

                                                    <td>
                                                        <?php echo $output['current_order_details']["houseName"] . ", " . $output['current_order_details']["fullAddress"] ?>
                                                        <br>
                                                        <?php if (!empty($output['current_order_details']["landmark"])) {
                                                            echo $output['current_order_details']["landmark"] . ", ";
                                                        }
                                                        echo $output['current_order_details']["pinCode"] ?>
                                                    </td>

                                                </tr>





                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="">

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Items</h3>
                                    </div>

                                    <?php if (!empty($output['current_order_details']["itemsList"])) {
                                    ?>
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">#</th>
                                                        <th style="width:40%">Item Name</th>
                                                        <th style="width:30%">Checking Spot</th>
                                                        <th style="width: 10%">Qty</th>
                                                        <th style="width: 10%">Rate</th>
                                                        <th style="width: 30%; text-align: end;">Total Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    // print_r($current_order_details["itemsList"]);
                                                    $total_item_amount = 0;
                                                    $total_items = 0;
                                                    $i = 1;

                                                    foreach ($output['current_order_details']["itemsList"] as $row) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row->itemName; ?></td>
                                                            <td>
                                                                <input type="checkbox" name="booking[]" value="Office">&nbsp; Shop
                                                                &nbsp;&nbsp;
                                                                <input type="checkbox" name="booking[]" value="Home">&nbsp; Home
                                                            <td><?php echo $row->quantity; ?></td>
                                                            <td> <?= number_format((float)$row->offerPrice, 2, '.', '') ?></td>
                                                            <td style="text-align: end"><?= number_format((float)($row->offerPrice * $row->quantity), 2, '.', '') ?></td>
                                                        </tr>
                                                    <?php

                                                        $total_item_amount = $total_item_amount + ($row->quantity * $row->offerPrice);
                                                        $total_items += $row->quantity;
                                                        $i++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <th>Packing Charge</th>
                                                        <td></td>
                                                        <td style="text-align: end"></td>
                                                        <td></td>
                                                        <th style="text-align: end"> <?= number_format((float)$output['current_order_details']["packingCharge"], 2, '.', '') ?></th>
                                                    <tr>
                                                        <td></td>
                                                        <th>Delivery Fee</th>
                                                        <td></td>
                                                        <td style="text-align: end"></td>
                                                        <td></td>
                                                        <th style="text-align: end"><?= number_format((float)$output['current_order_details']["deliveryFee"], 2, '.', '') ?></th>
                                                    <tr>
                                                        <td></td>
                                                        <th>GST</th>
                                                        <td></td>
                                                        <td style="text-align: end"></td>
                                                        <td></td>
                                                        <th style="text-align: end"><?= 
                                                         number_format((float)$output['current_order_details']['gst'], 2, '.', '') 
                                                         ?></th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th>Total</th>
                                                        <td></td>
                                                        <td style="text-align: end"></td>
                                                        <td></td>
                                                        <th style="text-align: end"><?= number_format((float)$output['current_order_details']['totalAmount'], 2, '.', '') ?></th>
                                                        
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th>Grand Total</th>
                                                        <td></td>
                                                        <td><?= $total_items ?></td>
                                                        <td></td>
                                                        <th style="text-align: end"><?= number_format((float)$output['current_order_details']['paymentAmount'], 2, '.', '')  ?></th>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    <?php
                                    } else
                                        echo "No Items"; ?>

                                </div>
                            </div>
                    </div>
                <?php
                        } ?>

                </div>
                <!-- /.card-body -->
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>dist/js/demo.js"></script>
</body>

</html>