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
    $this->load->view('admin/common/side_menu');
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
                   <!-- <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php /*echo $users; */?></h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>-->

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">

                            <div class="inner">
                                <?php if($pending_orders > 0)
                                {
                                    ?>
                                    <a href="<?= base_url('admin/get_orders/Received/'.$shopId) ?>"><h3><?php echo $pending_orders; ?></h3></a>
                                <?php
                                }
                                else {
                                    ?>
                                    <h3><?php echo $pending_orders; ?></h3>
                                <?php
                                }?>


                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?= ($pending_orders > 0)? base_url('admin/get_orders/Received/'.$shopId):"#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php if($assigned_orders > 0)
                                {
                                    ?>
                                    <a href="<?= base_url('admin/get_orders/Assigned/'.$shopId) ?>"><h3><?php echo $assigned_orders; ?></h3></a>
                                    <?php
                                }
                                else {
                                    ?>
                                    <h3><?php echo $assigned_orders; ?></h3>
                                    <?php
                                }?>

                                <p>Assigned Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?= ($assigned_orders > 0)? base_url('admin/get_orders/Assigned/'.$shopId):"#"; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">

                                <?php if($completed_orders > 0)
                                {
                                    ?>
                                    <a href="<?= base_url('admin/get_orders/Delivered/'.$shopId) ?>"><h3><?php echo $completed_orders; ?></h3></a>
                                    <?php
                                }
                                else {
                                    ?>
                                    <h3><?php echo $completed_orders; ?></h3>
                                    <?php
                                }?>

                                <p>Completed Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?= ($completed_orders > 0)? base_url('admin/get_orders/Delivered/'.$shopId):"#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php if ($canceled_orders > 0) {
                                    ?>
                                        <a href="<?= base_url('admin/get_orders/Cancelled/'.$shopId) ?>">
                                            <h3><?php echo $canceled_orders; ?></h3>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <h3><?php echo $canceled_orders; ?></h3>
                                    <?php } ?>
                                    <p>Canceled Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-ban"></i>
                                    <!-- <i class="ion ion-person-add"></i> -->
                                </div>
                                <a href="<?= base_url('admin/get_orders/Cancelled/'.$shopId) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                </div>
        </section>

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
<script src="<?php echo base_url(); ?>dist/js/pages/dashboard3.js"></script>
</body>
</html>
