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
                <form role="form" method="post" action="<?= base_url('admin/quick_bill_update/'.$bill->userId);?>" id="quickForm">
                    <div class="card-body">
                        
                            <div class="row">
                            <input type="hidden" name="orderId" value="<?= $bill->orderId ?>"/>
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

                                                    <td>
                                                        <input type="text" class="form-control" name="name" value="<?= $bill->name; ?>" required="">
                                                    </td>
                                                   
                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Customer Phone</th>
                                                    <td>
                                                        <input type="number" class="form-control" name="mobile" value="<?= $bill->mobile; ?>" readonly>
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <th style="width:30%">Date And Time</th>

                                                    <td><?= $bill->orderEntryDate; ?></td>

                                                </tr>

                                                <tr>

                                                    <th style="width:30%"> Address</th>

                                                    <td>
                                                        <input type="address" class="form-control" value="<?= $bill->address; ?>" name="address" required="">
                                                    </td>
                                                    
                                                </tr>

                                                <tr>

                                                        <th style="width:30%"> Bill Status</th>
                                                       
                                                        <td>
                                                            <select class="form-control" name="orderSummary" id="orderSummary">
                                                                <option value="OrderCompleted" <?= $bill->orderSummary == 'OrderCompleted' ? 'selected' : ''; ?>>Order Completed</option>
                                                                <option value="OrderCancelled" <?= $bill->orderSummary == 'OrderCancelled' ? 'selected' : ''; ?>>Order Cancelled</option>
                                                            </select>
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
                                                    $total_item_amount = 0;
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
                                                        $total_item_amount = $total_item_amount + ($row->quickQuantity * $row->quickAmount)+$row->quickGst;
                                                        $grand_total =  $total_item_amount +  $row->deliveryFee;
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
                                                    <td>
                                                    <input type="hidden" name="grandTotal" value="<?= $total_item_amount?>" >
                                                    </td>
                                                    <th><?= $grand_total?></th>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        
                                </div>
                                <button style="float: right;" type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </div>
                </form>
               
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