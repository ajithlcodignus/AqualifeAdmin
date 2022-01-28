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
                <form role="form" method="post" action="<?= base_url('admin/quick_order_complete');?>" id="quickForm">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Customer Details</h3>
                                            </div>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width:30%">Shop Name</th>

                                                        <td>
                                                            <input type="hidden" class="form-control" name="shopId" value="<?= $shop[0]->shopId; ?>" >
                                                            <input type="text" class="form-control"  name="shopName" value="<?=  $shop[0]->name; ?>" readonly>
                                                                
                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>

                                                        <th style="width:30%">Customer Name</th>

                                                        <td>
                                                            <input type="text" class="form-control" name="name" required="">
                                                        </td>

                                                    </tr>
                                                    <tr>

                                                        <th style="width:30%">Customer Phone</th>

                                                        <td>
                                                            <input type="number" class="form-control" id="mobile" name="mobile"  required="">
                                                            <div id="mobile_error" style='color:red'></div>
                                                        </td>

                                                    </tr>
                                                    <tr>

                                                        <th style="width:30%">Date And Time</th>

                                                        <td><?php echo date("Y/m/d H:i A") ?></td>

                                                    </tr>

                                                    <tr>

                                                        <th style="width:30%"> Address</th>

                                                        <td>
                                                            <input type="address" class="form-control" name="address" required="">
                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th style="width:30%"> Payment Mode</th>
                                                       
                                                        <td>
                                                            <select class="form-control form-control-sm" name="paymentMode" id="paymentMode">
                                                                <option value="COD">COD</option>
                                                                <option value="Online">Online</option>
                                                            </select>
                                                        </td>
                                                        
                                                    </tr>

                                                    <tr>

                                                        <th style="width:30%"> Delivery Fee</th>

                                                        <td>
                                                            <input type="text" class="form-control" name="deliveryFee">
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

                                        <table class="table table-striped table-valign-middle">
                                        
                                        <?php 
                                            if (!empty($cart_item)) 
                                            {
                                        ?>
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%">#</th>
                                                    <th  width="40%;">Item</th>
                                                    <th style="text-align: end"  width="15%;">Quantity</th>
                                                    <th style="text-align: end"   width="15%;">Price</th>
                                                    <th style="text-align: end" width="15%;">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_item_amount = 0;
                                                    $total_items = 0;
                                                    $i = 1;
                                                    foreach ($cart_item as $row) 
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?php echo $row->quickItemName; ?></td>
                                                                <td style="text-align: end">
                                                                
                                                                    <input id="quickCartId<?=$i?>" name="quickCartId<?=$i?>"  type="hidden" value="<?= $row->quickCartId ?>">
                                                                    <input id="quickQuantity<?=$i?>" name="quickQuantity<?=$i?>"  type="hidden" value="<?= $row->quickQuantity ?>">
                                                                        <span style="padding: 3px;"><?php echo $row->quickQuantity; ?></span>
                                                                </td>
                                                                <td style="text-align: end"><?php echo $row->quickAmount; ?></td>
                                                                <td style="text-align: end"><?php echo $row->quickQuantity * $row->quickAmount; ?></td>
                                                            </tr>

                                                <?php
                                                    $total_item_amount = $total_item_amount + ($row->quickQuantity * $row->quickAmount)+$row->quickGst;
                                                    $total_items+=$row->quickQuantity;
                                                    $i++;
                                                    }
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <th>GST</th>
                                                    <td></td>
                                                    <td></td>
                                                    <th style="text-align: end"><?php echo $row->quickGst; ?></th>
                                                </tr>
                                                
                                                <tr>
                                                    <td></td>
                                                    <th>Grand Total</th>
                                                    <th style="text-align: end"><?= $total_items ?></th>
                                                    <td>
                                                    <input type="hidden" name="grandTotal" value="<?= $total_item_amount?>" >
                                                    </td>
                                                    <th style="text-align: end"><?= $total_item_amount?></th>
                                                </tr>

                                            </tbody>

                                        <?php
                                            } else
                                            echo "Your Cart Is Empty...!"; 
                                        ?>

                                    </table>

                                    </div>
                                    
                                    <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>

                                </div>
                        </div>

                    </div>
                </form>
                <!-- /.card-body -->
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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