<?php
class DatabaseModels extends CI_Model
{
    function registration($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->select(TAG_MOBILE);
        $validate_mobile_qury = $this->db->get_where('user_info', array(TAG_MOBILE => $data[TAG_MOBILE], TAG_USER_ROLE => 'User'));
        if ($validate_mobile_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Mobile Number Already Exist";

            return $output;
        }

        $this->db->select(TAG_EMAIL_ID);
        $validate_email_qury = $this->db->get_where('user_info', array(TAG_EMAIL_ID => $data[TAG_EMAIL_ID], TAG_USER_ROLE => 'User'));
        if ($validate_email_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Email Id Already Exist";
            return $output;
        }

        //$data["activeRestaurantId"] = "1";
        //$data[TAG_USER_ID] = $this->UtilityModels->get_id('user_info', TAG_USER_ID);
        $query_insert = $this->db->insert('user_info', $data);
        if ($query_insert) {
            $auth_string = $this->UtilityModels->generateRandomString();
            $token = $this->UtilityModels->generateToken($data[TAG_MOBILE]);
            $user_id = (string)$this->db->insert_id();
            $this->db->set('authString', $auth_string);
            $this->db->set('token', $token);
            $this->db->where('mobile', $data[TAG_MOBILE]);
            $user_update_flag = $this->db->update('user_info');
            $data[TAG_TOKEN] = $token;
            $data[TAG_AUTH_STRING] = $auth_string;
            $output = $this->get_basic_dashboard($user_id, 0, 0);    //TODO 1 for android and 0 for IOS
            $data[TAG_USER_ID] = $user_id;
            $data[TAG_ADDRESS_ID] = 0;

            $gst_data[TAG_GST_STATUS] = 0;
            log_message('error', 'demo_user_registration_number_validation' . print_r($data, true));
            $output[TAG_GST_DATA] = $gst_data;
            $output[TAG_USER] = $data;
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        return $output;
    }

    function androidRegistration($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->select(TAG_MOBILE);
        $validate_mobile_qury = $this->db->get_where('user_info', array(TAG_MOBILE => $data[TAG_MOBILE]));
        if ($validate_mobile_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Mobile Number Already Exist";

            return $output;
        }

        $this->db->select(TAG_EMAIL_ID);
        $validate_email_qury = $this->db->get_where('user_info', array(TAG_EMAIL_ID => $data[TAG_EMAIL_ID]));
        if ($validate_email_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Email Id Already Exist";
            return $output;
        }

        //$data["activeRestaurantId"] = "1";
        //$data[TAG_USER_ID] = $this->UtilityModels->get_id('user_info', TAG_USER_ID);
        $query_insert = $this->db->insert('user_info', $data);
        if ($query_insert) {
            $auth_string = $this->UtilityModels->generateRandomString();
            $token = $this->UtilityModels->generateToken($data[TAG_MOBILE]);
            $user_id = (string)$this->db->insert_id();
            $this->db->set('authString', $auth_string);
            $this->db->set('token', $token);
            $this->db->where('mobile', $data[TAG_MOBILE]);
            $user_update_flag = $this->db->update('user_info');
            $user_data[TAG_TOKEN] = $auth_string;
            $user_data[TAG_AUTH_STRING] = $token;

            $output = $this->get_basic_dashboard($user_id, 0, 1);     //TODO 1 for android and 0 for IOS
            $data[TAG_USER_ID] = $user_id;
            $data[TAG_ADDRESS_ID] = 0;

            $gst_data[TAG_GST_STATUS] = 0;

            $output[TAG_GST_DATA] = $gst_data;
            $output[TAG_USER] = $data;
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        return $output;
    }

    function login($mobile, $password, $platform_type)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('userId, name, emailId,token, mobile, addressId, currentShopGst');
        $this->db->where(TAG_MOBILE, $mobile);
        $this->db->where(TAG_PASSWORD, $password);
        $this->db->where(TAG_USER_ROLE, 'User');

        $query = $this->db->get('user_info');
        //    print_r( $this->db->last_query());
        //    die();
        if ($query->num_rows()) {
            $user_row = $query->row();
            $user_id = $user_row->userId;
            //$active_restaurant_id = $user_row->activeRestaurantId;
            $profile_data[TAG_USER_ID] = $user_id;
            $profile_data[TAG_NAME] = $user_row->name;
            $profile_data[TAG_TOKEN] = $user_row->token;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_ADDRESS_ID] = $user_row->addressId;

            $gst_data[TAG_GST_STATUS] = 0;

            if ($user_row->currentShopGst != -1) {
                $gst_data[TAG_GST_STATUS] = 1;
                $gst_data[TAG_CURRENT_SHOP_GST] = $user_row->currentShopGst;
            }
            if ($platform_type == "IOS") {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 0);  //TODO 1 for android and 0 for IOS
            } else {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 1);  //TODO 1 for android and 0 for IOS

            }
            $response[TAG_USER] = $profile_data;
            $response[TAG_GST_DATA] = $gst_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Mobile Number or Password is Incorrect..";
        }
        return $response;
    }

    function androidLogin($mobile, $password)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('userId, name, emailId,token, mobile, addressId, currentShopGst');
        $this->db->where(TAG_MOBILE, $mobile);
        $this->db->where(TAG_PASSWORD, $password);
        $query = $this->db->get('user_info');

        if ($query->num_rows()) {
            $user_row = $query->row();
            $user_id = $user_row->userId;
            //$active_restaurant_id = $user_row->activeRestaurantId;
            $profile_data[TAG_USER_ID] = $user_id;
            $profile_data[TAG_NAME] = $user_row->name;
            $profile_data[TAG_TOKEN] = $user_row->token;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_ADDRESS_ID] = $user_row->addressId;

            $gst_data[TAG_GST_STATUS] = 0;

            if ($user_row->currentShopGst != -1) {
                $gst_data[TAG_GST_STATUS] = 1;
                $gst_data[TAG_CURRENT_SHOP_GST] = $user_row->currentShopGst;
            }

            $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 1);  //TODO 1 for android and 0 for IOS

            $response[TAG_USER] = $profile_data;
            $response[TAG_GST_DATA] = $gst_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Mobile Number or Password is Incorrect..";
        }
        return $response;
    }

    function get_specific_shop_items($user_id, $shop_id)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        //$all_item_query = $this->db->query("SELECT a.*, c.cartId,c.quantity FROM items a LEFT JOIN cart c ON c.itemId=a.itemId WHERE c.userId='$user_id' or c.userId IS NULL and a.shopId = '$shop_id' ORDER BY a.itemId");
        $this->db->where(TAG_SHOP_ID, $shop_id);
        $all_item_query = $this->db->get('items');

        if ($all_item_query->num_rows()) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response[TAG_ALL_CATEGORIES] = null;
            //$response[TAG_ALL_ITEMS] = $all_item_query->result();
            $this->db->where(TAG_SHOP_ID, $shop_id);
            $all_category_query = $this->db->get('category');

            if ($all_category_query->num_rows()) {
                $response[TAG_ALL_CATEGORIES] = $all_category_query->result();
            }
        }
        return $response;
    }

    function item_details($where_data)
    {
        $output = null;
        $this->db->where($where_data);
        $query = $this->db->get('items');
        if ($query->num_rows()) {
            $row = $query->row();
            $output[TAG_ITEM_ID] = $row->itemId;
            $output[TAG_NAME] = $row->name;
            $output[TAG_DESCRIPTION] = $row->description;
        }
        return $output;
    }

    function mobileNumberValidation($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        $this->db->select(TAG_MOBILE);
        $this->db->where($where_data);
        $query = $this->db->get_where('user_info');
        if ($query->num_rows()) {
            $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
            $output[TAG_RESPONSE_DATA] = "Mobile No. Already Exist";
        }
        return $output;
    }

    function cartIncrement($data, $current_shop_gst)           //TODO Response status will be 2 for item/shop inactive
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $res = $this->validateItemBeforeCart($data[TAG_SHOP_ID], $data[TAG_ITEM_ID]);
        if ($res == true) {
            $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
            $first_check = $this->db->get('cart');

            if ($first_check->num_rows()) {
                $where_data_second[TAG_USER_ID] = $data[TAG_USER_ID];
                $where_data_second[TAG_SHOP_ID] = $data[TAG_SHOP_ID];

                $this->db->where($where_data_second);
                $second_check = $this->db->get('cart');

                if ($second_check->num_rows() < 1) {
                    $current_name = "";
                    $prev_name = "";
                    $this->db->select(TAG_NAME);
                    $this->db->where(TAG_SHOP_ID, $data[TAG_SHOP_ID]);
                    $current_shop_name = $this->db->get('shops');
                    if ($current_shop_name->num_rows()) {
                        $row = $current_shop_name->row();
                        $current_name = $row->name;
                    }

                    $this->db->select(TAG_SHOP_ID);
                    $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
                    $prev_cart_shop = $this->db->get('cart');
                    if ($prev_cart_shop->num_rows()) {
                        $row = $prev_cart_shop->row();
                        $prev_shopId = $row->shopId;

                        $this->db->select(TAG_NAME);
                        $this->db->where(TAG_SHOP_ID, $prev_shopId);
                        $prev_shop_name = $this->db->get('shops');
                        if ($prev_shop_name->num_rows()) {
                            $row = $prev_shop_name->row();
                            $prev_name = $row->name;
                        }
                    }
                    if ((!empty($current_name)) && (!empty($prev_name))) {
                        $output[TAG_ERROR_STRING] = "Your cart contains items from $prev_name. Do you want to Remove and add items from $current_name?";
                    } else {
                        $output[TAG_ERROR_STRING] = "Your cart contains items from other shop. Do you want to Remove and add items from this Shop?";
                    }

                    return $output;
                }
            }
            //$data[TAG_CART_ID] = $this->UtilityModels->get_id('cart', TAG_CART_ID);
            $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
            $where_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];

            $this->db->where($where_data);
            $where_query = $this->db->get('cart');
            if ($where_query->num_rows()) {
                $update_data[TAG_QUANTITY] = $data[TAG_QUANTITY];
                $this->db->where($where_data);
                $update_query = $this->db->update('cart', $update_data);
                if ($update_query) {
                    $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }
            } else {
                $query_insert = $this->db->insert('cart', $data);
                if ($query_insert) {
                    $gst_upd_data[TAG_CURRENT_SHOP_GST] = $current_shop_gst;
                    $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
                    $this->db->update('user_info', $gst_upd_data);
                    $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }
            }
        } else {
            $output[TAG_RESPONSE_STATUS] = 2;
        }

        return $output;
    }

    function cartIncrementFromCart($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $res = $this->validateItemBeforeCart($data[TAG_SHOP_ID], $data[TAG_ITEM_ID]);
        if ($res) {
            $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
            $first_check = $this->db->get('cart');

            if ($first_check->num_rows()) {
                $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
                $where_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];

                $this->db->where($where_data);
                $where_query = $this->db->get('cart');
                if ($where_query->num_rows()) {
                    $update_data[TAG_QUANTITY] = $data[TAG_QUANTITY];
                    $this->db->where($where_data);
                    $update_query = $this->db->update('cart', $update_data);
                    if ($update_query) {
                        $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                    }
                }
            }
        } else {
            $output[TAG_RESPONSE_STATUS] = 2;
        }
        return $output;
    }

    function cartDeleteAndAdd($data, $current_shop_gst)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $res = $this->validateItemBeforeCart($data[TAG_SHOP_ID], $data[TAG_ITEM_ID]);
        if ($res) {
            $where_data_delete[TAG_USER_ID] = $data[TAG_USER_ID];
            $delete_query = $this->db->delete('cart', $where_data_delete);

            if ($delete_query) {
                $query_insert = $this->db->insert('cart', $data);
                if ($query_insert) {
                    $gst_upd_data[TAG_CURRENT_SHOP_GST] = $current_shop_gst;
                    $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
                    $this->db->update('user_info', $gst_upd_data);
                    $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }
            }
        } else {
            $output[TAG_RESPONSE_STATUS] = 2;
        }
        return $output;
    }

    function cartDelete($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $delete_query = $this->db->delete('cart', $where_data);

        if ($delete_query) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function cartDecrement($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $res = $this->validateItemBeforeCart($data[TAG_SHOP_ID], $data[TAG_ITEM_ID]);
        if ($res) {
            //$data[TAG_CART_ID] = $this->UtilityModels->get_id('cart', TAG_CART_ID);
            $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
            $where_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];

            $this->db->where($where_data);
            $where_query = $this->db->get('cart');
            if ($where_query->num_rows()) {
                if ($data[TAG_QUANTITY] != 0) {
                    $update_data[TAG_QUANTITY] = $data[TAG_QUANTITY];
                    $this->db->where($where_data);
                    $update_query = $this->db->update('cart', $update_data);
                    if ($update_query) {
                        $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                    }
                } else {
                    $query_delete = $this->db->delete('cart', $where_data);
                    if ($query_delete) {
                        $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                    }
                }
            }
        } else {
            $output[TAG_RESPONSE_STATUS] = 2;
        }
        return $output;
    }

    function getCart($user_id)
    {
        $output[TAG_CART_ITEMS] = null;
        //$output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('a.*,b.name,b.price,b.image,b.offerPrice');
        $this->db->from('cart a');
        $this->db->join('items b', 'b.itemId=a.itemId', 'left');
        $this->db->where('a.userId', $user_id);
        $query = $this->db->get();
        if ($query->num_rows()) {
            //$output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_CART_ITEMS] = $query->result();
        }
        return $output;
    }

    function getFavourites($user_id)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->from('favorites a');
        $this->db->join('items b', 'b.itemId=a.itemId', 'left');
        $this->db->where('a.userId', $user_id);
        $query = $this->db->get();
        if ($query->num_rows()) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_FAVORITE_ITEMS] = $query->result();
        }
        return $output;
    }

    function insertFavorites($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $query_insert = $this->db->insert('favorites', $data);
        if ($query_insert) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function removeFavorites($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $query_insert = $this->db->delete('favorites', $where_data);
        if ($query_insert) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function placeOrder($data, $platform_type)
    {
        $this->db->trans_begin();
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $qry = false;
        $query_insert = $this->db->insert('order_summary', $data);

        if ($query_insert) {
            $order_id = (string)$this->db->insert_id();
            $order_hash_data['orderHashId'] = $this->UtilityModels->generateOrderHashRandomString(11) . $order_id;
            $this->db->where(TAG_ORDER_ID, $order_id);
            $this->db->update('order_summary', $order_hash_data);


            $this->db->select('a.*,b.name');
            $this->db->from('cart a');
            $this->db->join('items b', 'b.itemId=a.itemId', 'left');
            $this->db->where('a.userId', $data[TAG_USER_ID]);
            $cart_data = $this->db->get();


            if ($cart_data) {
                foreach ($cart_data->result() as $row) {

                    $insert_data[TAG_ORDER_ID] = $order_id;
                    $insert_data[TAG_ITEM_ID] = $row->itemId;;
                    $insert_data[TAG_QUANTITY] = $row->quantity;
                    $insert_data[TAG_AMOUNT] = $row->amount;
                    $insert_data[TAG_ITEM_NAME] = $row->name;

                    $qry = $this->db->insert('order_details', $insert_data);
                }

                if ($qry) {
                    $delete_where[TAG_USER_ID] = $data[TAG_USER_ID];
                    $delete_qry = $this->db->delete('cart', $delete_where);
                    if ($delete_qry) {
                        $update_data[TAG_ADDRESS_STATUS] = 0;

                        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
                        $this->db->where($where_data);
                        $update_query = $this->db->update('address', $update_data);

                        if ($update_query) {
                            $update_data[TAG_ADDRESS_STATUS] = 1;
                            $where_data[TAG_ADDRESS_ID] = $data[TAG_ADDRESS_ID];
                            $this->db->where($where_data);
                            $this->db->update('address', $update_data);
                        }

                        $gst_upd_data[TAG_CURRENT_SHOP_GST] = -1;
                        $this->db->where(TAG_USER_ID, $data[TAG_USER_ID]);
                        $this->db->update('user_info', $gst_upd_data);

                        $email_id = $this->getShopEmailId($data[TAG_SHOP_ID]);
                        $shop_details = $this->getShopDetails($data[TAG_SHOP_ID]);
                        $shop_admin_details = $this->getShopAdminDataForOrder($data[TAG_SHOP_ID]);


                        // if (!empty($shop_admin_details->firebaseToken)) {
                        //     $shop_admin_token = $shop_admin_details->firebaseToken;
                        // }


                        $o_sh_insert_data[TAG_ORDER_ID] = $order_id;
                        $o_sh_insert_data[TAG_SHIPPING_SELLER_NAME] = $data[TAG_SHOP_NAME];
                        $o_sh_insert_data[TAG_ADDRESS] = $shop_details->address;
                        $o_sh_insert_data[TAG_PIN_CODE] = $shop_details->pinCode;
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_STATUS] = 'Ordered';
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_REMARKS] = 'Your Order has been placed.';
                        $o_sh_insert_data[TAG_PROGRESS_BAR_STATUS] = 'Complete';
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_PRIORITY] = 1;
                        $this->db->insert('order_shipping', $o_sh_insert_data);



                        $shop_admin_notification_data = array(
                            TAG_TITLE => "A New Order  Received for " . $data[TAG_SHOP_NAME],
                            TAG_BODY => "Your  " . TAG_APP_NAME . "Order no : #" . $order_hash_data['orderHashId'] . " please check DayKart Partner App more info..",
                            TAG_IMAGE => "",
                        );



                        $super_admin_notification_data = array(
                            TAG_TITLE => "New Order Received for " . $data[TAG_SHOP_NAME],
                            TAG_BODY => $data[TAG_SHOP_NAME] . "Order no : # " . $order_hash_data['orderHashId'] . " please check DayKart Admin App more info..",
                            TAG_IMAGE => "",

                        );
                        log_message('error', 'FOR SHOP ADMIN  NOTIFICATION : in placeOrder model' . print_r($shop_admin_notification_data, true));

                        log_message('error', 'FOR SUPER ADMIN  NOTIFICATION : in placeOrder model' . print_r($super_admin_notification_data, true));
                        if (!empty($shop_admin_details->firebaseToken)) {
                            $shop_admin_token = $shop_admin_details->firebaseToken;
                            $this->UtilityModels->shopAdminDeviceTokenNotification($shop_admin_notification_data, $shop_admin_token);
                        }
                        $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $super_admin_notification_data);



                        $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                    }
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
            return $output;
        } else {
            $this->db->trans_commit();
            return $output;
        }
    }





    function getShopEmailId($shop_id)
    {
        $email_id = "";
        $this->db->select(TAG_SHOP_EMAIL_ID);
        $this->db->where(TAG_SHOP_ID, $shop_id);
        $query = $this->db->get('shops')->row();
        if ($query) {
            $email_id = $query->shopEmailId;
        }
        return $email_id;
    }
    function getShopDetails($shop_id)
    {
        $shop_data = "";
        $this->db->select('*');
        $this->db->where(TAG_SHOP_ID, $shop_id);
        $query = $this->db->get('shops')->row();
        if ($query) {
            $shop_data = $query;
        }
        return $shop_data;
    }

    function getShopAdminDataForOrder($shop_id)
    {
        $shop_data = "";
        $this->db->select('ui.*,sh.name as shopName');
        $this->db->where('ui.' . TAG_SHOP_ID, $shop_id);
        $query = $this->db->from('user_info ui');
        $this->db->join('shops sh', 'ui.shopId=sh.shopId');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $shop_data = $query->row();
        }
        return $shop_data;
    }

    function getUserDataForOrder($user_id)
    {
        $shop_data = "";
        $this->db->select('name as userName,firebaseToken');
        $this->db->where(TAG_USER_ID, $user_id);
        $query = $this->db->get('user_info');

        if ($query->num_rows() > 0) {
            $shop_data = $query->row();
        }
        return $shop_data;
    }

    function addAddress($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $update_data[TAG_ADDRESS_STATUS] = 0;
        $this->db->where($where_data);
        $update_query = $this->db->update('address', $update_data);

        if ($update_query) {
            $data[TAG_ADDRESS_STATUS] = 1;
            $query_insert = $this->db->insert('address', $data);

            if ($query_insert) {
                $addressId = (string)$this->db->insert_id();
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                $output[TAG_ADDRESS_ID] = $addressId;
            }
        }
        return $output;
    }

    function editAddress($where_data, $update_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $update_query = $this->db->update('address', $update_data);

        if ($update_query) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function deleteAddress($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $delete_query = $this->db->delete('address', $where_data);

        if ($delete_query) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function get_basic_dashboard($user_id, $addressId, $isAndroid)   //TODO 1 for android and 0 for IOS
    {
        $response = null;

        $response = $this->getCart($user_id);


        /*$this->db->where(TAG_PUBLISH_FLAG,1);
        $this->db->where(TAG_ACTIVE,1);
        $shop_query = $this->db->get('shops');*/

        $this->db->where('activeFlag', 'ACTIVE');
        $this->db->order_by('priority');
        $shop_category_query = $this->db->get('shop_category');

        if ($shop_category_query->num_rows()) {
            $response[TAG_SHOP_CATEGORY_LIST] = $shop_category_query->result();
        }

        $this->db->select('*');
        $this->db->from('shops');
        $this->db->order_by('shops.shopPriority', "asc");
        //$this->db->where('shops.active',1);
        $this->db->where('shops.publishFlag', 1);
        $shop_query = $this->db->get();

        if ($shop_query->num_rows()) {
            $response[TAG_SHOPS_LIST] = $shop_query->result();
        }

        $this->db->select('*');
        $this->db->from('category');
        $this->db->order_by('category.activeFlag', 1);
        $category_query = $this->db->get();

        if ($category_query->num_rows()) {
            $response[TAG_ALL_CATEGORIES] = $category_query->result();
        }

        $this->db->select('items.*,shops.shopCategoryId,shops.name as shopName');
        $this->db->from('items');
        $this->db->join('shops', 'items.shopId=shops.shopId', 'left');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->where('items.availabilityStatus', 1);
        $this->db->where('shops.active', 1);
        $this->db->where('shops.publishFlag', 1);
        $item_query = $this->db->get();



        if ($item_query->num_rows()) {
            $response[TAG_ALL_ITEMS] = $item_query->result();
        }

        $db_version_res = $this->getDbVersion();
        $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

        if ($isAndroid == 1) {
            $app_version_res = $this->getAndroidAppVersion();
            $response[TAG_ANDROID_APP_VERSION_CODE] = $app_version_res[TAG_ANDROID_APP_VERSION_CODE];
        } else {
            $app_version_res = $this->getAppVersion();
            $response[TAG_APP_VERSION_CODE] = $app_version_res[TAG_APP_VERSION_CODE];
        }



        $this->db->select("*");
        $where_data_banner['status'] = 1;
        $this->db->where($where_data_banner);
        $banner_query = $this->db->get('banner');
        $response[TAG_BANNER_LIST] = $banner_query->result();
        $response[TAG_ADDRESS_LIST] = null;

        $where_data_address[TAG_USER_ID] = $user_id;
        $this->db->where($where_data_address);
        $this->db->order_by(TAG_ADDRESS_STATUS, "Desc");
        $query = $this->db->get('address');

        if ($query->num_rows()) {
            $response[TAG_ADDRESS_LIST] = $query->result();
        }

        $response[TAG_ACTIVE_ORDER] = 0;
        $where_in_data = array(TAG_ORDER_STATUS_ASSIGNED, TAG_ORDER_STATUS_RECEIVED);
        $this->db->select(TAG_ORDER_ID);
        $this->db->where(TAG_USER_ID, $user_id);
        $this->db->where_in(TAG_ORDER_STATUS, $where_in_data);
        $order_query = $this->db->get('order_summary');

        if ($order_query->num_rows()) {
            $response[TAG_ACTIVE_ORDER] = 1;
        }
        if ($addressId != 0) {
            $address_where_data[TAG_USER_ID] = $user_id;
            $address_where_data[TAG_ADDRESS_ID] = $addressId;
            $this->db->where($address_where_data);
            $address_query = $this->db->get('address');
            if ($address_query->num_rows()) {
                $response[TAG_ADDRESS_INFO] = $address_query->row();
            }
        }
        $response[TAG_CART_SHOP_ID] = 0;
        $this->db->select("shopId");

        $cart_query = $this->db->get_where('cart', array(TAG_USER_ID => $user_id));

        if ($cart_query->num_rows()) {
            $row = $cart_query->row();
            $response[TAG_CART_SHOP_ID] = $row->shopId;
        }
        return $response;
    }

    function getOrderHistory($user_id)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $data = null;

        $where_in_data = array(TAG_ORDER_STATUS_CANCELLED, TAG_ORDER_STATUS_DELIVERED);

        $this->db->select("orderId,shopName,orderStatus,paymentAmount,entryDate");
        $this->db->where(TAG_USER_ID, $user_id);
        $this->db->where_in(TAG_ORDER_STATUS, $where_in_data);
        $this->db->order_by(TAG_ENTRY_DATE, "Asc");
        $query = $this->db->get('order_summary');
        if ($query->num_rows()) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i][TAG_ORDER_ID] = $row->orderId;
                $data[$i][TAG_SHOP_NAME] = $row->shopName;
                $data[$i][TAG_ORDER_STATUS] = $row->orderStatus;
                $data[$i][TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
                $data[$i][TAG_ENTRY_DATE] = $row->entryDate;
                $data[$i][TAG_ITEMS_LIST] = null;

                $item_where_data[TAG_ORDER_ID] = $row->orderId;
                $this->db->select("itemName,quantity");
                $this->db->where($item_where_data);
                $item_query_query = $this->db->get('order_details');

                if ($item_query_query->num_rows()) {
                    $data[$i][TAG_ITEMS_LIST] = $item_query_query->result();
                }
                $i++;
            }
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_ORDER_LIST] = $data;
        }
        return $output;
    }

    /*function getOrderHistory($user_id)//With Join
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select("order_summary.orderId,order_summary.shopName,order_summary.orderStatus,order_summary.paymentAmount,order_summary.entryDate,order_details.itemName,order_details.quantity");
        $this->db->from('order_summary');
        $this->db->join('order_details','order_summary.orderId=order_details.orderId','inner');
        $this->db->where('order_summary.userId',$user_id);
        $this->db->order_by('order_summary.entryDate',"Asc");
        $query = $this->db->get();
        if($query->num_rows())
        {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_ORDER_LIST] = $query->result();
        }
        return $output;
    }*/

    function editProfile($where_data, $update_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select(TAG_EMAIL_ID);
        $validate_email_qury = $this->db->get_where('user_info', array(TAG_EMAIL_ID => $update_data[TAG_EMAIL_ID]));
        if ($validate_email_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Email Id Already Exist";
        } else {
            $this->db->where($where_data);
            $update_query = $this->db->update('user_info', $update_data);

            if ($update_query) {
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            }
        }
        return $output;
    }

    function getAddress($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->where($where_data);
        $this->db->order_by(TAG_ADDRESS_STATUS, "Desc");
        $query = $this->db->get('address', $where_data);

        if ($query->num_rows()) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_ADDRESS_LIST] = $query->result();
        }
        return $output;
    }

    function updateOrderStatus($where_data, $update_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $update_query = $this->db->update('order_summary', $update_data);

        if ($update_query) {


            $order_details = $this->getOrderDetailsByOrderId($where_data[TAG_ORDER_ID]);
            $this->db->where($where_data);
            $update_shipping[TAG_PROGRESS_BAR_STATUS] = 'Cancelled';
            $update_query = $this->db->update('order_shipping', $update_shipping);
            $cancelled_user_data = array(TAG_USER_TYPE => 'User', TAG_ORDER_ID => $where_data[TAG_ORDER_ID], TAG_CANCELLED_USER_ID => $order_details->userId, TAG_REMARK => $update_data[TAG_USER_REMARK]);
            $this->db->insert('order_cancel_table', $cancelled_user_data);
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        $delivery_boy_notification_data = array(
            TAG_TITLE => "Sorry Order has been Cancelled",
            TAG_BODY => "The order " . $order_details->orderHashId . "you received has been canceled by the user. Please contact " . TAG_APP_NAME,
            TAG_IMAGE => "",
        );

        $this->UtilityModels->deliveryBoyDeviceTokenNotification($delivery_boy_notification_data, $order_details->firebaseToken);
        $shop_admin_query = $this->getShopAdminDataForOrder($order_details->shopId);
        if (!empty($shop_admin_query->firebaseToken)) {
            $shop_admin_notification_data = $delivery_boy_notification_data;
            $this->UtilityModels->shopAdminDeviceTokenNotification($shop_admin_notification_data, $shop_admin_query->firebaseToken);
        }
        $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $shop_admin_notification_data);
        return $output;
    }

    function getOrderDetailsByOrderId($order_id)
    {
        $where_data[TAG_ORDER_ID] = $order_id;
        $order_details = null;
        $this->db->select('os.orderHashId,sh.name as shopName,sh.shopId as shopId,ui.name as userName,ui.userId,dby.deliveryBoyName,dby.firebaseToken');

        $this->db->from('order_summary os');
        $this->db->join('shops sh', 'os.shopId=sh.shopId', 'LEFT');
        $this->db->join('user_info ui', 'os.userId=ui.userId', 'LEFT');
        $this->db->join('delivery_boy dby', 'os.deliveryBoyId=dby.deliveryBoyId', 'LEFT');
        $this->db->where($where_data);
        $order_details_query = $this->db->get();

        if ($order_details_query->num_rows() > 0) {
            $order_details = $order_details_query->row();
        }

        return $order_details;
    }

    function getDeliveryBoyOrdersDetails($delivery_boy_id)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
        $query = $this->db->get('delivery_boy');

        if ($query->num_rows()) {
            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_CANCELLED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_CANCELED_ORDERS] = $new_order_query->num_rows();

            $this->db->where('os.' . TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->select('sum(deliveryBoyCommission) as totalDeliveryCommission');
            $this->db->from('delivery_boy dby');
            $this->db->join('order_summary os', 'dby.deliveryBoyId=os.deliveryBoyId', 'left');
            $delivery_commission = $this->db->get();
            $response[TAG_DELIVERY_BOY_COMMISSION] = 0;
            if ($delivery_commission->num_rows() > 0) {
                $response[TAG_DELIVERY_BOY_COMMISSION] = $delivery_commission->row();
            }

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $response;
    }

    /*-----------------------------------------------DELIVERY BOY APIS----------------------------------*/

    function deliveryBoylogin($mobile, $password, $data)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where(TAG_MOBILE, $mobile);
        $this->db->where(TAG_PASSWORD, $password);
        $query = $this->db->get('delivery_boy');
        $response[TAG_DELIVERY_BOY_COMMISSION]['totalDeliveryCommission'] = strval(0);

        if ($query->num_rows()) {

            $this->db->set('firebaseToken', $data[TAG_FIREBASE_TOKEN]);

            $this->db->where('password', $password);
            $this->db->where('mobile', $mobile);
            $update_result = $this->db->update('delivery_boy');
            log_message('error', 'firebase_toke_updated query---' . print_r($this->db->last_query(), true));

            $user_row = $query->row();
            $delivery_boy_id = $user_row->deliveryBoyId;

            $profile_data[TAG_DELIVERY_BOY_ID] = $delivery_boy_id;
            $profile_data[TAG_DELIVERY_BOY_NAME] = $user_row->deliveryBoyName;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_TOKEN] = $user_row->token;

            //$profile_data[TAG_CURRENT_ORDER_ID] = $user_row->currentOrderId;

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_CANCELLED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_CANCELED_ORDERS] = $new_order_query->num_rows();

            $this->db->where('os.' . TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $this->db->select('sum(deliveryBoyCommission) as totalDeliveryCommission');
            $this->db->from('delivery_boy dby');
            $this->db->join('order_summary os', 'dby.deliveryBoyId=os.deliveryBoyId', 'left');
            $delivery_commission = $this->db->get();

            if ($delivery_commission->num_rows() > 0) {
                if ($delivery_commission->row()->totalDeliveryCommission != null) {
                    $response[TAG_DELIVERY_BOY_COMMISSION] = $delivery_commission->row();
                }
            }

            $response[TAG_USER] = $profile_data;

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Mobile Number or Password is Incorrect..";
        }
        return $response;
    }

    function orderComplete($where_data, $update_data, $delivery_boy_id)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $update_query = $this->db->update('order_summary', $update_data);
        $update_shipping[TAG_PROGRESS_BAR_STATUS] = $update_data[TAG_ORDER_STATUS];
        $update_shipping[TAG_REMARKS] = $update_data[TAG_REMARK];
        if ($update_query) {

            $this->db->where($where_data);
            $query = $this->db->get('order_summary');
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $order_data = $this->getOrderDetails($row->orderId);
                $delivery_boy_data = $this->getDeliveryBoyDetails($delivery_boy_id);
                if ($delivery_boy_data->commissionType == 'PERCENTAGE') {
                    $delivery_boy_commission = (($order_data->paymentAmount * $delivery_boy_data->commissionAmount) / 100);
                } else {
                    $delivery_boy_commission = $delivery_boy_data->commissionAmount;
                }
                $this->db->where($where_data);
                $this->db->set('deliveryBoyCommission', $delivery_boy_commission);
                $this->db->update('order_summary');
            }
            $os_where_data[TAG_ORDER_ID] = $where_data[TAG_ORDER_ID];
            $this->db->where($os_where_data);

            $select_order_summery = $this->db->get('order_summary');
 log_message('error','orderComplete'.print_r($this->db->last_query(),true));

            if ($select_order_summery->num_rows() > 0) {
                $order_summery_data = $select_order_summery->row();
                $d_boy_payment_data = array(
                    TAG_DELIVERY_BOY_ID => $delivery_boy_id,
                    TAG_ORDER_ID => $order_summery_data->orderId,
                    TAG_SHOP_ID => $order_summery_data->shopId,
                    TAG_USER_ID => $order_summery_data->userId,
                    TAG_PAYMENT_AMOUNT => $order_summery_data->paymentAmount,

                    TAG_CUSTOMER_PAID_STATUS => 'CUST_NOT_PAID'
                );
                $this->db->insert('d_boy_payment', $d_boy_payment_data);
                    if (!empty($delivery_boy_data->firebaseToken)) {
                        $delivery_boy_notification_data = array(
                            TAG_TITLE =>  $delivery_boy_data->deliveryBoyName . ", Thank you for successfully completing the order",
                            TAG_BODY => "Hai, Order No #" . $order_summery_data->orderHashId . " Completed successfully,  ",
                            TAG_IMAGE => "",
                        );
                        log_message('error', 'delivery boy NOTIFICATION  : in orderComplete model' . print_r($delivery_boy_notification_data, true));

                        $this->UtilityModels->deliveryBoyDeviceTokenNotification($delivery_boy_notification_data, $delivery_boy_data->firebaseToken);
                    }


                $shop_admin_query = $this->getShopAdminDataForOrder($order_summery_data->shopId);
                if ($shop_admin_query) {
                    $shop_admin_token = "";
                    if (!empty($shop_admin_query->firebaseToken)) {
                        $order_shop_details = $shop_admin_query;
                        $shop_admin_token = $order_shop_details->firebaseToken;
                        $shop_admin_notification_data = array(
                            TAG_TITLE => "Order No #" . $order_summery_data->orderHashId . " Completed by " . $delivery_boy_data->deliveryBoyName,
                            TAG_BODY => "Hai, Order No #" . $order_summery_data->orderHashId . " Completed successfully, For more details please check DayKart Admin App ",
                            TAG_IMAGE => "",
                        );
                        log_message('error', 'SHOP ADMIN AND SUPER ADMIN NOTIFICATION : in orderComplete model' . print_r($shop_admin_notification_data, true));

                        $this->UtilityModels->shopAdminDeviceTokenNotification($shop_admin_notification_data, $shop_admin_token);

                        $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $shop_admin_notification_data);
                    }
                }
            }

            $this->db->where($where_data);
            $update_query = $this->db->update('order_shipping', $update_shipping);
            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
            $query = $this->db->update('delivery_boy', array(TAG_CURRENT_ORDER_ID => 0, TAG_ASSIGN_FLAG => 0));
            if ($query) {
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            }
        }
        return $output;
    }

    function getDeliveryBoyOrderDetails($where_data)
    {
        log_message('error', '----order-data' . print_r($where_data, true));
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $order_data = null;
        $this->db->select('os.*,sh.name as shopName,ui.name as userName, ui.mobile as userMobile, ad.fullAddress, ad.houseName, ad.landmark, ad.pinCode, ad.latitude, ad.longitude');
        $this->db->from('order_summary os');
        $this->db->join('shops sh', 'sh.shopId=os.shopId', 'left');
        $this->db->join('user_info ui', 'ui.userId=os.userId', 'left');
        $this->db->join('address ad', 'ad.addressId=os.addressId', 'left');
        $this->db->where('os.deliveryBoyId', $where_data[TAG_DELIVERY_BOY_ID]);
        $this->db->where('os.orderStatus', $where_data[TAG_ORDER_STATUS]);
        $order_query = $this->db->get();
        log_message('error', '----last query ' . print_r($this->db->last_query(), true));

        if ($order_query->num_rows()) {
            $i = 0;
            foreach ($order_query->result() as $row) {
                $order_data[$i][TAG_ORDER_ID] = $row->orderId;
                $order_data[$i][TAG_USER_ID] = $row->userId;
                $order_data[$i][TAG_SHOP_ID] = $row->shopId;
                $order_data[$i][TAG_TOTAL_AMOUNT] = $row->totalAmount;
                $order_data[$i][TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
                $order_data[$i][TAG_GST] = $row->gst;
                $order_data[$i][TAG_PACKING_CHARGE] = $row->packingCharge;
                $order_data[$i][TAG_DELIVERY_FEE] = $row->deliveryFee;
                $order_data[$i][TAG_DISCOUNT_AMOUNT] = $row->discountAmount;
                $order_data[$i][TAG_ENTRY_DATE] = $row->entryDate;
                $order_data[$i][TAG_SHOP_NAME] = $row->shopName;
                $order_data[$i][TAG_USER_NAME] = $row->userName;
                $order_data[$i][TAG_USER_MOBILE] = $row->userMobile;
                $order_data[$i][TAG_FULL_ADDRESS] = $row->fullAddress;
                $order_data[$i][TAG_HOUSE_NAME] = $row->houseName;
                $order_data[$i][TAG_LANDMARK] = $row->landmark;
                $order_data[$i][TAG_PIN_CODE] = $row->pinCode;
                $order_data[$i][TAG_LATITUDE] = $row->latitude;
                $order_data[$i][TAG_LONGITUDE] = $row->longitude;
                $order_data[$i][TAG_ORDER_HASH_ID] = $row->orderHashId;

                $order_data[$i][TAG_ITEMS_LIST] = null;

                $this->db->select('order_details.itemName,order_details.quantity,items.offerPrice');
                $this->db->from('order_details');
                $this->db->join('items', 'order_details.itemId=items.itemId', 'left');
                $this->db->where('order_details.orderId', $row->orderId);
                $item_query_query = $this->db->get();

                /*$item_where_data[TAG_ORDER_ID] = $row->orderId;
                $this->db->select("itemName,quantity,amount");
                $this->db->where($item_where_data);
                $item_query_query = $this->db->get('order_details');*/

                if ($item_query_query->num_rows()) {
                    $order_data[$i][TAG_ITEMS_LIST] = $item_query_query->result();
                }
                $i++;
            }

            $response[TAG_ORDER_LIST] = $order_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ORDER_LIST] = null;
        }
        return $response;
    }

    function deliveryBoyProfileEdit($where_data, $update_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select(TAG_EMAIL_ID);
        $validate_email_qury = $this->db->get_where('delivery_boy', array(TAG_EMAIL_ID => $update_data[TAG_EMAIL_ID]));
        if ($validate_email_qury->num_rows()) {
            $output[TAG_ERROR_STRING] = "Email Id Already Exist";
        } else {
            $this->db->where($where_data);
            $update_query = $this->db->update('delivery_boy', $update_data);

            if ($update_query) {
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            }
        }
        return $output;
    }

    /*-----------------------------------------------DELIVERY BOY APIS----------------------------------*/

    function forgotPasswordSendOtp($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $query = $this->db->get('user_info');
        if ($query->num_rows()) {
            $row = $query->row();

            $user_update_data[TAG_OTP] = $this->UtilityModels->generateNumericOTP(6);
            $user_where_data[TAG_USER_ID] = $row->userId;
            $this->db->where($user_where_data);
            $upd_query = $this->db->update('user_info', $user_update_data);
            if ($upd_query) {
                $email_id = $where_data[TAG_EMAIL_ID];
                $this->UtilityModels->sendOtpToMail($user_update_data[TAG_OTP], $email_id);
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                $output[TAG_USER_ID] = $row->userId;
            } else {
                $output[TAG_ERROR_STRING] = "Something went Wrong";
            }
        } else {
            $output[TAG_ERROR_STRING] = "No Account found";
        }

        return $output;
    }

    function forgotPasswordSubmitOtp($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where($where_data);
        $query = $this->db->get('user_info');
        if ($query->num_rows()) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $output[TAG_ERROR_STRING] = "OTP doesn't match";
        }
        return $output;
    }

    function resetPasswordSubmit($where_data, $update_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->where($where_data);
        $query = $this->db->update('user_info', $update_data);
        if ($query) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function getCurrentOrderStatus($where_data)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ACTIVE_ORDER] = 0;
        $where_in_data = array(TAG_ORDER_STATUS_ASSIGNED, TAG_ORDER_STATUS_RECEIVED);
        $this->db->select(TAG_ORDER_ID);
        $this->db->where($where_data);
        $this->db->where_in(TAG_ORDER_STATUS, $where_in_data);
        $order_query = $this->db->get('order_summary');

        if ($order_query->num_rows()) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response[TAG_ACTIVE_ORDER] = 1;
        }
        return $response;
    }

    function getCurrentOrderDetails($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $where_in_data = array(TAG_ORDER_STATUS_ASSIGNED, TAG_ORDER_STATUS_RECEIVED);
        $data = null;


        $this->db->select("order_summary.*,address.houseName,address.fullAddress,address.landmark,address.pinCode");
        $this->db->from('order_summary');
        $this->db->join('address', 'order_summary.addressId=address.addressId', 'left');
        $this->db->where('order_summary.userId', $where_data[TAG_USER_ID]);
        $this->db->where_in('order_summary.orderStatus', $where_in_data);

        $query = $this->db->get();
        if ($query->num_rows()) {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_ORDER_HASH_ID] = $row->orderHashId;
            $data[TAG_SHOP_NAME] = $row->shopName;
            $data[TAG_ORDER_STATUS] = $row->orderStatus;
            $data[TAG_TOTAL_AMOUNT] = $row->totalAmount;
            $data[TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
            $data[TAG_GST] = $row->gst;
            $data[TAG_PACKING_CHARGE] = $row->packingCharge;
            $data[TAG_DELIVERY_FEE] = $row->deliveryFee;
            $data[TAG_DISCOUNT_AMOUNT] = $row->discountAmount;
            $data[TAG_ENTRY_DATE] = $row->entryDate;
            $data[TAG_FULL_ADDRESS] = $row->fullAddress;
            $data[TAG_PIN_CODE] = $row->pinCode;
            $data[TAG_LANDMARK] = $row->landmark;
            $data[TAG_HOUSE_NAME] = $row->houseName;
            $data[TAG_DELIVERY_TIME] = $row->deliveryTime;
            $data[TAG_SHIPPING_TYPE] = $row->shippingType;
            $data[TAG_ITEMS_LIST] = null;

            $item_where_data[TAG_ORDER_ID] = $row->orderId;
            $this->db->select("itemName,quantity,amount");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get('order_details');

            if ($item_query_query->num_rows()) {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }
            $this->db->select("o_sh.*,DATE_FORMAT(o_sh.entryDate,'%a,%D %b %y  %r') as shEntryDate, os.*");
            $this->db->from('order_shipping o_sh');
            $this->db->join('order_summary os', 'os.orderId = o_sh.orderId', 'LEFT');
            $this->db->where('o_sh.orderId', $row->orderId);
            $this->db->order_by('orderShippingId');
            $query = $this->db->get();
            $data[TAG_ORDER_SHIPPING_DETAILS] = null;
            if ($query->num_rows()) {
                $data[TAG_ORDER_SHIPPING_DETAILS] = $query->result();
            }


            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

    function getCurrentOrderDetailsBKP($where_data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $where_in_data = array(TAG_ORDER_STATUS_ASSIGNED, TAG_ORDER_STATUS_RECEIVED);
        $data = null;


        $this->db->select("order_summary.orderId,order_summary.shopName,order_summary.orderStatus,order_summary.paymentAmount,order_summary.entryDate");
        $this->db->where($where_data);
        $this->db->where_in(TAG_ORDER_STATUS, $where_in_data);
        $query = $this->db->get('order_summary');
        if ($query->num_rows()) {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_SHOP_NAME] = $row->shopName;
            $data[TAG_ORDER_STATUS] = $row->orderStatus;
            $data[TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
            $data[TAG_ENTRY_DATE] = $row->entryDate;
            $data[TAG_ITEMS_LIST] = null;

            $item_where_data[TAG_ORDER_ID] = $row->orderId;
            $this->db->select("itemName,quantity");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get('order_details');

            if ($item_query_query->num_rows()) {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

    function getSyncData($user_id)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;


        $response = $this->getCart($user_id);



        $this->db->select('*');
        $this->db->from('shops');
        $this->db->order_by('shops.shopPriority', "asc");
        //$this->db->where('shops.active',1);
        $this->db->where('shops.publishFlag', 1);
        $shop_query = $this->db->get();

        if ($shop_query->num_rows()) {
            $response[TAG_SHOPS_LIST] = $shop_query->result();
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        $this->db->select('items.*,shops.name as shopName');
        $this->db->from('items');
        $this->db->join('shops', 'items.shopId=shops.shopId', 'left');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->where('items.availabilityStatus', 1);
        $this->db->where('shops.active', 1);
        $this->db->where('shops.publishFlag', 1);
        $item_query = $this->db->get();

        /*$this->db->where(TAG_AVAILABILITY_STATUS,1);
        $item_query = $this->db->get('items');*/

        if ($item_query->num_rows()) {
            $response[TAG_ALL_ITEMS] = $item_query->result();
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        $db_version_res = $this->getDbVersion();
        $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

        $app_version_res = $this->getAppVersion();
        $response[TAG_APP_VERSION_CODE] = $app_version_res[TAG_APP_VERSION_CODE];

        $this->db->select("*");
        $where_data_banner['status'] = 1;
        $this->db->where($where_data_banner);
        $banner_query = $this->db->get('banner');

        if ($banner_query->num_rows()) {
            $response[TAG_BANNER_LIST] = $banner_query->result();
        }
        return $response;
    }

    function androidGetSyncData($user_id)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $response = $this->getCart($user_id);

        $this->db->select('*');
        $this->db->from('shops');
        $this->db->order_by('shops.shopPriority', "asc");
        //$this->db->where('shops.active',1);
        $this->db->where('shops.publishFlag', 1);
        $shop_query = $this->db->get();

        if ($shop_query->num_rows()) {
            $response[TAG_SHOPS_LIST] = $shop_query->result();
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        $this->db->select('items.*,shopCategoryId,shops.name as shopName');
        $this->db->from('items');
        $this->db->join('shops', 'items.shopId=shops.shopId', 'left');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->where('items.availabilityStatus', 1);
        $this->db->where('shops.active', 1);
        $this->db->where('shops.publishFlag', 1);
        $item_query = $this->db->get();

        /*$this->db->where(TAG_AVAILABILITY_STATUS,1);
        $item_query = $this->db->get('items');*/

        if ($item_query->num_rows()) {
            $response[TAG_ALL_ITEMS] = $item_query->result();
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        $db_version_res = $this->getDbVersion();
        $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

        $app_version_res = $this->getAndroidAppVersion();
        $response[TAG_ANDROID_APP_VERSION_CODE] = $app_version_res[TAG_ANDROID_APP_VERSION_CODE];

        $this->db->select("*");
        $where_data_banner['status'] = 1;
        $this->db->where($where_data_banner);
        $banner_query = $this->db->get('banner');

        if ($banner_query->num_rows()) {
            $response[TAG_BANNER_LIST] = $banner_query->result();
        }
        return $response;
    }

    function getDbVersion()
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response["versionCode"] = "0";
        $qry = $this->db->get('db_version');

        if ($qry->num_rows()) {
            $row = $qry->row();
            $version = $row->versionCode;
            $response["versionCode"] = $version;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        return $response;
    }

    function getAppVersion()
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_APP_VERSION_CODE] = "0";
        $qry = $this->db->get('app_version');

        if ($qry->num_rows()) {
            $row = $qry->row();
            $version = $row->appVersionCode;
            $response[TAG_APP_VERSION_CODE] = $version;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        return $response;
    }

    function updateVersionCde()
    {
        $version = 0;
        $qry = $this->db->get('db_version');

        if ($qry->num_rows()) {
            $row = $qry->row();
            $version = $row->versionCode;
        }

        echo  $version;

        $add_value = 0.1;
        $this->db->set('versionCode', 'versionCode+' . $add_value, false);
        $result = $this->db->update('db_version');
    }

    function getDbVersionAndSyncData($user_id, $local_db_version_code)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $qry = $this->db->get('db_version');

        if ($qry->num_rows()) {

            $row = $qry->row();
            $current_db_version = $row->versionCode;
            if ($current_db_version != $local_db_version_code) {
                $response = $this->getCart($user_id);

                $this->db->select('*');
                $this->db->from('shops');
                $this->db->order_by('shops.shopPriority', "asc");
                //$this->db->where('shops.active',1);
                $this->db->where('shops.publishFlag', 1);
                $shop_query = $this->db->get();

                if ($shop_query->num_rows()) {
                    $response[TAG_SHOPS_LIST] = $shop_query->result();
                    $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }

                $this->db->select('items.*,shopCategoryId,shops.name as shopName');
                $this->db->from('items');
                $this->db->join('shops', 'items.shopId=shops.shopId', 'left');
                $this->db->order_by('items.itemPriority', "asc");
                $this->db->where('items.availabilityStatus', 1);
                $this->db->where('shops.active', 1);
                $this->db->where('shops.publishFlag', 1);
                $item_query = $this->db->get();

                /*$this->db->where(TAG_AVAILABILITY_STATUS,1);
                $item_query = $this->db->get('items');*/

                if ($item_query->num_rows()) {
                    $response[TAG_ALL_ITEMS] = $item_query->result();
                    $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }

                $db_version_res = $this->getDbVersion();
                $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

                $this->db->select("*");
                $where_data_banner['status'] = 1;
                $this->db->where($where_data_banner);
                $banner_query = $this->db->get('banner');

                if ($banner_query->num_rows()) {
                    $response[TAG_BANNER_LIST] = $banner_query->result();
                }
            }
        }
        $app_version_res = $this->getAppVersion();
        $response[TAG_APP_VERSION_CODE] = $app_version_res[TAG_APP_VERSION_CODE];

        return $response;
    }

    function androidGetDbVersionAndSyncData($user_id, $local_db_version_code)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $qry = $this->db->get('db_version');

        if ($qry->num_rows()) {

            $row = $qry->row();
            $current_db_version = $row->versionCode;
            if ($current_db_version != $local_db_version_code) {
                $response = $this->getCart($user_id);

                $this->db->select('*');
                $this->db->from('shops');
                $this->db->order_by('shops.shopPriority', "asc");
                //$this->db->where('shops.active',1);
                $this->db->where('shops.publishFlag', 1);
                $shop_query = $this->db->get();

                if ($shop_query->num_rows()) {
                    $response[TAG_SHOPS_LIST] = $shop_query->result();
                    $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }

                $this->db->select('items.*,shopCategoryId,shops.name as shopName');
                $this->db->from('items');
                $this->db->join('shops', 'items.shopId=shops.shopId', 'left');
                $this->db->order_by('items.itemPriority', "asc");
                $this->db->where('items.availabilityStatus', 1);
                $this->db->where('shops.active', 1);
                $this->db->where('shops.publishFlag', 1);
                $item_query = $this->db->get();

                /*$this->db->where(TAG_AVAILABILITY_STATUS,1);
                $item_query = $this->db->get('items');*/

                if ($item_query->num_rows()) {
                    $response[TAG_ALL_ITEMS] = $item_query->result();
                    $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                }

                $db_version_res = $this->getDbVersion();
                $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

                $this->db->select('*');
                $where_data_banner['status'] = 1;
                $this->db->where($where_data_banner);
                $banner_query = $this->db->get('banner');

                if ($banner_query->num_rows()) {
                    $response[TAG_BANNER_LIST] = $banner_query->result();
                }
            }
        }
        $app_version_res = $this->getAndroidAppVersion();

        $response[TAG_ANDROID_APP_VERSION_CODE] = $app_version_res[TAG_ANDROID_APP_VERSION_CODE];
        return $response;
    }

    function validateItemBeforeCart($shop_id, $item_id)
    {
        $this->db->select('shopId');
        $this->db->where(TAG_SHOP_ID, $shop_id);
        $this->db->where(TAG_ACTIVE, 1);
        $this->db->where(TAG_PUBLISH_FLAG, 1);
        $shop_query = $this->db->get('shops');

        if ($shop_query->num_rows()) {
            $this->db->select('itemId');
            $this->db->where(TAG_ITEM_ID, $item_id);
            $this->db->where(TAG_AVAILABILITY_STATUS, 1);
            $item_query = $this->db->get('items');

            if ($item_query->num_rows()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    function cartDeleteInactiveItem($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        //$data[TAG_CART_ID] = $this->UtilityModels->get_id('cart', TAG_CART_ID);
        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $where_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];

        $query_delete = $this->db->delete('cart', $where_data);
        if ($query_delete) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }

    function calculateDeliveryAmount($shop_id, $latitude, $longitude)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $query = $this->db->query("SELECT shopId, deliveryFee, deliveryBaseAmount, deliveryFeeBaseKM, latitude,longitude,IFNULL((6371 * acos (cos ( radians($latitude) )* cos( radians( latitude ) )* cos( radians( longitude ) - radians($longitude) )+ sin ( radians($latitude) )* sin( radians( latitude ) ))),0) AS Distance FROM `shops`  where `shopId` = $shop_id  HAVING  Distance >= 0  ORDER BY Distance");

        if ($query->num_rows()) {
            $row = $query->row();
            $deliveryFee = $row->deliveryFee;
            $deliveryBaseAmount = $row->deliveryBaseAmount;
            $deliveryFeeBaseKM = $row->deliveryFeeBaseKM;
            $Distance = $row->Distance + 1;

            if ($Distance > $deliveryFeeBaseKM) {
                $km_diff = $Distance - $deliveryFeeBaseKM;

                $deliveryFee  += ($km_diff * $deliveryBaseAmount);
            }

            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $data[TAG_DELIVERY_FEE] = round($deliveryFee);
            $output[TAG_DELIVERY_FEE_DETAILS] = $data;
        }

        return $output;
    }

    function getAndroidAppVersion()
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_APP_VERSION_CODE] = "0";
        $qry = $this->db->get('app_version');

        if ($qry->num_rows()) {
            $row = $qry->row();
            $version = $row->androidAppVersionCode;
            $response[TAG_ANDROID_APP_VERSION_CODE] = $version;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }

        return $response;
    }



    function insert_login_otp($mobile)
    {
        $data[TAG_OTP] =  $this->UtilityModels->generateNumericOTP(6);
        $this->db->where('mobile', $mobile);
        $result =  $this->db->get('user_info');
        $output['otpSentStatus'] = 0;

        if ($result->num_rows() > 0) {
            $row = $result->row();
            if ($row->otpSentCount >= 3) {
                $output['error_string'] = "You’ve reached the maximum attempts. Exit your browser and try again.";
            } else {
                $output['otpSentStatus'] =  $this->UtilityModels->login_sent_otp($data[TAG_OTP], $mobile);
                if ($output['otpSentStatus']) {
                    $this->db->set('otpSentCount', 'otpSentCount+1', false);
                    $this->db->where('mobile', $mobile);
                    $output['insertStatus'] = $this->db->update('user_info', $data);
                }
            }
        } else {

            $data[TAG_MOBILE] = $mobile;
            $output['otpSentStatus'] =  $this->UtilityModels->login_sent_otp($data[TAG_OTP], $mobile);
            if ($output['otpSentStatus']) {
                $output['insertStatus'] = $this->db->insert('user_info', $data);
            }
        }


        return $output;
    }

    function reset_login_otp($mobile, $otp)
    {
        $this->db->where('mobile', $mobile);
        $this->db->where('otp', $otp);
        $result =  $this->db->get('user_info');

        if ($result->num_rows() > 0) {
            $this->db->set('otp', '');
            $this->db->set('otpSentCount', 0);
            $this->db->where('mobile', $mobile);
            $this->db->update('user_info');
            $output['loginStatus'] = 1;
        } else {
            $output['loginStatus'] = 0;
        }
    }

    function login_home($mobile)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('userId, name, emailId, mobile, addressId, currentShopGst');
        $this->db->where(TAG_MOBILE, $mobile);
        $query = $this->db->get('user_info');

        if ($query->num_rows()) {
            $user_row = $query->row();
            $user_id = $user_row->userId;
            //$active_restaurant_id = $user_row->activeRestaurantId;

            $profile_data[TAG_USER_ID] = $user_id;
            $profile_data[TAG_NAME] = $user_row->name;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_ADDRESS_ID] = $user_row->addressId;

            $gst_data[TAG_GST_STATUS] = 0;

            if ($user_row->currentShopGst != -1) {
                $gst_data[TAG_GST_STATUS] = 1;
                $gst_data[TAG_CURRENT_SHOP_GST] = $user_row->currentShopGst;
            }
            $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 1);

            $response[TAG_USER] = $profile_data;
            $response[TAG_GST_DATA] = $gst_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Incorrect  Mobile Number..";
        }
        return $response;
    }
    function validate_coupon_code($post_data)
    {

        $response[TAG_RESPONSE_DATA_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_DATA_ERROR_STRING] = "Invalid coupon";
        $coupon_where = array(
            TAG_SHOP_ID => $post_data[TAG_SHOP_ID],
            TAG_COUPON_STATUS => 1,
            TAG_COUPON_CODE => $post_data[TAG_COUPON_CODE],

        );

        $this->db->where($coupon_where);
        $coupon_result = $this->db->get('coupon_code');
        $coupon_data = $coupon_result->row();
        if ($coupon_result->num_rows()) {
            if ($coupon_data->couponType == 2) {
                $user_where_data = array(TAG_USER_ID => $post_data[TAG_USER_ID]);
                $this->db->where($user_where_data);
                $user_data = $this->db->get('user_info');
                $user_order_count = $user_data->row()->orderCount;
                if ($coupon_data->numberOfOrders > $user_order_count) {
                    if ($coupon_data->orderCountType == 0) {
                        $response =  $this->calculate_discount_amount($post_data[TAG_TOTAL_AMOUNT], $coupon_data->minPurchaseAmount, $coupon_data->maxDiscountAmount, $coupon_data->couponFixedAmount, 0);
                    } elseif ($coupon_data->orderCountType == 1) {
                        $response = $this->calculate_discount_amount($post_data[TAG_TOTAL_AMOUNT], $coupon_data->minPurchaseAmount, $coupon_data->maxDiscountAmount, $coupon_data->couponPercentage, 1);
                    } elseif ($coupon_data->orderCountType == 2) {
                        $response = array(TAG_RESPONSE_DATA_STATUS => HTTP_SUCCESS_RESPONSE, TAG_COUPON_DISCOUNT_AMOUNT => -1,);
                    }
                } else {
                    $response[TAG_DATA_ERROR_STRING] = "Invalid coupon";
                }
            } else if ($coupon_data->couponType == 0) {
                $response = $this->calculate_discount_amount($post_data[TAG_TOTAL_AMOUNT], $coupon_data->minPurchaseAmount, $coupon_data->maxDiscountAmount, $coupon_data->couponFixedAmount, 0);
            } else if ($coupon_data->couponType == 1) {

                $response = $this->calculate_discount_amount($post_data[TAG_TOTAL_AMOUNT], $coupon_data->minPurchaseAmount, $coupon_data->maxDiscountAmount, $coupon_data->couponPercentage, 1);
            }
        }
        return $response;
    }

    function calculate_discount_amount($total_amount, $minPurchaseAmount, $maxDiscountAmount, $coupon_value, $couponType)
    {
        if ($minPurchaseAmount < $total_amount) {

            if ($couponType == 0) {
                $response[TAG_COUPON_DISCOUNT_AMOUNT] = $coupon_value;
                $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
            } elseif ($couponType == 1) {

                $couponPercentageValue = (($total_amount * $coupon_value) / 100);
                if ($couponPercentageValue >  $maxDiscountAmount) {
                    $couponPercentageValue = $maxDiscountAmount;
                }
                $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
                $response[TAG_COUPON_DISCOUNT_AMOUNT] = $couponPercentageValue;
            } elseif ($couponType == 2) {
                $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
                $response[TAG_COUPON_DISCOUNT_AMOUNT] = -1;
            }
        } else {
            $response[TAG_RESPONSE_DATA_STATUS] = HTTP_FAILURE_RESPONSE;
            $response[TAG_DATA_ERROR_STRING] = "To get discount Minimum order amount should be greater than " . $minPurchaseAmount;
        }
        return $response;
    }


    function login_with_number($mobile)
    {
        date_default_timezone_set("Asia/Kolkata");
        $response[TAG_RESPONSE_DATA_STATUS] = HTTP_FAILURE_RESPONSE;
        $response['new_user'] = 0;
        $response['otpSentStatus'] = 0;
        $this->db->select('*');
        $this->db->where(TAG_MOBILE, $mobile);
        $result = $this->db->get('user_info');
        $data[TAG_OTP] =  $this->UtilityModels->generateNumericOTP(6);
        if ($result->num_rows() == 0) {
            $data[TAG_MOBILE] = $mobile;
            $data[TAG_OTP_SENT_COUNT] = 0;
            $otp_sent_flag = $this->UtilityModels->login_sent_otp($data[TAG_OTP], $mobile);
            if ($otp_sent_flag) {
                $response['otpSentStatus'] = $otp_sent_flag;
                if ($this->db->insert('user_info', $data))
                    $response['insertStatus'] = true;
                // $response[TAG_USER_ID] = $this->db->insert_id();
                $response[TAG_NEW_USER] = 1;
                $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
            }
        } else {

            $user_row = $result->row();
            if (!$user_row->name) {
                $response[TAG_NEW_USER] = 1;
            }
            // $response[TAG_USER_ID] = $user_row->userId;
            /* OTP sending will stop is otpSendCount is greater than 3 */

            if (($user_row->otpSentCount >= 3)) {
                if (strtotime($user_row->otpLimitExceededTime) + 300 > strtotime(date('Y-m-d H:i:s'))) {
                    $response['error_string'] = "You’ve reached the maximum attempts. Please try after sometime.";
                } else {
                    $otp_sent_flag = $this->UtilityModels->login_sent_otp($data[TAG_OTP], $mobile);
                    if ($otp_sent_flag) {
                        $response['otpSentStatus'] = $otp_sent_flag;
                        $data[TAG_OTP_SENT_COUNT] = 0;
                        $this->db->where('mobile', $mobile);
                        $response['insertStatus'] = $this->db->update('user_info', $data);
                    }
                }
            } else {
                $response['otpSentStatus'] =  $this->UtilityModels->login_sent_otp($data[TAG_OTP], $mobile);
                if ($response['otpSentStatus']) {
                    if ($user_row->otpSentCount == 2) {
                        $data[TAG_OTP_LIMIT_EXCEEDED_TIME] = date('Y-m-d H:i:s');
                    }
                    $this->db->set('otpSentCount', 'otpSentCount+1', false);
                    $this->db->where('mobile', $mobile);
                    $response['insertStatus'] = $this->db->update('user_info', $data);
                }
            }
            $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $response;
    }

    function validate_otp_and_mobile($mobile, $otp, $isAndroid)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('userId, name, emailId, mobile, addressId, currentShopGst');
        $this->db->where(TAG_MOBILE, $mobile);
        if ($otp != 192021) { //For Testing purpose
            $this->db->where(TAG_OTP, $otp);
        }
        $query = $this->db->get('user_info');
        if ($query->num_rows()) {
            $auth_string = $this->UtilityModels->generateRandomString();
            $token = $this->UtilityModels->generateToken($mobile);
            $this->db->set('otp', '');
            $this->db->set('otpSentCount', 0);
            $this->db->set('authString', $auth_string);
            $this->db->set('token', $token);
            $this->db->where('mobile', $mobile);
            $this->db->update('user_info');
            $user_row = $query->row();
            $user_id = $user_row->userId;
            //$active_restaurant_id = $user_row->activeRestaurantId;

            $profile_data[TAG_USER_ID] = $user_id;
            $profile_data[TAG_NAME] = $user_row->name;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_ADDRESS_ID] = $user_row->addressId;

            $gst_data[TAG_GST_STATUS] = 0;

            if ($user_row->currentShopGst != -1) {
                $gst_data[TAG_GST_STATUS] = 1;
                $gst_data[TAG_CURRENT_SHOP_GST] = $user_row->currentShopGst;
            }
            if ($isAndroid) {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 1);  //TODO 1 for android and 0 for IOS
            } else {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 0);  //TODO 1 for android and 0 for IOS
            }
            $response[TAG_NEW_USER] = 0;
            if (!$user_row->name) {
                $response[TAG_NEW_USER] = 1;
            }
            $response[TAG_TOKEN] = $token;
            $response[TAG_AUTH_STRING] = $auth_string;
            $response[TAG_USER] = $profile_data;
            $response[TAG_GST_DATA] = $gst_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "OTP is Incorrect OR Invalid..";
        }
        return $response;
    }



    function fetch_all_home_data($isAndroid)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->select('*');
        $this->db->from('shops');
        $this->db->order_by('shops.shopPriority', "asc");
        //$this->db->where('shops.active',1);
        $this->db->where('shops.publishFlag', 1);
        $shop_query = $this->db->get();

        if ($shop_query->num_rows()) {
            $response[TAG_SHOPS_LIST] = $shop_query->result();
        }
        $item_query = $this->db->query("SELECT `items`.*,`shops`.`shopCategoryId`,`shops`.`name` as `shopName` FROM `items` LEFT JOIN `shops` ON `items`.`shopId`=`shops`.`shopId` WHERE `items`.`availabilityStatus` = 1 AND `shops`.`active` = 1 AND `shops`.`publishFlag` = 1 ORDER BY `items`.`itemPriority` ASC");

        if ($item_query->num_rows()) {
            $response[TAG_ALL_ITEMS] = $item_query->result();
        }

        $response[TAG_SHOP_CATEGORY_LIST] = null;
        $this->db->where('activeFlag', 'ACTIVE');
        $this->db->order_by('priority');
        $shop_category_query = $this->db->get('shop_category');
        if ($shop_category_query->num_rows()) {
            $response[TAG_SHOP_CATEGORY_LIST] = $shop_category_query->result();
        }


        $response[TAG_ALL_CATEGORIES] = null;


        $all_category_query = $this->db->get('category');

        if ($all_category_query->num_rows()) {
            $response[TAG_ALL_CATEGORIES] = $all_category_query->result();
        }
        $db_version_res = $this->getDbVersion();
        $response[TAG_VERSION_CODE] = $db_version_res[TAG_VERSION_CODE];

        if ($isAndroid == 1) {
            $app_version_res = $this->getAndroidAppVersion();
            $response[TAG_ANDROID_APP_VERSION_CODE] = $app_version_res[TAG_ANDROID_APP_VERSION_CODE];
        } else {
            $app_version_res = $this->getAppVersion();
            $response[TAG_APP_VERSION_CODE] = $app_version_res[TAG_APP_VERSION_CODE];
        }



        $this->db->select("*");
        $where_data_banner['status'] = 1;
        $this->db->where($where_data_banner);
        $this->db->order_by('bannerPriority');
        $banner_query = $this->db->get('banner');
        $response[TAG_BANNER_LIST] = $banner_query->result();


        return $response;
    }


    function outer_get_specific_shop_items($shop_id)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $this->db->where(TAG_SHOP_ID, $shop_id);
        $all_item_query = $this->db->get('items');

        if ($all_item_query->num_rows()) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response[TAG_ALL_CATEGORIES] = null;
            //$response[TAG_ALL_ITEMS] = $all_item_query->result();
            $this->db->where(TAG_SHOP_ID, $shop_id);
            $all_category_query = $this->db->get('category');

            if ($all_category_query->num_rows()) {
                $response[TAG_ALL_CATEGORIES] = $all_category_query->result();
            }
        }
        return $response;
    }


    function all_data_with_token($token, $isAndroid)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->select('userId, name, emailId, mobile, addressId, currentShopGst');
        $this->db->where(TAG_TOKEN, $token);
        $query = $this->db->get('user_info');
        if ($query->num_rows()) {
            $user_row = $query->row();

            $user_id = $user_row->userId;
            //$active_restaurant_id = $user_row->activeRestaurantId;

            $profile_data[TAG_USER_ID] = $user_id;
            $profile_data[TAG_NAME] = $user_row->name;
            $profile_data[TAG_EMAIL_ID] = $user_row->emailId;
            $profile_data[TAG_MOBILE] = $user_row->mobile;
            $profile_data[TAG_ADDRESS_ID] = $user_row->addressId;

            $gst_data[TAG_GST_STATUS] = 0;

            if ($user_row->currentShopGst != -1) {
                $gst_data[TAG_GST_STATUS] = 1;
                $gst_data[TAG_CURRENT_SHOP_GST] = $user_row->currentShopGst;
            }
            if ($isAndroid) {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 1);  //TODO 1 for android and 0 for IOS
            } else {
                $response = $this->get_basic_dashboard($user_id, $user_row->addressId, 0);  //TODO 1 for android and 0 for IOS
            }
            $response[TAG_NEW_USER] = 0;
            if (!$user_row->name) {
                $response[TAG_NEW_USER] = 1;
            }
            $response[TAG_TOKEN] = $token;
            $response[TAG_USER] = $profile_data;
            $response[TAG_GST_DATA] = $gst_data;
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "OTP is Incorrect OR Invalid..";
        }
        return $response;
    }
    function edit_user_profile($token, $user_name)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ERROR_STRING] = "User details didn't updated try again !";
        $this->db->where('token', $token);
        $this->db->set('name', $user_name);
        $update_status = $this->db->update('user_info');
        if ($update_status) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response[TAG_ERROR_STRING] = "";
        }
    }

    function get_language()
    {
        $result = $this->db->get('language')->result();

        $english_result['language'] = "English";
        foreach ($result as $val) {

            $index_name = $val->english;
            $translate[$index_name] = $val->english;
        }
        $english_result['translate'] = $translate;
        $content['content'][] = $english_result;


        $english_result['language'] = 'Malayalam';
        foreach ($result as $val) {

            $index_name = $val->english;
            $translate[$index_name] = $val->malayalam;
        }
        $english_result['translate'] = $translate;
        $content['content'][] = $english_result;


        $english_result['language'] = 'Hindi';
        foreach ($result as $val) {

            $index_name = $val->english;
            $translate[$index_name] = $val->hindi;
        }
        $english_result['translate'] = $translate;
        $content['content'][] = $english_result;

        $english_result['language'] = 'Bengali';
        foreach ($result as $val) {

            $index_name = $val->english;
            $translate[$index_name] = $val->bengali;
        }
        $english_result['translate'] = $translate;
        $content['content'][] = $english_result;


        $english_result['language'] = 'Tamil';
        foreach ($result as $val) {

            $index_name = $val->english;
            $translate[$index_name] = $val->tamil;
        }
        $english_result['translate'] = $translate;
        $content['content'][] = $english_result;

        return $content;
    }

    function demo_user_number_validation($mobile)
    {
        $where_data['mobile'] = $mobile;
        $where_data['isActive'] = 'Active';
        $demo_user =  $this->db->get_where('demo_users', $where_data);
        $this->db->where('mobile', $mobile);
        $user_data = $this->db->get('user_info');
        $isTimeNotExpired = false;
        log_message('error', 'log messsage by ajith');
        if (($user_data->num_rows() > 0) && ($demo_user->num_rows() > 0)) {
            $startTime = strtotime($user_data->row()->entryDate);
            $endTime = strtotime(date('Y-m-d H:i:s'));
            $time = abs($startTime - $endTime);
            $minutes = floor($time / 60);

            $explode_time = explode(':', $demo_user->row()->demoTime);
            $hour_to_min = ($explode_time[0] * 60);
            $demoMinutes = $hour_to_min + $explode_time[1];

            if ($demoMinutes > $minutes) {
                $isTimeNotExpired = true;
            }
        }
        if (($demo_user->num_rows() > 0) && $isTimeNotExpired) {
            return true;
        } else {
            return false;
        }
    }


    function demo_user_token_validation($token)
    {

        $this->db->where('token', $token);
        $user_data = $this->db->get('user_info');
        $isTimeNotExpired = false;
        if ($user_data->num_rows() > 0) {
            $where_data['mobile'] = $user_data->row()->mobile;
            $where_data['isActive'] = 'Active';
            $demo_user =  $this->db->get_where('demo_users', $where_data);
            $startTime = strtotime($user_data->row()->entryDate);
            $endTime = strtotime(date('Y-m-d H:i:s'));
            $time = abs($startTime - $endTime);
            $minutes = floor($time / 60);

            $explode_time = explode(':', $demo_user->row()->demoTime);
            $hour_to_min = ($explode_time[0] * 60);
            $demoMinutes = $hour_to_min + $explode_time[1];

            if ($demoMinutes > $minutes) {
                $isTimeNotExpired = true;
            }
        }
        if (($demo_user->num_rows() > 0) && $isTimeNotExpired) {
            return true;
        } else {
            return false;
        }
    }
    function demo_user_registration_number_validation($mobile)
    {
        $where_data['mobile'] = $mobile;
        $where_data['isActive'] = 'Active';
        $demo_user =  $this->db->get_where('demo_users', $where_data);
        if ($demo_user->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function getOrderDetails($order_id)
    {

        $order_data = "";
        $this->db->select('*');
        $this->db->where(TAG_ORDER_ID, $order_id);
        $query = $this->db->get('order_summary');
        if ($query->num_rows() > 0) {

            $order_data = $query->row();
        }
        return $order_data;
    }
    function getDeliveryBoyDetails($order_id)
    {

        $delivery_boy_data = "";
        $this->db->select('*');
        $this->db->where(TAG_DELIVERY_BOY_ID, $order_id);
        $query = $this->db->get('delivery_boy');
        if ($query->num_rows() > 0) {

            $delivery_boy_data = $query->row();
        }
        return $delivery_boy_data;
    }

    function deliverySignUp($data)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ERROR_STRING] = "Please contact " . TAG_APP_NAME . " shop to become a delivery agent";
        $response[TAG_RESPONSE_DATA_STATUS] = HTTP_FAILURE_RESPONSE;
        $auth_string = $this->UtilityModels->generateRandomString();
        $token = $this->UtilityModels->generateToken($data[TAG_MOBILE]);
        // $this->db->set('authString', $auth_string);
        $this->db->where('mobile', $data[TAG_MOBILE]);

        $delivery_boy_mobile = $this->db->get('delivery_boy');
        log_message('error', 'dellivery--ajith' . print_r($delivery_boy_mobile->num_rows(), true));
        if ($delivery_boy_mobile->num_rows() > 0) {
            $response[TAG_ERROR_STRING] = "You have already signed-up";

            $this->db->where('mobile', $data[TAG_MOBILE]);
            $this->db->where('token IS NULL');
            $delivery_boy_result = $this->db->get('delivery_boy');

            if ($delivery_boy_result->num_rows() > 0) {
                $response[TAG_ERROR_STRING] = "";

                $this->db->set('firebaseToken', $data[TAG_FIREBASE_TOKEN]);
                $this->db->set('token', $token);
                $this->db->set('active', 1);
                $this->db->set('password', $data[TAG_PASSWORD]);
                $this->db->where('mobile', $data[TAG_MOBILE]);
                $update_result = $this->db->update('delivery_boy');
                if ($update_result) {
                    $this->db->select(TAG_TOKEN . ',deliveryBoyName,emailId,deliveryBoyId,mobile');
                    $this->db->where('mobile', $data[TAG_MOBILE]);
                    $result = $this->db->get('delivery_boy');
                    if ($result->num_rows() > 0) {
                        $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;

                        $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
                        $delivery_boy_details = $result->row();

                        $profile_data[TAG_DELIVERY_BOY_ID] = $delivery_boy_details->deliveryBoyId;
                        $profile_data[TAG_DELIVERY_BOY_NAME] = $delivery_boy_details->deliveryBoyName;
                        $profile_data[TAG_EMAIL_ID] = $delivery_boy_details->emailId;
                        $profile_data[TAG_MOBILE] = $delivery_boy_details->mobile;
                        $profile_data[TAG_TOKEN] = $token;

                        $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
                        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
                        $new_order_query = $this->db->get('order_summary');
                        $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

                        $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
                        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
                        $new_order_query = $this->db->get('order_summary');
                        $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

                        $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
                        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_CANCELLED);
                        $new_order_query = $this->db->get('order_summary');
                        $response[TAG_CANCELED_ORDERS] = $new_order_query->num_rows();


                        $this->db->where('os.' . TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
                        $this->db->select('sum(deliveryBoyCommission) as totalDeliveryCommission');
                        $this->db->from('delivery_boy dby');
                        $this->db->join('order_summary os', 'dby.deliveryBoyId=os.deliveryBoyId', 'left');
                        $delivery_commission = $this->db->get();
                        log_message('error', print_r($delivery_commission->num_rows(), true) . 'password_validation');
                        $response[TAG_DELIVERY_BOY_COMMISSION] = 0;

                        if ($delivery_commission->num_rows() > 0) {
                            $response[TAG_DELIVERY_BOY_COMMISSION] = $delivery_commission->row();
                        }

                        $response[TAG_USER] = $profile_data;
                    }
                }
            }
        }
        return $response;
    }

    function deliveryBoyTokenLogin($data)
    {
        $response[TAG_RESPONSE_DATA_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where('token', $data[TAG_TOKEN]);
        $this->db->select('mobile,token,deliveryBoyName,emailId,deliveryBoyId');
        $delivery_boy_data = $this->db->get('delivery_boy');
$response[TAG_DELIVERY_BOY_COMMISSION]['totalDeliveryCommission'] = strval(0);
        if ($delivery_boy_data->num_rows() > 0) {
 $response[TAG_RESPONSE_DATA_STATUS] = HTTP_SUCCESS_RESPONSE;
            $this->db->set('firebaseToken', $data[TAG_FIREBASE_TOKEN]);
            $this->db->where('token', $data[TAG_TOKEN]);
            $update_result = $this->db->update('delivery_boy');
            $delivery_boy_details = $delivery_boy_data->row();

            $profile_data[TAG_DELIVERY_BOY_ID] = $delivery_boy_details->deliveryBoyId;
            $profile_data[TAG_DELIVERY_BOY_NAME] = $delivery_boy_details->deliveryBoyName;
            $profile_data[TAG_EMAIL_ID] = $delivery_boy_details->emailId;
            $profile_data[TAG_MOBILE] = $delivery_boy_details->mobile;

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_CANCELLED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_CANCELED_ORDERS] = $new_order_query->num_rows();


            $this->db->where('os.' . TAG_DELIVERY_BOY_ID, $delivery_boy_details->deliveryBoyId);
            $this->db->select('sum(deliveryBoyCommission) as totalDeliveryCommission');
            $this->db->from('delivery_boy dby');
            $this->db->join('order_summary os', 'dby.deliveryBoyId=os.deliveryBoyId', 'left');
            $delivery_commission = $this->db->get();
            log_message('error', print_r($delivery_commission->row(), true) . 'totalDeliveryCommission');

            if ($delivery_commission->num_rows() > 0) {
                $response[TAG_DELIVERY_BOY_COMMISSION] = $delivery_commission->row();
            }

            $response[TAG_USER] = $profile_data;
        }
        return $response;
    }

    function deliveryBoyForgetPass($data)
    {

        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ERROR_STRING] = "Please enter the Email and phone number you provided when you signed up";
        $this->db->select('token,mobile');
        $this->db->where(TAG_EMAIL_ID, $data[TAG_EMAIL_ID]);
        $this->db->where(TAG_MOBILE, $data[TAG_MOBILE]);
        $this->db->where('token IS NOT NULL');
        $result = $this->db->get('delivery_boy');

        if ($result->num_rows() > 0) {

            $otp =  $this->UtilityModels->generateRandomOtp(6, $data[TAG_MOBILE]);
            $data[TAG_OTP] = $otp;
            $this->db->where(TAG_MOBILE, $data[TAG_MOBILE]);
            $update_result = $this->db->update('delivery_boy', $data);

            if ($update_result) {
                $user_data[TAG_TOKEN] = $result->row()->token;
                $user_data[TAG_MOBILE] = $result->row()->mobile;
                $response[TAG_USER] = $user_data;

                $this->UtilityModels->sendOtpToMail($otp, $data[TAG_EMAIL_ID]);
                //    $response = $this->UtilityModels->login_sent_otp($otp, $data[TAG_MOBILE]);
                $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            }
        }
        return $response;
    }

    function deliveryBoyPasswordResetOtpSubmit($data)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ERROR_STRING] = "Invalid otp. please enter a valid otp";

        $this->db->select('token');
        $this->db->where(TAG_OTP, $data[TAG_OTP]);
        $this->db->where(TAG_TOKEN, $data[TAG_TOKEN]);
        $this->db->where('token IS NOT NULL');
        $result = $this->db->get('delivery_boy');
        if ($result->num_rows() > 0) {
            $this->db->where(TAG_TOKEN, $data[TAG_TOKEN]);
            $this->db->set('otp', '');
            $this->db->update('delivery_boy');
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $response;
    }

    function deliveryBoySubmitNewPassword($data)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where(TAG_TOKEN, $data[TAG_TOKEN]);
        $update_data[TAG_PASSWORD] = $data[TAG_PASSWORD];
        $update_result = $this->db->update('delivery_boy', $update_data);
        if ($update_result) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $response;
    }
}
