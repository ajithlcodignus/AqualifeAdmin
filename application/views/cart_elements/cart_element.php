
<div class="container each_element_class each_cart_element_container<?= $cart_view_data['itemId'] ?>" >
    <div class="row">

        <div class="col-4 col-md-4">
            <img class="img-thumbnail" src="<?= base_url().$cart_view_data['itemImage'] ?>">
        </div>
        <div class="col-8 col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-between">

                        <span><?= $cart_view_data['itemName'] ?></span>

                        <button type="button" class="close cart-close remove_cart_element" aria-label="Close" h_p="<?= $cart_view_data['shopId'] ?>" t_d="<?= $cart_view_data['itemId'] ?>" q_y="<?= $cart_view_data['quantity'] ?>" s_t="<?= $cart_view_data['shopGst'] ?>" c_s_g="<?= $cart_view_data['shopGst'] ?>" item_image="<?= $cart_view_data['itemImage'] ?>" item_name="<?= $cart_view_data['itemName'] ?>" item_price="<?= $cart_view_data['itemPrice'] ?>"  <?php if(!empty($cart_view_data['cartId'])){ ?> c_d="<?php echo  $cart_view_data['cartId'] ?>" <?php } ?>>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-around">
                        <h6 class="cart-price">₹ <?= $cart_view_data['itemPrice'] ?><span>&nbsp;x&nbsp;<span  class="cart_count_times<?= $cart_view_data['itemId']?>"><?= $cart_view_data['quantity']?></span> &nbsp;&nbsp;&nbsp;</span></h6>
                        <h6 class="item_price_total<?= $cart_view_data['itemId']?>">₹&nbsp;<?= ($cart_view_data['itemPrice']*$cart_view_data['quantity']) ?></h6>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        <?php
                        $this->load->view('cart_elements/cart_two_way', $cart_view_data);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>