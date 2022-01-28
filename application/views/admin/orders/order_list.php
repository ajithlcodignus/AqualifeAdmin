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

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->

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
                            <h1>Orders</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">

                    <?php if (!empty($orders_list)) {
                    ?>
                        <div class="card-body table-responsive ">
                            <table class="table table-striped projects" id="datatable1">

                                <thead>
                                    <tr>
                                        <th style="width: 2%">
                                            #
                                        </th>
                                        <th style="width: 2%">
                                            Order Id
                                        </th>
                                        <th style="width: 15%;">
                                            User Details
                                        </th>
                                        <th style="width: 20%;">
                                            Delivery Address
                                        </th>
                                        <th style="width: 15%;">
                                            Shop Details
                                        </th>
                                        <th style="width: 12%;">
                                            Amount Details
                                        </th>
                                        <th style="width: 12%;" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 12%;" class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($orders_list as $row) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <a>
                                                    <?php echo '#' . $row->orderHashId; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a>
                                                    <?php echo $row->userName . " - " . $row->mobile; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a>
                                                    <?php echo $row->houseName . ", " . $row->landmark; ?>
                                                </a>
                                                <br />
                                                <small>
                                                    <?php echo $row->fullAddress . ", " . $row->pinCode; ?>
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
                                                <?php if ($row->orderStatus == "Received") {
                                                ?>
                                                    <span class="badge badge-danger">Received</span>
                                                <?php
                                                } elseif ($row->orderStatus == "Assigned") {
                                                ?>
                                                    <span class="badge badge-primary">Assigned</span>
                                                <?php
                                                } elseif ($row->orderStatus == "Delivered") {

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
                                                <?php if ($row->orderStatus == "Received" && ($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SUPER_ADMIN) || ($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_ADMIN)) {
                                                ?>

                                                    <!-- <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="long_shipping_order(<?php echo $row->orderId; ?>)">
                                                        <i class="fas fa-shipping-fast" title="Long shipping">
                                                        </i>
                                                    </a> -->

                                                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="short_shipping_order(<?php echo $row->orderId; ?>)">
                                                        <i class="fa fa-plus" title="Short shipping">
                                                        </i>
                                                    </a>

                                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="cancel_order(<?= $row->orderId; ?>);">
                                                        <i class="fa fa-ban" title="Cancel"></i>
                                                    </a>

                                                <?php
                                                }
                                                ?>
                                                <?php if ($row->orderStatus == "Assigned") {
                                                ?>
                                                    <!-- <a class="btn btn-info btn-sm" href="<?php echo base_url() ?>admin/order_shipping_list/<?php echo $row->orderId; ?>">
                                                        <i class="fas fa-shipping-fast" title="Long shipping">
                                                        </i>
                                                    </a> -->

                                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="cancel_assigned_order(<?= $row->orderId; ?>);">
                                                        <i class="fa fa-ban" title="Cancel"></i>
                                                    </a>

                                                <?php
                                                } ?>

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
                    }
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
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>

    <!-- AdminLTE -->
    <script src="<?php echo base_url(); ?>dist/js/adminlte.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        
            jQuery(document).ready(function() {
            $("#datatable1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
        
    </script>
    <script>
        

        function cancel_order(id) {
            var res = confirm("Are you sure!  You want to cancel this order?");
            if (res == true) {
                $.post("<?= base_url(); ?>admin/cancel_order", {
                    id: id
                }, function(data) {
                    if (data.length > 0) {
                        alert(data);
                        location.reload(true);
                    }
                })
            }
        }

        function cancel_assigned_order(id) {
            var res = confirm("Are you sure!  You want to cancel this order?");
            if (res == true) {
                $.post("<?= base_url(); ?>admin/cancel_assigned_order", {
                    id: id
                }, function(data) {
                    if (data.length > 0) {
                        alert(data);
                        location.reload(true);
                    }
                })
            }
        }

        function long_shipping_order(id) {
            var res = confirm("You Are Selected Long Shipping Are you sure!  You want to proceed ?");
            if (res == true) {
                $.post("<?= base_url(); ?>admin/order_shipping_list", {
                    id: id
                }, function(data) {
                    if (data.length > 0) {
                        window.location.replace("<?= base_url(); ?>admin/order_shipping_list/" + id);

                    }
                })
            }

        }

        function short_shipping_order(id) {
            var res = confirm("You Are Selected Short Shipping Are you sure!  You want to proceed?");
            if (res == true) {
                $.post("<?= base_url(); ?>admin/delivery_boy_list_order_assign", {
                    id: id
                }, function(data) {
                    if (data.length > 0) {
                        window.location.replace("<?= base_url(); ?>admin/delivery_boy_list_order_assign/" + id);

                    }
                })
            }
        }
    </script>
</body>

</html>