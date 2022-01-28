<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= TAG_APP_NAME ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Delivery Boys List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">


                <div class="container-fluid">
                    <div class="row">

                        <?php
                        $i = 1;
                        if (!empty($delivery_boys_list)) {
                            foreach ($delivery_boys_list as $row) {

                        ?>
                                <div class="col-md-3">
                                    <form method="get" action="<?php echo base_url() ?>admin/assign_order">
                                        <!-- Profile Image -->
                                        <input type="hidden" name="deliveryBoyId" value="<?php echo $row->deliveryBoyId ?>" />
                                        <input type="hidden" name="orderId" value="<?php echo $orderId ?>" />

                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle" style="border:none;" src="<?php echo base_url() ?>images/admin/demo_user.png" alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center"><?php echo $row->deliveryBoyName; ?></h3>

                                                <p class="text-muted text-center">Delivery Boy</p>

                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Mobile</b> <a class="float-right"><?php echo $row->mobile; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Email</b> <a class="float-right"><?php echo $row->emailId; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Address</b> <a class="float-right"><?php echo $row->address; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label>Delivery Time</label>
                                                        <input type="text" name="deliveryTime<?= $row->deliveryBoyId ?>" class="form-control deliveryTime" id="deliveryTime<?= $row->deliveryBoyId ?>" value="<?= $row->deliveryTime ?>" />
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                        <!-- /.input group -->
                                                    </li>

                                                </ul>
                                                <?php if ($type == "assign") {
                                                ?>
                                                    <input type="submit" value="Assign" class="btn btn-primary btn-block">
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="<?php echo base_url() ?>admin/add_shop_delivery_boy?deliveryBoyId=<?php echo $row->deliveryBoyId; ?>" class="btn btn-primary btn-block"><b>Add</b></a>
                                                <?php
                                                } ?>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No Delivery Boys for this shop";
                        }
                        ?>


                        <!-- /.col -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script>
        jQuery(document).ready(function() {

            $('.deliveryTime').timepicker({
                showMeridian: false,
                up: 'glyphicon glyphicon-chevron-up',
                down: 'glyphicon glyphicon-chevron-down'
            });
        });
    </script>
</body>

</html>
