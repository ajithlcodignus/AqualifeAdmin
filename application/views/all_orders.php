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
                    <div class="card pt-3 pr-3 pl-3">
                        <ul class="nav nav-tabs">
                            <?php if ($cart_count > 0) { ?>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?= base_url('checkout') ?>">Order Summery</a>
                                </li>
                            <?php } else { ?>

                                <li class="nav-item">
                                    <a class="nav-link " href="<?= base_url('profile') ?>">My Profile</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= base_url('orders') ?>">Your Orders</a>
                            </li>
                        </ul>

                        <?php
                        if (!empty($order_list)) {
                            for ($i = 0; $i < count($order_list); $i++) {
                        ?>
                                <div class="card mb-3">

                                    <div class="card-header"><?php
                                                                if (($order_list[$i][TAG_ORDER_STATUS] == 'Received') || ($order_list[$i][TAG_ORDER_STATUS] == 'Assigned')) {
                                                                ?>
                                            <div id="message_container" class="alert alert-success text-center">Your order will
                                                deliver soon</div>
                                        <?php
                                                                } else {
                                                                    echo $order_list[$i][TAG_ORDER_STATUS] . ' on ' . date('l jS \of F Y h:i:s A', strtotime($order_list[$i][TAG_ENTRY_DATE]));
                                                                } ?>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="row">

                                                </div>
                                            </li>
                                            <?php foreach ($order_list[$i][TAG_ITEMS_LIST] as $key => $value) {

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
                                                            <?= number_format((float)($value->offerPrice * $value->quantity), 2, '.', '') ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }

                                            ?>

                                            <?php
                                            if ($order_list[$i][TAG_PACKING_CHARGE] != 0) {
                                            ?>
                                                <li class="list-group-item">

                                                    <div class="row">
                                                        <div class="col-2 col-md-2">
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            Packing Fee
                                                        </div>
                                                        <div class="col-4 col-md-4 text-right">
                                                            <?= number_format((float)$order_list[$i][TAG_PACKING_CHARGE], 2, '.', '') ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            if ($order_list[$i][TAG_DELIVERY_FEE] != 0) {
                                            ?>
                                                <li class="list-group-item">

                                                    <div class="row">
                                                        <div class="col-2 col-md-2">
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            Delivery Fee
                                                        </div>
                                                        <div class="col-4 col-md-4 text-right">
                                                            <?= number_format((float)$order_list[$i][TAG_DELIVERY_FEE], 2, '.', '') ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            if ($order_list[$i]['gst'] != 0) {
                                            ?>
                                                <li class="list-group-item">

                                                    <div class="row">
                                                        <div class="col-2 col-md-2">
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            GST
                                                        </div>
                                                        <div class="col-4 col-md-4 text-right">
                                                            <?= number_format((float)(($order_list[$i][TAG_TOTAL_AMOUNT] * $order_list[$i]['gst']) / 100), 2, '.', '') ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <li class="list-group-item">

                                                <div class="row">
                                                    <div class="col-2 col-md-2">
                                                    </div>
                                                    <div class="col-6 col-md-6">
                                                        Total
                                                    </div>
                                                    <div class="col-4 col-md-4 text-right">
                                                        <?= number_format((float)$order_list[$i][TAG_TOTAL_AMOUNT], 2, '.', '')  ?>
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
                                                        <p>
                                                            <?= number_format((float)$order_list[$i][TAG_PAYMENT_AMOUNT], 2, '.', '')  ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">

                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <?php if ($order_list[$i][TAG_ORDER_STATUS] == 'Received') {
                                                        ?><button id="cancel_order" class="btn btn-primary cancel_order" style="background:#eb445a;border-color:#eb445a">CANCEL
                                                                ORDER</button><?php
                                                                            } ?>

                                                    </div>

                                                </div>
                                            </li>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>

                            <div class="card-header">
                                <div id="message_container" class="alert alert-warning text-center">Order Details Empty</div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="error_container" class="row d-flex justify-content-center">
                <div class="error_message">
                </div>
            </div>

        </div>
    </section>

    <!--Full Address Modal -->

    <div class="modal fade" id="fullAddressModal" tabindex="-1" role="dialog" aria-labelledby="fullAddressModalTitle" aria-hidden="true">
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
                                    <input type="text" class="form-control" placeholder="House Name / Door Number" name="houseName" id="houseName" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="address" class="form-control" placeholder="Full address" name="fullAddress" id="fullAddress" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Landmark" name="landmark" id="landmark">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="PIN Code" name="pinCode" id="pinCode" required="">
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

    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" placeholder="House Name / Door Number" name="editHouseName" id="editHouseName" required="" value="<?= ($address_data->houseName != null && $address_data->houseName != '') ?  $address_data->houseName : '' ?>" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <input type="address" class="form-control" placeholder="Full address" name="editFullAddress" id="editFullAddress" required="" value="<?=
                                                                                                                                                                                ($address_data->fullAddress != null && $address_data->fullAddress != '') ?  $address_data->fullAddress : ''
                                                                                                                                                                                ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" class="form-control" placeholder="Landmark" name="editLandmark" id="editLandmark" value="<?= ($address_data->landmark != null && $address_data->landmark != '') ?  $address_data->landmark : '' ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" class="form-control" placeholder="PIN Code" name="editPinCode" id="editPinCode" required="" value="<?= ($address_data->pinCode != null && $address_data->pinCode != '') ?  $address_data->pinCode : '' ?>">
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
