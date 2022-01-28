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
    <!-- ajith -->
    <script>
        var base_url = '<?= base_url(); ?>';
        jQuery(document).ready(function() {
            $("#datatable1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         $('button[type=submit]').prop('disabled', true);
            //         this.submit();
            //     }
            // });

            $('#quickForm').validate({
                rules: {
                    couponName: {
                        required: true,
                        maxlength: 5,
                        lettersonly: true
                    },

                    couponNumber: {
                        required: true,
                        maxlength: 5
                    }

                },
                messages: {
                    couponName: {
                        required: "This field is required.",
                        maxlength: "Enter a valid Text"
                    },
                    couponNumber: {
                        required: "This field is required.",
                        maxlength: "Maximum 5 digits"
                    }
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
                }
            });

            $('#addShopAdmin').validate({
                rules: {

                    emailId: {
                        required: true,
                        email: true,

                        remote: {
                            url: "<?= base_url('admin/shop_admin_emailId_already') ?>",
                            type: "post",

                        }
                    },
                    mobile: {
                        required: true,
                        number: true,
                        remote: {
                            url: "<?= base_url('admin/shop_admin_phone_already') ?>",
                            type: "post",

                        }
                    },
                    pinCode: {
                        number: true,
                    }

                },
                messages: {
                    mobile: {
                        required: "This field is required.",
                        number: "enter a valid phone number.",
                        remote: 'Phone number already exist.'

                    },
                    pinCode: {
                        required: "This field is required.",
                        maxlength: "Maximum 7 digits",
                        number: "enter a valid PIN Code.",
                    },
                    emailId: {
                        remote: 'Email already exist.'
                    }
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

            $('#editShopAdmin').validate({
                rules: {

                    emailId: {
                        required: true,
                        email: true,

                        remote: {
                            url: "<?= base_url('admin/shop_admin_emailId_update_already') ?>",
                            type: "post",
                            data: {
                                userId: $('#userId').val()
                            },
                        }
                    },
                    mobile: {
                        required: true,
                        number: true,
                        remote: {
                            url: "<?= base_url('admin/shop_admin_phone_update_already') ?>",
                            type: "post",
                            data: {
                                userId: $('#userId').val()
                            },
                        }
                    },
                    pinCode: {
                        number: true,
                    }

                },
                messages: {
                    mobile: {
                        required: "This field is required.",
                        number: "enter a valid phone number.",
                        remote: 'Phone number already exist.'

                    },
                    pinCode: {
                        required: "This field is required.",
                        maxlength: "Maximum 7 digits",
                        number: "enter a valid PIN Code.",
                    },
                    emailId: {
                        remote: 'Email already exist.'
                    }
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

        function publish_shop(id) {
            var publish_flag = parseInt($('#publish_flag').val());
            var shop_item_count = parseInt($('#shop_item_count').val());

            if (shop_item_count != 0) {
                var res = confirm("Are you want to Publish this Shop?");
                if (res == true) {
                    $.post("<?= base_url(); ?>admin/publish_shop", {
                        id: id
                    }, function(data) {
                        if (data.length > 0) {
                            alert(data);
                            location.reload(true);
                        }
                    })
                }
            } else {
                alert("Please add atleast one Product to publish the Shop");
            }
        }

        // function generateCouponCodeOnChange()
        //         {
        //             $('#couponNumber').val(generateCouponName());
        //         }

        function generateCouponName() {

            // Declare a digits variable  
            // which stores all digits 
            var digits = '0123456789';
            let OTP = '';
            for (let i = 0; i < 4; i++) {
                OTP += digits[Math.floor(Math.random() * 10)];
            }
            return OTP;
        }




        $("#couponType").change(function() {
            if ($('#couponType').val() == 2) {
                $("#couponPercentage").prop('disabled', false);
                $("#couponFixedAmount").prop('disabled', true);
                $("#orderCountType").prop('disabled', false);
                $("#couponTypeLabel").prop('disabled', false);
                $('#orderCountPercentage').prop('disabled', false);
                $('#numberOfOrders').prop('disabled', false);
                $('#orderCountDiv').prop('disabled', false);
                $('#couponTypeDiv').prop('disabled', true);
                $("#orderCountPercentage").val('');
                $("#couponFixedAmount").val('');
                $("#numberOfOrders").val('');
                $("#orderCountType").val('--Select--');
                $("#numberOfOrders").show();
                $("#couponPercentage").hide();
                $("#couponFixedAmount").hide();
                $("#orderCountDiv").show();
                $("#couponTypeDiv").hide();
                $("#orderCountPercentage").show();
                $("#amount").hide();
                $("#couponTypeLabel").text('Number Of Orders');
                // alert('percentage selected');
            }

            if ($('#couponType').val() == 1) {
                $("#couponPercentage").prop('disabled', false);
                $("#couponFixedAmount").prop('disabled', true);
                $("#orderCountType").prop('disabled', true);
                $("#couponTypeLabel").prop('disabled', true);
                $("#orderCountFixed").prop('disabled', true);
                $("#orderCountPercentage").prop('disabled', true);
                $("#numberOfOrders").prop('disabled', true);
                $("#orderCountDiv").prop('disabled', true);
                $("#couponTypeDiv").prop('disabled', true);
                $("#couponFixedAmount").val('');
                $("#couponPercentage").val('');
                $("#numberOfOrders").val('');
                $("#couponPercentage").show();
                $("#numberOfOrders").hide();
                $("#couponFixedAmount").hide();
                $("#orderCountDiv").hide();
                $("#couponTypeDiv").hide();
                $("#orderCountPercentage").hide();
                $("#orderCountFixed").hide();
                $("#couponTypeLabel").text('Percentage');
                // alert('percentage selected');
            } else if ($('#couponType').val() == 0) {
                $("#couponPercentage").prop('disabled', true);
                $("#couponFixedAmount").prop('disabled', false);
                $("#orderCountType").prop('disabled', true);
                $("#couponTypeLabel").prop('disabled', true);
                $("#orderCountFixed").prop('disabled', true);
                $("#numberOfOrders").prop('disabled', true);
                $("#couponTypeDiv").prop('disabled', true);
                $("#orderCountDiv").prop('disabled', true);
                $("#orderCountPercentage").prop('disabled', true);
                $("#couponFixedAmount").val('');
                $("#couponPercentage").hide();
                $("#numberOfOrders").hide();
                $("#orderCountDiv").hide();
                $("#couponTypeDiv").hide();
                $("#couponFixedAmount").show();
                $("#orderCountPercentage").hide();
                $("#orderCountFixed").hide();
                $("#couponTypeLabel").text('fixed Amount');
                // alert('amount selected');
            }
        });


        $("#orderCountType").change(function() {
            if ($('#orderCountType').val() == 2) {
                $("#orderCountFixed").prop('disabled', true);
                $("#orderCountPercentage").prop('disabled', true);
                $("#couponTypeDiv").hide();
            } else if ($('#orderCountType').val() == 1) {
                $("#orderCountPercentage").prop('disabled', false);
                $("#orderCountFixed").prop('disabled', true);
                $("#orderCountFixed").val('');
                $("#orderCountPercentage").show();
                $("#couponTypeDiv").show();
                $("#orderCountFixed").hide();
                $("#percentageLabel").text('Percentage');
                // alert('percentage selected');
            } else if ($('#orderCountType').val() == 0) {
                $("#orderCountPercentage").prop('disabled', true);
                $("#orderCountFixed").prop('disabled', false);
                $("#orderCountFixed").val('');
                $("#orderCountPercentage").hide();
                $("#orderCountFixed").show();
                $("#percentageLabel").text('Amount');
                $("#couponTypeDiv").show();
                // alert('amount selected');
            }
        });
    </script>
</body>

</html>