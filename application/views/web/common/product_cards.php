<?php

                    if (!empty($item_data)) {
                    ?>

<?php
                        foreach ($item_data as $value) {
                            ?>
<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4  product_id" l_i_d="<?= $value->itemId ?>">
    <div class="card h-100 p-3">
	<img class="bg-img img-fluid card-img-top" src="<?= base_url($value->image)  ?>" alt="">
        <?php
                                    if (null == $this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
                                    ?>
        <div class="fv-item-btn-container">
            <button type="button" class="fv-item-btn" data-toggle="modal" data-target="#LoginModal" aria-haspopup="true"
                aria-expanded="false" id="itemId<?= $value->itemId ?>" h_p="<?= $value->shopId ?>"
                t_d="<?= $value->itemId ?>" q_y="<?= $value->quantity ?>" s_t="<?= $value->shopGst ?>"
                c_s_g="<?= $value->shopGst ?>">
                <span class="btn-icon">

                    <i class="fa fa-plus cart_add" aria-hidden="true"></i>

                </span>
            </button>
        </div>
        <?php } else {
                                        $view_data['itemId'] = $value->itemId;
                                        $view_data['shopId'] = $value->shopId;
                                        $view_data['quantity'] = $value->quantity;
                                        $view_data['shopGst'] = $value->shopGst;
                                        $view_data['itemName'] = $value->name;
                                        $view_data['itemPrice'] = $value->offerPrice;
                                        $view_data['itemImage'] = $value->image;
                                        $view_data['cartId'] = $value->cartId;

                                        if ($value->quantity > 0) {
                                        ?>
        <div class="item_btn_container<?= $value->itemId ?>">
            <?php
                                                $this->load->view('web/common/cart_two_way', $view_data);

                                                ?>
        </div>
        <?php
                                        } else { ?>
        <div class="item_btn_container<?= $value->itemId ?>">
            <?php
                                                $this->load->view('web/common/cart_increment', $view_data);
                                                ?>

        </div><?php
                                                }
                                            } ?>

        <div class="card-body">
            <p class="card-text price"><?php echo "₹ " . $value->offerPrice . ".00" ?></p>

            <p class="card-text item-name"><?php echo $value->name; ?></p>

        </div>
    </div>
</div>

<?php     
 }
                ?>


<?php
            }
            ?>
