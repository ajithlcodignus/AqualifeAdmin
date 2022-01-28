<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?= TAG_APP_NAME ?> | PUSH NOTIFICATION </title>

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
            jQuery(document).ready(function () {


                $.validator.setDefaults({
                    submitHandler: function () {
//                        alert("Form successful submitted!");
                        $('button[type=submit]').prop('disabled',true);
                        this.submit();
                    }
                });
                $('#quickForm').validate({
                    rules: {
                        title: {
                            required: true,
                            maxlength: 30
                        },

                        body: {
                            required: true,
                            maxlength: 60
                        }
                    },
                    messages: {
                        title: {
                            required: "This field is required.",
                            maxlength: "Enter a valid Title(Max Legth 30)"
                        },
                        body: {
                            required: "This field is required.",
                            maxlength: "Enter a valid Message(Max Legth 60)"
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });


            });
            function publish_shop(id)
            {
                var publish_flag = parseInt($('#publish_flag').val());
                var shop_item_count = parseInt($('#shop_item_count').val());

                if(shop_item_count != 0)
                {
                    var res = confirm("Are you want to Publish this Shop?");
                    if (res == true) {
                        $.post("<?= base_url(); ?>admin/publish_shop", {id: id}, function (data) {
                            if (data.length > 0) {
                                alert(data);
                                location.reload(true);
                            }
                        })
                    }
                }
                else
                {
                    alert("Please add atleast one Product to publish the Shop");
                }
            }
        </script>
    </body>
</html>
