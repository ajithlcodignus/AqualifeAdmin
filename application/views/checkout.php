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

    <section class="pt-5 ">
        <div class="container vh-100 pt-5 pb-5">

            <div class="row mt-5">
                <div class="col-md-2">
                </div>

                <div class="col-md-8">
                    <div class="card pt-3 pl-3 pr-3">
                   

                        <ul class="nav nav-tabs">
                        <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url('checkout') ?>">Order Summery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('orders') ?>">Your Orders</a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">

                                    </div>
                                </li>
                                <?php foreach ($cart_data as $key => $value) {
                           
                        ?>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-md-5 col-xl-5 col-lg-5 col-sm-5 col-xs-5">
                                            <?= $value->name ?>
                                        </div>
                                        <div class="col-4 col-md-2 text-right">
                                            <?= number_format((float)$value->offerPrice, 2, '.', '') ?>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            x
                                        </div>
                                        <div class="col-2 col-md-2">
                                            <?= $value->quantity ?>
                                        </div>
                                        <div class="col-4 col-md-2 text-right">
                                            <?= number_format((float)($value->offerPrice*$value->quantity), 2, '.', '') ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                        }
                     
                        ?>

                                <?php 
                              if($cart_calc_data['packingCharge']!=0){
                          ?>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2 col-md-2">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            Packing Fee
                                        </div>
                                        <div class="col-4 col-md-4 text-right">
                                            <?= number_format((float)$cart_calc_data['packingCharge'], 2, '.', '') ?>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                              }
                              if($cart_calc_data['deliveryFee']!=0){
                          ?>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2 col-md-2">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            Delivery Fee
                                        </div>
                                        <div class="col-4 col-md-4 text-right">
                                            <?= number_format((float)$cart_calc_data['deliveryFee'], 2, '.', '') ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                         } if($cart_calc_data['shopGst']!=0){
                         ?>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2 col-md-2">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            GST
                                        </div>
                                        <div class="col-4 col-md-4 text-right">
                                            <?= number_format((float)(($cart_calc_data['totalAmount']*$cart_calc_data['shopGst'])/100), 2, '.', '') ?>
                                        </div>
                                    </div>
                                </li>
                                <?php }?>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2 col-md-2">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            Total
                                        </div>
                                        <div class="col-4 col-md-4 text-right">
                                            <?= number_format((float)$cart_calc_data['totalAmount'], 2, '.', '')  ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-2 col-md-2">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <p> Grand Total</p>
                                        </div>
                                        <div class="col-4 col-md-4 text-right">
                                            <p  >
                                                <?=  number_format((float)$cart_calc_data['paymentAmount'], 2, '.','')  ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">

                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button class="btn btn-primary place_order"
                                                style="background:#eb445a;border-color:#eb445a">PLACE ORDER</button>
                                        </div>

                                    </div>
                                </li>
                        </div>
                    </div>
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



    <?php 
$this->load->view('web/index');
?>

</body>

</html>
