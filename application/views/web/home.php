<!DOCTYPE html>
<html>

<head>
    <?php
    if (!empty($is_category)) {
        $view_data['is_category'] = $is_category;
        $view_data['category_id'] = $category_id;
        $this->load->view('web/common/head', $view_data);
    } else if (!empty($is_search_result)) {
        $view_data['is_search_result'] = $is_search_result;
        $this->load->view('web/common/head', $view_data);
    } else {
        $this->load->view('web/common/head');
    }
    ?>


</head>

<body>
    <?php
    if ($this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
        $i = 0;
        $grandTotal = 0;
        foreach ($cart_data as $value) {
            $i++;

            $grandTotal = $grandTotal + ($value->quantity * $value->offerPrice);
        }

    ?>
        <div class="cart_info_div" data-toggle="modal" data-target="#sidebar-right">

            <div class="cart_total_price">
                <span class="btn-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;</span>
                <span class="cart_count_total"><?= $i ?></span>&nbsp;<span class="item_count_label"><?= ($i > 1) ? 'Items' : 'Item' ?></span>
            </div>
            <div class="cart_item_count">
                <span class="btn-icon">₹ </span><span class="cart_grand_total"><?= number_format((float)$grandTotal, 2, '.', ''); ?></span></span>
            </div>

        </div>


        <!-- Sidebar Right -->
        <div class="modal fade right" id="sidebar-right" tabindex="-1" role="dialog">
            <div class="modal-dialog right-modal-dialog" role="document">
                <div class="modal-content right-modal-content">
                    <div class="modal-header right-modal-header cart_font border-bottom">
                        <span class="btn-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;</span>
                        <span class="cart_count_total"><?= $i ?></span>&nbsp;<span class="item_count_label"><?= ($i > 1) ? 'Items' : 'Item' ?></span>&nbsp; &nbsp;
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center" id="cart_item_container">
                        <div class="cart-items">

                            <?php
                            foreach ($cart_data as $cart_data_value) {

                                $data['cart_view_data'] = array(
                                    'itemId' => $cart_data_value->itemId,
                                    'shopId' => $cart_data_value->shopId,
                                    'quantity' => $cart_data_value->quantity,
                                    'itemName' => $cart_data_value->name,
                                    'itemPrice' => $cart_data_value->offerPrice,
                                    'shopGst' => $cart_data_value->cartGst,
                                    'itemImage' => $cart_data_value->image,
                                    'cartId' => $cart_data_value->cartId,

                                );

                                $this->load->view('cart_elements/cart_element', $data);
                            }
                            ?>


                        </div>
                    </div>

                    <div class="modal-footer justify-content-start">
                        <button class="cart-button">
                            <a class="price-tag" href="<?= base_url('checkout') ?>">Checkout</a>
                            <span id="cart_price_box" class="cart-price-box">₹ <span class="cart_grand_total"> <?= number_format((float)$grandTotal, 2, '.', ''); ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php

    } else {
    ?>
        
        <div class="cart_info_div" data-toggle="modal" data-target="#sidebar-right">

            <div class="cart_total_price">
                <span class="btn-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;</span>
                <span class="cart_count_total">0<span class="item_count_label">&nbsp; Item</span>
            </div>
            <div class="cart_item_count">
                <span class="btn-icon">₹</span><span class="cart_grand_total">0.00</span>
            </div>

        </div>

        <!-- Sidebar Right -->
        <div class="modal fade right" id="sidebar-right" tabindex="-1" role="dialog">
            <div class="modal-dialog right-modal-dialog" role="document">
                <div class="modal-content right-modal-content">
                    <div class="modal-header right-modal-header cart_font border-bottom">
                        <span class="btn-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;</span>
                        <span class="cart_count_total">0</span>&nbsp;<span class="item_count_label">Items</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center">
                        <div class="cart-items">

                        </div>

                        <button class="cart-button">
                            <a class="price-tag">Checkout</a>
                            <span class="cart-price-box cart_grand_total">₹ 0.00</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
    ?>



    <?php
    $this->load->view('web/common/header');
    $this->load->view('web/index');
    ?>

    <section class="banner_section">
        <div class="fv-background">
            <div class="container">
                <div class="fv-description">
                    <h1 class="fv-heading">Foodveno-Online Supermarket-8943421724</h1><span class="fv-mal-dec">വീട്ടിലിരുന്ന് ഓർഡർ ചെയ്യു, വീട്ടിലെത്തും വേണ്ടതെല്ലാം..
                    </span>
                    <div class="fv-search">


                        <div class="container banner_search_container">
                            <div class="row">
                                <div class="col-10 col-md-10 pr-0">
                                    <input class="form-control rounded-left search-input banner_search_item" type="search" name="search_item" placeholder="Search Your Product" aria-label="Search">
                                </div>
                                <div class="col-2 col-md-2 pl-0">
                                    <button class="button rounded-right banner_search_button" type="submit" name="search" value="Search">Search</button>

                                </div>
                                <!-- <div class="col-10 col-md-10 pr-0" >
                                     <ul class="list-group" id="search_suggestion" style="position: absalute;z-index: 999;display:block" >

                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div><span></span>
                </div>
            </div>
        </div>
    </section>

    <!-- carousel starts -->

    <div class="container-fluid pb-5" id="carousel_container">
        <div class="row">
            <div class="col">

                <div class="bbb_viewed_slider_container">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12">
                                <div class="carousel_prev bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                <div class="owl-carousel owl-theme bbb_viewed_slider">
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="bbb_viewed_image"><img class="img-fluid" src="https://yesvalue.in/FoodvenoWeb/images/banner/veg_banner1.jpeg" alt=""></div>


                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="bbb_viewed_image"><img class="img-fluid" src="https://yesvalue.in/FoodvenoWeb/images/banner/food_banner.jpeg" alt=""></div>


                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="bbb_viewed_image"><img class="img-fluid" src="https://yesvalue.in/FoodvenoWeb/images/banner/grocery_banner.jpeg" alt=""></div>


                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="bbb_viewed_image"><img class="img-fluid" src="https://yesvalue.in/FoodvenoWeb/images/banner/food_banner.jpeg" alt=""></div>


                                        </div>
                                    </div>
                                </div>
                                <div class="carousel_next bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- carousel end -->

    <div class="container-fluid" id="main">
        <div class="row row-offcanvas row-offcanvas-left" <?= ((!empty($is_category)) || (!empty($is_search_result))) ? 'id="category_container"' : '' ?>>

            <div class="col-md-5 col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-offcanvas  side-menu" id="side_menu_fix" role="navigation">
                <ul class="nav" id="category_menu">
                    <?php if (!empty($category_data)) {
                        foreach ($category_data as $category_value) { ?>

                            <li class="col-md-12">

                                <div class="d-flex">
                                    <img class="category-thumbnail" src="<?= base_url($category_value->categoryIcon)  ?>">
                                    <a class="nav-link category" href="<?= base_url('category_items/' . $category_value->categoryId) ?>"><?= $category_value->name ?></a>
                                </div>

                            </li>

                    <?php
                        }
                    }
                    ?>

                </ul>
            </div>
            <div class="col-md-5 col-xl-3 col-lg-3 col-sm-12 col-xs-12 side_menu_substi" id="side_menu_substi">

            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-9 col-xl-9 main pt-2 bg-light" id="load_data">
                <div class="row product_container" id="product_container">

                    <?php
                    if (!empty($is_search_result)) {
                    ?>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="col-12 col-sm-12 col-md-12">
                                <h6>Search result -<span class="price"><?= ' ' . $item_data[0]->name ?></span></h6><a href="<?= base_url() ?>">View All Products</a>
                            </div>
                        <?php
                    }

                    $view_data['item_data'] = $item_data;

                    $this->load->view('web/common/product_cards', $view_data);
                        ?>

                        </div>
                        <div class="row">
                            <div class="col-12 loading_more_product">
                                Loading ...
                            </div>
                        </div>



                </div>
            </div>

            <!--Login Modal -->
            <form role="form" method="post" id="loginForm1" enctype="multipart/form-data">
                <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title justify-content-center" id="modalLongTitle">Login</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                            <div class="modal-body">


                                <div class="container">

                                    <div class="row">
                                        <div class="col py-2 form-group">
                                            <input type="number" class="form-control" id="mobile1" name="mobile" placeholder="Mobile Number">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col py-2 form-group">
                                            <input type="password" class="form-control" id="password1" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                </div>


                                <div class="d-flex justify-content-center pt-4">
                                    <p>New Member <a href="#" data-toggle="modal" data-target="#SignupModal">Sign
                                            Up?</a></p>
                                </div>

                                <div class="modal-footer update_button">
                                    <button type="submit" id="loginButton1" class="modal-button mr-auto">Login</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <script>
        jQuery(document).ready(function() {
            $(document).on('click', '.cart_bttn', function() {

                var t_d = $(this).attr("t_d");
                var h_p = $(this).attr("h_p");
                var q_y = $(this).attr("q_y");
                var s_t = $(this).attr("s_t");
                var c_s_g = $(this).attr("c_s_g");
                var itemImage = $(this).attr("item_image");
                var itemName = $(this).attr("item_name");
                var itemPrice = $(this).attr("item_price");
                var c_d = $(this).attr("c_d");

                var cartData = {
                    t_d: t_d,
                    h_p: h_p,
                    q_y: q_y,
                    s_t: s_t,
                    c_s_g: c_s_g,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    c_d: c_d,

                };

                $.ajax({
                    url: "<?= base_url() ?>web/cart_increment",
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {

                        if (data.status) {
                            var decodedData = jQuery.parseJSON(JSON.stringify(data));
                            $('.cart_count_total').text(decodedData['cart_total'][
                                'cartCount'
                            ]);
                            $('.cart_grand_total').text(decodedData['cart_total'][
                                'grandTotal'
                            ]);
                            itemCountLabel(decodedData['cart_total']['cartCount']);

                            if (q_y == 0) {

                                $('.item_btn_container' + t_d).html(data.html);
                                $('#cart_item_container').append(data.cart_html);

                            }
                            q_y = parseInt(q_y) + 1;
                            $('.countDecrement' + t_d).attr("q_y", q_y);
                            $('.countIncrement' + t_d).attr("q_y", q_y);
                            $('.cart_count' + t_d).text(q_y);
                            $('.cart_count_times' + t_d).text(q_y);
                            $('.item_price_total' + t_d).text((parseInt(q_y) * parseInt(
                                itemPrice)));

                        }
                        if (data.status == 0) {
                            alert(data['demo_error_string']);
                        }
                    },
                    data: cartData
                });

            });
            $(document).on('click', '.cart_bttn_decrement', function(e) {
                var t_d = $(this).attr("t_d");
                var h_p = $(this).attr("h_p");
                var q_y = $(this).attr("q_y");
                var s_t = $(this).attr("s_t");
                var c_s_g = $(this).attr("c_s_g");
                var itemImage = $(this).attr("item_image");
                var itemName = $(this).attr("item_name");
                var itemPrice = $(this).attr("item_price");
                var c_d = $(this).attr("c_d");

                var cartData = {
                    t_d: t_d,
                    h_p: h_p,
                    q_y: q_y,
                    s_t: s_t,
                    c_s_g: c_s_g,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    c_d: c_d,

                };

                $.ajax({
                    url: "<?= base_url() ?>web/cart_decrement",
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            q_y = (parseInt(q_y) - 1);
                            $('.item_price_total' + t_d).text((parseInt(q_y) * parseInt(
                                itemPrice)));
                            $('.countDecrement' + t_d).attr("q_y", q_y);
                            $('.countIncrement' + t_d).attr("q_y", q_y);
                            $('.cart_count' + t_d).text(q_y);
                            $('.cart_count_times' + t_d).text(q_y);

                            var decodedData = jQuery.parseJSON(JSON.stringify(data));

                            $('.cart_count_total').text(decodedData['cart_total'][
                                'cartCount'
                            ]);
                            $('.cart_grand_total').text(decodedData['cart_total'][
                                'grandTotal'
                            ]);
                            itemCountLabel(decodedData['cart_total']['cartCount']);

                            if (q_y == 0) {
                                $('.each_cart_element_container' + t_d).remove();
                                $('.item_btn_container' + t_d).html(data['html']);

                            }
                        } else if (data.status == 0) {
                            alert(data.demo_error_string);
                        }
                    },
                    data: cartData
                });

            });
            $(document).on('click', '.cart_cart_bttn_decrement', function(e) {
                var t_d = $(this).attr("t_d");
                var h_p = $(this).attr("h_p");
                var q_y = $(this).attr("q_y");
                var s_t = $(this).attr("s_t");
                var c_s_g = $(this).attr("c_s_g");
                var itemImage = $(this).attr("item_image");
                var itemName = $(this).attr("item_name");
                var itemPrice = $(this).attr("item_price");
                var c_d = $(this).attr("c_d");

                var cartData = {
                    t_d: t_d,
                    h_p: h_p,
                    q_y: q_y,
                    s_t: s_t,
                    c_s_g: c_s_g,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    c_d: c_d,

                };

                $.ajax({
                    url: "<?= base_url() ?>web/cart_decrement",
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {

                        if (data.status) {
                            q_y = (parseInt(q_y) - 1);
                            $('.countDecrement' + t_d).attr("q_y", q_y);
                            $('.countIncrement' + t_d).attr("q_y", q_y);
                            $('.cart_count' + t_d).text(q_y);
                            $('.cart_count_times' + t_d).text(q_y);
                            $('.item_price_total' + t_d).text((parseInt(q_y) * parseInt(
                                itemPrice)));

                            var decodedData = jQuery.parseJSON(JSON.stringify(data));
                            $('.cart_count_total').text(decodedData['cart_total'][
                                'cartCount'
                            ]);
                            $('.cart_grand_total').text(decodedData['cart_total'][
                                'grandTotal'
                            ]);
                            itemCountLabel(decodedData['cart_total']['cartCount']);

                            if (q_y == 0) {
                                $('.each_cart_element_container' + t_d).remove();
                                $('.item_btn_container' + t_d).html(data['html']);
                            }
                        } else if (data.status == 0) {
                            alert(data.demo_error_string);
                        }
                    },
                    data: cartData
                });
            });

            $(document).on('click', '.cart_cart_bttn', function() {
                ;
                var t_d = $(this).attr("t_d");
                var h_p = $(this).attr("h_p");
                var q_y = $(this).attr("q_y");
                var s_t = $(this).attr("s_t");
                var c_s_g = $(this).attr("c_s_g");
                var itemImage = $(this).attr("item_image");
                var itemName = $(this).attr("item_name");
                var itemPrice = $(this).attr("item_price");
                var c_d = $(this).attr("c_d");

                var cartData = {
                    t_d: t_d,
                    h_p: h_p,
                    q_y: q_y,
                    s_t: s_t,
                    c_s_g: c_s_g,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    c_d: c_d,

                };

                $.ajax({
                    url: "<?= base_url() ?>web/cart_increment",
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {

                        if (data.status) {
                            var decodedData = jQuery.parseJSON(JSON.stringify(data));

                            $('.cart_count_total').text(decodedData['cart_total'][
                                'cartCount'
                            ]);
                            $('.cart_grand_total').text(decodedData['cart_total'][
                                'grandTotal'
                            ]);
                            itemCountLabel(decodedData['cart_total']['cartCount']);



                            q_y = parseInt(q_y) + 1;
                            $('.countDecrement' + t_d).attr("q_y", q_y);
                            $('.countIncrement' + t_d).attr("q_y", q_y);
                            $('.cart_count' + t_d).text(q_y);
                            $('.cart_count_times' + t_d).text(q_y);
                            $('.item_price_total' + t_d).text((parseInt(q_y) * parseInt(
                                itemPrice)));


                        } else if (data.status == 0) {
                            alert(data.demo_error_string);
                        }
                    },
                    data: cartData
                });
            });


            $(document).on('click', '.remove_cart_element', function() {

                var t_d = $(this).attr("t_d");
                var h_p = $(this).attr("h_p");
                var q_y = 0;
                var s_t = $(this).attr("s_t");
                var c_s_g = $(this).attr("c_s_g");
                var itemImage = $(this).attr("item_image");
                var itemName = $(this).attr("item_name");
                var itemPrice = $(this).attr("item_price");
                var c_d = $(this).attr("c_d");


                var cartData = {
                    t_d: t_d,
                    h_p: h_p,
                    q_y: q_y,
                    s_t: s_t,
                    c_s_g: c_s_g,
                    itemImage: itemImage,
                    itemName: itemName,
                    itemPrice: itemPrice,
                    c_d: c_d,
                };

                $.ajax({
                    url: "<?= base_url() ?>web/delete_cart_item",
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        var decodedData = jQuery.parseJSON(JSON.stringify(data));

                        if (decodedData['status'] == 1) {

                            $('.item_btn_container' + t_d).html(decodedData['html']);
                            $('.each_cart_element_container' + t_d).remove();
                            $('.cart_count_total').text(decodedData['cart_total'][
                                'cartCount'
                            ]);

                            $('.cart_grand_total').text(decodedData['cart_total'][
                                'grandTotal'
                            ]);
                            itemCountLabel(decodedData['cart_total']['cartCount']);
                        } else if (decodedData['status'] == 0) {
                            alert(decodedData['demo_error_string']);
                        }
                    },
                    data: cartData
                });
            });

            function itemCountLabel(cart_count) {
                if (cart_count > 1) {
                    $('.item_count_label').text('items');
                } else {
                    $('.item_count_label').text('item');
                }
            }

        });
    </script>
    <?php
    $this->load->view('web/index');
    ?>

</body>

</html>