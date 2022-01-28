<?php

class EbaazaarModels extends CI_Model {

    function get_dashboard_details_for_super_admin()
    {
        $output = null;

        $user_query = $this->db->get('user_info');
        $output[TAG_USERS] = $user_query->num_rows();

        //$this->db->select('shopId,name,address,minimumOrder,pinCode');
        $shop_query = $this->db->query("select shopId,name,address,minimumOrder,active,pinCode, (SELECT COUNT(*) FROM order_summary WHERE order_summary.shopId = shops.shopId and orderStatus = 'Received') AS newOrder from shops");
        //$shop_query = $this->db->get('shops');


        $output[TAG_SHOP_LIST] = $shop_query->result();


        $this->db->where(TAG_ORDER_STATUS,TAG_ORDER_STATUS_RECEIVED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_PENDING_ORDERS] = $new_order_query->num_rows();

        $this->db->where(TAG_ORDER_STATUS,TAG_ORDER_STATUS_ASSIGNED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

        $this->db->where(TAG_ORDER_STATUS,TAG_ORDER_STATUS_DELIVERED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();


        return $output;
    }

    function get_dashboard_details_for_shop_admin()
    {
        $output = null;

        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $where_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_RECEIVED;

        $this->db->where($where_data);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_PENDING_ORDERS] = $new_order_query->num_rows();

        $where_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;
        $this->db->where($where_data);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

        $where_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_DELIVERED;
        $this->db->where($where_data);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();


        return $output;
    }


    public function get_item_categories()
    {
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        //$this->db->select('shopId, name');
        $this->db->where($where_data);
        $query = $this->db->get('category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_shop_categories()
    {
        /*$where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $this->db->where($where_data);*/
        $query = $this->db->get('shop_category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_shops()
    {
        /*$where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $this->db->where($where_data);*/
        $this->db->select('shops.*, shop_category.name as shopCategory');
        $this->db->join('shop_category', 'shops.shopCategoryId = shop_category.shopCategoryId', 'left');
        $this->db->order_by('shops.shopPriority', "asc");
        $query = $this->db->get('shops');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_single_shop_details($id)
    {
        $where_data[TAG_CATEGORY_ID] = $id;
        //$this->db->select('shopId, name');
        $this->db->select('shops.*, shop_category.name as shopCategory');
        $this->db->join('shop_category', 'shops.shopCategoryId = shop_category.shopCategoryId', 'left');
        $this->db->where('shops.shopId',$id);
        $query = $this->db->get('shops');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }
    public function check_shop_items($id)
    {
        $this->db->select("itemId");
        $this->db->where(TAG_SHOP_ID,$id);
        $qry = $this->db->get('items');

        return $qry->num_rows();
    }

    function insert_item_category($post_data,$file_data) {
        $data = array(
            TAG_SHOP_ID => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            TAG_NAME => $post_data[TAG_NAME],
            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION],
            TAG_ENTRY_DATE => date('Y-m-d H:i:s')
        );

        $this->db->insert('category', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/items/grocery/category/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/category/' . $files['file_name'];
                    $data = array('image' => $photo);
                    $this->db->where('categoryId', $id);
                    $this->db->update('category', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }

    function insert_shop_category($post_data,$file_data) {
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            TAG_NAME => $post_data[TAG_NAME],
            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION],
            TAG_ENTRY_DATE => date('Y-m-d H:i:s')
        );

        $this->db->insert('shop_category', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/items/grocery/category/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/category/' . $files['file_name'];
                    $data = array('image' => $photo);
                    $this->db->where('shopCategoryId', $id);
                    $this->db->update('shop_category', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }
    function insert_shop_category_bkp($post_data,$file_data) {
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            TAG_NAME => $post_data[TAG_NAME],
            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION],
            TAG_ENTRY_DATE => date('Y-m-d H:i:s')
        );

        $this->db->insert('category', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/items/grocery/category/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/category/' . $files['file_name'];
                    $data = array('image' => $photo);
                    $this->db->where('categoryId', $id);
                    $this->db->update('category', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }

    function insert_shop($post_data,$file_data) {
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            TAG_NAME => $post_data[TAG_NAME],
            TAG_SHOP_CATEGORY_ID => $post_data[TAG_SHOP_CATEGORY_ID],
            TAG_MINIMUM_ORDER => $post_data[TAG_MINIMUM_ORDER],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_DELIVERY_FEE => $post_data[TAG_DELIVERY_FEE],
            TAG_PACKING_CHARGE => $post_data[TAG_PACKING_CHARGE],
            TAG_SHOP_GST => $post_data[TAG_SHOP_GST],
            TAG_SHOP_EMAIL_ID => $post_data[TAG_SHOP_EMAIL_ID],
            TAG_SHOP_PRIORITY => $post_data[TAG_SHOP_PRIORITY],
            TAG_ENTRY_DATE => date('Y-m-d H:i:s')
        );

        $this->db->insert('shops', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/items/grocery/category/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/category/' . $files['file_name'];
                    $data = array('image' => $photo);
                    $this->db->where('shopId', $id);
                    $this->db->update('shops', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }

    function update_shop($post_data, $file_data) {
        $flag = false;
        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_ACTIVE => $post_data[TAG_ACTIVE],
            TAG_SHOP_CATEGORY_ID => $post_data[TAG_SHOP_CATEGORY_ID],
            TAG_MINIMUM_ORDER => $post_data[TAG_MINIMUM_ORDER],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_DELIVERY_FEE => $post_data[TAG_DELIVERY_FEE],
            TAG_PACKING_CHARGE => $post_data[TAG_PACKING_CHARGE],
            TAG_SHOP_GST => $post_data[TAG_SHOP_GST],
            TAG_SHOP_EMAIL_ID => $post_data[TAG_SHOP_EMAIL_ID],
            TAG_SHOP_PRIORITY => $post_data[TAG_SHOP_PRIORITY],

        );

        $this->db->where(TAG_SHOP_ID, $post_data[TAG_SHOP_ID]);
        $qry = $this->db->update('shops', $data);
        if ($qry) {
            $flag = true;

        }

        $config = array(
            'upload_path' => './images/items/grocery/category/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image'] != '') {
            if ($post_data['currentImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink( $post_data['currentImage'] );
            }
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/category/' . $files['file_name'];
                $data = array('image' => $photo);
                $this->db->where('shopId', $post_data[TAG_SHOP_ID]);
                $this->db->update('shops', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }


    function update_item_category($post_data, $file_data) {
        $flag = false;
        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION],
        );
        $this->db->where(TAG_CATEGORY_ID, $post_data[TAG_CATEGORY_ID]);
        $qry = $this->db->update('category', $data);

        if ($qry) {
            $flag = true;
        }

        $config = array(
            'upload_path' => './images/items/grocery/category/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image'] != '') {
            if ($post_data['currentImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink( $post_data['currentImage'] );
            }
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/category/' . $files['file_name'];
                $data = array('image' => $photo);
                $this->db->where('categoryId', $post_data[TAG_CATEGORY_ID]);
                $this->db->update('category', $data);
            }
        }

        return $flag;
    }


    public function get_single_category_details($id)
    {
        $where_data[TAG_CATEGORY_ID] = $id;
        //$this->db->select('shopId, name');
        $this->db->where($where_data);
        $query = $this->db->get('category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    public function get_single_shop_category_details($id)
    {
        $where_data[TAG_SHOP_CATEGORY_ID] = $id;
        //$this->db->select('shopId, name');
        $this->db->where($where_data);
        $query = $this->db->get('shop_category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    public function get_delivery_boys()
    {
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];

        $this->db->select("delivery_boy.*");
        $this->db->join('delivery_boy', 'shop_tag_delivery_boy.deliveryBoyId = delivery_boy.deliveryBoyId', 'left');

        $this->db->where('shop_tag_delivery_boy.shopId',$where_data[TAG_SHOP_ID]);
        $query = $this->db->get('shop_tag_delivery_boy');





        //$this->db->select('shopId, name');
        /*$this->db->where($where_data);
        $query = $this->db->get('delivery_boy');*/
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_delivery_boys_for_admin()
    {
        //$where_data[TAG_ACTIVE] = 0;
        //$this->db->where($where_data);
        $query = $this->db->get('delivery_boy');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function delete_single_delivery_boy($id) {
        /*$this->db->select('image');
        $this->db->where(TAG_DELIVERY_BOY_ID, $id);
        $query = $this->db->get('delivery_boy');
        $result = $query->result();*/

        $this->db->where(TAG_SHOP_ID, $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        $this->db->where(TAG_DELIVERY_BOY_ID, $id);

        $this->db->delete('shop_tag_delivery_boy');
        if ($this->db->affected_rows() == 0) {
            echo 'Something went wroung!';
        } else {
            //@unlink($result[0]->image);

            echo 'Record deleted successfully';
        }
    }

    public function get_single_delivery_boy_details($id)
    {
        $where_data[TAG_DELIVERY_BOY_ID] = $id;
        //$this->db->select('shopId, name');
        $this->db->where($where_data);
        $query = $this->db->get('delivery_boy');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_delivery_boy_deatils($post_data) {
        $flag = 0;
        $data = array(
            TAG_DELIVERY_BOY_NAME => $post_data[TAG_DELIVERY_BOY_NAME],
            TAG_ACTIVE => $post_data[TAG_MOBILE],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_ACTIVE => $post_data[TAG_ACTIVE],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PLACE => $post_data[TAG_PLACE],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE]
        );
        $this->db->where(TAG_DELIVERY_BOY_ID, $post_data[TAG_DELIVERY_BOY_ID]);
        $this->db->update('delivery_boy', $data);
        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }
        return $flag;
    }

    function add_shop_delivery_boy($where_data) {
        $flag = 0;
        $data = array(
            TAG_ASSIGN_FLAG => 1,
        );
        $this->db->where($where_data);
        $qry = $this->db->update('delivery_boy', $data);

        if ($qry) {

            $insert_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
            $insert_data[TAG_DELIVERY_BOY_ID] = $where_data[TAG_DELIVERY_BOY_ID];
            $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');

            $this->db->insert('shop_tag_delivery_boy', $insert_data);
            if ($this->db->affected_rows() > 0) {
                $flag = 1;
            }

        }
        else
        {
            echo "hari";
        }
        return $flag;
    }

    function insert_delivery_boy($post_data) {

        $password = $this->UtilityModels->generate_password();
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            TAG_PASSWORD => $password,
            TAG_ENTRY_DATE => date('Y-m-d H:i:s'),
            TAG_DELIVERY_BOY_NAME => $post_data[TAG_DELIVERY_BOY_NAME],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_ACTIVE => $post_data[TAG_ACTIVE],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PLACE => $post_data[TAG_PLACE],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE]
        );

        $this->db->insert('delivery_boy', $data);
        if ($this->db->affected_rows() > 0) {

            $this->UtilityModels->sendMail($data[TAG_PASSWORD], $data[TAG_EMAIL_ID]);

            $id = $this->db->insert_id();

            return $id;
        } else {
            return 0;
        }
    }

    function get_delivery_boys_list($where_data)
    {
        /*$output = null;
        $this->db->where($where_data);
        $query = $this->db->get('delivery_boy');
        if($query->num_rows())
        {
            $output[TAG_DELIVERY_BOYS_LIST] = $query->result();
        }

        return $output;*/

        $output = null;
        $shopId = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $query = $this->db->query("SELECT dby.*  FROM delivery_boy dby  LEFT JOIN shop_tag_delivery_boy stdby ON stdby.deliveryBoyId = dby.deliveryBoyId  WHERE stdby.shopId  = $shopId AND dby.active=1 ");

        if($query->num_rows())
        {
            $output[TAG_DELIVERY_BOYS_LIST] = $query->result();
        }
        return $output;
    }

    function get_delivery_boys_list_for_add_to_shop($where_data)
    {
        $output = null;
        $shopId = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $query = $this->db->query("SELECT dby.*  FROM delivery_boy dby  LEFT JOIN shop_tag_delivery_boy stdby ON stdby.deliveryBoyId = dby.deliveryBoyId AND stdby.shopId = $shopId WHERE stdby.deliveryBoyId is null AND dby.active=1 ");

        if($query->num_rows())
        {
            $output[TAG_DELIVERY_BOYS_LIST] = $query->result();
        }
        return $output;
    }
    function orders_list($where_data)
    {
        $output[TAG_ORDERS_LIST] = null;

        $this->db->select('os.*,sh.name,ui.name as userName,ui.mobile as mobile, ad.fullAddress, ad.houseName, ad.landmark, ad.pinCode');
        $this->db->from('order_summary os');
        $this->db->join('shops sh','sh.shopId=os.shopId','left');
        $this->db->join('user_info ui','ui.userId=os.userId','left');
        $this->db->join('address ad','ad.addressId=os.addressId','left');
        $this->db->where('os.shopId',$where_data[TAG_SHOP_ID]);
        $this->db->where('os.orderStatus',$where_data[TAG_ORDER_STATUS]);
        $query = $this->db->get();
        if($query->num_rows())
        {
            //$output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_ORDERS_LIST] = $query->result();
        }
        return $output;
    }

    function assign_order($where_data,$update_data)  //Use Transaction later
    {
        $this->db->trans_begin();
        $this->db->where($where_data);
        $qry = $this->db->update('order_summary',$update_data);
        if ($qry)
        {
            $delivery_boy_data[TAG_DELIVERY_BOY_ID] = $update_data[TAG_DELIVERY_BOY_ID];
            $delivery_boy_data[TAG_ORDER_ID] = $where_data[TAG_ORDER_ID];
            $delivery_boy_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;
            $delivery_boy_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
            $this->db->insert('order_tag_delivery_boy',$delivery_boy_data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }



    function get_user_details_for_login($post_data) {
        $user_name = $post_data['shop_username'];
        $user_password = $post_data['shop_user_password'];

        $this->db->select('userId,userRole,activeShopId');
        $this->db->where('emailId = "' . $user_name . '" and password = "' . $user_password . '"');
        $query = $this->db->get('user_info');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_user_login_session($user_data) {

        $active_shop_name = "";

        if(!empty($user_data[0]->activeShopId))
        {
            $this->db->select(TAG_NAME);
            $this->db->where(TAG_SHOP_ID,$user_data[0]->activeShopId);
            $qry = $this->db->get('shops');
            if($qry->num_rows())
            {
                $row = $qry->row();
                $active_shop_name = $row->shopName;
            }
        }


        $session_data = array(TAG_E_B_TEMP_SESSION_USER_ID => $user_data[0]->userId, TAG_SESSION_USER_ROLE => $user_data[0]->userRole,TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID => $user_data[0]->activeShopId, TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_NAME => $active_shop_name);
        $this->session->set_userdata(TAG_E_B_TEMP_LOGIN_SESSION, $session_data);
        return TRUE;
    }

    function validate_login_session() {
        if (!isset($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_logout() {
        if (!$this->validate_login_session()) {
            return TRUE;
        } else {
            $this->session->unset_userdata(TAG_E_B_TEMP_LOGIN_SESSION);
            return TRUE;
        }
    }

    public function get_all_item_details() {
        $this->db->select('items.*, shops.name as shopName');
        $this->db->join('shops', 'items.shopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = items.userId', 'inner');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->where('items.shopId',$this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        $query = $this->db->get('items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_shop_details() {
        $this->db->select('shopId,name');
        $query = $this->db->get('shops');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_category_details() {
        $this->db->select('categoryId,name');//TODO change name to categoryName
        $query = $this->db->get('category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_item_sub_category_details($cat_id) {
        if ($cat_id) {
            $this->db->select('suCategoryId,name');
            $this->db->where('categoryId = "' . $cat_id . '" ');
            $query = $this->db->get('sub_category');
            if ($query->num_rows() == 0) {
                return NULL;
            } else {
                $result = $query->result();
                return $result;
            }
        } else {
            return NULL;
        }
    }

    public function get_all_item_category_for_shop($shop_id) {
        if ($shop_id) {
            $this->db->select('categoryId,name');
            $this->db->where('shopId = "' . $shop_id . '" ');
            $query = $this->db->get('category');
            if ($query->num_rows() == 0) {
                return NULL;
            } else {
                $result = $query->result();
                return $result;
            }
        } else {
            return NULL;
        }
    }

    public function get_all_shop_categories() {

        $this->db->select('shopCategoryId,name');
        $query = $this->db->get('shop_category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }


    function fileext($text) {
        $ext1 = explode(".", $text);
        $cnt = count($ext1);
        $ext = $ext1[$cnt - 1];
        $extEN = strtolower($ext);
        return $extEN;
    }

    function insert_item_deatils($post_data,$file_data) {
        //'itemType' => $post_data['itemType'],


        $gst = $this->get_shop_gst();



        $data = array(
            'shopId' => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID],
            'categoryId' => $post_data['categoryId'] ? $post_data['categoryId'] : NULL,
            'name' => $post_data['name'],
            'availabilityStatus' => $post_data['availabilityStatus'],
            'price' => $post_data['price'],
            'offerPrice' => $post_data['offerPrice'],
            'recommendedItemFlag' => isset($post_data['recommendedItemFlag']) ? $post_data['recommendedItemFlag'] : 0,
            'popularItemFlag' => isset($post_data['popularItemFlag']) ? $post_data['popularItemFlag'] : 0,
            'bestItemFlag' => isset($post_data['bestItemFlag']) ? $post_data['bestItemFlag'] : 0,
            'description' => $post_data['description'],
            'entryDate' => date('Y-m-d H:i:s'),
            'userId' => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_USER_ID],
            'itemGst' => $gst,
            TAG_ITEM_PRIORITY => $post_data[TAG_ITEM_PRIORITY]
        );

        $this->db->insert('items', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/items/grocery/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/' . $files['file_name'];
                    $data = array('image' => $photo);
                    $this->db->where('itemId', $id);
                    $this->db->update('items', $data);
                }
            }
            if ($file_data['bestItemImage'] != '') {
                if ($this->upload->do_upload('bestItemImage')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/' . $files['file_name'];
                    $data = array('bestItemImage' => $photo);
                    $this->db->where('itemId', $id);
                    $this->db->update('items', $data);
                }
            }
            return $id;
        } else {
            return 0;
        }
    }

    function get_shop_gst()
    {
        $gst = 0;
        $this->db->select(TAG_SHOP_GST);
        $this->db->where(TAG_SHOP_ID, $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        $qry = $this->db->get('shops');

        if($qry->num_rows())
        {
            $row = $qry->row();
            $gst = $row->shopGst;
        }
        return $gst;
    }

    function get_single_item_details($id) {
        //$this->db->select('items.*,shops.name as shopName,category.name as CatName,sub_category.name as subCatName,user_info.name as userName');
        $this->db->select('items.*,shops.name as shopName,category.name as subCatName,user_info.name as userName');
        $this->db->join('shops', 'items.shopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = items.userId', 'inner');
        //$this->db->join('category', 'category.categoryId = items.categoryId', 'inner');
        $this->db->join('category', 'category.categoryId = items.categoryId', 'left');
        $this->db->where('itemId = "' . $id . '" ');
        $query = $this->db->get('items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function delete_single_item($id) {
        $this->db->select('image,bestItemImage');
        $this->db->where('itemId = "' . $id . '" ');
        $query = $this->db->get('items');
        $result = $query->result();

        $this->db->where('itemId', $id);
        $this->db->delete('items');
        if ($this->db->affected_rows() == 0) {
            echo 'Something went wroung!';
        } else {
            @unlink($result[0]->image);
            @unlink($result[0]->bestItemImage);
            echo 'Record deleted successfully';
        }
    }

    function publish_shop($id) {

        $update_data["publishFlag"] = 1;
        $this->db->where('shopId', $id);
        $qry = $this->db->update('shops',$update_data);
        if ($qry) {
            echo 'Shop Published successfully';
        } else {
            echo 'Something went wroung!';
        }
    }

    function update_item_deatils($post_data, $file_data) {
        $flag = 0;
        $data = array(
            'categoryId' => $post_data['categoryId'] ? $post_data['categoryId'] : NULL,
            'name' => $post_data['name'],
            'availabilityStatus' => $post_data['availabilityStatus'],
            'price' => $post_data['price'],
            'offerPrice' => $post_data['offerPrice'],
            'recommendedItemFlag' => isset($post_data['recommendedItemFlag']) ? $post_data['recommendedItemFlag'] : 0,
            'popularItemFlag' => isset($post_data['popularItemFlag']) ? $post_data['popularItemFlag'] : 0,
            'bestItemFlag' => isset($post_data['bestItemFlag']) ? $post_data['bestItemFlag'] : 0,
            'description' => $post_data['description'],
            TAG_ITEM_PRIORITY => $post_data[TAG_ITEM_PRIORITY]
        );
        $this->db->where('itemId', $post_data['itemId']);
        $this->db->update('items', $data);
        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }

        $item_details = $this->get_single_item_details($post_data['itemId']);
        $config = array(
            'upload_path' => './images/items/grocery/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image'] != '') {
            if ($item_details[0]->image) {
                log_message("debug","IMAGE-Update".$item_details[0]->image);
                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink($item_details[0]->image );
            }
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/' . $files['file_name'];
                $data = array('image' => $photo);
                $this->db->where('itemId', $post_data['itemId']);
                $this->db->update('items', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = 1;
                }
            }
        }
        if ($file_data['bestItemImage'] != '') {
            if ($item_details[0]->bestItemImage) {
                //@unlink('images/items/grocery/' . $item_details[0]->bestItemImage . '');
                @unlink($item_details[0]->bestItemImage);
            }
            if ($this->upload->do_upload('bestItemImage')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/' . $files['file_name'];
                $data = array('bestItemImage' => $photo);
                $this->db->where('itemId', $post_data['itemId']);
                $this->db->update('items', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = 1;
                }
            }
        }
        return $flag;
    }

    function update_item_deatils_new_shintu($post_data, $file_data) {
        $flag = 0;
        $data = array(
            'shopId' => $post_data['shopId'],
            'categoryId' => $post_data['categoryId'],
            'subCategoryId' => $post_data['subCategoryId'] ? $post_data['subCategoryId'] : NULL,
            'name' => $post_data['name'],
            'itemType' => $post_data['itemType'],
            'availabilityStatus' => $post_data['availabilityStatus'],
            'price' => $post_data['price'],
            'offerPrice' => $post_data['offerPrice'],
            'recommendedItemFlag' => isset($post_data['recommendedItemFlag']) ? $post_data['recommendedItemFlag'] : 0,
            'popularItemFlag' => isset($post_data['popularItemFlag']) ? $post_data['popularItemFlag'] : 0,
            'bestItemFlag' => isset($post_data['bestItemFlag']) ? $post_data['bestItemFlag'] : 0,
            'description' => $post_data['description']
        );
        $this->db->where('itemId', $post_data['itemId']);
        $this->db->update('items', $data);
        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }

        $item_details = $this->get_single_item_details($post_data['itemId']);
        $config = array(
            'upload_path' => './images/items/grocery/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image'] != '') {
            if ($item_details[0]->image) {
                @unlink('images/items/grocery/' . $item_details[0]->image . '');
            }
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/' . $files['file_name'];
                $data = array('image' => $photo);
                $this->db->where('itemId', $post_data['itemId']);
                $this->db->update('items', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = 1;
                }
            }
        }
        if ($file_data['bestItemImage'] != '') {
            if ($item_details[0]->bestItemImage) {
                @unlink('images/items/grocery/' . $item_details[0]->bestItemImage . '');
            }
            if ($this->upload->do_upload('bestItemImage')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/' . $files['file_name'];
                $data = array('bestItemImage' => $photo);
                $this->db->where('itemId', $post_data['itemId']);
                $this->db->update('items', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = 1;
                }
            }
        }
        return $flag;
    }

    function insert_import_item($file_data) {
        move_uploaded_file($file_data["item_import_file"]["tmp_name"], 'excel/dummy/' . $file_data['item_import_file']['name']);
        $this->load->library('PHPExcel');
        $inputFileType = 'Excel2007';
        $inputFileName = 'excel/dummy/' . $_FILES['item_import_file']['name'];

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

        $res = array();
        $row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        for ($i = 2; $i <= $row; $i++) {

            $shop_id = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(0, $i)->getValue() : '0';
            $cat_id = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(1, $i)->getValue() : '0';
            $name = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(2, $i)->getValue() : '';

            if(($shop_id != '0') && ($cat_id != '0') && ($name != ''))
            {
                if ($name) {

                    if ($shop_id) {
                        $this->db->select('shopId');
                        $this->db->where('shopId = "' . $shop_id . '" ');
                        $query = $this->db->get('shops');
                        if ($query->num_rows() == 0) {
                            $res[$i]['msg'] = 'Shop not exist!';
                            $res[$i]['flag'] = 0;
                            continue;
                        }
                    } else {
                        $res[$i]['msg'] = 'Shop Id must be entered';
                        $res[$i]['flag'] = 0;
                        continue;
                    }


                    if ($cat_id) {
                        $this->db->select('categoryId');
                        //$this->db->where('categoryId = "' . $cat_id . '" ');
                        $this->db->where('shopId = "' . $shop_id . '" and categoryId = ' . $cat_id . '');
                        $query = $this->db->get('category');
                        if ($query->num_rows() == 0) {
                            $res[$i]['msg'] = 'Category not exist!';
                            $res[$i]['flag'] = 0;
                            continue;
                        }
                    } else {
                        $res[$i]['msg'] = 'Category ID must be entered';
                        $res[$i]['flag'] = 0;
                        continue;
                    }
                    if ($shop_id && $cat_id) {
                        /*if ($sub_cat_name) {
                            $this->db->select('suCategoryId');
                            $this->db->where('name = "' . $sub_cat_name . '" and categoryId = ' . $cat_id . '');
                            $query = $this->db->get('sub_category');
                            if ($query->num_rows() == 0) {
                                $sub_cat_id = NULL;
                                $res[$i]['msg'] = 'Sub category not exist!';
                                $res[$i]['flag'] = 0;
                                continue;
                            } else {
                                $result = $query->result();
                                $sub_cat_id = $result[0]->suCategoryId;
                            }
                        } else {
                            $sub_cat_id = NULL;
                        }*/

                        if (!$name) {
                            $res[$i]['msg'] = 'Name must be entered.';
                            $res[$i]['flag'] = 0;
                            continue;
                        }
                        $type = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(3, $i)->getValue() : 'Veg';
                        if (!$type) {
                            $res[$i]['msg'] = 'Type must be entered.';
                            $res[$i]['flag'] = 0;
                            continue;
                        }
                        $available_status = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(4, $i)->getValue() : '0';
                        $price = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(5, $i)->getValue() : '0';
                        $offer_price = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(6, $i)->getValue() : '0';
                        $recommended_item = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(7, $i)->getValue() : '0';
                        $popular_item = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(8, $i)->getValue() : '0';
                        $best_item = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(9, $i)->getValue() : '0';
                        $description = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(10, $i)->getValue() : '';
                        $image = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(11, $i)->getValue() : '';
                        $gst = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(12, $i)->getValue() : '';
                        $priority = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(13, $i)->getValue() : '0';

                        $this->db->select('itemId');
                        $this->db->where('name = "' . $name . '" and shopId = ' . $shop_id . ' and categoryId = ' . $cat_id . '');
                        $query = $this->db->get('items');
                        if ($query->num_rows() == 0) {
                            $data = array(
                                'shopId' => $shop_id,
                                'userId' => $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_USER_ID],
                                'name' => $name,
                                'itemType' => $type,
                                'description' => $description,
                                'categoryId' => $cat_id,
                                'image' => $image,
                                'availabilityStatus' => $available_status,
                                'price' => $price,
                                'offerPrice' => $offer_price,
                                'recommendedItemFlag' => $recommended_item,
                                'popularItemFlag' => $popular_item,
                                'bestItemFlag' => $best_item,
                                'entryDate' => date('Y-m-d H:i:s'),
                                'itemGst' => $gst,
                                'itemPriority' => $priority
                            );
                            $this->db->insert('items', $data);
                            if ($this->db->affected_rows() > 0) {
                                $res[$i]['msg'] = 'Item created successfully.';
                                $res[$i]['flag'] = 1;
                            } else {
                                $res[$i]['msg'] = 'Item not created. Something went wrong!';
                                $res[$i]['flag'] = 0;
                            }
                        } else {
                            $sub_cat_id = NULL;
                            $res[$i]['msg'] = 'Item already exist!';
                            $res[$i]['flag'] = 0;
                            continue;
                        }
                    }
                }
                if (!$name) {
                    $res[$i]['msg'] = 'Name must be entered.';
                    $res[$i]['flag'] = 0;
                    continue;
                }
            }
            else{
                $res[$i]['msg'] = 'This is end of Excel file';
                $res[$i]['flag'] = 0;
                break;
            }

        }
        return $res;
    }



    function get_enum_values($table, $field) {
        $type = $this->db->query("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")->row(0)->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    function get_order_details($post_data) {
        if ($post_data['search_date']) {
            $date = urldecode($post_data['search_date']);
            $sdate = substr($date, 0, 10);
            $edate = substr($date, 12, 20);
            $s_stamp = strtotime($sdate);
            $e_stamp = strtotime($edate);
            $data['sdate'] = date('Y-m-d', $s_stamp);
            $data['edate'] = date('Y-m-d', $e_stamp);
        }
        $this->db->select('order_summary.*,shops.name as shopName');
        $this->db->join('shops', 'shops.shopId = order_summary.shopId', 'inner');
        $this->db->where('orderDate between "' . $data['sdate'] . '" and "' . $data['edate'] . '" ');
        $this->db->where('order_summary.shopId',$this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        if ($post_data['search_order_status']) {
            $this->db->where('orderStatus = "' . $post_data['search_order_status'] . '" ');
        }
        $query = $this->db->get('order_summary');
        if ($query->num_rows() == 0) {
            $result = NULL;
        } else {
            $result = $query->result();
        }
        return $result;
    }

    function get_order_full_view($where_data)
    {
        $output[TAG_CURRENT_ORDER_DETAILS] = null;

        $this->db->select('os.*,sh.name,ui.name as userName,ui.mobile as userMobile, ad.fullAddress, ad.houseName, ad.landmark, ad.pinCode, ad.latitude, ad.longitude, db.deliveryBoyId, db.deliveryBoyName, db.mobile as deliveryBoyMobile, db.emailId as deliveryBoyEmailId, db.address as deliverBoyAddress, db.place as deliveryBoyPlace, db.pinCode as deliveryBoyPinCode');
        $this->db->from('order_summary os');
        $this->db->join('shops sh','sh.shopId=os.shopId','left');
        $this->db->join('user_info ui','ui.userId=os.userId','left');
        $this->db->join('delivery_boy db','os.deliveryBoyId=db.deliveryBoyId','left');
        $this->db->join('address ad','ad.addressId=os.addressId','left');
        $this->db->where('os.orderId',$where_data[TAG_ORDER_ID]);

        $query = $this->db->get();
        if($query->num_rows())
        {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_SHOP_NAME] = $row->shopName;
	    $data[TAG_USER_NAME] = $row->userName;
	    $data["userMobile"] = $row->userMobile;
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
            $data[TAG_LATITUDE] = $row->latitude;
            $data[TAG_LONGITUDE] = $row->longitude;
            $data[TAG_PAYMENT_MODE] = $row->paymentMode;
            $data[TAG_DELIVERY_BOY_ID] = $row->deliveryBoyId;
            $data[TAG_DELIVERY_BOY_NAME] = $row->deliveryBoyName;
            $data[TAG_DELIVERY_BOY_MOBILE] = $row->deliveryBoyMobile;
            $data[TAG_DELIVERY_BOY_EMAIL_ID] = $row->deliveryBoyEmailId;
            $data[TAG_DELIVERY_BOY_ADDRESS] = $row->deliverBoyAddress;
            $data[TAG_DELIVERY_BOY_PLACE] = $row->deliveryBoyPlace;
            $data[TAG_DELIVERY_BOY_PIN_CODE] = $row->deliveryBoyPinCode;
            $data[TAG_ITEMS_LIST] = null;

            $item_where_data[TAG_ORDER_ID] = $row->orderId;
            $this->db->select("itemName,quantity,amount");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get('order_details');

            if($item_query_query->num_rows())
            {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

}
