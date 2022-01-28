<html>

<head>
    <?php 
$this->load->view('web/common/head');

?>
    <style>
    .nav_color {
        background-color: rgb(247, 247, 247) !important;
    }
    </style>
</head>

<body>

    <?php
    $this->load->view('web/common/header');
    
    ?>

    <section class="pt-5">
        <div class="container vh-100 pt-5 pb-5">
            <div class="row mt-5">
                <div class="col-md-2">
                </div>

                <div class="col-md-8">
                    <div class="card p-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url('profile') ?>">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= base_url('orders') ?>">Your Orders</a>
                            </li>
                        </ul>
                        <div class="card">
                            
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        Name
                                    </div>
                                    <div class="col-md-12">
                                        <?=$user_details->name ?>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        Email
                                    </div>
                                    <div class="col-md-12">
                                        <?=$user_details->emailId ?>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <a class="btn btn-primary" style="background:#eb445a;border-color:#eb445a"
                                            href="#" data-toggle="modal" data-target="#changeProfileDetails"
                                            aria-haspopup="true" aria-expanded="false"><i
                                                class="fa fa-edit"></i>&nbsp;Change Profile</a>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        Phone
                                    </div>
                                    <div class="col-md-12">
                                        <?= $user_details->mobile ?><a class="ml-4" href="#" data-toggle="modal"
                                            data-target="#changePhoneNumber" aria-haspopup="true"
                                            aria-expanded="false">Change</a>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <a class="btn btn-primary" style="background:#eb445a;border-color:#eb445a"
                                            href="#" data-toggle="modal" data-target="#changePasswordModal"
                                            aria-haspopup="true" aria-expanded="false"><i
                                                class="fa fa-key"></i>&nbsp;Change Password</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div id="error_container" class="row d-flex justify-content-center">
                <div class="error_message">
                </div>
            </div>
            <div class="row mt-5" id="address_container">
                <div class="col-md-2">
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">Delivery Address
                                <?php if (!empty($address_data)) { ?><a class="btn btn-warning delete_address">&nbsp;<i
                                        class="fa fa-trash"></i>&nbsp;</a><a class="btn btn-primary" href="#"
                                    data-toggle="modal" data-target="#editAddressModal" aria-haspopup="true"
                                    aria-expanded="false">&nbsp;<i class="fa fa-edit"></i>&nbsp;</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php
                            if (!empty($address_data)) {
                            ?>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            House Name
                                        </div>
                                        <div class="col-md-7">
                                            <?= ($address_data->houseName!=null&&$address_data->houseName!='')?  $address_data->houseName:'' ?>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-md-5">
                                            Full Address
                                        </div>
                                        <div class="col-md-7">
                                            <?= 
                                            ($address_data->fullAddress!=null&&$address_data->fullAddress!='')?  $address_data->fullAddress:''
                                             ?>
                                        </div>
                                    </div>

                                </li>
                                <?php if($address_data->landmark!=null&&$address_data->landmark!=''){ ?>
                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-md-5">
                                            Landmark
                                        </div>
                                        <div class="col-md-7">
                                            <?= ($address_data->landmark!=null&&$address_data->landmark!='')?  $address_data->landmark:'' ?>
                                        </div>
                                    </div>

                                </li>
                                <?php } ?>

                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-md-5">
                                            PIN Code
                                        </div>
                                        <div class="col-md-7">
                                            <?= ($address_data->pinCode!=null&&$address_data->pinCode!='')?  $address_data->pinCode:'' ?>
                                        </div>
                                    </div>

                                </li>
                            </ul>


                            <?php
                            } else {
                            ?>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#fullAddressModal"
                                aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus"></i>&nbsp; Add
                                Address</a>
                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>


            </div>




        </div>
    </section>

    <!--Full Address Modal -->

    <div class="modal fade" id="fullAddressModal" tabindex="-1" role="dialog" aria-labelledby="fullAddressModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header profile-edit">
                    <h5 class="modal-title " id="exampleModalLongTitle">Add Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form class="modal-form" role="form" method="post" id="addAddressForm">
                        <div class="container">

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="House Name / Door Number"
                                        name="houseName" id="houseName" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="address" class="form-control" placeholder="Full address"
                                        name="fullAddress" id="fullAddress" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Landmark" name="landmark"
                                        id="landmark">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="PIN Code" name="pinCode"
                                        id="pinCode" required="">
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

    <!--Edit Address Modal -->

    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header profile-edit">
                    <h5 class="modal-title " id="exampleModalLongTitle">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                            if (!empty($address_data)) {
                            ?>
                    <form class="modal-form" role="form" method="post" id="editAddressForm">
                        <div class="container">

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="House Name / Door Number"
                                        name="editHouseName" id="editHouseName" required=""
                                        value="<?= ($address_data->houseName!=null&&$address_data->houseName!='')?  $address_data->houseName:'' ?>" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="address" class="form-control" placeholder="Full address"
                                        name="editFullAddress" id="editFullAddress" required="" value="<?=
                                        ($address_data->fullAddress!=null&&$address_data->fullAddress!='')?  $address_data->fullAddress:''
                                        ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Landmark" name="editLandmark"
                                        id="editLandmark"
                                        value="<?= ($address_data->landmark!=null&&$address_data->landmark!='')?  $address_data->landmark:'' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="PIN Code" name="editPinCode"
                                        id="editPinCode" required=""
                                        value="<?= ($address_data->pinCode!=null&&$address_data->pinCode!='')?  $address_data->pinCode:'' ?>">
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer update_button">
                            <button type="submit" class="modal-button mr-auto">submit</button>
                        </div>
                    </form>
                    <?php 
                            }
                    ?>

                </div>
            </div>
        </div>
    </div>


    <!-- Change Profile details Modal -->

    <div class="modal fade" id="changeProfileDetails" tabindex="-1" role="dialog"
        aria-labelledby="changeProfileDetailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header profile-edit">
                    <h5 class="modal-title " id="editProfileDetailsTitle">Edit Profile Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                            if (!empty($user_details)) {
                            ?>
                    <form class="modal-form" role="form" method="post" id="editProfileForm">
                        <div class="container">

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="proName"
                                        id="proName" required=""
                                        value="<?= ($user_details->name!=null&&$user_details->name!='')?  $user_details->name:'' ?>" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="proEmail"
                                        id="proEmail" required="" value="<?=
                                        ($user_details->emailId!=null&&$user_details->emailId!='')?  $user_details->emailId:''
                                        ?>">
                                </div>
                            </div>



                        </div>

                        <div class="modal-footer update_button">
                            <button type="submit" class="modal-button mr-auto">submit</button>
                        </div>
                    </form>
                    <?php 
                            }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- change phoneNumber -->
    <div class="modal fade" id="changePhoneNumber" tabindex="-1" role="dialog" aria-labelledby="changePhoneNumberTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header profile-edit">
                    <h5 class="modal-title " id="changePhoneNumberTitle">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                            if (!empty($user_details)) {
                            ?>
                    <form class="modal-form" role="form" method="post" id="changePhoneNumberForm">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="alert alert-warning">
                                    OTP will send to your new phone number
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Enter your new phone number"
                                        name="resetPhone" id="resetPhone" required="" />
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer update_button">
                            <button type="submit" class="modal-button mr-auto">Submit</button>
                        </div>
                    </form>
                    <?php 
                            }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- change password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header profile-edit">
                    <h5 class="modal-title " id="changePasswordTitle">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?php
                            if (!empty($user_details)) {
                            ?>
                    <form class="modal-form" role="form" method="post" id="changePasswordForm">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="alert alert-warning">
                                    OTP will send to Email and Phone number
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="resetName"
                                        id="resetName" required=""
                                        value="<?= ($user_details->mobile!=null&&$user_details->mobile!='')?  $user_details->mobile:'' ?>" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="resetEmail"
                                        id="resetEmail" required="" value="<?=
                                        ($user_details->emailId!=null&&$user_details->emailId!='')?  $user_details->emailId:''
                                        ?>">
                                </div>
                            </div>



                        </div>

                        <div class="modal-footer update_button">
                            <button type="submit" class="modal-button mr-auto">SEND OTP</button>
                        </div>
                    </form>
                    <?php 
                            }
                    ?>

                </div>
            </div>
        </div>
    </div>



    <?php 
$this->load->view('web/index');
?>

</body>

</html>
