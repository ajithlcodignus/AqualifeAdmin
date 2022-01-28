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
                        
                            <div class="row">
                            
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Payment Amount</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?= $bill->paymentAmount; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Mode of
                                                        Payment</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?= $bill->paymentMode; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Status</span>
                                                    <span class="info-box-number text-center text-muted mb-0"><?= $bill->orderSummary; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">

                                                    <a href="<?= base_url('admin/quick_bill_edit/'.$bill->orderId) ?>">
                                                        <span class="info-box-text text-center text-muted">Edit Bill</span>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Pdf Bill</span>
                                                        <a href="<?= base_url()?>admin/quick_bill_pdf?orderId=<?= $bill->orderId ?>" class="btn btn-success btn-xs">
                                                                PRINT BILL</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Thermal Print</span>
                                                        <a href="<?= base_url()?>admin/thermal_print?orderId=<?= $bill->orderId ?>" class="btn btn-success btn-xs">
                                                                PRINT BILL</a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-12">





                                            <div class="post">

                                                <!-- /.user-block -->
                                                <p>


                                                </p>


                                            </div>
                                        </div>

                                        
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

                                                    <td><?= $bill->shopName; ?></td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Customer Name</th>

                                                    <td><?= $bill->name; ?> </td>
                                                   
                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Customer Phone</th>

                                                    <td><?= $bill->mobile; ?></td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Date And Time</th>

                                                    <td><?= $bill->orderEntryDate; ?></td>

                                                </tr>

                                                <tr>

                                                    <th style="width:30%"> Address</th>

                                                    <td><?= $bill->address; ?></td>
                                                    
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

                                    
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">#</th>
                                                        <th style="width:50%">Item Name</th>
                                                        <th style="width: 20%">Qty</th>
                                                        <th style="width: 20%">Rate</th>
                                                        <th style="width: 20%">Total Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_items = 0;
                                                    $i = 1;
                                                    foreach($bill_item as $row)
                                                    {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo  $row->quickItemName; ?></td>
                                                            <td ><?php echo  $row->quickQuantity; ?></td>
                                                            <td ><?php echo  $row->quickAmount; ?></td>
                                                            <td ><?php echo  $row->quickQuantity * $row->quickAmount; ?></td>
                                                        </tr>
                                                    <?php
                                                        $total_items+=$row->quickQuantity;
                                                        $i++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <th>Delivery Fee</th>
                                                        <td></td>
                                                        <td></td>
                                                        <th><?php echo  $row->deliveryFee?></th>
                                                    <tr>
                                                        <td></td>
                                                        <th>GST</th>
                                                        <td></td>
                                                        <td></td>
                                                        <th><?php echo  $row->quickGst; ?></th>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                    <td></td>
                                                    <th>Grand Total</th>
                                                    <td><?= $total_items ?></td>
                                                    <td></td>
                                                    <th><?= $row->paymentAmount;?></th>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                    </div>
               
        </section>
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