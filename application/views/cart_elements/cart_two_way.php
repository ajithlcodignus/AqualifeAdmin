<div style="width: 105px; text-align: center;margin:0" class="fv-item-btn-container">
    <button type="button" class="fv-item-btn cart_cart_bttn_decrement countDecrement<?= $itemId ?>" h_p="<?= $shopId ?>" t_d="<?= $itemId ?>"  q_y="<?= $quantity ?>" s_t="<?= $shopGst ?>" c_s_g="<?= $shopGst ?>" item_image="<?= $itemImage ?>" item_name="<?= $itemName ?>" item_price="<?= $itemPrice ?>" <?php if(!empty($cartId)){ ?> c_d="<?php echo $cartId ?>" <?php } ?>>
        <span class="btn-icon">
            <i class="fa fa-minus cart_add" aria-hidden="true"></i>
        </span>
    </button>
    <span class="cart_count<?= $itemId ?>">
        <?= $quantity ?>
    </span>
    <button type="button" class="fv-item-btn cart_cart_bttn countIncrement<?= $itemId ?>" h_p="<?= $shopId ?>" t_d="<?= $itemId ?>" q_y="<?= $quantity ?>" s_t="<?= $shopGst ?>" c_s_g="<?= $shopGst ?>" item_image="<?= $itemImage ?>" item_name="<?= $itemName ?>" item_price="<?= $itemPrice ?>" <?php if(!empty($cartId)){ ?> c_d="<?php echo $cartId ?>" <?php } ?>>
        <span class="btn-icon">
            <i class="fa fa-plus cart_add" aria-hidden="true"></i>
        </span>
    </button>
</div>