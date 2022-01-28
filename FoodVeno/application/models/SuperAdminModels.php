<?php
class SuperAdminModels extends CI_Model
{
    function editItemAvailability($item_id, $availability_status)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response[TAG_ERROR_STRING] = "Status didn't updated try again !";
        $this->db->where('itemId', $item_id);
        $this->db->set('availabilityStatus', $availability_status);
        $update_status = $this->db->update('items');

        if ($update_status) {
            $add_value = 0.1;
            $this->db->set('versionCode', 'versionCode+' . $add_value, false);
            $result = $this->db->update('db_version');

            if ($result) {
                $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
                $response[TAG_ERROR_STRING] = "";
            }
        }
    }

    function superAdminLogin($mobile, $password, $firebase_token)
    {

        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where(TAG_MOBILE, $mobile);
        $this->db->where(TAG_PASSWORD, $password);
        $this->db->where(TAG_USER_ROLE, 'SuperAdmin');
        $this->db->where(TAG_TOKEN . ' is NOT NULL', NULL, FALSE);
        $this->db->where(TAG_TOKEN . '!=" "');
        $query = $this->db->get('user_info');
        log_message('error', '---super_admin_login_qu' . print_r($this->db->last_query(), true));

        if ($query->num_rows()) {

            $this->db->set('firebaseToken', $firebase_token);
            $this->db->where(TAG_MOBILE, $mobile);
            $this->db->where(TAG_PASSWORD, $password);
            $this->db->where(TAG_USER_ROLE, 'SuperAdmin');
            $this->db->update('user_info');
            $user_data[TAG_TOKEN] = $query->row()->token;
            $user_data[TAG_EMAIL_ID] = $query->row()->emailId;
            $user_data[TAG_MOBILE] = $query->row()->mobile;
            $user_data[TAG_NAME] = $query->row()->name;
            $response[TAG_USER] = $user_data;
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_RECEIVED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_RECEIVED_ORDERS] = $new_order_query->result();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $response[TAG_SHOP_ADMIN_DETAILS] = $query->row();
            $query = $this->db->get('shops');

            if ($query->num_rows()) {
                $response[TAG_SHOP_LIST] = $query->result();
            }
            $query = $this->db->get('items');

            if ($query->num_rows()) {
                $response[TAG_ALL_ITEMS] = $query->result();
            }
            $this->db->select('ui.name,ui.mobile,os.*');
            $this->db->from('order_summary os');
            $this->db->join('user_info ui', 'ui.userId=os.userId');


            $query = $this->db->get();

            if ($query->num_rows()) {
                $response[TAG_ORDERS_LIST] = $query->result();
            }

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Mobile Number or Password is Incorrect..";
        }
        return $response;
    }




    function getFullHomeData($token)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where(TAG_TOKEN, $token);
        $query = $this->db->get('user_info');

        if ($query->num_rows()) {


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $response[TAG_SHOP_ADMIN_DETAILS] = $query->row();
            $query = $this->db->get('shops');

            if ($query->num_rows()) {
                $response[TAG_SHOP_LIST] = $query->result();
            }
            $query = $this->db->get('items');

            if ($query->num_rows()) {
                $response[TAG_ALL_ITEMS] = $query->result();
            }
            $this->db->select('ui.name,ui.mobile,os.*');
            $this->db->from('order_summary os');
            $this->db->join('user_info ui', 'ui.userId=os.userId');

            $query = $this->db->get();

            if ($query->num_rows()) {
                $response[TAG_ORDERS_LIST] = $query->result();
            }

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "Mobile Number or Password is Incorrect..";
        }
        return $response;
    }
    function getNormalUserDetails()
    {
        $output[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $output[TAG_USER_LIST] = null;

        $query = $this->db->query("SELECT user_info.userId,user_info.name,user_info.mobile,user_info.entryDate,user_info.accountStatus, (select count(*) from order_summary where user_info.userId=order_summary.userId) as orderCount FROM `user_info` left JOIN order_summary ON user_info.userId=order_summary.userId where userRole='User' GROUP by userId");

        log_message("error", "user rolr " . print_r($query->result(), true));

        if ($query->num_rows()) {
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_USER_LIST] = $query->result();
        }

        return $output;
    }
    function getDataWithToken($token)
    {
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where(TAG_TOKEN, $token);
        $this->db->where(TAG_USER_ROLE, 'SuperAdmin');
        $query = $this->db->get('user_info');

        if ($query->num_rows()) {
            $user_data[TAG_TOKEN] = $query->row()->token;
            $user_data[TAG_EMAIL_ID] = $query->row()->emailId;
            $user_data[TAG_NAME] = $query->row()->name;
            $user_data[TAG_MOBILE] = $query->row()->mobile;
            $response[TAG_USER] = $user_data;


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);


            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);


            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $response[TAG_SHOP_ADMIN_DETAILS] = $query->row();



            $query = $this->db->get('shops');

            if ($query->num_rows()) {
                $response[TAG_SHOP_LIST] = $query->result();
            }

            $query = $this->db->get('items');

            if ($query->num_rows()) {
                $response[TAG_ALL_ITEMS] = $query->result();
            }

            $this->db->select('ui.name,ui.mobile,os.*');
            $this->db->from('order_summary os');
            $this->db->join('user_info ui', 'ui.userId=os.userId');

            $query = $this->db->get();

            if ($query->num_rows()) {
                $response[TAG_ORDERS_LIST] = $query->result();
            }

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = "!Oops Somthing went worng";
        }
        return $response;
    }

    function superAdminSignUp($mobile, $otp, $password, $firebase_token)
    {

        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $this->db->where('mobile', $mobile);
        $this->db->where('otp', $otp);
        $this->db->where('userRole', 'SuperAdmin');
        $query = $this->db->get('user_info');
        if ($query->num_rows() && $otp != '' && $otp != null) {

            $token = $this->UtilityModels->generateToken($mobile);
            $this->db->set('firebaseToken', $firebase_token);
            $this->db->set('token', $token);
            $this->db->set('otp', '');
            $this->db->set('password', $password);
            $this->db->where('mobile', $mobile);
            $this->db->where('userRole', 'SuperAdmin');
            $update_flag = $this->db->update('user_info');
            if ($update_flag) {
                $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            }

            $user_data[TAG_TOKEN] = $token;
            $user_data[TAG_EMAIL_ID] = $query->row()->emailId;
            $user_data[TAG_MOBILE] = $mobile;
            $user_data[TAG_NAME] = $query->row()->name;
            $response[TAG_USER] = $user_data;
            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_RECEIVED);

            $new_order_query = $this->db->get('order_summary');
            $response[TAG_RECEIVED_ORDERS] = $new_order_query->result();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);

            $new_order_query = $this->db->get('order_summary');
            $response[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();


            $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);

            $new_order_query = $this->db->get('order_summary');
            $response[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();

            $response[TAG_SHOP_ADMIN_DETAILS] = $query->row();


            $query = $this->db->get('shops');

            if ($query->num_rows()) {
                $response[TAG_SHOP_LIST] = $query->result();
            }


            $query = $this->db->get('items');

            if ($query->num_rows()) {
                $response[TAG_ALL_ITEMS] = $query->result();
            }
            $this->db->select('ui.name,ui.mobile,os.*');
            $this->db->from('order_summary os');
            $this->db->join('user_info ui', 'ui.userId=os.userId');


            $query = $this->db->get();

            if ($query->num_rows()) {
                $response[TAG_ORDERS_LIST] = $query->result();
            }

            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
        } else {
            $response[TAG_ERROR_STRING] = 'Wrong Mobile or OTP number';
        }

        return $response;
    }
}
