<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= TAG_APP_NAME ?> | SHOP-CATEGORY </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.css">
    <!-- time picker -->
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap/bootstrap-timepicker.css" crossorigin="anonymous" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
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

        <?php

        $this->load->view('admin/common/header');
        $this->load->view('admin/common/admin_side_menu'); ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $content ?>
        <!-- /.content-wrapper -->

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

    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap/js/daterangepicker.js"></script>

    <!-- Time Picker -->
    <script src="<?php echo base_url(); ?>js/bootstrap-timepicker.js"></script>



    <!-- AdminLTE -->
    <script src="<?php echo base_url(); ?>dist/js/adminlte.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- jquery-validation -->
    <script src="<?php echo base_url(); ?>plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>plugins/select2/js/select2.full.min.js"></script>
    <?php $this->load->view('admin/common/index_js'); ?>
    <script>
        var base_url = '<?= base_url(); ?>';
        jQuery(document).ready(function() {

            $("#datatable1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('.select2').select2();

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("ajay Form successful submitted!");
            //         $('button').prop('disabled', true);
            //         this.submit();
            //     }
            // });


            $('#quickForm').validate({
                rules: {
                    emailId: {
                        required: true,
                        email: true,
                        remote: {
                            url: "<?= base_url('admin/delivery_boy_emailId_already') ?>",
                            type: "post",

                        }
                    },
                    mobile: {
                        required: true,
                        maxlength: 10,
                        number: true,
                        remote: {
                            url: "<?= base_url('admin/delivery_boy_phone_already') ?>",
                            type: "post",

                        }
                    },
                    editEmailId: {
                        required: true,
                        email: true,
                        remote: {
                            url: "<?= base_url('admin/delivery_boy_emailId_update_already') ?>",
                            type: "post",
                            data: {
                                deliveryBoyId: $('#deliveryBoyId').val()
                            },
                        }
                    },
                    editMobile: {
                        required: true,
                        maxlength: 10,
                        number: true,
                        remote: {
                            url: "<?= base_url('admin/delivery_boy_phone_update_already') ?>",
                            type: "post",
                            data: {
                                deliveryBoyId: $('#deliveryBoyId').val()
                            },
                        }
                    },


                    place: {
                        required: true,
                        maxlength: 31
                    },
                    pinCode: {
                        required: true,
                        maxlength: 6,
                        number: true,
                    },
                    address: {
                        required: true,
                        maxlength: 200
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    emailId: {
                        required: "This field is required.",
                        email: "Please enter a vaild email address",
                        remote: "Email already exist",
                    },

                    mobile: {
                        required: "This field is required.",
                        maxlength: "Enter a valid Mobile Number(Max Legth)",
                        number: "Please enter a valid Mobile Number",
                        remote: "Mobile number already exist",
                    },
                    place: {
                        required: "This field is required.",
                        maxlength: "Enter a valid Place(Max Legth)"
                    },
                    pinCode: {
                        required: "This field is required.",
                        maxlength: "Enter a valid PIN CODE(Max Legth)",
                        number: "Please enter a valid PIN CODE",
                    },
                    address: {
                        required: "This field is required.",
                        maxlength: "Enter a valid Address(Max Legth)"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {

                    $('button').prop('disabled', true);
                    form.submit();
                },
            });



        });
    </script>
</body>

</html>