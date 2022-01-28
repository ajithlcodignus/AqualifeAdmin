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
    <?php
    $this->load->view('admin/common/header');
    $this->load->view('admin/common/side_menu');
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Completed Orders</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">

                <?php if(!empty($orders_list))
                {
                    ?>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 2%">
                                    #
                                </th>
                                <th style="width: 15%;">
                                    User Details
                                </th>
                                <th style="width: 24%;">
                                    Delivery Address
                                </th>
                                <th style="width: 19%;">
                                    Shop Details
                                </th>
                                <th style="width: 15%;">
                                    Amount Details
                                </th>
                                <th style="width: 8%;" class="text-center">
                                    Status
                                </th>
                                <th style="width: 15%;">

                                </th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i=1;
                           
                            foreach ($orders_list as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <a>
                                            <?php echo $row->userName." - ".$row->mobile; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            <?php echo $row->houseName.", ".$row->landmark; ?>
                                        </a>
                                        <br/>
                                        <small>
                                            <?php echo $row->fullAddress.", ".$row->pinCode; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <a>
                                            <?php echo $row->name; ?>
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            <?php echo $row->paymentAmount; ?>
                                        </a>
                                    </td>
                                    <td class="project-state">
                                        <?php if($row->orderStatus == "Received") {
                                            ?>
                                            <span class="badge badge-danger">Received</span>
                                            <?php
                                        }
                                        elseif($row->orderStatus == "Assigned")
                                        {
                                            ?>
                                            <span class="badge badge-primary">Assigned</span>
                                        <?php
                                        }
                                        elseif($row->orderStatus == "Delivered"){

                                            ?>
                                            <span class="badge badge-success">Delivered</span>
                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>admin/order_full_view?orderId=<?php echo $row->orderId; ?>">
                                            <i class="fa fa-eye">
                                            </i>
                                        </a>
                                       
                                        <!-- <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a> -->
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
                }else
                echo "No Orders...!"; 
                ?>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('admin/common/footer') ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



</body>
</html>
