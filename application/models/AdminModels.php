<?php

use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class AdminModels extends CI_Model
{

    function get_dashboard_details_for_super_admin()
    {

        $output = null;

        $user_query = $this->db->get('user_info');
        $output[TAG_USERS] = $user_query->num_rows();

        //$this->db->select('shopId,name,address,minimumOrder,pinCode');
        $shop_query = $this->db->query("select shopId,name,address,minimumOrder,active,pinCode, (SELECT COUNT(*) FROM order_summary WHERE order_summary.shopId = shops.shopId and orderStatus = 'Received') AS newOrder from shops ORDER BY newOrder DESC");
        //$shop_query = $this->db->get('shops');


        $output[TAG_SHOP_LIST] = $shop_query->result();


        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_RECEIVED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_PENDING_ORDERS] = $new_order_query->num_rows();

        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_ASSIGNED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_ASSIGNED_ORDERS] = $new_order_query->num_rows();

        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_DELIVERED);
        $new_order_query = $this->db->get('order_summary');
        $output[TAG_COMPLETED_ORDERS] = $new_order_query->num_rows();
        $this->db->where(TAG_ORDER_STATUS, TAG_ORDER_STATUS_CANCELLED);
        $canceled_order_query = $this->db->get('order_summary');
        $output[TAG_CANCELLED_ORDERS] = $canceled_order_query->num_rows();

        return $output;
    }

    function get_dashboard_details_for_shop_admin()
    {
        $output = null;

        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $where_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_RECEIVED;
        $output[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
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

        $where_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_CANCELLED;
        $this->db->where($where_data);
        $canceled_order_query = $this->db->get('order_summary');
        $output[TAG_CANCELLED_ORDERS] = $canceled_order_query->num_rows();

        return $output;
    }


    public function get_item_categories()
    {
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
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


    public function get_shops()
    {
        /*$where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $this->db->where($where_data);*/
        $this->db->select('*');
        $this->db->order_by('shopPriority', "asc");
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
        $this->db->select('sh.*,shc.name as shopCategoryName');
        $this->db->from('shops sh');
        $this->db->join('shop_category shc', 'sh.shopCategoryId=shc.shopCategoryId', 'left');

        $this->db->where('sh.shopId', $id);
        $query = $this->db->get();
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
        $this->db->where(TAG_SHOP_ID, $id);
        $qry = $this->db->get('items');

        return $qry->num_rows();
    }

    function insert_item_category($post_data, $file_data)
    {
        $data = array(
            TAG_SHOP_ID => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
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


    function insert_shop($post_data, $file_data)
    {
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
            TAG_NAME => $post_data[TAG_NAME],
            TAG_SHOP_CATEGORY_ID => $post_data[TAG_SHOP_CATEGORY_ID],
            TAG_MINIMUM_ORDER => $post_data[TAG_MINIMUM_ORDER],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_DELIVERY_FEE => $post_data[TAG_DELIVERY_FEE],
            TAG_DELIVERY_BASE_AMOUNT => $post_data[TAG_DELIVERY_BASE_AMOUNT],
            TAG_DELIVERY_FEE_BASE_KM => $post_data[TAG_DELIVERY_FEE_BASE_KM],
            TAG_PACKING_CHARGE => $post_data[TAG_PACKING_CHARGE],
            TAG_SHOP_GST => $post_data[TAG_SHOP_GST],
            TAG_LOCATION => $post_data[TAG_LOCATION],
            TAG_SHOP_EMAIL_ID => $post_data[TAG_SHOP_EMAIL_ID],
            TAG_SHOP_MOBILE => $post_data[TAG_SHOP_MOBILE],
            TAG_SHOP_LANDLINE => $post_data[TAG_SHOP_LANDLINE],
            TAG_SHOP_PRIORITY => $post_data[TAG_SHOP_PRIORITY],
            TAG_ENTRY_DATE => date('Y-m-d H:i:s'),
            TAG_DELIVERY_TIME => $post_data[TAG_DELIVERY_TIME],

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

                    $config = array(
                        'upload_path' => './images/items/grocery/category/',
                        'allowed_types' => '*',
                    );
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($file_data['bannerImage'] != '') {
                        // print_r($this->upload->data()["full_path"]);
                        // log("debug","publish_db_changes".print_r($this->upload->data(),true));
                        if ($this->upload->do_upload('bannerImage')) {
                            $files = $this->upload->data();
                            $photo = 'images/items/grocery/category/' . $files['file_name'];
                            $data['bannerImage'] =  $photo;
                            $this->db->where('shopId', $id);
                            $this->db->update('shops', $data);
                        }
                    }

                    $this->db->where('shopId', $id);
                    $this->db->update('shops', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }




    function update_item_category($post_data, $file_data)
    {
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
        if ($file_data['image']['name'] != '') {
            if ($post_data['currentImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink($post_data['currentImage']);
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


    public function get_delivery_boys()
    {
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];

        $this->db->select("delivery_boy.*");
        $this->db->join('delivery_boy', 'shop_tag_delivery_boy.deliveryBoyId = delivery_boy.deliveryBoyId', 'left');

        $this->db->where('shop_tag_delivery_boy.shopId', $where_data[TAG_SHOP_ID]);
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

    public function get_partner_delivery_boys()
    {
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];

        $this->db->select("delivery_boy.*");
        $this->db->join('delivery_boy', 'shop_tag_delivery_boy.deliveryBoyId = delivery_boy.deliveryBoyId', 'left');

        $this->db->where('shop_tag_delivery_boy.shopId', $where_data[TAG_SHOP_ID]);
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
        $response[TAG_DELIVERY_BOYS_COUNT] = 0;
        $response[TAG_DELIVERY_BOYS_LIST] = null;
        $this->db->select('dby.*,dbp.paidStatus, (DATE(`dbp`.`entryDate`)=CURDATE()) as isToday');
        $this->db->from('delivery_boy dby');
        $this->db->join('d_boy_payment dbp', 'dby.deliveryBoyId=dbp.deliveryBoyId', 'left');
        $this->db->group_by('dby.deliveryBoyId');
        $delivery_boy_list_query = $this->db->get();
        //  echo $this->db->last_query();
        //   die();
        log_message('error', '---delivery ajith' . print_r($this->db->last_query(), true));
        if ($delivery_boy_list_query->num_rows() > 0) {
            $response[TAG_DELIVERY_BOYS_LIST] = $delivery_boy_list_query->result();
        }
        $this->db->select('*');
        $this->db->where(TAG_ACTIVE, 1);

        $delivery_boy_count_query = $this->db->get('delivery_boy');
        if ($delivery_boy_list_query->num_rows() > 0) {
            $response[TAG_DELIVERY_BOYS_COUNT] = $delivery_boy_count_query->num_rows();
        }
        return $response;
    }

    function delete_single_delivery_boy($id)
    {
        /*$this->db->select('image');
        $this->db->where(TAG_DELIVERY_BOY_ID, $id);
        $query = $this->db->get('delivery_boy');
        $result = $query->result();*/

        $this->db->where(TAG_SHOP_ID, $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $this->db->where(TAG_DELIVERY_BOY_ID, $id);
        $this->db->delete('shop_tag_delivery_boy');

        $data = array(
            TAG_SHOP_ID => NULL,
            TAG_ASSIGN_FLAG => 0
        );
        $this->db->where(TAG_DELIVERY_BOY_ID, $id);
        $this->db->update('delivery_boy', $data);

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

    function update_delivery_boy_deatils($post_data)
    {
        log_message('error','update_delivery_boy_deatils'.print_r($post_data,true));
        $flag = 0;
        $data = array(
            TAG_DELIVERY_BOY_NAME => $post_data[TAG_DELIVERY_BOY_NAME],
            TAG_MOBILE => $post_data[TAG_EDIT_MOBILE],
            TAG_EMAIL_ID => $post_data[TAG_EDIT_EMAIL],
            TAG_ACTIVE => $post_data[TAG_ACTIVE],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PLACE => $post_data[TAG_PLACE],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_COMMISSION_TYPE => $post_data[TAG_COMMISSION_TYPE],
            TAG_COMMISSION_AMOUNT => $post_data[TAG_COMMISSION_AMOUNT],
        );
        $this->db->where(TAG_DELIVERY_BOY_ID, $post_data[TAG_DELIVERY_BOY_ID]);
        $this->db->update('delivery_boy', $data);
        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }
        return $flag;
    }

    function add_shop_delivery_boy($where_data)
    {
        $flag = 0;
        $data = array(
            TAG_SHOP_ID => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
        );
        $this->db->where($where_data);
        $qry = $this->db->update('delivery_boy', $data);

        if ($qry) {

            $insert_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
            $insert_data[TAG_DELIVERY_BOY_ID] = $where_data[TAG_DELIVERY_BOY_ID];
            $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');

            $this->db->insert('shop_tag_delivery_boy', $insert_data);
            if ($this->db->affected_rows() > 0) {
                $flag = 1;
            }
        } else {
            echo "hari";
        }
        return $flag;
    }

    function insert_delivery_boy($post_data)
    {

        $password = $this->UtilityModels->generate_password();
        $data = array(
            //TAG_SHOP_ID => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
            TAG_PASSWORD => $password,
            TAG_ENTRY_DATE => date('Y-m-d H:i:s'),
            TAG_DELIVERY_BOY_NAME => $post_data[TAG_DELIVERY_BOY_NAME],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_ACTIVE => 0,
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PLACE => $post_data[TAG_PLACE],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_COMMISSION_TYPE => $post_data[TAG_COMMISSION_TYPE],
            TAG_COMMISSION_AMOUNT => $post_data[TAG_COMMISSION_AMOUNT],
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

        $output = null;
        // $query = $this->db->query("SELECT dby.*  FROM delivery_boy dby  LEFT JOIN shop_tag_delivery_boy stdby ON stdby.deliveryBoyId = dby.deliveryBoyId  WHERE stdby.shopId  = $shopId AND dby.active=1 ");

        $this->db->select('dby.*,sh.shopId,sh.deliveryTime,stdby.deliveryBoyId,stdby.shopId');
        $this->db->from('delivery_boy dby');
        $this->db->join('shops sh', 'sh.shopId=dby.shopId', 'left');
        $this->db->join('shop_tag_delivery_boy stdby', 'stdby.deliveryBoyId=dby.deliveryBoyId', 'left');
        $this->db->join('d_boy_payment dbp', 'dby.deliveryBoyId=dbp.deliveryBoyId', 'left');
        $this->db->where('stdby.shopId', $where_data[TAG_SHOP_ID]);
        $this->db->where('dby.active', 1);
        $this->db->where('dby.assignFlag', 0);

        $this->db->where("(`dbp`.`paidStatus` IS NULL OR `dbp`.`paidStatus` != 'NOT_PAID' OR DATE(`dbp`.`entryDate`)=CURDATE())");
        $this->db->group_by('dby.deliveryBoyId');
        $query = $this->db->get();

        log_message("error", "scxjhgsx theresa" . print_r($this->db->last_query(), true));
        // die();

        if ($query->num_rows()) {
            $output[TAG_DELIVERY_BOYS_LIST] = $query->result();
        }
        return $output;
    }

    function get_delivery_boys_list_for_add_to_shop($where_data)
    {
        $output = null;
        $shopId = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $sql_query = "SELECT `dbp`.`paidStatus`,`dby`.* FROM `delivery_boy` `dby` LEFT JOIN `d_boy_payment` `dbp` ON `dby`.`deliveryBoyId`=`dbp`.`deliveryBoyId` WHERE `dby`.`active` = '1'  and  (`dbp`.`paidStatus` IS NULL OR `dbp`.`paidStatus` != 'NOT_PAID' OR DATE(`dbp`.`entryDate`)=CURDATE()) GROUP BY `dby`.`deliveryBoyId` ";
        // $query = $this->db->query("SELECT dby.*,sh.shopId,sh.deliveryTime  FROM delivery_boy dby  LEFT JOIN shops sh ON sh.shopId = dby.shopId AND dby.shopId = $shopId WHERE  dby.active=1 ");
        $query = $this->db->query($sql_query);
        // $this->db->select('dby.*,sh.shopId,sh.deliveryTime');
        // $this->db->from('delivery_boy dby');
        // $this->db->join('shops sh', 'sh.shopId = dby.shopId AND dby.shopId = ' . $shopId,'left');
        // $this->db->join('d_boy_payment dbp','dby.shopId=dby.shopId and dbp.paidStatus!="NOT_PAID"','left');
        // $this->db->where('dby.active', '1');
        // $this->db->where('dby.active', '1');
        // $this->db->or_where('dby.active', '1');

        if ($query->num_rows()) {
            $output[TAG_DELIVERY_BOYS_LIST] = $query->result();
        }
        return $output;
    }



    function orders_list($where_data, $shop_id)
    {
        $output[TAG_ORDERS_LIST] = null;

        $this->db->select('os.*,sh.name,ui.name as userName,ui.mobile as mobile, ad.fullAddress, ad.houseName, ad.landmark, ad.pinCode');
        $this->db->from('order_summary os');
        $this->db->join('shops sh', 'sh.shopId=os.shopId', 'left');
        $this->db->join('user_info ui', 'ui.userId=os.userId', 'left');
        $this->db->join('address ad', 'ad.addressId=os.addressId', 'left');
        if (!empty($shop_id)) {
            $this->db->where('os.shopId', $where_data[TAG_SHOP_ID]);
        }
        $this->db->where('os.orderStatus', $where_data[TAG_ORDER_STATUS]);
        $query = $this->db->get();


        if ($query->num_rows()) {
            $output[TAG_ORDERS_LIST] = $query->result();
        }
        return $output;
    }


    function assign_order($where_data, $update_data)  //Use Transaction later
    {
        $this->db->trans_begin();

        $data = array(
            TAG_SHIPPING_TYPE => TAG_SHORT_SHIPPING,
            TAG_ORDER_STATUS => 'Assigned'
        );
        $this->db->where($where_data);
        $qry = $this->db->update('order_summary', $update_data);



        if ($qry) {
            $delivery_boy_data[TAG_DELIVERY_BOY_ID] = $update_data[TAG_DELIVERY_BOY_ID];
            $delivery_boy_data[TAG_ORDER_ID] = $where_data[TAG_ORDER_ID];
            $delivery_boy_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;
            $delivery_boy_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
            $this->db->insert('order_tag_delivery_boy', $delivery_boy_data);

            $this->db->select('dby.deliveryBoyName,dby.mobile,dby.deliveryBoyId,otdb.deliveryBoyId,otdb.orderId,dby.firebaseToken');
            $this->db->from('delivery_boy dby');
            $this->db->join('order_tag_delivery_boy otdb', 'dby.deliveryBoyId=otdb.deliveryBoyId', 'left');
            $this->db->where('otdb.orderId', $where_data[TAG_ORDER_ID]);
            $datas = $this->db->get();

            if ($datas->num_rows()) {
                $row = $datas->row();

                $delivery_boy_data[TAG_DELIVERY_BOY_NAME] = $row->deliveryBoyName;
                $delivery_boy_data[TAG_MOBILE] = $row->mobile;


                $this->db->select('*');
                $this->db->where(TAG_ORDER_ID, $where_data[TAG_ORDER_ID]);
                $order_details_query = $this->db->get('order_summary');
                if ($order_details_query->num_rows() > 0) {
                    $order_details = $order_details_query->row();
                    $order_shop_admin_query = $this->getShopAdminDataForOrder($order_details->shopId);
                    log_message('error', 'assign_order_admi_datan' . print_r($this->db->last_query(), true));

                    $order_user_details = $this->getUserDataForOrder($order_details->userId);
                    if ($order_shop_admin_query->num_rows() > 0) {
                        $shop_admin_token = "";
                        if (!empty($order_shop_admin_query->row()->firebaseToken)) {
                            $order_shop_admin_details = $order_shop_admin_query->row();
                            $shop_admin_token = $order_shop_admin_details->firebaseToken;

                            $notification_data = array(
                                TAG_TITLE => 'Hai ' . $row->deliveryBoyName . ' New Order Assigned from ' . $order_shop_admin_details->shopName,
                                TAG_BODY => 'Order No #' . $order_details->orderHashId . 'For more details please check ' . TAG_APP_NAME . ' delivery App',
                                TAG_IMAGE => ''
                            );



                            $shop_admin_notification_data = array(
                                TAG_TITLE => "Order No #" . $order_details->orderHashId . " Assigned to " . $delivery_boy_data[TAG_DELIVERY_BOY_NAME],
                                TAG_BODY => "Hai, Order No #" . $order_details->orderHashId . " You can call in delivery boy number : " . $delivery_boy_data[TAG_MOBILE] . ", For more details please check DayKart Admin App ",
                                TAG_IMAGE => "",
                            );

                            log_message('error', 'DELIVERY BOY  NOTIFICATION  : in assign_order model' . print_r($notification_data, true));

                            log_message('error', 'SHOP ADMIN AND SUPER ADMIN NOTIFICATION  : in assign_order model' . print_r($shop_admin_notification_data, true));
                            $this->UtilityModels->deviceTokenNotification($notification_data, $row->firebaseToken);

                            $this->UtilityModels->shopAdminDeviceTokenNotification($shop_admin_notification_data, $shop_admin_token);

                            $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $shop_admin_notification_data);
                        }
                    }
                }


                $data = array(
                    TAG_ORDER_ID => $where_data[TAG_ORDER_ID],
                    TAG_SHIPPING_TYPE => TAG_SHORT_SHIPPING,
                    TAG_SHIPPING_STATUS => 'Assigned to Deliveryboy',
                    TAG_PROGRESS_BAR_STATUS => 'Assigned',
                    TAG_REMARKS => 'Order Has been Assigned to ' . $delivery_boy_data[TAG_DELIVERY_BOY_NAME],
                    TAG_PRIORITY => 1

                );
                $query = $this->db->insert('order_shipping', $data);

                if ($query) {
                    $data = array(
                        TAG_ORDER_ID => $where_data[TAG_ORDER_ID],
                        TAG_SHIPPING_TYPE => TAG_SHORT_SHIPPING,
                        TAG_PROGRESS_BAR_STATUS => 'Assigned',
                        TAG_SHIPPING_STATUS => 'Item Collected From Seller',
                        TAG_REMARKS => 'Order Has been Collected From Shop For more details Contact Deliver Boy on ' . $delivery_boy_data[TAG_MOBILE],
                        TAG_PRIORITY => 1

                    );
                    $query1 = $this->db->insert('order_shipping', $data);

                    if ($query1) {
                        $data = array(
                            TAG_CURRENT_ORDER_ID => $where_data[TAG_ORDER_ID],
                            TAG_ASSIGN_FLAG => 1,
                        );
                        $this->db->where('deliveryBoyId', $update_data[TAG_DELIVERY_BOY_ID]);
                        $this->db->update('delivery_boy', $data);
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
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
            $shop_data = $query;
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



    function get_user_details_for_login($post_data)
    {
        $user_name = $post_data['shop_username'];
        $user_password = md5($post_data['shop_user_password']);

        $this->db->select('userId,userRole,activeShopId');
        $this->db->where('emailId = "' . $user_name . '" and password = "' . $user_password . '"');

        $this->db->where('(userRole="SuperAdmin" or userRole="ShopAdmin")');
        $query = $this->db->get('user_info');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_user_login_session($user_data)
    {

        $active_shop_name = "";

        if (!empty($user_data[0]->activeShopId)) {

            $this->db->select(TAG_NAME);
            $this->db->where(TAG_SHOP_ID, $user_data[0]->activeShopId);
            $qry = $this->db->get('shops');
            if ($qry->num_rows()) {
                $row = $qry->row();
                $active_shop_name = $row->name;
            }
        }


        $session_data = array(TAG_SESSION_USER_ID => $user_data[0]->userId, TAG_SESSION_USER_ROLE => $user_data[0]->userRole, TAG_SESSION_ACTIVE_SHOP_ID => $user_data[0]->activeShopId, TAG_SESSION_ACTIVE_SHOP_NAME => $active_shop_name);
        $this->session->set_userdata(TAG_E_BAAZAAR_LOGIN_SESSION, $session_data);
        return TRUE;
    }

    function validate_login_session()
    {
        if (!isset($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION])) {
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
            $this->session->unset_userdata(TAG_E_BAAZAAR_LOGIN_SESSION);
            return TRUE;
        }
    }

    public function get_all_item_details()
    {
        $this->db->select('items.*, shops.name as shopName');
        $this->db->join('shops', 'items.shopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = items.userId', 'inner');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->where('items.shopId', $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);

        $query = $this->db->get('items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_shop_details()
    {
        $this->db->select('shopId,name');
        $query = $this->db->get('shops');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_category_details()
    {
        $this->db->select('categoryId,name'); //TODO change name to categoryName
        $query = $this->db->get('category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_item_sub_category_details($cat_id)
    {
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

    public function get_all_item_category_for_shop($shop_id)
    {
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


    function fileext($text)
    {
        $ext1 = explode(".", $text);
        $cnt = count($ext1);
        $ext = $ext1[$cnt - 1];
        $extEN = strtolower($ext);
        return $extEN;
    }


    function insert_item_deatils($post_data, $file_data)
    {
        //'itemType' => $post_data['itemType'],
        //'availabilityStatus' => $post_data['availabilityStatus'],

        $gst = $this->get_shop_gst();



        $data = array(
            'shopId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
            'categoryId' => $post_data['categoryId'] ? $post_data['categoryId'] : NULL,
            'name' => $post_data['name'],
            'availabilityStatus' => 0,
            'price' => $post_data['price'],
            'offerPrice' => $post_data['offerPrice'],
            'recommendedItemFlag' => isset($post_data['recommendedItemFlag']) ? $post_data['recommendedItemFlag'] : 0,
            'popularItemFlag' => isset($post_data['popularItemFlag']) ? $post_data['popularItemFlag'] : 0,
            'bestItemFlag' => isset($post_data['bestItemFlag']) ? $post_data['bestItemFlag'] : 0,
            'description' => $post_data['description'],
            'entryDate' => date('Y-m-d H:i:s'),
            'userId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ID],
            'itemGst' => $gst,
            TAG_ITEM_PRIORITY => $post_data[TAG_ITEM_PRIORITY]
        );

        $this->db->insert('items', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();

            $insert_temp_data = array(
                TAG_ITEM_ID => $id,
                'tempPrice' => $post_data['price'],
                'tempOfferPrice' => $post_data['offerPrice'],
                'tempAvailabilityStatus' => $post_data['availabilityStatus'],
                TAG_ENTRY_DATE => date('Y-m-d H:i:s')
            );
            $insert_qry = $this->db->insert('temp_item_details', $insert_temp_data);
            if ($insert_qry) {
                $this->update_db_version();
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
        } else {
            return 0;
        }
    }

    function get_shop_gst()
    {
        $gst = 0;
        $this->db->select(TAG_SHOP_GST);
        $this->db->where(TAG_SHOP_ID, $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $qry = $this->db->get('shops');

        if ($qry->num_rows()) {
            $row = $qry->row();
            $gst = $row->shopGst;
        }
        return $gst;
    }

    function get_single_item_details($id)
    {
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

    function delete_single_item($id)
    {
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



    function update_item_deatils($post_data, $file_data)
    {

        $this->db->trans_begin();
        $flag = 0;
        $data = array(
            'categoryId' => $post_data['categoryId'] ? $post_data['categoryId'] : NULL,
            'name' => $post_data['name'],
            'availabilityStatus' => 0,
            'recommendedItemFlag' => isset($post_data['recommendedItemFlag']) ? $post_data['recommendedItemFlag'] : 0,
            'popularItemFlag' => isset($post_data['popularItemFlag']) ? $post_data['popularItemFlag'] : 0,
            'bestItemFlag' => isset($post_data['bestItemFlag']) ? $post_data['bestItemFlag'] : 0,
            'description' => $post_data['description'],
            TAG_ITEM_PRIORITY => $post_data[TAG_ITEM_PRIORITY]
        );
        $this->db->where('itemId', $post_data['itemId']);
        $qry = $this->db->update('items', $data);
        if ($qry) {

            $cart_updated_data[TAG_CART_ACTIVE_ITEM] = 0;
            $this->db->where(TAG_ITEM_ID, $post_data[TAG_ITEM_ID]);
            $this->db->update('cart', $cart_updated_data);

            $temp_where_data[TAG_ITEM_ID] = $post_data[TAG_ITEM_ID];

            $this->db->select(TAG_ITEM_ID);
            $this->db->where($temp_where_data);
            $temp_query = $this->db->get('temp_item_details');
            if ($temp_query->num_rows()) {
                $update_temp_data = array(
                    'tempPrice' => $post_data['price'],
                    'tempOfferPrice' => $post_data['offerPrice'],
                    'tempAvailabilityStatus' => $post_data['availabilityStatus'],
                    TAG_ENTRY_DATE => date('Y-m-d H:i:s')
                );

                $this->db->where(TAG_ITEM_ID, $post_data[TAG_ITEM_ID]);
                $upd_qry = $this->db->update('temp_item_details', $update_temp_data);
                if ($upd_qry) {
                    $flag = 1;
                }
            } else {
                $insert_temp_data = array(
                    TAG_ITEM_ID => $post_data[TAG_ITEM_ID],
                    'tempPrice' => $post_data['price'],
                    'tempOfferPrice' => $post_data['offerPrice'],
                    'tempAvailabilityStatus' => $post_data['availabilityStatus'],
                    TAG_ENTRY_DATE => date('Y-m-d H:i:s')
                );
                $this->db->insert('temp_item_details', $insert_temp_data);
                if ($this->db->affected_rows() > 0) {
                    $flag = 1;
                }
            }

            $this->update_db_version();
        }

        $item_details = $this->get_single_item_details($post_data['itemId']);
        $config = array(
            'upload_path' => './images/items/grocery/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image']['name'] != '') {
            if ($item_details[0]->image) {
                log_message("debug", "IMAGE-Update" . $item_details[0]->image);
                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                $this->db->select('default_image');
                $shop_category_data = $this->db->get('shop_category')->result();
                foreach ($shop_category_data as $value) {
                    $default_images[] = $value->default_image;
                }


                if (!in_array($item_details[0]->image, $default_images)) {
                    log_message("debug", "Def_IMGS-TRUE-" . in_array($item_details[0]->image, $default_images));

                    @unlink($item_details[0]->image);
                }
                log_message("debug", "Def_IMGS-FALSE-" . in_array($item_details[0]->image, $default_images));

                log_message("debug", "Def_IMGS-FALSE");
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
        if ($file_data['bestItemImage']['name'] != '') {
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

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $flag;
        } else {
            $this->db->trans_commit();
            return $flag;
        }
    }

    function update_shop($post_data, $file_data)
    {
        $flag = false;
        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_SHOP_CATEGORY_ID => $post_data[TAG_SHOP_CATEGORY_ID],
            TAG_ACTIVE => 0,
            TAG_MINIMUM_ORDER => $post_data[TAG_MINIMUM_ORDER],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_DELIVERY_FEE => $post_data[TAG_DELIVERY_FEE],
            TAG_DELIVERY_BASE_AMOUNT => $post_data[TAG_DELIVERY_BASE_AMOUNT],
            TAG_DELIVERY_FEE_BASE_KM => $post_data[TAG_DELIVERY_FEE_BASE_KM],
            TAG_PACKING_CHARGE => $post_data[TAG_PACKING_CHARGE],
            TAG_LOCATION => $post_data[TAG_LOCATION],
            TAG_SHOP_EMAIL_ID => $post_data[TAG_SHOP_EMAIL_ID],
            TAG_SHOP_MOBILE => $post_data[TAG_SHOP_MOBILE],
            TAG_SHOP_LANDLINE => $post_data[TAG_SHOP_LANDLINE],
            TAG_SHOP_PRIORITY => $post_data[TAG_SHOP_PRIORITY],
            TAG_DELIVERY_TIME => $post_data[TAG_DELIVERY_TIME],

        );

        $this->db->where(TAG_SHOP_ID, $post_data[TAG_SHOP_ID]);
        $qry = $this->db->update('shops', $data);
        if ($qry) {

            $cart_updated_data[TAG_CART_ACTIVE_ITEM] = 0;
            $this->db->where(TAG_SHOP_ID, $post_data[TAG_SHOP_ID]);
            $this->db->update('cart', $cart_updated_data);


            $temp_where_data[TAG_SHOP_ID] = $post_data[TAG_SHOP_ID];

            $this->db->select(TAG_SHOP_ID);
            $this->db->where($temp_where_data);
            $temp_query = $this->db->get('temp_shop_details');

            if ($temp_query->num_rows()) {
                $update_temp_data = array(
                    'tempShopGst' => $post_data[TAG_SHOP_GST],
                    'tempActive' => $post_data[TAG_ACTIVE],
                    TAG_ENTRY_DATE => date('Y-m-d H:i:s')
                );

                $this->db->where(TAG_SHOP_ID, $post_data[TAG_SHOP_ID]);
                $upd_qry = $this->db->update('temp_shop_details', $update_temp_data);
                if ($upd_qry) {
                    $flag = true;
                }
            } else {
                $insert_temp_data = array(
                    TAG_SHOP_ID => $post_data[TAG_SHOP_ID],
                    'tempShopGst' => $post_data[TAG_SHOP_GST],
                    'tempActive' => $post_data[TAG_ACTIVE],
                    TAG_ENTRY_DATE => date('Y-m-d H:i:s')
                );
                $this->db->insert('temp_shop_details', $insert_temp_data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }

            $this->update_db_version();
        }

        $config = array(
            'upload_path' => './images/items/grocery/category/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image']['name'] != '') {
            if ($post_data['currentImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink($post_data['currentImage']);
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
        if ($file_data['bannerImage']['name'] != '') {
            if ($post_data['currentBannerImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink($post_data['currentBannerImage']);
            }
            if ($this->upload->do_upload('bannerImage')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/category/' . $files['file_name'];
                $data = array('bannerImage' => $photo);
                $this->db->where('shopId', $post_data[TAG_SHOP_ID]);
                $this->db->update('shops', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }
        }

        return $flag;
    }

    function update_item_deatils_new_shintu($post_data, $file_data)
    {
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

    function insert_import_item($file_data)
    {
        move_uploaded_file($file_data["item_import_file"]["tmp_name"], 'excel/dummy/' . $file_data['item_import_file']['name']);
        $this->load->library('PHPExcel');
        $inputFileType = 'Excel2007';
        $inputFileName = 'excel/dummy/' . $_FILES['item_import_file']['name'];
        log_message("debug", "insert_import_items");
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

        $res = array();
        $row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        for ($i = 2; $i <= $row; $i++) {

            $shop_id = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(0, $i)->getValue() : '0';




            $cat_id = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(1, $i)->getValue() : '0';
            $name = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(2, $i)->getValue() : '';

            if (($shop_id != '0') && ($cat_id != '0') && ($name != '')) {
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
                                'userId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ID],
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
            } else {
                $res[$i]['msg'] = 'This is end of Excel file';
                $res[$i]['flag'] = 0;
                break;
            }
        }
        return $res;
    }



    function get_enum_values($table, $field)
    {
        $type = $this->db->query("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")->row(0)->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    function get_order_details($post_data)
    {
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
        $this->db->where('order_summary.shopId', $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
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
        $this->db->join('shops sh', 'sh.shopId=os.shopId', 'left');
        $this->db->join('user_info ui', 'ui.userId=os.userId', 'left');
        $this->db->join('delivery_boy db', 'os.deliveryBoyId=db.deliveryBoyId', 'left');
        $this->db->join('address ad', 'ad.addressId=os.addressId', 'left');
        $this->db->where('os.orderId', $where_data[TAG_ORDER_ID]);

        $query = $this->db->get();

        if ($query->num_rows()) {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_ORDER_HASH_ID] = $row->orderHashId;
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
            $this->db->select('od.*,itm.itemId,itm.price,itm.offerPrice');
            $this->db->from('order_details od');
            $this->db->join('items itm', 'itm.itemId=od.itemId', 'left');
            // $this->db->select("itemName,quantity,amount");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get();


            if ($item_query_query->num_rows()) {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }
            $output[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

    function publish_db_changes()
    {
        $this->db->trans_begin();
        //Item Table
        $temp_item = $this->db->get('temp_item_details');
        if ($temp_item->num_rows()) {
            foreach ($temp_item->result() as $row) {

                $this->db->select("itemId, availabilityStatus, offerPrice, price, itemGst, name");
                $this->db->where(TAG_ITEM_ID, $row->itemId);
                $item_qry = $this->db->get('items');
                if ($item_qry->num_rows()) {
                    $item_row = $item_qry->row();

                    $update_item_data[TAG_OFFER_PRICE] = $row->tempOfferPrice;
                    $update_item_data[TAG_PRICE] = $row->tempPrice;
                    $update_item_data[TAG_AVAILABILITY_STATUS] = $row->tempAvailabilityStatus;

                    $this->db->where(TAG_ITEM_ID, $item_row->itemId);
                    $update_qry = $this->db->update('items', $update_item_data);
                    if ($update_qry) {
                        $gst_amount_for_item = ($row->tempOfferPrice * $item_row->itemGst) / 100;
                        $update_cart_data[TAG_CART_ACTIVE_ITEM] = $row->tempAvailabilityStatus;
                        $update_cart_data[TAG_CART_GST] = $gst_amount_for_item;
                        $this->db->where(TAG_ITEM_ID, $item_row->itemId);
                        $this->db->update('cart', $update_cart_data);
                    }
                }
            }
            // $this->update_db_version();
            $this->db->query("delete from temp_item_details where 1");
        }

        $temp_shop = $this->db->get('temp_shop_details');
        if ($temp_shop->num_rows()) {
            foreach ($temp_shop->result() as $shopRow) {

                $this->db->select("shopId, active, shopGst");
                $this->db->where(TAG_SHOP_ID, $shopRow->shopId);
                $shop_qry = $this->db->get('shops');
                if ($shop_qry->num_rows()) {
                    $item_shop_row = $shop_qry->row();

                    $update_shop_data[TAG_SHOP_GST] = $shopRow->tempShopGst;
                    $update_shop_data[TAG_ACTIVE] = $shopRow->tempActive;

                    $this->db->where(TAG_SHOP_ID, $item_shop_row->shopId);
                    $update_shop_qry = $this->db->update('shops', $update_shop_data);
                    if ($update_shop_qry) {
                        $item_where_data[TAG_SHOP_ID] = $item_shop_row->shopId;
                        $item_update_data_from_shop[TAG_ITEM_GST] = $shopRow->tempShopGst;

                        $this->db->where($item_where_data);
                        $qry = $this->db->update('items', $item_update_data_from_shop);
                        if ($qry) {
                            $this->db->where(TAG_SHOP_ID, $item_shop_row->shopId);
                            $cart_qry = $this->db->get('cart');
                            if ($cart_qry->num_rows()) {
                                foreach ($cart_qry->result() as $cart_row) {

                                    $this->db->select('itemId, itemGst, offerPrice');
                                    $this->db->where(TAG_ITEM_ID, $cart_row->itemId);
                                    $item_qry2 = $this->db->get('items')->row();

                                    if (!empty($item_qry2)) {
                                        $gst_amount_for_item = ($item_qry2->offerPrice * $item_qry2->itemGst) / 100;
                                        $update_cart_data[TAG_CART_GST] = $gst_amount_for_item;
                                        $update_cart_data[TAG_CART_ACTIVE_ITEM] = $shopRow->tempActive;
                                        $this->db->where(TAG_ITEM_ID, $item_qry2->itemId);
                                        $this->db->update('cart', $update_cart_data);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $this->db->query("delete from temp_shop_details where 1");
        }

        $this->update_db_version();

        //$response = $this->UtilityModels->sendToTopic("isDbVersionChanged");
        //print_r($response);
        //echo "gfdsgfd";

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "Updated Failed";
        } else {
            $this->db->trans_commit();
            echo "Successfully Updated";
        }
    }

    function publish_app_version()
    {
        echo "Successfully Published";
    }


    function publish_shop($id)
    {

        $update_data["publishFlag"] = 1;
        $this->db->where('shopId', $id);
        $qry = $this->db->update('shops', $update_data);
        if ($qry) {
            echo 'Shop Published successfully';
        } else {
            echo 'Something went wroung!';
        }
    }

    function update_db_version()
    {
        $add_value = 0.1;
        $this->db->set('versionCode', 'versionCode+' . $add_value, false);
        $result = $this->db->update('db_version');
        return $result;
    }



    function update_app_version()
    {
        $this->UtilityModels->sendToTopic("isAppVersionChanged");
    }

    function send_push_notification($post_data, $file_data)
    {


        $flag = false;
        $config = array(
            'upload_path' => './images/offers/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image'] != '') {
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/offers/' . $files['file_name'];

                $data = array(
                    TAG_TITLE => $post_data[TAG_TITLE],
                    TAG_BODY => $post_data[TAG_BODY],
                    TAG_IMAGE => base_url($photo)
                );

                $this->UtilityModels->userSendGeneralNotification("isGeneralNotification", "userGlobalNotification", $data);
                $flag = true;
            }
        }

        return $flag;
    }

    function check_active_orders_to_publish()
    {
        $flag = 1;
        $where_in_data = array(TAG_ORDER_STATUS_CANCELLED, TAG_ORDER_STATUS_DELIVERED);
        $this->db->select("orderId, orderStatus");
        $this->db->where_not_in(TAG_ORDER_STATUS, $where_in_data);
        $qry = $this->db->get('order_summary');

        if ($qry->num_rows() < 1) {
            $flag = 1;
        }
        return $flag;
    }

    public function get_banner()
    {

        $this->db->select('banner.*');
        $query = $this->db->get('banner');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function insert_banner($post_data, $file_data)
    {
        $data = array(

            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION]
        );

        $this->db->insert('banner', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/banner/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['banner'] != '') {
                if ($this->upload->do_upload('banner')) {
                    $files = $this->upload->data();
                    $photo = 'images/banner/' . $files['file_name'];
                    // echo $photo;
                    $data = array('banner' => $photo);
                    $this->db->where('id', $id);
                    $this->db->update('banner', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }

    public function get_single_banner_details($id)
    {
        $where_data[TAG_BANNER_ID] = $id;
        $this->db->select('banner.*', 'banner_details.name as bannerDetails');
        $this->db->where($where_data);

        $query = $this->db->get('banner');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    public function check_banner_items($id)
    {
        $this->db->select("id");
        $this->db->where(TAG_BANNER_ID, $id);
        $qry = $this->db->get('banner');

        return $qry->num_rows();
    }

    public function get_all_banner_categories()
    {

        $this->db->select('id');
        $query = $this->db->get('banner');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function update_banner($post_data, $file_data)
    {
        $flag = false;
        $data = array(
            TAG_DESCRIPTION => $post_data[TAG_DESCRIPTION],
            TAG_STATUS => $post_data[TAG_STATUS]

        );

        $this->db->where(TAG_BANNER_ID, $post_data[TAG_BANNER_ID]);
        $qry = $this->db->update('banner', $data);


        $config = array(
            'upload_path' => './images/banner/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['banner']['name'] != '') {
            if ($post_data['currentImage']) {

                //@unlink('images/items/grocery/' . $item_details[0]->image . '');
                @unlink($post_data['currentImage']);
            }
            if ($this->upload->do_upload('banner')) {
                $files = $this->upload->data();
                $photo = 'images/banner/' . $files['file_name'];
                $data = array('banner' => $photo);
                $this->db->where('id', $post_data[TAG_BANNER_ID]);
                $this->db->update('banner', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    function insert_coupon_code($post_data)
    {


        $this->db->select('coupon_code.*, shops.shopId,shops.name,user_info.orderCount');
        $this->db->join('shops', 'shops.shopId=coupon_code.shopId', 'inner');
        $this->db->join('user_info', 'user_info.oderCount=coupon_code.');
        $this->db->get();
        $data = array();

        if ($post_data[TAG_SHOP_ID] == 0) {
            $shopIds = explode(',', $post_data[TAG_SHOP_IDS]);
            $index = 0;
            foreach ($shopIds as $value) {

                $data[$index] = $this->get_coupon_post_data($post_data, $value);
                $index++;
            }
        } else {
            $data[0] = $this->get_coupon_post_data($post_data, $post_data[TAG_SHOP_ID]);
        }


        return  $this->db->insert_batch('coupon_code', $data);
    }

    function get_coupon_post_data($post_data, $shopId)
    {
        if ($post_data[TAG_COUPON_TYPE] == 0) {
            $data = array(
                TAG_SHOP_ID => $shopId,
                strtoupper(TAG_COUPON_NAME) =>  strtoupper($post_data[TAG_COUPON_NAME]),
                TAG_COUPON_NUMBER => $post_data[TAG_COUPON_NUMBER],
                strtoupper(TAG_COUPON_CODE) => strtoupper($post_data[TAG_COUPON_NAME] . $post_data[TAG_COUPON_NUMBER]),
                TAG_COUPON_STATUS => $post_data[TAG_COUPON_STATUS],
                TAG_COUPON_TYPE => $post_data[TAG_COUPON_TYPE],
                TAG_FIXED_AMOUNT => $post_data[TAG_FIXED_AMOUNT],
                TAG_MIN_PURCHASE_AMOUNT => $post_data[TAG_MIN_PURCHASE_AMOUNT],
                TAG_MAX_DISCOUNT_AMOUNT => $post_data[TAG_MAX_DISCOUNT_AMOUNT]
            );
        } else if ($post_data[TAG_COUPON_TYPE] == 1) {
            $data = array(
                TAG_SHOP_ID => $shopId,
                strtoupper(TAG_COUPON_NAME) =>  strtoupper($post_data[TAG_COUPON_NAME]),
                TAG_COUPON_NUMBER => $post_data[TAG_COUPON_NUMBER],
                strtoupper(TAG_COUPON_CODE) => strtoupper($post_data[TAG_COUPON_NAME] . $post_data[TAG_COUPON_NUMBER]),
                TAG_COUPON_STATUS => $post_data[TAG_COUPON_STATUS],
                TAG_COUPON_TYPE => $post_data[TAG_COUPON_TYPE],
                TAG_COUPON_PERCENTAGE => $post_data[TAG_COUPON_PERCENTAGE],
                TAG_MIN_PURCHASE_AMOUNT => $post_data[TAG_MIN_PURCHASE_AMOUNT],
                TAG_MAX_DISCOUNT_AMOUNT => $post_data[TAG_MAX_DISCOUNT_AMOUNT]
            );
        } else if ($post_data[TAG_COUPON_TYPE] == 2) {
            $data = array(
                TAG_SHOP_ID => $shopId,
                strtoupper(TAG_COUPON_NAME) =>  strtoupper($post_data[TAG_COUPON_NAME]),
                TAG_COUPON_NUMBER => $post_data[TAG_COUPON_NUMBER],
                strtoupper(TAG_COUPON_CODE) => strtoupper($post_data[TAG_COUPON_NAME] . $post_data[TAG_COUPON_NUMBER]),
                TAG_COUPON_STATUS => $post_data[TAG_COUPON_STATUS],
                TAG_COUPON_TYPE => $post_data[TAG_COUPON_TYPE],
                TAG_NUMBER_OF_ORDERS => $post_data[TAG_NUMBER_OF_ORDERS],
                TAG_ORDER_COUNT_TYPE => $post_data[TAG_ORDER_COUNT_TYPE],
                TAG_MIN_PURCHASE_AMOUNT => $post_data[TAG_MIN_PURCHASE_AMOUNT],
                TAG_MAX_DISCOUNT_AMOUNT => $post_data[TAG_MAX_DISCOUNT_AMOUNT]
            );
            if (isset($post_data[TAG_ORDER_COUNT_FIXED])) {
                $data[TAG_FIXED_AMOUNT] = $post_data[TAG_ORDER_COUNT_FIXED];
            }
            if (isset($post_data[TAG_ORDER_COUNT_PERCENTAGE])) {
                $data[TAG_COUPON_PERCENTAGE] = $post_data[TAG_ORDER_COUNT_PERCENTAGE];
            }
        }
        return $data;
    }

    public function coupon_view()
    {
        /*$where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $this->db->where($where_data);*/
        $this->db->select('coupon_code.*');
        $query = $this->db->get('coupon_code');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_single_coupon_details($id)
    {
        $where_data[TAG_COUPON_ID] = $id;
        $this->db->select('*');
        $this->db->where($where_data);

        $query = $this->db->get('coupon_code');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }


    function update_coupon($post_data)
    {
        $flag = 0;
        $data = array(
            strtoupper(TAG_COUPON_NAME) =>  strtoupper($post_data[TAG_COUPON_NAME]),
            TAG_COUPON_NUMBER => $post_data[TAG_COUPON_NUMBER],
            strtoupper(TAG_COUPON_CODE) => strtoupper($post_data[TAG_COUPON_NAME] . $post_data[TAG_COUPON_NUMBER]),
        );
        $this->db->where(TAG_COUPON_ID, $post_data[TAG_COUPON_ID]);
        $this->db->update('coupon_code', $data);
        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }
        return $flag;
    }

    function delete_coupon($id)
    {

        $this->db->where(TAG_COUPON_ID, $id);
        $this->db->delete('coupon_code');
        if ($this->db->affected_rows() == 0) {
            // echo "<script> alert('Something went wrong !')</script>";
        } else {

            //  echo "<script>alert('Record deleted successfully !');<script>";
        }
    }

    function get_shop_details()
    {
        $this->db->select('shopId,name');
        $result = $this->db->get('shops')->result();
        return $result;
    }


    function get_details_for_quick_shop()
    {
        $output = null;
        $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID] = 1;
        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
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


    function quick_insert_items($post_data, $file_data)
    {
        //'itemType' => $post_data['itemType'],
        //'availabilityStatus' => $post_data['availabilityStatus'],

        $gst = $this->get_shop_gst();


        $data = array(
            'quickShopId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID],
            'quickCategoryId' => $post_data['quickCategoryId'] ? $post_data['quickCategoryId'] : NULL,
            'quickName' => $post_data['quickName'],
            'quickAvailabilityStatus' => 0,
            'quickPrice' => $post_data['quickPrice'],
            'quickPurchasePrice' => $post_data['quickPurchasePrice'],
            'quickOfferPrice' => $post_data['quickOfferPrice'],
            'quickRecommendedItemFlag' => isset($post_data['quickRecommendedItemFlag']) ? $post_data['quickRecommendedItemFlag'] : 0,
            'quickPopularItemFlag' => isset($post_data['quickPopularItemFlag']) ? $post_data['quickPopularItemFlag'] : 0,
            'quickBestItemFlag' => isset($post_data['quickBestItemFlag']) ? $post_data['quickBestItemFlag'] : 0,
            'quickDescription' => $post_data['quickDescription'],
            'quickEntryDate' => date('Y-m-d H:i:s'),
            'quickUserId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ID],
            'quickItemGst' => $gst,
            TAG_QUICK_ITEM_PRIORITY => $post_data[TAG_QUICK_ITEM_PRIORITY]
        );

        $this->db->insert('quick_items', $data);

        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();

            $config = array(
                'upload_path' => './images/items/grocery/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['quickImage'] != '') {
                if ($this->upload->do_upload('quickImage')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/' . $files['file_name'];
                    $data = array('quickImage' => $photo);
                    $this->db->where('quickItemId', $id);
                    $this->db->update('quick_items', $data);
                }
            }
            if ($file_data['quickBestItemImage'] != '') {
                if ($this->upload->do_upload('quickBestItemImage')) {
                    $files = $this->upload->data();
                    $photo = 'images/items/grocery/' . $files['file_name'];
                    $data = array('quickBestItemImage' => $photo);
                    $this->db->where('quickItemId', $id);
                    $this->db->update('quick_items', $data);
                }
            }
            return $id;
        } else {
            return 0;
        }
    }

    public function get_all_quick_item_details()
    {
        $this->db->select('quick_items.*, shops.name as shopName');
        $this->db->join('shops', 'quick_items.quickShopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = quick_items.quickUserId', 'inner');
        $this->db->order_by('quick_items.quickItemPriority', "asc");
        $this->db->where('quick_items.quickShopId', $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $query = $this->db->get('quick_items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_quick_single_item_details($id)
    {
        $this->db->select('quick_items.*,shops.name as shopName,category.name as subCatName,user_info.name as userName');
        $this->db->join('shops', 'quick_items.quickShopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = quick_items.quickUserId', 'inner');
        $this->db->join('category', 'category.categoryId = quick_items.quickCategoryId', 'left');
        $this->db->where('quickItemId = "' . $id . '" ');
        $query = $this->db->get('quick_items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function update_quick_item_deatils($post_data, $file_data)
    {

        $flag = false;
        $data = array(
            'quickCategoryId' => $post_data['quickCategoryId'] ? $post_data['quickCategoryId'] : NULL,
            'quickName' => $post_data['quickName'],
            'quickAvailabilityStatus' => 0,
            'quickRecommendedItemFlag' => isset($post_data['quickRecommendedItemFlag']) ? $post_data['quickRecommendedItemFlag'] : 0,
            'quickPopularItemFlag' => isset($post_data['quickPopularItemFlag']) ? $post_data['quickPopularItemFlag'] : 0,
            'quickBestItemFlag' => isset($post_data['quickBestItemFlag']) ? $post_data['quickBestItemFlag'] : 0,
            'quickDescription' => $post_data['quickDescription'],
            TAG_QUICK_ITEM_PRIORITY => $post_data[TAG_QUICK_ITEM_PRIORITY]
        );
        $this->db->where('quickItemId', $post_data['quickItemId']);
        $qry = $this->db->update('quick_items', $data);


        if ($qry) {
            $flag = true;
        }


        $config = array(
            'upload_path' => '.images/items/grocery/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($file_data['quickImage']['name'] != '') {
            if ($post_data['currentImage']) {
                @unlink($post_data['currentImage']);
            }

            if ($this->upload->do_upload('quickImage')) {
                $files = $this->upload->data();
                $photo = 'images/items/grocery/' . $files['file_name'];
                $data = array('quickImage' => $photo);
                $this->db->where('quickItemId', $post_data[TAG_QUICK_ITEM_ID]);
                $this->db->update('quick_items', $data);
            }
        }
        return $flag;
    }


    function import_quick_item($file_data)
    {
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

            if (($shop_id != '0') && ($cat_id != '0') && ($name != '')) {
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
                        $purchase_price = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(6, $i)->getValue() : '0';
                        $offer_price = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(7, $i)->getValue() : '0';
                        $recommended_item = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(8, $i)->getValue() : '0';
                        $popular_item = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(9, $i)->getValue() : '0';
                        $best_item = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(10, $i)->getValue() : '0';
                        $description = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(11, $i)->getValue() : '';
                        $image = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(12, $i)->getValue() : '';
                        $gst = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(13, $i)->getValue() : '';
                        $priority = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue() ? $objWorksheet->getCellByColumnAndRow(14, $i)->getValue() : '0';


                        $this->db->select('quickItemId');
                        $this->db->where('quickName = "' . $name . '" and quickShopId = ' . $shop_id . ' and quickCategoryId = ' . $cat_id . '');
                        $query = $this->db->get('quick_items');
                        if ($query->num_rows() == 0) {
                            $data = array(
                                'quickShopId' => $shop_id,
                                'quickUserId' => $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ID],
                                'quickName' => $name,
                                'quickItemType' => $type,
                                'quickDescription' => $description,
                                'quickCategoryId' => $cat_id,
                                'quickImage' => $image,
                                'quickAvailabilityStatus' => $available_status,
                                'quickPrice' => $price,
                                'quickPurchasePrice' => $purchase_price,
                                'quickOfferPrice' => $offer_price,
                                'quickRecommendedItemFlag' => $recommended_item,
                                'quickPopularItemFlag' => $popular_item,
                                'quickBestItemFlag' => $best_item,
                                'quickEntryDate' => date('Y-m-d H:i:s'),
                                'quickItemGst' => $gst,
                                'quickItemPriority' => $priority
                            );
                            $this->db->insert('quick_items', $data);
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
            } else {
                $res[$i]['msg'] = 'This is end of Excel file';
                $res[$i]['flag'] = 0;
                break;
            }
        }
        return $res;
    }

    function add_quick_cart($post_data)
    {
        $data = array(
            TAG_QUICK_ITEM_ID => $post_data[TAG_QUICK_ITEM_ID],
            TAG_QUICK_ITEM_NAME => $post_data[TAG_QUICK_ITEM_NAME],
            TAG_QUICK_QUANTITY => 1,
            TAG_QUICK_AMOUNT => $post_data[TAG_QUICK_AMOUNT],
        );

        $result = $this->db->insert('quick_cart', $data);
        if ($result) {
            echo 'Item successfully added';
        } else {
            echo '!Oops item didn\'t add please try again';
        }
    }


    public function get_all_quick_details()
    {
        $this->db->select('items.*, shops.name as shopName');
        $this->db->join('quick_cart qc', 'items.itemId = qc.quickItemId and qc.cartActiveItem="ActiveOrder"', 'left');
        $this->db->join('shops', 'items.shopId = shops.shopId', 'inner');
        $this->db->join('user_info', 'user_info.userId = items.userId', 'inner');
        $this->db->order_by('items.itemPriority', "asc");
        $this->db->group_by('items.itemId');
        $this->db->where('qc.quickItemId is NULL');
        // $this->db->where('qc.cartActiveItem', 'OrderCompleted');
        $this->db->where('items.shopId', $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);

        $query = $this->db->get('items');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function get_all_cart_items()
    {
        $this->db->select('quickGst,quickCartId,quickItemName,quickQuantity,quickAmount');
        $this->db->where('cartActiveItem', 'ActiveOrder');
        $query = $this->db->get('quick_cart');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function increment_cart($cartId)
    {

        $result = false;
        $this->db->set('quickQuantity', 'quickQuantity+1', FALSE);
        $this->db->where('quickCartId', $cartId);
        $result = $this->db->update('quick_cart');
        if ($result) {
            return true;
        }
    }

    public function decrement_cart($cartId, $quatity)
    {
        $result = false;
        if ($quatity == 1) {
            $this->db->where('quickCartId', $cartId);
            $this->db->delete('quick_cart');
        } else {
            $this->db->set('quickQuantity', 'quickQuantity-1', FALSE);
            $this->db->where('quickCartId', $cartId);
            $result = $this->db->update('quick_cart');
        }

        if ($result) {
            return true;
        }
    }

    function complete_quick_order($post_data)
    {
        $this->db->where(TAG_MOBILE, $post_data['mobile']);
        $result = $this->db->get('user_info');
        if ($result->num_rows() > 0) {
            $data = array(
                'name' => $post_data['name'],
                'address' => $post_data['address'],
                'entryDate' => date('Y-m-d H:i:s'),
            );
            $this->db->where(TAG_MOBILE, $post_data['mobile']);
            $this->db->update('user_info', $data);
            if ($this->db->affected_rows() > 0) {
                $id1 = $this->db->insert_id();

                $data1 = array(
                    'userId' => $result->row()->userId,
                    'shopId' => $post_data['shopId'],
                    'orderAmount' => $post_data['grandTotal'],
                    'paymentMode' => $post_data['paymentMode'],
                    'deliveryFee' => $post_data['deliveryFee'],
                    'paymentAmount' => $post_data['grandTotal'] + $post_data['deliveryFee'],
                    TAG_ORDER_SUMMARY => 'OrderCompleted',
                );
                $this->db->insert('quick_order', $data1);


                if ($this->db->affected_rows() > 0) {

                    $orderId = $this->db->insert_id();
                    $data2 = array('orderId' => $orderId);
                    $this->db->where('cartActiveItem', 'ActiveOrder');
                    $this->db->update('quick_cart', $data2);
                    $this->db->set('quick_cart.cartActiveItem', 'OrderCompleted');
                    $this->db->update('quick_cart');
                    return $orderId;
                }
            }
        } else {
            $data = array(
                'name' => $post_data['name'],
                'mobile' => $post_data['mobile'],
                'address' => $post_data['address'],
                'entryDate' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('user_info', $data);

            if ($this->db->affected_rows() > 0) {
                $id1 = $this->db->insert_id();

                $data1 = array(
                    'userId' => $id1,
                    'shopId' => $post_data['shopId'],
                    'orderAmount' => $post_data['grandTotal'],
                    'paymentMode' => $post_data['paymentMode'],
                    'deliveryFee' => $post_data['deliveryFee'],
                    'paymentAmount' => $post_data['grandTotal'] + $post_data['deliveryFee'],
                    TAG_ORDER_SUMMARY => 'OrderCompleted',
                );
                $this->db->insert('quick_order', $data1);

                if ($this->db->affected_rows() > 0) {
                    $orderId = $this->db->insert_id();

                    $data2 = array('orderId' => $orderId);
                    $this->db->where('cartActiveItem', 'ActiveOrder');
                    $this->db->update('quick_cart', $data2);
                    $this->db->set('quick_cart.cartActiveItem', 'OrderCompleted');
                    $this->db->update('quick_cart');
                    return $orderId;
                }
            }
        }
    }

    function quick_order_full_view($id)
    {
        $this->db->select('quick_order.*,user_info.userId, user_info.name,user_info.mobile,user_info.address,shops.shopId,shops.name as shopName');
        $this->db->join('user_info', 'quick_order.userId = user_info.userId', 'left');
        $this->db->join('shops', 'quick_order.shopId = shops.shopId', 'left');
        $this->db->where('quick_order.orderId= "' . $id . '" ');
        $query = $this->db->get('quick_order');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }


    function bill_item_full_view($id)
    {
        $this->db->select('quick_cart.*, quick_order.orderId,quick_order.deliveryFee,quick_order.paymentAmount');
        $this->db->join('quick_order', 'quick_cart.orderId = quick_order.orderId', 'left');
        $this->db->where('quick_cart.orderId= "' . $id . '" ');
        $query = $this->db->get('quick_cart');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }


    function update_quick_bill_deatils($post_data, $orderId)
    {
        $this->db->where(TAG_MOBILE, $post_data['mobile']);
        $result = $this->db->get('user_info');
        if ($result->num_rows() > 0) {
            $data = array(
                'name' => $post_data['name'],
                'address' => $post_data['address'],
                'mobile' => $post_data['mobile'],
                'entryDate' => date('Y-m-d H:i:s'),
            );
            $this->db->where(TAG_MOBILE, $post_data['mobile']);
            $this->db->update('user_info', $data);

            $this->db->select('quick_order.userId,quick_order.orderSummary,quick_order.orderId,user_info.userId,quick_cart.orderId,quick_cart.cartActiveItem');
            $this->db->join('user_info', 'quick_order.userId = user_info.userId', 'left');
            $this->db->join('quick_order', 'quick_cart.orderId = quick_order.orderId', 'left');

            $data = array(
                'orderSummary' => $post_data['orderSummary']
            );

            $this->db->where('quick_order.orderId', $orderId);
            $this->db->update('quick_order', $data);

            $data = array(
                'cartActiveItem' => $post_data['orderSummary']
            );
            $this->db->where('quick_cart.orderId', $orderId);
            $this->db->update('quick_cart', $data);
        } else {
            $userId = $this->uri->segment(3);
            $data = array(
                'name' => $post_data['name'],
                'mobile' => $post_data['mobile'],
                'address' => $post_data['address'],
                'entryDate' => date('Y-m-d H:i:s'),
            );
            $this->db->where('user_info.userId', $userId);
            $this->db->update('user_info', $data);
        }
    }


    function quick_bill_pdf($where_data)
    {

        $quick_output[TAG_CURRENT_ORDER_DETAILS] = null;

        $this->db->select('qo.*,sh.name as shopName,ui.name as userName,ui.mobile as userMobile,ui.address as userAddress');
        $this->db->from('quick_order qo');
        $this->db->join('shops sh', 'sh.shopId=qo.shopId', 'left');
        $this->db->join('user_info ui', 'ui.userId=qo.userId', 'left');
        $this->db->where('qo.orderId', $where_data[TAG_ORDER_ID]);

        $query = $this->db->get();

        if ($query->num_rows()) {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_SHOP_NAME] = $row->shopName;
            $data[TAG_USER_NAME] = $row->userName;
            $data["userMobile"] = $row->userMobile;
            $data[TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
            $data[TAG_GST] = $row->quickGst;
            $data[TAG_DELIVERY_FEE] = $row->deliveryFee;
            $data[TAG_ORDER_ENTRY_DATE] = $row->orderEntryDate;
            $data[TAG_USER_ADDRESS] = $row->userAddress;
            $data[TAG_PAYMENT_MODE] = $row->paymentMode;
            $data[TAG_ITEMS_LIST] = null;

            $item_where_data[TAG_ORDER_ID] = $row->orderId;
            $this->db->select('qc.*,qi.quickItemId,qi.quickOfferPrice');
            $this->db->from('quick_cart qc');
            $this->db->join('quick_items qi', 'qi.quickItemId=qc.quickItemId', 'left');
            // $this->db->select("itemName,quantity,amount");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get();


            if ($item_query_query->num_rows()) {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }

            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

    function get_all_quick_bills()
    {
        $this->db->select('quick_order.*,user_info.userId, user_info.name,user_info.mobile,user_info.address');
        $this->db->join('user_info', 'quick_order.userId = user_info.userId', 'left');
        $this->db->order_by('quick_order.orderId', "asc");
        $query = $this->db->get('quick_order');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_quick_bills_status($status)
    {
        $this->db->select('quick_order.*,user_info.userId, user_info.name,user_info.mobile,user_info.address');
        $this->db->join('user_info', 'quick_order.userId = user_info.userId', 'left');
        $this->db->order_by('quick_order.orderId', "asc");
        $this->db->where('quick_order.orderSummary', $status);
        $query = $this->db->get('quick_order');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function mobile_exists($mobile)
    {
        $this->db->where('mobile', $mobile);
        $result = $this->db->get('user_info');
        if ($result->num_rows() > 0) {
            echo 'Mobile Number Already exist';
        }
    }

    function quick_thermal_bill_pdf($where_data)
    {

        $quick_output[TAG_CURRENT_ORDER_DETAILS] = null;

        $this->db->select('qo.*,sh.name as shopName,ui.name as userName,ui.mobile as userMobile,ui.address as userAddress');
        $this->db->from('quick_order qo');
        $this->db->join('shops sh', 'sh.shopId=qo.shopId', 'left');
        $this->db->join('user_info ui', 'ui.userId=qo.userId', 'left');
        $this->db->where('qo.orderId', $where_data[TAG_ORDER_ID]);

        $query = $this->db->get();

        if ($query->num_rows()) {
            $row = $query->row();

            $data[TAG_ORDER_ID] = $row->orderId;
            $data[TAG_SHOP_NAME] = $row->shopName;
            $data[TAG_USER_NAME] = $row->userName;
            $data["userMobile"] = $row->userMobile;
            $data[TAG_PAYMENT_AMOUNT] = $row->paymentAmount;
            $data[TAG_GST] = $row->quickGst;
            $data[TAG_DELIVERY_FEE] = $row->deliveryFee;
            $data[TAG_ORDER_ENTRY_DATE] = $row->orderEntryDate;
            $data[TAG_USER_ADDRESS] = $row->userAddress;
            $data[TAG_PAYMENT_MODE] = $row->paymentMode;
            $data[TAG_ITEMS_LIST] = null;

            $item_where_data[TAG_ORDER_ID] = $row->orderId;
            $this->db->select('qc.*,qi.quickItemId,qi.thermalPrinterItems,qi.quickOfferPrice');
            $this->db->from('quick_cart qc');
            $this->db->join('quick_items qi', 'qi.quickItemId=qc.quickItemId', 'left');
            // $this->db->select("itemName,quantity,amount");
            $this->db->where($item_where_data);
            $item_query_query = $this->db->get();


            $data['order_row_numbers'] = $item_query_query->num_rows();
            if ($item_query_query->num_rows()) {
                $data[TAG_ITEMS_LIST] = $item_query_query->result();
            }

            $output[TAG_CURRENT_ORDER_DETAILS] = $data;
        }
        return $output;
    }

    function get_all_users()
    {
        $query =  $this->db->query('SELECT usi.* , count(qo.orderId) as orderCount  FROM  user_info as usi LEFT JOIN quick_order as qo  USING(userId) GROUP by usi.userId');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_user_details($id)
    {
        $this->db->select('*');
        $this->db->order_by('userId', "asc");
        $this->db->where('userId', $id);
        $query = $this->db->get('user_info');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_user_status($status)
    {
        $this->db->select('*');
        $this->db->order_by('userId', "asc");
        $this->db->where('accountStatus', $status);
        $query = $this->db->get('user_info');
        // log_message("debug", "jhsfhqss" . print_r($this->db->last_query(),true));
        // die();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function user_full_view($id)
    {
        $this->db->select('*');
        $this->db->where('userId= "' . $id . '" ');
        $query = $this->db->get('user_info');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_user_status($post_data, $userId)
    {
        $data = array(
            'accountStatus' => $post_data['accountStatus']
        );

        $this->db->where('userId', $userId);
        $this->db->update('user_info', $data);
    }

    function get_single_user_orders($id)
    {
        $this->db->select('quick_order.*,user_info.userId, user_info.name,user_info.mobile,user_info.address');
        $this->db->join('user_info', 'quick_order.userId = user_info.userId', 'left');
        $this->db->order_by('quick_order.orderId', "asc");
        $this->db->where('user_info.userId', $id);
        $query = $this->db->get('quick_order');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function shop_admin()
    {
        $this->db->select('ui.*,sh.name as shopName');
        $this->db->where('userRole', 'ShopAdmin');
        $this->db->from('user_info ui');
        $this->db->join('shops sh', 'ui.shopId=sh.shopId');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function get_shop_data()
    {
        $response = null;
        $this->db->select('sh.name,sh.shopId');
        $this->db->from('shops sh');
        $this->db->join('user_info ui', 'ui.shopId=sh.shopId', 'LEFT');
        $this->db->where('ui.shopId IS NULL');
        $this->db->where('ui.activeShopId IS NULL');
        $this->db->group_by('shopId');
        $query = $this->db->get('shops');


        if ($query->num_rows() > 0) {
            $response = $query->result();
        }
        return $response;
    }

    function insert_shop_admin($post_data, $file_data, $mobile)
    {
        $auth_string = $this->UtilityModels->generateRandomString();
        // $token = $this->UtilityModels->generateToken($mobile);
        log_message('error', 'admin_submit_BY_AJITH' . print_r($post_data, true));
        $otp = $this->UtilityModels->generateNumericOTP(6);

        $data = array(

            TAG_USER_ROLE => 'ShopAdmin',
            TAG_NAME => $post_data[TAG_NAME],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_AUTHSTRING => $auth_string,
            TAG_OTP => $otp,
            TAG_SHOP_ID => $post_data[TAG_SHOP_ID],
            TAG_ACTIVE_SHOP_ID => $post_data[TAG_SHOP_ID],
            // TAG_TOKEN => $token
        );

        $this->db->insert('user_info', $data);

        if ($this->db->affected_rows() > 0) {


            $otp_send_status = $this->UtilityModels->send_admin_otp($otp, $mobile);

             if ($otp_send_status == 0) {
                 return 0;
             }
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['profileImg'] != '') {
                if ($this->upload->do_upload('profileImg')) {
                    $files = $this->upload->data();
                    $photo = 'images/' . $files['file_name'];
                    // echo $photo;
                    $data = array('profileImg' => $photo);
                    $this->db->where('id', $id);
                    $this->db->update('user_info', $data);
                }
            }

            return $id;
        } else {
            return 0;
        }
    }

    public function get_single_shop_admin($id)
    {
        $this->db->select('*');
        $this->db->where('userId', $id);
        $query = $this->db->get('user_info');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_shop_admin($post_data, $file_data)
    {
        $flag = false;
        $data = array(
            TAG_USER_ROLE => 'ShopAdmin',
            TAG_NAME => $post_data[TAG_NAME],
            TAG_EMAIL_ID => $post_data[TAG_EMAIL_ID],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            // TAG_PASSWORD => md5($post_data[TAG_PASSWORD]),
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            // TAG_AUTHSTRING => $post_data[TAG_AUTHSTRING],
            // TAG_TOKEN => $post_data[TAG_TOKEN]

        );

        $this->db->where('userId', $post_data[TAG_USER_ID]);
        $qry = $this->db->update('user_info', $data);

        $config = array(
            'upload_path' => './images/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($file_data['profileImg']['name'] != '') {

            if ($post_data['currentImage']) {

                @unlink($post_data['currentImage']);
            }

            if ($this->upload->do_upload('profileImg')) {
                $files = $this->upload->data();
                $photo = 'images/' . $files['file_name'];
                $data = array('profileImg' => $photo);
                $this->db->where('id', $post_data[TAG_USER_ID]);
                $this->db->update('user_info', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    public function get_all_shipping_details($id)
    {

        $this->db->select('o_sh.*,o_sh.entryDate as shEntryDate, os.*');
        $this->db->from('order_shipping o_sh');
        $this->db->join('order_summary os', 'os.orderId = o_sh.orderId', 'LEFT');
        $this->db->where('o_sh.orderId', $id);
        $this->db->order_by('o_sh.orderShippingId', "asc");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }


    public function complete_single_order($id)
    {
        $this->db->select("*");
        $this->db->where('orderId', $id);
        $db_id = $this->db->get('order_summary');
        $delivery_boy_id = $db_id->num_rows('deliveryBoyId');

        $data = array(
            TAG_ORDER_STATUS => 'Delivered'
        );

        $this->db->where('orderId', $id);
        $query = $this->db->update('order_summary', $data);

        if ($query) {
            $data1 = array(
                TAG_PROGRESS_BAR_STATUS => 'Delivered'
            );
            $this->db->where('orderId', $id);
            $qry = $this->db->update('order_shipping', $data1);

            if ($qry) {
                $data2 = array(
                    TAG_CURRENT_ORDER_ID => 0
                );
                $this->db->where('deliveryBoyId', $delivery_boy_id);
                $this->db->update('delivery_boy', $data2);
            }
        }
    }


    public function insert_shipping_details($post_data)
    {
        $data = array(
            TAG_ORDER_ID => $post_data['orderId'],
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_SELLER_NAME => $post_data[TAG_SELLER_NAME],
            TAG_LOCATION => $post_data[TAG_LOCATION],
            TAG_SHIPPING_TYPE => TAG_LONG_SHIPPING,
            TAG_PROGRESS_BAR_STATUS => $post_data[TAG_PROGRESS_BAR_STATUS],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_SHIPPING_STATUS => $post_data[TAG_SHIPPING_STATUS],
            TAG_PRIORITY => $post_data[TAG_PRIORITY],
            TAG_REMARKS => $post_data[TAG_REMARKS]
        );

        $query = $this->db->insert('order_shipping', $data);




        if ($query) {
            $update_data[TAG_SHIPPING_TYPE] = TAG_LONG_SHIPPING;
            $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;

            $this->db->where(TAG_ORDER_ID, $post_data['orderId']);
            $this->db->update('order_summary', $update_data);
        }
    }

    public function get_single_order_shippment($id)
    {
        $this->db->select('*');
        $this->db->where('orderShippingId', $id);
        $query = $this->db->get('order_shipping');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_order_shipment($post_data)
    {
        $flag = 0;
        $data = array(
            TAG_ADDRESS => $post_data[TAG_ADDRESS],
            TAG_LOCATION => $post_data[TAG_LOCATION],
            TAG_PIN_CODE => $post_data[TAG_PIN_CODE],
            TAG_PROGRESS_BAR_STATUS => $post_data[TAG_PROGRESS_BAR_STATUS],
            TAG_SHIPPING_STATUS => $post_data[TAG_SHIPPING_STATUS],
            TAG_REMARKS => $post_data[TAG_REMARKS]
        );

        $this->db->where('orderShippingId', $post_data['id']);
        $this->db->update('order_shipping', $data);

        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }
        return $flag;
    }

    function delete_single_order_shippment($id)
    {
        $this->db->select('*');
        $this->db->from('order_shipping');
        $this->db->where('orderShippingId', $id);
        $this->db->delete('order_shipping');


        if ($this->db->affected_rows() == 0) {
            echo 'Something went wroung!';
        } else {
            echo 'Shipment Deleted successfully';
        }
    }

    function cancel_single_order($id)
    {
        $data = array(
            'orderStatus' => 'Cancelled'
        );
        // $this->db->where(TAG_SHOP_ID, $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $this->db->where(TAG_ORDER_ID, $id);
        $this->db->update('order_summary', $data);


        if ($this->db->affected_rows() == 0) {
            echo 'Something went wroung!';
        } else {
            echo 'Order Cancelled successfully';
        }
    }


    function cancel_single_assigned_order($id)
    {
        $data = array(
            'orderStatus' => 'Cancelled'
        );




        $this->db->where(TAG_ORDER_ID, $id);
        $query = $this->db->update('order_summary', $data);


        if ($query) {
            $data = array(
                TAG_PROGRESS_BAR_STATUS => 'Cancelled'
            );
            $this->db->where(TAG_ORDER_ID, $id);
            $query = $this->db->update('order_shipping', $data);
        }
        $this->db->select('os.deliveryBoyId,dby.deliveryBoyName,os.orderHashId, os.shopId,dby.firebaseToken dBoyFirebaseToken,ui.firebaseToken as shopFirebaseToken,sh.name as shopName');
        $this->db->from('order_summary os');
        $this->db->join('order_tag_delivery_boy otdb', 'os.orderId=otdb.orderId', 'LEFT');
        $this->db->join('delivery_boy dby', 'dby.deliveryBoyId=otdb.deliveryBoyId', 'LEFT');
        $this->db->join('shops sh', 'os.shopId=sh.shopId');
        $this->db->join('user_info ui', 'os.shopId=ui.shopId', 'LEFT');



        $this->db->where('os.' . TAG_ORDER_ID, $id);
        $delivery_boy_query = $this->db->get();

        if ($delivery_boy_query->num_rows() > 0) {
            if (isset($delivery_boy_query->row()->deliveryBoyId)) {
                $delivery_details = $delivery_boy_query->row();
                $delivery_boy_id = $delivery_details->deliveryBoyId;
                $delivery_boy_update = array('assignFlag' => 0);
                $this->db->where(TAG_DELIVERY_BOY_ID, $delivery_boy_id);
                $query = $this->db->update('delivery_boy', $delivery_boy_update);


                if (!empty($delivery_details->dBoyFirebaseToken)) {
                    $delivery_boy_notification_data = array(
                        TAG_TITLE => 'Hai ' . $delivery_details->deliveryBoyName . ', Order has been cancelled',
                        TAG_BODY => 'The Order No #' . $delivery_details->orderHashId . ' assigned to you by ' . TAG_APP_NAME . ' has been canceled',
                        TAG_IMAGE => ''
                    );
                    log_message('error', 'delivery boy NOTIFICATION  : in admin panel cancel_single_assigned_order model' . print_r($delivery_boy_notification_data, true));


                    $this->UtilityModels->deviceTokenNotification($delivery_boy_notification_data, $delivery_details->dBoyFirebaseToken);
                }

                $shop_admin_notification_data = array(
                    TAG_TITLE => "Order No #" . $delivery_details->orderHashId . " has been canceled by " . TAG_APP_NAME,
                    TAG_BODY => "Hai, Order No #" . $delivery_details->orderHashId  . " has been canceled. Please Contact " . TAG_APP_NAME . " for more information",
                    TAG_IMAGE => "",
                );

                if (!empty($delivery_details->shopFirebaseToken)) {
                    $shop_admin_notification_data = array(
                        TAG_TITLE => "Order No #" . $delivery_details->orderHashId . " has been canceled by " . TAG_APP_NAME,
                        TAG_BODY => "Hai, Order No #" . $delivery_details->orderHashId  . " has been canceled. check admin App a for more information",
                        TAG_IMAGE => "",
                    );

                    log_message('error', 'SHOP ADMIN AND SUPER ADMIN  NOTIFICATION : in admin panel cancel_single_assigned_order model' . print_r($shop_admin_notification_data, true));

                    $this->UtilityModels->shopAdminDeviceTokenNotification($shop_admin_notification_data, $delivery_details->shopFirebaseToken);
                }
                $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $shop_admin_notification_data);
            }
        }





        if ($this->db->affected_rows() == 0) {
            echo 'Something went wroung!';
        } else {
            echo 'Order Cancelled successfully';
        }
    }

    public function demo_user()
    {
        $this->db->select('*');
        $query = $this->db->get('demo_users');

        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    function insert_demo_user($post_data)
    {
        $data = array(

            TAG_USER_NAME => $post_data[TAG_USER_NAME],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            TAG_IS_ACTIVE => $post_data[TAG_IS_ACTIVE],
            TAG_DEMO_TIME => $post_data[TAG_DEMO_TIME],
        );

        $this->db->insert('demo_users', $data);
    }

    public function get_single_demo_user($id)
    {
        $this->db->select('*');
        $this->db->where('demoId', $id);
        $query = $this->db->get('demo_users');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_demo_user($post_data)
    {
        $flag = false;
        $data = array(
            TAG_USER_NAME => $post_data[TAG_USER_NAME],
            TAG_MOBILE => $post_data[TAG_MOBILE],
            TAG_IS_ACTIVE => $post_data[TAG_IS_ACTIVE],
            TAG_DEMO_TIME => $post_data[TAG_DEMO_TIME],

        );

        $this->db->where('demoId', $post_data[TAG_DEMO_ID]);
        $this->db->update('demo_users', $data);

        if ($this->db->affected_rows() > 0) {
            $flag = 1;
        }
        return $flag;
    }

    function demo_user_mobile_exist($mobile)
    {
        $this->db->select('*');
        $this->db->where('mobile', $mobile);
        $query = $this->db->get('demo_users');
        if ($query->num_rows() == 0) {

            echo 0;
        } else {
            echo 1;
        }
    }

    function validate_emailId($email, $user_role, $table)
    {
        $this->db->where('emailId', $email);
        if ($table == "user_info") {
            $this->db->where('userRole', $user_role);
        }
        $result = $this->db->get($table);


        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function phone_already($email, $user_role, $table)
    {
        $this->db->where('mobile', $email);
        if ($table == "user_info") {
            $this->db->where('userRole', $user_role);
        }
        $result = $this->db->get($table);


        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }
    function validate_update_emailId($email, $user_role, $id, $table)
    {
        $this->db->where('emailId', $email);
        if ($table == "user_info") {
            $this->db->where('userId!=', $id);
            $this->db->where('userRole', $user_role);
        } else {
            $this->db->where('deliveryBoyId!=', $id);
        }
        $result = $this->db->get($table);

        // log_message('error', 'userId---' . print_r($this->db->last_query(), true));

        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    


    function phone_update_already($mobile, $user_role, $id, $table)
    {
        $this->db->where('mobile', $mobile);
        log_message('error', 'hai_ajith_valid');

        if ($table == "user_info") {
            $this->db->where('userId!=', $id);
            $this->db->where('userRole', $user_role);
        } else {
            $this->db->where('deliveryBoyId!=', $id);
        }
        $result = $this->db->get($table);


        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }
    function delivery_boy_validate_update_emailId($email, $id)
    {
        $this->db->where('emailId', $email);

        $this->db->where('deliveryBoyId!=', $id);

        $result = $this->db->get('delivery_boy');

        // log_message('error', 'userId---' . print_r($this->db->last_query(), true));

        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function delivery_boy_phone_update_already($mobile, $id)
    {
        $this->db->where('mobile', $mobile);
       
        $this->db->where('deliveryBoyId!=', $id);
        $result = $this->db->get('delivery_boy');
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function get_shop_category()
    {

        $this->db->select('*');
        $query = $this->db->get('shop_category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }
    }


    function insert_shop_category($post_data, $file_data)
    {
        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_ACTIVE_FLAG => $post_data[TAG_SHOP_CATEGORY_STATUS]
        );

        $this->db->insert('shop_category', $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $config = array(
                'upload_path' => './images/shop_category/',
                'allowed_types' => '*',
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($file_data['image'] != '') {
                if ($this->upload->do_upload('image')) {
                    $files = $this->upload->data();
                    $photo = 'images/shop_category/' . $files['file_name'];
                    // echo $photo;
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

    function get_shop_category_details($id)
    {
        $this->db->select('*');

        $this->db->where('shopCategoryId', $id);
        $query = $this->db->get('shop_category');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->row();
            return $result;
        }
    }

    function update_shop_category($post_data, $file_data)
    {
        $flag = false;
        $data = array(
            TAG_NAME => $post_data[TAG_NAME],
            TAG_ACTIVE_FLAG => $post_data[TAG_STATUS]
        );

        $this->db->where(TAG_SHOP_CATEGORY_ID, $post_data[TAG_BANNER_ID]);
        $qry = $this->db->update('shop_category', $data);


        $config = array(
            'upload_path' => './images/shop_category/',
            'allowed_types' => '*',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($file_data['image']['name'] != '') {
            if ($post_data['currentImage']) {
                if ($post_data['currentImage'] != 'images/shop_category/default.jpg') {
                    @unlink($post_data['currentImage']);
                }
            }
            if ($this->upload->do_upload('image')) {
                $files = $this->upload->data();
                $photo = 'images/shop_category/' . $files['file_name'];
                $data = array('image' => $photo);
                $this->db->where(TAG_SHOP_CATEGORY_ID, $post_data[TAG_BANNER_ID]);
                $this->db->update('shop_category', $data);
                if ($this->db->affected_rows() > 0) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    function get_active_shop_category($id = 0)
    {


        if ($id == null) {
            $query = $this->db->query("SELECT * FROM `shop_category` WHERE `activeFlag` = 'ACTIVE'");
        } else {
            $this->db->where(TAG_SHOP_ID, $id);
            $shop_query = $this->db->get('shops');
            $shop_data = $shop_query->row();
            $query = $this->db->query("SELECT * FROM `shop_category` WHERE `activeFlag` = 'ACTIVE' ORDER BY CASE WHEN `shopCategoryId` = $shop_data->shopCategoryId THEN 1 ELSE 2 END");
        }
        // die();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result;
        }

        return NULL;
    }

    function get_shop_category_priority()
    {
        $this->db->select_max('priority');
        $query = $this->db->get('shop_category');

        $priority = 0;
        if ($query->num_rows() > 0) {
            $priority = $query->row()->priority;
        }
        return (++$priority);
    }

    function get_payment_pending_orders()
    {
        $this->db->select('dbp.dbPaymentId,sh.name as shopName,db.deliveryBoyName,dbp.paymentAmount,db.mobile as deliveryBoyMobile');
        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $this->db->join('shops sh', 'dbp.shopId = sh.shopId', 'left');
        $this->db->join('delivery_boy db', 'dbp.deliveryBoyId = db.deliveryBoyId', 'left');
        $query = $this->db->get('d_boy_payment dbp');
        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->result();
        }
        $response['pending_delivery_boys_list'] = $result;
        $this->db->select_sum('dbp.paymentAmount');
        $this->db->select('count(*) as deliveryBoyCount');
        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $this->db->order_by("dbp.dbPaymentId", "asc");

        $query = $this->db->get('d_boy_payment dbp');

        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->row();
        }

        $response['pending_amount_details'] = $result;
        return $response;
    }
    function d_boy_paid_orders()
    {
        $this->db->select('dbp.dbPaymentId,sh.name as shopName,db.deliveryBoyName,dbp.paymentAmount,db.mobile as deliveryBoyMobile');
        $this->db->where('dbp.paidStatus', 'PAID');
        $this->db->join('shops sh', 'dbp.shopId = sh.shopId', 'left');
        $this->db->join('delivery_boy db', 'dbp.deliveryBoyId = db.deliveryBoyId', 'left');
        $this->db->order_by("dbp.dbPaymentId", "asc");
        $query = $this->db->get('d_boy_payment dbp');
        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->result();
        }
        $response['pending_delivery_boys_list'] = $result;
        $this->db->select_sum('dbp.paymentAmount');
        $this->db->select('count(*) as deliveryBoyCount');
        $this->db->where('dbp.paidStatus', 'PAID');
        $query = $this->db->get('d_boy_payment dbp');

        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->row();
        }

        $response['pending_amount_details'] = $result;
        return $response;
    }

    function update_d_boy_payment_status($dbPaymentId, $status)
    {
        $this->db->where('dbPaymentId', $dbPaymentId);
        $update_data = array('paidStatus' => $status);
        $result = $this->db->update('d_boy_payment', $update_data);
        return $result;
    }

    function payment_pending_delivery_boys()
    {
        $this->db->select('count(dbp.deliveryBoyId) as paymentPendingCount,dbp.dbPaymentId,sh.name as shopName,db.deliveryBoyName,dbp.deliveryBoyId,sum(dbp.paymentAmount) as paymentAmount,db.mobile as deliveryBoyMobile');
        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $this->db->join('shops sh', 'dbp.shopId = sh.shopId', 'left');
        $this->db->join('delivery_boy db', 'dbp.deliveryBoyId = db.deliveryBoyId', 'left');
        $this->db->group_by('dbp.deliveryBoyId');
        $query = $this->db->get('d_boy_payment dbp');


        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->result();
        }
        $response['pending_delivery_boys_list'] = $result;


        $this->db->select_sum('dbp.paymentAmount');
        $this->db->select('count(*) as deliveryBoyCount');
        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $query = $this->db->get('d_boy_payment dbp');

        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->row();
        }
        $response['pending_amount_details'] = $result;
        return $response;
    }
    function payment_pending_d_boy_order_list($deliveryBoyId)
    {
        $this->db->select('dbp.dbPaymentId,sh.name as shopName,db.deliveryBoyName,dbp.deliveryBoyId,dbp.orderId,dbp.paymentAmount,db.mobile as deliveryBoyMobile');
        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $this->db->where('dbp.deliveryBoyId', $deliveryBoyId);
        $this->db->join('shops sh', 'dbp.shopId = sh.shopId', 'left');
        $this->db->join('delivery_boy db', 'dbp.deliveryBoyId = db.deliveryBoyId', 'left');
        echo  $this->db->last_query();
        $query = $this->db->get('d_boy_payment dbp');
        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->result();
        }
        $response['pending_delivery_boys_list'] = $result;

        $this->db->select_sum('dbp.paymentAmount');
        $this->db->select('count(*) as deliveryBoyCount');
        $this->db->where('dbp.deliveryBoyId', $deliveryBoyId);

        $this->db->where('dbp.paidStatus', 'NOT_PAID');
        $query = $this->db->get('d_boy_payment dbp');


        $result = NULL;
        if ($query->num_rows() > 0) {

            $result = $query->row();
        }
        $response['pending_amount_details'] = $result;

        return $response;
    }
}
