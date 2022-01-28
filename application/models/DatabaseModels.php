<?php
defined('BASEPATH') or exit('No direct script access allowed');


class DatabaseModels extends CI_Model
{

    

    function item_details($limit)
    {
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->limit($limit);
        $data = $this->db->get();
        return $data->result();
    }


    

    function validate_login_session()
    {
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_logout()
    {
        if (!$this->validate_login_session()) {
            return TRUE;
        } else {
            $this->session->unset_userdata(TAG_FOODVENO_LOGIN_SESSION);
            return TRUE;
        }
    }

    function user_registration($post_data)
    {
      
        $auth_string = $this->UtilityModels->generateRandomString();
        $token = $this->UtilityModels->generateToken($post_data[TAG_PHONE]);

        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_PHONE => $post_data[TAG_PHONE],
            TAG_PASSWORD =>  md5($post_data[TAG_PASSWORD]),
            TAG_AUTHSTRING => $auth_string,
            TAG_TOKEN => $token
        );

       $result= $this->db->insert('user_info', $data);
       if($result){
           $user_id=$this->db->insert_id();
           $this->get_user_login_session($user_id,$post_data[TAG_NAME],$token);

       }
        
    }

    function get_user_details_for_login($post_data)
    {
        $mobile = $post_data['mobile'];
        $password = md5($post_data['password']);

        $this->db->select('*');
        $this->db->where('mobile', $mobile);
        $this->db->where('password', $password);
        $query = $this->db->get('user_info');
        $result['flag'] = false;
        if ($query->num_rows() == 0) {

            return $result;
        } else {
            $result['flag'] = true;
            $result['data'] = $query->result();
            return $result;
        }
    }

    function get_user_login_session($user_id,$name,$token)
    {
        $session_data = array(TAG_SESSION_ACTIVE_USER_ID => $user_id, TAG_SESSION_ACTIVE_USER_NAME => $name, TAG_SESSION_ACTIVE_TOKEN => $token,);
        $this->session->set_userdata(TAG_FOODVENO_LOGIN_SESSION, $session_data);
    }

    public function get_user_details()
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $this->db->select('name,emailId,mobile');
        $this->db->where('userId', $id);
        $query = $this->db->get('user_info');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_user_details($post_data)
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
        );

        $this->db->where('userId', $id);
        $this->db->update('user_info', $data);
    }

    function change_password($post_data)
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $password = $post_data['currentPassword'];
        $newPassword = $post_data['newPassword'];

        $this->db->where('userId', $id);
        $this->db->where('password', $password);
        $query = $this->db->get('user_info');

        if ($query->num_rows() > 0) {

            $data = array(
                TAG_PASSWORD => $newPassword
            );

            $this->db->where('userId', $id);
            $this->db->update('user_info', $data);

            if ($this->db->affected_rows() == 0) {
                echo 'Current Password is Incorrect';
            } else {
                echo 'Your Password is updated';
            }
        } else {
            echo 'Current Password is Incorrect';
        }
    }

    function add_address($post_data)
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $data = array(
            TAG_USER_ID => $id,
            TAG_HOUSE_NAME => $post_data[TAG_HOUSE_NAME],
            TAG_FULL_ADDRESS => $post_data[TAG_FULL_ADDRESS],
            TAG_LANDMARK => $post_data[TAG_LANDMARK],
            TAG_PINCODE => $post_data[TAG_PINCODE]
        );

        $this->db->insert('address', $data);
    }



    function cart_details()
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->select('ct.shopId,ct.itemId,it.name,ct.quantity,ct.cartGst,it.offerPrice,it.image,ct.cartId');
        $this->db->from('cart ct');
        $this->db->join('items it', 'ct.itemId=it.itemId');
        $this->db->where('ct.userId', $id);
        $data = $this->db->get();

        return $data->result();
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
            if($demo_user->num_rows() > 0){
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
            }else{
                return false;
            }
        }
        if (($demo_user->num_rows() > 0) && $isTimeNotExpired) {
            return true;
        } else {
            return false;
        }
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
                $output['cart_id'] = $this->db->insert_id();
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


    private function sendPushNotification($fields, $platform_type)
    {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=AAAAojWxlb8:APA91bFGBHmK6X4h6W9ZUOqn3u2qU7nZUr0CHGfaFxZD3b6GtPssrUP0QDQCFDfycGf8XoFmxkx01QgYKIEzZqn1xuaQH5M8BHdPG743V4c3-0k_COmQZBYdGsF0z858v7kEZBAIe-v-',
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }


    function cartDecrement($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;

        $res = $this->validateItemBeforeCart($data[TAG_SHOP_ID], $data[TAG_ITEM_ID]);
        if ($res) {

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
    function cart_total()
    {
        $user_id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->select('count(ct.cartId) as cartCount,sum(it.offerPrice*ct.quantity) as grandTotal');
        $this->db->from('cart ct');
        $this->db->join('items it', 'it.itemId=ct.itemId');
        $this->db->where('ct.userId', $user_id);
        $result= $this->db->get();
        return $result->row();

    }

    function deleteCartItem($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where('cartId', $data['cart_id']);
        $result = $this->db->delete('cart');
        if ($result) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        }
        return $output;
    }


    /* address model */

    function addAddress($data)
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
            $data[TAG_ADDRESS_STATUS] = 1;
            $query_insert = $this->db->insert('address', $data);

            if ($query_insert) {
                $addressId = (string)$this->db->insert_id();
                $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                $output[TAG_ADDRESS_ID] = $addressId;
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



    function placeOrder($data, $platform_type)
    {
        $this->db->trans_begin();
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $qry = false;
        $query_insert = $this->db->insert('order_summary', $data);
       
     

        if ($query_insert) {
            $order_id = (string)$this->db->insert_id();

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

                        $o_sh_insert_data[TAG_ORDER_ID] = $order_id;
                        $o_sh_insert_data[TAG_SHIPPING_SELLER_NAME] = $data[TAG_SHOP_NAME];
                        $o_sh_insert_data[TAG_ADDRESS] = $shop_details->address;
                        $o_sh_insert_data[TAG_PINCODE] = $shop_details->pinCode;
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_STATUS] = 'Ordered';
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_REMARKS] = 'Your Order has been placed.';
                        $o_sh_insert_data[TAG_PROGRESS_BAR_STATUS] = 'Received';
                        $o_sh_insert_data[TAG_ORDER_SHIPPING_PRIORITY] = 1;

                        $update_query1=  $this->db->insert('order_shipping', $o_sh_insert_data);



                        $subject = "Order Received";
                        $message = "You have new Order received, please check admin panel";

                        // $this->UtilityModels->sendMail($email_id, $message, $subject);

                        $data = array(
                            TAG_TITLE => "Order Received",
                            TAG_BODY => "You have new Order received, please check admin panel",
                            TAG_IMAGE=>"",
                        );

                        

                        $fields = array(
                            'notification' => array('body' => 'new Orders', 'title' => 'Title', 'image' => 'https://ebaazaarweb.com/images/grecery_banner1.jpg'),
                            'to' => '/topics/' . "adminNotification"
                        );

                     //   $this->sendPushNotification($fields, $platform_type);

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

    function cartCalculation()
    {
        $result = $this->db->get('shops');
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $total_amount = $this->cart_total();
        if ($result->num_rows() > 0) {
            
            $shop_data = $result->row();
            $output[TAG_SHOP_ID]=$shop_data->shopId;
            $output[TAG_SHOP_NAME]=$shop_data->name;
            $output[TAG_DELIVERY_FEE] = $shop_data->deliveryFee != NULL ? $shop_data->deliveryFee : 0;
            $output[TAG_SHOP_GST] = $shop_data->shopGst != NULL ? $shop_data->shopGst : 0;
            $output[TAG_PACKING_CHARGE] = $shop_data->packingCharge != NULL ? $shop_data->packingCharge : 0;
          
            $output['totalAmount'] = $total_amount->grandTotal;

	    $output['paymentAmount'] = ($total_amount->grandTotal + $output[TAG_DELIVERY_FEE] + ($output['totalAmount']*($output[TAG_SHOP_GST]/100)) + $output[TAG_PACKING_CHARGE]);
        }

	return $output;
    }

    function validate_emailId($email){
        $where_data['emailId']=$email;
     $result=$this->db->get_where('user_info',$where_data);
   
   
     if($result->num_rows()>0){
    return true;
    }
    return false;

    }
    function validate_mobile($mobile){
        $where_data['mobile']=$mobile;
     $result=$this->db->get_where('user_info',$where_data);

     if($result->num_rows()>0){
    return true;
    }
    return false;

    }

    function get_address(){
        $where_data['userId']=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->where($where_data);
        $result=$this->db->get('address');

        if($result->num_rows()>0){
            return $result->row();
        }
        return false;
        
            
    }

    function delete_address(){
        $where_data['userId']=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $this->db->where($where_data);

        $result=$this->db->delete('address');
     
        
        if( $result){
            return true;
        }
        return false;
    }

    function all_orders(){
        $where_data['userId']=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->where($where_data);
        $result=$this->db->get('address');
   
    }
    
    function haveActiveOrder(){
        $where_data['userId']=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->where($where_data);
       
        $where = '(orderStatus="Received" or orderStatus = "Assigned")';
        $this->db->where($where);
        $result=$this->db->get('order_summary');
        if($result->num_rows()<1){
        return true  ;
        }
        return false;
    }

    function order_count(){
        $where_data['userId']=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $this->db->where($where_data);

        $result= $this->db->get('order_summary');
        if($result->num_rows()<1){
            return true  ;
        }
        return false;
    }
    function order_details(){
        $user_id=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $data = null;
        
        $this->db->select("os.orderId,os.shopName,os.orderStatus,os.paymentAmount,os.packingCharge,os.deliveryFee,os.gst,os.totalAmount,os.entryDate as orderEntryDate,ad.*");
        $this->db->where('os.'.TAG_USER_ID, $user_id);
       
        $this->db->order_by('os.'.TAG_ENTRY_DATE, "DESC");
        $this->db->from('order_summary os');
        $this->db->join('address ad', 'os.addressId=ad.addressId', 'left outer');
        $query = $this->db->get();
        $output[TAG_ORDER_LIST] = NULL;

        if ($query->num_rows()) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i][TAG_ORDER_ID] = $row->orderId;
                $data[$i][TAG_SHOP_NAME] = $row->shopName;
                $data[$i][TAG_ORDER_STATUS] = $row->orderStatus;
                $data[$i][TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
                $data[$i][TAG_TOTAL_AMOUNT] = $row->totalAmount;
                $data[$i][TAG_GST] = $row->gst;
                $data[$i][TAG_DELIVERY_FEE] = $row->deliveryFee;
                $data[$i][TAG_PACKING_CHARGE] = $row->packingCharge;
                $data[$i][TAG_ENTRY_DATE] = $row->orderEntryDate;
                $data[$i][TAG_HOUSE_NAME] = $row->houseName;
                $data[$i][TAG_FULL_ADDRESS] = $row->fullAddress;
                $data[$i][TAG_LANDMARK] = $row->landmark;
                $data[$i][TAG_PINCODE] = $row->pinCode;

                $data[$i][TAG_ITEMS_LIST] = null;

                $item_where_data[TAG_ORDER_ID] = $row->orderId;
              
                $this->db->select("it.name,od.quantity,it.offerPrice,it.itemId");
                $this->db->where($item_where_data);
                $this->db->from('order_details od');
               
                $this->db->join('items it', 'it.itemId=od.itemId', 'left outer');
                $this->db->group_by('itemId');
                $item_query_query = $this->db->get();

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

    function cancel_order()
    {
        $response['status']=0;
        $user_id=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $where_data1['userId']=$user_id;
        $where_data1['orderStatus']='Received';
        $this->db->where($where_data1);
        $result=$this->db->get('order_summary');
        $shop_result= $this->db->get('shops');
        $response['demo_error_string'] = "Sorry, Order has confirmed, you can't cancel the order now. please contact shop";
        if($shop_result->num_rows()>0){
        $response['shop_number']=$shop_result->row()->shopMobile;

        $response['demo_error_string'] = "Sorry, Order has confirmed, you can't cancel the order now. please call  in "."<a href=\"tel:+91". $shop_result->row()->shopMobile ."\">".$shop_result->row()->shopMobile."</a>";
      
        }
        if($result->num_rows()>0){
            $order_id=$result->row()->orderId;
            $where_data['orderId']=$order_id;
            $this->db->where($where_data);
            $update_data['orderStatus']='Cancelled';
            $response['demo_error_string'] = "Order didn't cancelled please try again";
            $response['status']= $this->db->update('order_summary',$update_data);

	     if ($response['status']) {
                $data = array(
                    TAG_PROGRESS_BAR_STATUS => 'Cancelled'
                );
                $this->db->where(TAG_ORDER_ID, $order_id);
                $this->db->update('order_shipping', $data);
            }

            if($response['status']=='Cancelled'){
                $response['demo_error_string'] = "Order cancelled successfully";
            }
            
        
        }
        $output=$response;
       return $output;
    }
    function cart_count(){
        $user_id=$this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $where_data['userId']=$user_id;
        $this->db->where($where_data);
        $result=$this->db->get('cart');
        $cart_count=  $result->num_rows();
        return $cart_count;
    }

    function get_category(){
        $result=$this->db->get('category');
        if( $result->num_rows()){
            return  $result->result();
        }
        return null;
    }
    function load_more_products($last_id,$limit){
        

        $last_item_id=$last_id;
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->where('it.itemId>'.$last_item_id);
        $this->db->limit($limit);
        $data = $this->db->get();
       // log_message('error','response--'.print_r($this->db->last_query(),true));
        if($data->num_rows()>0){
            $response['status']=1;
            $response['item_data']=$data->result();
            $output=$response;
          
            return $output;
        }
        
        return false;
    }


    function load_more_category_products($last_id,$limit,$category_id){
        

        $last_item_id=$last_id;
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->where('it.itemId>'.$last_item_id);
        $this->db->where('it.categoryId',$category_id);
        $this->db->limit($limit);
        $data = $this->db->get();
       // log_message('error','response--'.print_r($this->db->last_query(),true));
        if($data->num_rows()>0){
            $response['status']=1;
            $response['item_data']=$data->result();
            $output=$response;
          
            return $output;
        }
        
        return false;
    }
    function category_item_details($limit,$category_id)
    {
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->where('it.categoryId', $category_id);
        
        $this->db->limit($limit);
        $data = $this->db->get();
        return $data->result();
    }
    

    function search_product($result)
    {
        $this->db->select('*');
        $this->db->from('items it');
        $this->db->like('it.name', $result);
        $this->db->where('it.availabilityStatus', '1');
        $data = $this->db->get();
        $response['item_data']=$data->result(); 
        $output=$response;
        return $output;
    }

    function search_result($itemId)
    {
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->where('it.itemId', $itemId);
       
        $data = $this->db->get();
        return $data->result();
    }

    function cart_item_delete($itemId){
        $where_data[TAG_USER_ID]  = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $where_data[TAG_ITEM_ID] = $itemId;
        $this->db->where($where_data);
        $query_delete = $this->db->delete('cart', $where_data);
        if($query_delete){
            return true;
        }
        return false;

    }

    function item_search_results($keyword){
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->like('it.name', $keyword);
        $this->db->where('it.availabilityStatus', '1');
        $data = $this->db->get();
        $response['item_data']=$data->result();
        $output=$response;
        log_message('error','log--- '.print_r($output,true));

        return $output;
    }

    function update_profile($post_data)
    {
        $id = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];

        $proName = $post_data['proName'];
        $proEmail = $post_data['proEmail'];

        $data = array(
            TAG_NAME => $proName,
            TAG_EMAIL_ID => $proEmail
        );

        $this->db->where('userId', $id);
        $this->db->update('user_info', $data);
        // log_message("error","profileupdattee".print_r($this->db->last_query(),true));
        // die();
    }

    
    function single_item_details($itemId)
    {
        $this->db->select('it.*,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->where('it.itemId', $itemId);
        $data = $this->db->get();
        return $data->result();
    }

    function item_category($itemId)
    {
        $this->db->select('*');
        $this->db->where('itemId', $itemId);
        $data = $this->db->get('items');
        return $data->row();
    }

    function category_items_data($limit, $categoryId)
    {
        $this->db->select('it.itemId,it.name,it.offerPrice,it.image,it.itemPriority,it.availabilityStatus,it.shopId,sh.shopGst, COALESCE(ct.quantity, 0) as quantity, ct.cartId');
        $this->db->from('items it');
        $this->db->join('shops sh', 'it.shopId=sh.shopId', 'left outer');
        if (!isset($this->session->userdata[TAG_FOODVENO_LOGIN_SESSION])) {
            $this->db->join('cart ct', 'it.itemId=ct.itemId', 'left outer');
        } else {
            $userId = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $this->db->join('cart ct', 'it.itemId=ct.itemId and ct.userId=' . $userId, 'left outer');
        }
        $this->db->order_by('it.itemId', 'ASC');
        $this->db->where('it.availabilityStatus', '1');
        $this->db->where('it.categoryId', $categoryId);

        $this->db->limit($limit);
        $data = $this->db->get();
        // log_message("error","bchsbccccccc".print_r($data->result(),true));
        // die();
        return $data->result();
    }  
}
