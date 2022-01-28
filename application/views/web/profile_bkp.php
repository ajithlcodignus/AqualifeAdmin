<html>

<head>
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style_2.css">
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">

    <script>
        $(document).ready(function() {

            $(window).bind('scroll', function() {
                var navHeight = 50; // custom nav height
                ($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop'): $('nav').removeClass('goToTop');
            });
        });
    </script>

    <style>
        .navbar {
            position: sticky;
            min-height: 94px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .card {
            color: black;
            padding: 1rem;
            height: 20rem;
            overflow: hidden;
            border: none;

        }

        .cards {
            max-width: 160%;
            margin: 0 auto;
        }


        .category {
            color: black;
        }

        .category:hover {
            color: #eb445a;
            ;
        }

        a {
            text-decoration: none;
        }

        .password-button {
            background-color: #eb445a;
            border: #eb445a;
            color: white;
            height: 10%;
            border: 0px;
            width: 35%;
            border-radius: 6px;
        }

        @media (max-width: 950px) {
            .password-button {
                width: 57%;
            }
        }

        .address-button {
            border: #eb445a;
            height: 10%;
            width: 40%;
            border: 0px;
            border-radius: 6px;
        }

        .address {
            text-decoration: none;
            color: #eb445a;
        }

        .address:hover {
            text-decoration: none;
            color: #eb445a;
        }

        .header_section {
            left: 0px;
            top: 0px;
            z-index: 999;
            width: 100%;
        }

        @media (min-width:1000px) and (max-width:9000px) {
            .header_section {
                position: fixed;
                left: 0px;
                top: 0px;
                z-index: 999;
                width: 100%;
                padding-top: 0%;
            }

            .order-review {
                padding-top: 0 !important;
            }
        }

        .modal-button {
            background-color: #eb445a;
            border: #eb445a;
            color: white;
            height: 50px;
            width: 55%;
            border-radius: 6px;
        }

        .modal-header {
            color: #eb445a;
            text-align: center;
            font-size: 120%;
            padding-left: 40%;
            border: none;
        }

        @media (min-width:1200px) {
            .header_icon_size {

                font-size: 30px;
            }

        }

        @media (min-width:992px) and (max-width:1199px) {
            .header_icon_size {
                font-size: 25px;
            }

        }

        @media (min-width:768px) and (max-width:991px) {
            .header_icon_size {
                font-size: 20px;

            }
        }

        @media(min-width:576px) and (max-width:767px) {
            .header_icon_size {
                font-size: 15px;
            }
        }

        @media (max-width:992px) {
            .navbar_button {

                background-color: rgb(247, 247, 247) !important;
            }

            .nav_color {
                background-color: rgb(247, 247, 247) !important;
            }


        }

        @media (min-width:992px) {
            .nav_color {
                background-color: rgb(247, 247, 247) !important;
            }

        }

        .theme_color {
            color: #eb445a;
        }

        .order-review {
            padding-top: 4rem !important;
        }

        @media (min-width:50px) and (max-width:1000px){
            .order-review {
                padding-top: 0rem !important;
            }
        }

        .password-change {
            color: white
        }

        .password-change:hover {
            text-decoration: none;
            color: white
        }

        .profile-edit {
            padding-left: 29%;
            border: none;
        }

        .update_button {
            padding-left: 30%;
            border: none;
        }

        .pswd-chng {
            padding-left: 25%;
            border: none;
        }

        .whatsaapp-icon {
            color: green
        }

        .fb-icon {
            color: #4267B2
        }
    </style>

</head>

<body>

    <?php
    $this->load->view('admin/common/header');
    $this->load->view('admin/index');
    ?>

    <div class="container order-review" id="main">
        <div class="row row-offcanvas row-offcanvas-left vh-100 order-review">

            <div class="col-md-4" id="sidebar" role="navigation">

                <h5 class="py-5 px-4 border border-bottom-0">Orders</h5>
                <div class="card  bg-light border border-top-0">
                    <ul class="nav flex-column sticky-top mt-7">
                        <b>
                            <li class="nav-item"><a class="nav-link category" href="#">Your Account Settings</a></li>
                            <li class="nav-item"><a class="nav-link category" href="#">Wallet</a></li>
                            <li class="nav-item"><a class="nav-link category" href="#">Refferals</a></li>
                            <li class="nav-item"><a class="nav-link category" href="<?= base_url('logout') ?>">Logout</a></li>
                        </b>
                    </ul>
                </div>
            </div>

            <main class="col main pt-4 border border-bottom-0">

                <div class="profile">

                    <div class="card">
                        <h3>Profile</h3>

                        <table cellspacing=10px>
                            <span class="pt-5">

                                <th>Name</th>
                                <tr>
                                    <td class="pt-1">
                                        <?= $user_details->name ?>
                                        &nbsp;
                                        <a clas="pl-5" href="#" data-toggle="modal" data-target="#profileEditModal"> Change </a>
                                    </td>
                                </tr>

                                <th class="pt-4">Email</th>
                                <tr>
                                    <td class="pt-1">
                                        <?= $user_details->emailId ?>&nbsp;
                                        <a clas="pl-5" href="#" data-toggle="modal" data-target="#profileEditModal"> Change </a>
                                    </td>
                                </tr>

                                <th class="pt-4">Phone</th>
                                <tr>
                                    <td class="pt-1">
                                        <?= $user_details->mobile ?>&nbsp;
                                    </td>
                                </tr>

                            </span>
                        </table>

                    </div>

                    <div>
                        <button class="password-button" type="submit">
                            <a href="#" data-toggle="modal" data-target="#passwordChangeModal" class="password-change"> Change Password </a>
                        </button><br><br>
                        <b>Delivery Address</b>
                    </div>
                    <div class="pt-4">

                        <button class="btn btn-outline-light address-button " type="submit">
                            <a class="address" href="#" data-toggle="modal" data-target="#addAddressModal">Add Address</a>
                        </button>
                        </button>
                    </div>
                </div>

                <!--Profile Edit Modal -->

                <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="profileEditModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header profile-edit">
                                <h5 class="modal-title" id="exampleModalLongTitle">Profile Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <form class="modal-form" role="form" method="post" action="<?= base_url('update_profile'); ?>" id="profileUpdateForm">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="text" class="form-control" name="name" value=" <?= $user_details->name ?>" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="email" class="form-control" name="emailId" value=" <?= $user_details->emailId ?>" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer update_button">
                                        <button type="submit" class="modal-button mr-auto">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!--Password Change Modal -->

                <div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header pswd-chng">
                                <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form role="form" method="post" id="passwordChangeForm" enctype="multipart/form-data">
                                    <div class="container">


                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="text" class="form-control" name="currentPassword" id="currentPassword" placeholder="Current Password" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password" required="">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm New Password" required="">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col justify-content-center error alert alert-danger" id='errorMessage' role="alert"></div>
                                    <div class="col justify-content-center error alert alert-success" id='successMessage' role="alert"></div>

                                    <div class="modal-footer update_button">
                                        <button type="submit" id="pswdChngBtn" class="modal-button mr-auto">Change</button>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!--Add Address Modal -->

                <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="addAddressModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header profile-edit">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Address</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <form class="modal-form" role="form" method="post" action="<?= base_url('insert_address'); ?>" id="addAddressForm">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="text" class="form-control" placeholder="House Name" name="houseName" id="houseName" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="address" class="form-control" placeholder="Full address" name="fullAddress" id="fullAddress" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="text" class="form-control" placeholder="Landmark" name="landmark" id="landmark" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col form-group">
                                                <input type="text" class="form-control" placeholder="pincode" name="pinCode" id="pinCode" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer update_button">
                                        <button type="submit" class="modal-button mr-auto">Add</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>

    <script>
        jQuery(document).ready(function() {
            $('#errorMessage').hide();
            $('#successMessage').hide();
        });
    </script>

</body>

</html>
