<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= TAG_APP_NAME ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->




</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->

        <?php
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/admin_side_menu');
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!--<h1 class="m-0 text-dark">Dashboard v3</h1>-->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <!--<ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboar</li>
                        </ol>-->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <!-- ./col -->


                        <!-- ./col -->
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-danger">

                                <div class="inner">
                                    <?php if ($pending_orders > 0) {
                                    ?>
                                        <a href="<?= base_url('admin/get_orders/Received') ?>">
                                            <h3><?php echo $pending_orders; ?></h3>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <h3><?php echo $pending_orders; ?></h3>
                                    <?php
                                    } ?>


                                    <p>New Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?= base_url('admin/get_orders/Received') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php if ($assigned_orders > 0) {
                                    ?>
                                        <a href="<?= base_url('admin/get_orders/Assigned') ?>">
                                            <h3><?php echo $assigned_orders; ?></h3>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <h3><?php echo $assigned_orders; ?></h3>
                                    <?php
                                    } ?>

                                    <p>Assigned Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?= base_url('admin/get_orders/Assigned') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <?php if ($completed_orders > 0) {
                                    ?>
                                        <a href="<?= base_url('admin/get_orders/Delivered') ?>">
                                            <h3><?php echo $completed_orders; ?></h3>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <h3><?php echo $completed_orders; ?></h3>
                                    <?php
                                    } ?>

                                    <p>Completed Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?= base_url('admin/get_orders/Delivered') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                    </div>
            </section>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class=" col-lg-8">
                            <div class="card">

                                <div class="card-body table-responsive ">
                                    <?php
                                    if (!empty($shop_list)) {
                                    ?>

                                        <table class="table table-striped table-valign-middle" id="datatable1">
                                            <thead>
                                                <tr>
                                                    <th>Shop Name</th>
                                                    <th>Address</th>
                                                    <th>Pin Code</th>
                                                    <th>Active</th>
                                                    <th>New Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($shop_list)) {
                                                    foreach ($shop_list as $row) {
                                                ?>
                                                        <tr>
                                                            <td><a href="<?php echo base_url('admin/shop_select/' . $row->shopId . '/' . $row->name); ?>"><?php echo $row->name; ?></a></td>
                                                            <td><?php echo $row->address; ?></td>
                                                            <td><?php echo $row->pinCode; ?></td>
                                                            <td><?php echo $row->active == 1 ? 'Yes' : 'No' ?></td>
                                                            <td>
                                                                <?php if ($row->newOrder > 0) {
                                                                ?>
                                                                    <a href="<?= base_url('admin/get_orders/Received/' . $row->shopId) ?>">
                                                                        <h3><?php echo $row->newOrder; ?></h3>
                                                                    </a></td>
                                                        <?php
                                                                } else {
                                                        ?>
                                                            <?php echo $row->newOrder; ?>
                                                        <?php
                                                                } ?>

                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No Shops added...";
                                    } ?>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php $this->load->view('admin/common/footer') ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?php echo base_url(); ?>dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo base_url(); ?>lugins/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("#datatable1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [
                    [4, "desc"]
                ]
            });
        });
    </script>
</body>

</html>