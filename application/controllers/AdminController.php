<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("AdminModels");
        $this->load->model("UtilityModels");
        $this->load->helper('FirebaseNotification.php');
    }



    public function _remap($method)
    {
        

        $segment_2 = $this->uri->segment(2);
        if (method_exists($this, $method)) {
            if ($segment_2 == 'login') {
                $segment_3 = $this->uri->segment(3);
                $this->login($segment_3);
            } else if ($segment_2 == 'item_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->item_edit($segment_3);
            } else if ($segment_2 == 'item_view') {
                $segment_3 = $this->uri->segment(3);
                $segment_4 = $this->uri->segment(4);
                $this->item_view($segment_3, $segment_4);
            } else if ($segment_2 == 'delivery_boy_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->delivery_boy_edit($segment_3);
            } else if ($segment_2 == 'delivery_boy_view') {
                $segment_3 = $this->uri->segment(3);
                $this->delivery_boy_view($segment_3);
            } else if ($segment_2 == 'delivery_boy_view_admin') {
                $segment_3 = $this->uri->segment(3);
                $this->delivery_boy_view_admin($segment_3);
            } else if ($segment_2 == 'shop_select') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_select($segment_3);
            } else if ($segment_2 == 'get_orders') {
                $segment_3 = $this->uri->segment(3);
                $segment_4 = $this->uri->segment(4);
                $this->get_orders($segment_3, $segment_4);
            } else if ($segment_2 == 'category_view') {
                $segment_3 = $this->uri->segment(3);
                $this->category_view($segment_3);
            } else if ($segment_2 == 'category_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->category_edit($segment_3);
            } else if ($segment_2 == 'shop_view') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_view($segment_3);
            } else if ($segment_2 == 'shop_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_edit($segment_3);
            } else if ($segment_2 == 'banner_view') {
                $segment_3 = $this->uri->segment(3);
                $this->banner_view($segment_3);
            } else if ($segment_2 == 'banner_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->banner_edit($segment_3);
            } else if ($segment_2 == 'coupon_view') {
                $segment_3 = $this->uri->segment(3);
                $this->coupon_view($segment_3);
            } else if ($segment_2 == 'coupon_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->coupon_edit($segment_3);
            } else if ($segment_2 == 'for_quick_shop_view') {
                $segment_3 = $this->uri->segment(3);
                $this->for_quick_shop_view($segment_3);
            } else if ($segment_2 == 'quick_shop_items') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_shop_items($segment_3);
            } else if ($segment_2 == 'quick_item_list') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_item_list($segment_3);
            } else if ($segment_2 == 'quick_item_view') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_item_view($segment_3);
            } else if ($segment_2 == 'quick_add_items_for_shop') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_add_items_for_shop($segment_3);
            } else if ($segment_2 == 'quick_insert_items_for_shop') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_insert_items_for_shop($segment_3);
            } else if ($segment_2 == 'quick_item_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_item_edit($segment_3);
            } else if ($segment_2 == 'update_quick_item') {
                $segment_3 = $this->uri->segment(3);
                $this->update_quick_item($segment_3);
            } else if ($segment_2 == 'add_to_quickcart') {
                $segment_3 = $this->uri->segment(3);
                $this->add_to_quickcart($segment_3);
            } else if ($segment_2 == 'quick_bill') {
                $segment_3 = $this->uri->segment(3);
                $this->quick_bill($segment_3);
            } else if ($segment_2 == 'user_full_view') {
                $segment_3 = $this->uri->segment(3);
                $this->user_full_view($segment_3);
            } else if ($segment_2 == 'shop_category_view') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_category_view($segment_3);
            } else if ($segment_2 == 'shop_category_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_category_edit($segment_3);
            } else if ($segment_2 == 'payment_pending_d_boy_order_list') {
                $segment_3 = $this->uri->segment(3);
                $this->payment_pending_d_boy_order_list($segment_3);
            } else if ($segment_2 == 'pending_payment_order_full_view') {
                $segment_3 = $this->uri->segment(3);
                $this->pending_payment_order_full_view($segment_3);
            } else if ($segment_2 == 'delivery_boy_emailId_update_already') {
                $segment_3 = $this->uri->segment(3);
                $this->delivery_boy_emailId_update_already();
            } else if ($segment_2 == 'delivery_boy_phone_update_already') {
                $segment_3 = $this->uri->segment(3);
                $this->delivery_boy_phone_update_already();
            }else if($segment_2=='partner_delivery_boy_view'){
                $segment_3 = $this->uri->segment(3);
		$this->partner_delivery_boy_view($segment_3);
	    }
            else if ($segment_2 == 'update_delivery_boy') {
              
                $this->update_delivery_boy();
            } else {
                $this->{$method}();
            }
        }
    }

    function index()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }


        if (($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SUPER_ADMIN) || ($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_ADMIN)) {
            $result = $this->AdminModels->get_dashboard_details_for_super_admin();
            $this->load->view('admin/home', $result, false);
        } else {
            $result = $this->AdminModels->get_dashboard_details_for_shop_admin();
            $this->load->view('admin/shop_dashboard', $result, false);
        }
    }

    function shop_select($shop_id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

	  $shop_name=$_GET['shop_name'];
	
	$this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID] = $shop_id;
        $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_NAME] = $shop_name;
        redirect(base_url() . 'admin/shop_index');
    }
    function shop_index()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->get_dashboard_details_for_shop_admin();
        $result[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $this->load->view('admin/shop_dashboard', $result, false);
    }

    function delivery_boy()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_DELIVERY_BOYS_LIST] = $this->AdminModels->get_delivery_boys();
        $data["type"] = "admin";
        $content['content'] = $this->load->view('admin/delivery_boy/delivery_boy_list', $data, TRUE);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function partner_delivery_boys()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_DELIVERY_BOYS_LIST] = $this->AdminModels->get_partner_delivery_boys();
        $data["type"] = "admin";
        $content['content'] = $this->load->view('partner/delivery_boy/partner_delivery_boy_list', $data, TRUE);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function delivery_boy_admin()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $response = $this->AdminModels->get_delivery_boys_for_admin();
        $data[TAG_DELIVERY_BOYS_COUNT] = $response[TAG_DELIVERY_BOYS_COUNT];
        $data[TAG_DELIVERY_BOYS_LIST] = $response[TAG_DELIVERY_BOYS_LIST];
        $data["type"] = "superAdmin";
        $data['selected_menu'] = 'DELIVERY_BOY_LIST';
        $content['content'] = $this->load->view('admin/delivery_boy_admin/delivery_boy_list', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }


    function delete_delivery_boy()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->delete_single_delivery_boy($_POST['id']);
        echo $result;
    }

    function delivery_boy_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['selected_menu'] = 'DELIVERY_BOY_LIST';
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->AdminModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('admin/delivery_boy_admin/delivery_boy_edit', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function add_delivery_boy_from_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $where_data[TAG_ACTIVE] = 1;
        $where_data[TAG_ASSIGN_FLAG] = 0;
        //$where_data[TAG_SHOP_ID] = 0;

        $output = $this->AdminModels->get_delivery_boys_list_for_add_to_shop($where_data);
        $output[TAG_TYPE] = "add";
        $content['content'] = $this->load->view('admin/delivery_boy/list_for_add_delivery_boy', $output, TRUE);
        //print_r($content);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function update_delivery_boy()
    {


        $res = $this->AdminModels->update_delivery_boy_deatils($_POST);

        if ($res) {
            redirect('admin/delivery_boy_view_admin/' . $_POST[TAG_DELIVERY_BOY_ID]);
        } else {
            redirect('admin/delivery_boy_admin');
        }
    }

    function add_shop_delivery_boy()
    {
        $where_data[TAG_DELIVERY_BOY_ID] = $this->input->get(TAG_DELIVERY_BOY_ID);
        $res = $this->AdminModels->add_shop_delivery_boy($where_data);
        if ($res) {
            redirect('admin/delivery_boy');
        } else {
            redirect('admin/delivery_boy');
        }
    }

    function delivery_boy_view($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->AdminModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('admin/delivery_boy/delivery_boy_view', $data, TRUE);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function partner_delivery_boy_view($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->AdminModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('partner/delivery_boy/partner_delivery_boy_view', $data, TRUE);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function delivery_boy_view_admin($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['selected_menu'] = 'DELIVERY_BOY_LIST';

        $data[TAG_DELIVERY_BOY_DETAILS] = $this->AdminModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('admin/delivery_boy_admin/delivery_boy_view', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function add_delivery_boy()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('admin/delivery_boy/delivery_boy_add', $data, TRUE);
        $this->load->view('admin/delivery_boy/index', $content);
    }

    function add_delivery_boy_for_admin()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['selected_menu'] = 'DELIVERY_BOY_LIST';
        $data["data"] = null;
        $content['content'] = $this->load->view('admin/delivery_boy_admin/delivery_boy_add', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function insert_delivery_boy()
    {
        $id = $this->AdminModels->insert_delivery_boy($_POST);
        if ($id > 0) {
            redirect('admin/delivery_boy_view_admin/' . $id);
        } else {
            redirect('admin/delivery_boy_admin');
        }
    }

    function item_categories()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAGS_LIST] = $this->AdminModels->get_item_categories();
        $content['content'] = $this->load->view('admin/item_category/category_list', $data, TRUE);
        $this->load->view('admin/item_category/index', $content);
    }

    function add_item_category()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('admin/item_category/category_add', $data, TRUE);
        $this->load->view('admin/item_category/index', $content);
    }

    function insert_item_category()
    {

        $id = $this->AdminModels->insert_item_category($_POST, $_FILES);
        if ($id > 0) {
            redirect('admin/category_view/' . $id);
        } else {
            redirect('admin/item_categories');
        }
    }

    function category_view($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->AdminModels->get_single_category_details($id);
        $content['content'] = $this->load->view('admin/item_category/category_view', $data, TRUE);
        $this->load->view('admin/item_category/index', $content);
    }

    function category_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_CATEGORY_DETAILS] = $this->AdminModels->get_single_category_details($id);
        $content['content'] = $this->load->view('admin/item_category/category_edit', $data, TRUE);
        $this->load->view('admin/item_category/index', $content);
    }


    function shops()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data[TAGS_LIST] = $this->AdminModels->get_shops();
        $content['content'] = $this->load->view('admin/shop/shop_list', $data, TRUE);
        $this->load->view('admin/shop/index', $content);

        //print_r(json_encode($data));
    }

    function shop_view($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_SHOP_DETAILS] = $this->AdminModels->get_single_shop_details($id);
        $data["shop_item_count"] = $this->AdminModels->check_shop_items($id);
        $content['content'] = $this->load->view('admin/shop/shop_view', $data, TRUE);
        $this->load->view('admin/shop/index', $content);
    }

    function add_shop()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = $this->AdminModels->get_active_shop_category();
        $content['content'] = $this->load->view('admin/shop/add_shop', $data, TRUE);
        $this->load->view('admin/shop/index', $content);
    }

    function shop_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_SHOP_CATEGORY_LIST] = $this->AdminModels->get_active_shop_category($id);


        $data[TAG_SHOP_DETAILS] = $this->AdminModels->get_single_shop_details($id);
        $content['content'] = $this->load->view('admin/shop/shop_edit', $data, TRUE);
        $this->load->view('admin/shop/index', $content);
    }



    function insert_shop()
    {
        $id = $this->AdminModels->insert_shop($_POST, $_FILES);
        if ($id > 0) {
            redirect('admin/shop_view/' . $id);
        } else {
            redirect('admin/shops');
        }
    }

    function update_shop()
    {
        $res = $this->AdminModels->update_shop($_POST, $_FILES);

        if ($res) {
            redirect('admin/shop_view/' . $_POST[TAG_SHOP_ID]);
        } else {
            redirect('admin/shops');
        }
    }

    function update_item_category()
    {

        $res = $this->AdminModels->update_item_category($_POST, $_FILES);
        if ($res) {
            redirect('admin/category_view/' . $_POST[TAG_CATEGORY_ID]);
        } else {
            redirect('admin/item_categories');
        }
    }


    function delivery_boy_list_order_assign()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $where_data[TAG_ORDER_ID] = $this->uri->segment(3);
        $output = $this->AdminModels->get_delivery_boys_list($where_data);
        $output[TAG_ORDER_ID] =  $this->uri->segment(3);
        $output[TAG_TYPE] = "assign";
        $content['content'] = $this->load->view('admin/delivery_boy/list_for_assign_order', $output, TRUE);
        //print_r($content);
        $this->load->view('admin/delivery_boy/index', $content);
    }



    function get_orders($status, $shop_id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        if (!empty($shop_id)) {
            $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID] = $shop_id;
        }


        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID];
        $where_data[TAG_ORDER_STATUS] = $status;
        $output = $this->AdminModels->orders_list($where_data, $shop_id);

        $this->load->view('admin/orders/order_list', $output);
    }




    function assign_order()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $deliveryBoyId = $this->input->get('deliveryBoyId');

        $update_data[TAG_DELIVERY_BOY_ID] = $this->input->get(TAG_DELIVERY_BOY_ID);
        $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;
        $update_data[TAG_SHIPPING_TYPE] = TAG_SHORT_SHIPPING;

        $update_data[TAG_DELIVERY_TIME] = $_GET['deliveryTime' . $deliveryBoyId];
        $notific_send_flag = $this->AdminModels->assign_order($where_data, $update_data);
        if ($notific_send_flag) {
            redirect(base_url() . 'admin/index');
        } else {
            redirect(base_url() . 'admin/assign_order');
        }
    }

    function login($response = '')
    {
        if ($this->AdminModels->validate_login_session()) {
            redirect('admin/index');
        }
        $data['login_response'] = $response;
        $this->load->view('admin/login/index', $data);
    }

    function get_login()
    {
        $result = $this->AdminModels->get_user_details_for_login($_POST);
        if ($result == '') {
            redirect('admin/login/invalid');
        } else {
            $this->AdminModels->get_user_login_session($result);
            redirect('admin/index');
        }
    }

    function logout()
    {
        $this->AdminModels->get_logout();
        redirect('admin/login');
    }

    function check_session()
    {
        echo $this->AdminModels->validate_login_session();
    }

    function item()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_item_details();
        $content['content'] = $this->load->view('admin/item/item_table', $data, TRUE);
        $this->load->view('admin/item/index', $content);
    }

    function add_items()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['shop'] = $this->AdminModels->get_all_shop_details();

        //$data['category'] = $this->AdminModels->get_all_category_details();
        $data['category'] = $this->AdminModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $content['content'] = $this->load->view('admin/item/add_items', $data, TRUE);
        $this->load->view('admin/item/index', $content);
    }

    function item_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_single_item_details($id);
        $data['shop'] = $this->AdminModels->get_all_shop_details();
        $data['category'] = $this->AdminModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        //$data['sub_category'] = $this->AdminModels->get_all_item_sub_category_details($data['item'][0]->categoryId);
        $content['content'] = $this->load->view('admin/item/item_edit', $data, TRUE);
        $this->load->view('admin/item/index', $content);
    }


    function load_sub_category()
    {
        $data['sub_category'] = $this->AdminModels->get_all_item_sub_category_details($_POST['cat_id']);
        $content = $this->load->view('admin/item/load_sub_category_list', $data, TRUE);
        echo $content;
    }

    function insert_item()
    {
        $id = $this->AdminModels->insert_item_deatils($_POST, $_FILES);
        if ($id) {
            redirect('admin/item_view/' . $id);
        } else {
            redirect('admin/add_items');
        }
    }

    function item_view($id, $response = '')
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item_response'] = $response;
        $data['item'] = $this->AdminModels->get_single_item_details($id);
        $content['content'] = $this->load->view('admin/item/item_single_view', $data, TRUE);
        $this->load->view('admin/item/index', $content);

        //print_r($data);
    }

    function delete_item()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->delete_single_item($_POST['id']);
        echo $result;
    }

    function publish_shop()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->publish_shop($_POST['id']);
        echo $result;
    }


    function update_item()
    {
        $up = $this->AdminModels->update_item_deatils($_POST, $_FILES);
        if ($up) {
            redirect('admin/item_view/' . $_POST['itemId']);
        } else {
            redirect('admin/item');
        }
    }

    function import_item()
    {
        echo $this->load->view('admin/item/import_item', '', TRUE);
    }

    function insert_import_item()
    {
        $response = $this->AdminModels->insert_import_item($_FILES);
        echo json_encode(array('count' => count($response), 'response' => $response));
    }

    function import_result()
    {
        $data['response'] = $_POST['response'];
        echo $this->load->view('admin/item/import_item_result', $data, TRUE);
    }

    // REPORT
    function order_report()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['status'] = $this->AdminModels->get_enum_values('order_summary', 'orderStatus');
        $content['content'] = $this->load->view('admin/report/order', $data, TRUE);
        $this->load->view('admin/report/index', $content);
    }

    function order_report_details()
    {
        $data['result'] = $this->AdminModels->get_order_details($_POST);
        $content = $this->load->view('admin/report/order_view', $data, TRUE);
        $res = array(
            'result' => 1,
            'search_data' => $content,
        );
        if (isset($_POST['type']) && $_POST['type'] == 1) {
            $this->UtilityModels->html_to_pdf($content, 'order_report');
        } else {
            echo json_encode($res);
        }
    }

    function demo()
    {
        $device_ids = array('c2ba1637163b5760');
        $msg = "You have received booking for " . date('d-m-Y') . " 10:00 AM for something";
        $message = array('title' => 'Turf Booking Alert', 'body' => $msg, 'type' => 'slot_type', 'public_page_id' => "reVg871963");
        // $message= "dfg  ";
        echo send_notification("", "");
    }

    function order_full_view()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data['output'] = $this->AdminModels->get_order_full_view($where_data);

        $content['content'] = $this->load->view('admin/orders/order_full_view', $output_data, TRUE);
        $this->load->view('admin/orders/index', $content);
    }

    function demo_curl_check()
    {
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://ebaazaarweb.com/ebaazaar/mobile/getDbVersion");
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // grab URL and pass it to the browser
        $content = curl_exec($ch);

        $header = curl_getinfo($ch);


        // close cURL resource, and free up system resources
        curl_close($ch);

        $header['content'] = $content;

        print_r($header);
    }

    function publish_db_changes()
    {
        $result = $this->AdminModels->publish_db_changes();
        //log("debug","publish_db_changes".print_r($result,true));
        echo $result;
    }

    function publish_app_version()
    {
        $result = $this->AdminModels->publish_app_version();
        //log("debug","publish_db_changes".print_r($result,true));
        echo $result;
    }

    function publish_db()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["flag"] = $this->AdminModels->check_active_orders_to_publish();

        $content['content'] = $this->load->view('admin/publish_pages/publish_db_version', $data, TRUE);
        $this->load->view('admin/publish_pages/index', $content);
    }

    function shop_admin_publish_db()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["flag"] = $this->AdminModels->check_active_orders_to_publish();

        $content['content'] = $this->load->view('admin/publish_pages/publish_db_version', $data, TRUE);
        $this->load->view('admin/publish_page_shop/index', $content);
    }

    function update_app_version()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["flag"] = $this->AdminModels->check_active_orders_to_publish();

        $content['content'] = $this->load->view('admin/publish_pages/publish_app_version', $data, TRUE);
        $this->load->view('admin/publish_pages/index', $content);
    }


    function push_notification()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;

        $content['content'] = $this->load->view('admin/push_notification/push_notification', $data, TRUE);
        $this->load->view('admin/push_notification/index', $content);
    }

    function send_push_notification()
    {

        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $res = $this->AdminModels->send_push_notification($_POST, $_FILES);
        if ($res) {

            redirect('admin/notification_success');
        } else {
            redirect('admin/notification_failure');
        }
    }

    function notification_failure()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;

        $content['content'] = $this->load->view('admin/push_notification/notification_failure', $data, TRUE);
        $this->load->view('admin/push_notification/index', $content);
    }

    function notification_success()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;

        $content['content'] = $this->load->view('admin/push_notification/notification_success', $data, TRUE);
        $this->load->view('admin/push_notification/index', $content);
    }

    function banner_images()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAGS_LIST] = $this->AdminModels->get_banner();
        $content['content'] = $this->load->view('admin/banner_image/banner_images', $data, TRUE);
        $this->load->view('admin/banner_image/index', $content);

        //print_r(json_encode($data));
    }

    function banner_view($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_BANNER_DETAILS] = $this->AdminModels->get_single_banner_details($id);
        $data["shop_item_count"] = $this->AdminModels->check_shop_items($id);
        $content['content'] = $this->load->view('admin/banner_image/banner_view', $data, TRUE);
        $this->load->view('admin/banner_image/index', $content);
    }


    function insert_banner()
    {
        $id = $this->AdminModels->insert_banner($_POST, $_FILES);
        if ($id > 0) {
            redirect('admin/banner_view/' . $id);
        } else {
            redirect('admin/banner_images');
        }
    }


    function add_banner()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('admin/banner_image/add_banner', $data, TRUE);
        $this->load->view('admin/banner_image/index', $content);
    }

    function banner_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_BANNER_DETAILS] = $this->AdminModels->get_single_banner_details($id);
        $data['banner_category'] = $this->AdminModels->get_all_banner_categories();
        $content['content'] = $this->load->view('admin/banner_image/banner_edit', $data, TRUE);
        $this->load->view('admin/banner_image/index', $content);
    }


    function update_banner()
    {
        $res = $this->AdminModels->update_banner($_POST, $_FILES);


        if ($res) {
            redirect('admin/banner_view/' . $_POST[TAG_BANNER_ID]);
        } else {
            redirect('admin/banner_images');
        }
    }


    function coupon_code()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;
        $data['shop_details'] = $this->AdminModels->get_shop_details();
        $content['content'] = $this->load->view('admin/coupon_code/coupon_code', $data, TRUE);
        $this->load->view('admin/coupon_code/index', $content);
    }

    function insert_coupon_code()
    {
        $id = $this->AdminModels->insert_coupon_code($_POST);
        if ($id > 0) {
            redirect('admin/coupon_view');
        } else {
            redirect('admin/coupon_code/');
        }
    }

    function coupon_view()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAGS_LIST] = $this->AdminModels->coupon_view();
        $content['content'] = $this->load->view('admin/coupon_code/coupon_view', $data, TRUE);
        $this->load->view('admin/coupon_code/index', $content);
    }

    function coupon_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAG_COUPON_DETAILS] = $this->AdminModels->get_single_coupon_details($id);
        $content['content'] = $this->load->view('admin/coupon_code/coupon_edit', $data, TRUE);
        $this->load->view('admin/coupon_code/index', $content);
    }


    function update_coupon()
    {
        $res = $this->AdminModels->update_coupon($_POST);

        if ($res) {
            redirect('admin/coupon_view/' . $_POST[TAG_COUPON_ID]);
        } else {
            redirect('admin/coupon_edit/' . $_POST[TAG_COUPON_ID]);
        }
    }

    function delete_coupon()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $this->AdminModels->delete_coupon($_GET['couponId']);


        redirect('admin/coupon_view/');
    }

    function for_quick_shop_view()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->get_details_for_quick_shop();
        $this->load->view('admin/for_shop/for_shop_view', $result, false);
    }

    function quick_shop_items()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_quick_item_details();
        $content['content'] = $this->load->view('admin/for_shop/for_shop_items', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function quick_item_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_quick_item_details();
        $content['content'] = $this->load->view('admin/for_shop/for_shop_item_list', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function quick_item_view($id, $response = '')
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item_response'] = $response;
        $data['item'] = $this->AdminModels->get_quick_single_item_details($id);
        $content['content'] = $this->load->view('admin/for_shop/quick_item_single_view', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }


    function quick_add_items_for_shop()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['shop'] = $this->AdminModels->get_all_shop_details();
        //$data['category'] = $this->AdminModels->get_all_category_details();
        $data['category'] = $this->AdminModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $content['content'] = $this->load->view('admin/for_shop/add_items_for_shop', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function quick_insert_items_for_shop()
    {

        $id = $this->AdminModels->quick_insert_items($_POST, $_FILES);
        if ($id) {
            redirect('admin/quick_item_list/' . $id);
        } else {
            redirect('admin/quick_add_items_for_shop');
        }
    }


    function quick_item_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_quick_single_item_details($id);
        $data['shop'] = $this->AdminModels->get_all_shop_details();
        $data['category'] = $this->AdminModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_ACTIVE_SHOP_ID]);
        $content['content'] = $this->load->view('admin/for_shop/quick_item_edit', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function update_quick_item()
    {
        $up = $this->AdminModels->update_quick_item_deatils($_POST, $_FILES);
        if ($up) {
            redirect('admin/quick_item_view/' . $_POST['quickItemId']);
        } else {
            redirect('admin/quick_shop_items');
        }
    }


    function quick_import_item()
    {
        echo $this->load->view('admin/for_shop/quick_import_item', '', TRUE);
    }

    function import_quick_item()
    {
        $response = $this->AdminModels->import_quick_item($_FILES);
        echo json_encode(array('count' => count($response), 'response' => $response));
    }

    function quick_import_result()
    {
        $data['response'] = $_POST['response'];
        echo $this->load->view('admin/for_shop/quick_import_result', $data, TRUE);
    }

    function quick_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_quick_item_details();
        $content['content'] = $this->load->view('admin/for_shop/quick_list', $data, TRUE);
        $this->load->view('admin/for_shop/quick_index', $content);
    }

    function quick_cart()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_quick_details();
        $data['cart_item'] = $this->AdminModels->get_all_cart_items();
        $content['content'] = $this->load->view('admin/for_shop/quick_cart_item', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function add_to_quickcart()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $response = $this->AdminModels->add_quick_cart($_POST);
        echo $response;
    }

    function order_bill_pdf()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data['output'] = $this->AdminModels->get_order_full_view($where_data);
        //$output_data['bill_output_data']=$this->load->view('admin/orders/order_full_view', $output_data, TRUE);
        $html_content = $this->load->view('admin/order_bill/order_bill_pdf', $output_data, TRUE);
        //echo $html_content;
        $this->UtilityModels->html_to_pdf($html_content, 'order_' . $output_data[TAG_ORDER_ID]);
    }

    function quick_all_item_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item'] = $this->AdminModels->get_all_quick_item_details();
        $html_content = $this->load->view('admin/for_shop/for_shop_all_list_pdf', $data, TRUE);
        //   echo $html_content;
        $this->UtilityModels->html_to_pdf($html_content, 'item_price_list');
    }

    function quickCartIncre()
    {
        $cartId = $this->uri->segment(3);

        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $this->AdminModels->increment_cart($cartId);
        redirect('admin/quick_cart');
    }
    function quickCartDecre()
    {
        $cartId = $this->uri->segment(3);
        $quantity = $this->uri->segment(4);
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $this->AdminModels->decrement_cart($cartId, $quantity);
        redirect('admin/quick_cart');
    }

    function quick_order_submit()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data['shop'] = $this->AdminModels->get_all_shop_details();
        $data['cart_item'] = $this->AdminModels->get_all_cart_items();
        $content['content'] = $this->load->view('admin/quick_bill/quick_order_bill', $data, TRUE);
        $this->load->view('admin/quick_bill/index', $content);
    }

    function quick_order_complete()
    {
        $id = $this->AdminModels->complete_quick_order($_POST);
        if ($id > 0) {
            redirect('admin/quick_bill/' . $id);
        } else {
            redirect('admin/quick_order_submit/' . $id);
        }
    }

    function quick_bill()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);

        $data['bill'] = $this->AdminModels->quick_order_full_view($id);
        $data['bill_item'] = $this->AdminModels->bill_item_full_view($id);
        $content['content'] = $this->load->view('admin/quick_bill/complete_order_bill', $data, TRUE);
        $this->load->view('admin/quick_bill/index', $content);
    }

    function quick_bill_edit()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data['bill'] = $this->AdminModels->quick_order_full_view($id);
        $data['bill_item'] = $this->AdminModels->bill_item_full_view($id);
        $content['content'] = $this->load->view('admin/quick_bill/quick_bill_edit', $data, TRUE);
        $this->load->view('admin/quick_bill/index', $content);
    }

    function quick_bill_update()
    {
        $orderId = $_POST['orderId'];
        $bill = $this->AdminModels->update_quick_bill_deatils($_POST, $orderId);
        if ($bill) {
            redirect('admin/quick_bill_list');
        } else {
            redirect('admin/quick_bill_edit');
        }
    }

    function quick_bill_pdf()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data['quick_output'] = $this->AdminModels->quick_bill_pdf($where_data);
        $html_content = $this->load->view('admin/quick_bill/quick_pdf_bill', $output_data, TRUE);
        $this->UtilityModels->html_to_pdf($html_content, 'order_' . $output_data[TAG_ORDER_ID]);
    }

    function quick_bill_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['bill_data'] = $this->AdminModels->get_all_quick_bills();
        $content['content'] = $this->load->view('admin/quick_bill/quick_bill_table', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function quick_bill_list_status()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $status = $_POST['orderSummary'];
        $data['bill_data'] = $this->AdminModels->get_quick_bills_status($status);
        $content['content'] = $this->load->view('admin/quick_bill/quick_bill_table', $data, TRUE);
        $this->load->view('admin/for_shop/index', $content);
    }

    function mobile_exist()
    {
        $mobile = $this->input->post('mobile');
        log_message("debug", "ajith mobile-Update" . $mobile);
        $response = $this->AdminModels->mobile_exists($mobile);
        echo $response;
    }
    function thermal_print()
    {
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output_data['quick_output'] = $this->AdminModels->quick_thermal_bill_pdf($where_data);
        $html_content = $this->load->view('admin/quick_bill/thermal_pdf_bill', $output_data, TRUE);
        $order_row_numbers = $output_data['quick_output'][TAG_CURRENT_ORDER_DETAILS]['order_row_numbers'];
        $page_height = 366 + ($order_row_numbers * 18);
        $this->UtilityModels->html_to_thermal_pdf($html_content, $page_height);
    }

    function user_info_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['user_data'] = $this->AdminModels->get_all_users();
        $content['content'] = $this->load->view('admin/user/user_info_table', $data, TRUE);
        $this->load->view('admin/user/index', $content);
    }

    function user_full_view($id, $response = '')
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['item_response'] = $response;
        $data['user'] = $this->AdminModels->get_user_details($id);
        $content['content'] = $this->load->view('admin/user/user_single_view', $data, TRUE);
        $this->load->view('admin/user/index', $content);
    }

    function user_status()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $status = $_POST['accountStatus'];
        $data['user_data'] = $this->AdminModels->get_user_status($status);
        $content['content'] = $this->load->view('admin/user/user_info_table', $data, TRUE);
        $this->load->view('admin/user/index', $content);
    }

    function edit_user_status()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data['user'] = $this->AdminModels->user_full_view($id);
        $content['content'] = $this->load->view('admin/user/user_status_edit', $data, TRUE);
        $this->load->view('admin/user/index', $content);
    }

    function user_status_update()
    {
        $userId = $_POST['userId'];

        $bill = $this->AdminModels->update_user_status($_POST, $userId);
        if ($bill) {
            redirect('admin/user_info_table');
        } else {
            redirect('admin/user_full_view/' . $userId);
        }
    }

    function single_user_orders()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data['bill_data'] = $this->AdminModels->get_single_user_orders($id);
        $content['content'] = $this->load->view('admin/user/user_orders', $data, TRUE);
        $this->load->view('admin/user/index', $content);
    }

    function shop_admins()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAGS_LIST] = $this->AdminModels->shop_admin();
        $content['content'] = $this->load->view('admin/shop_admin/shop_admin_list', $data, TRUE);
        $this->load->view('admin/shop_admin/index', $content);
    }

    function shop_admin()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["shop_data"] = $this->AdminModels->get_shop_data();
        $content['content'] = $this->load->view('admin/shop_admin/add_shop_admin', $data, TRUE);
        $this->load->view('admin/shop_admin/index', $content);
    }

    function insert_shop_admin()
    {
        $mobile = $_POST['mobile'];
        $id = $this->AdminModels->insert_shop_admin($_POST, $_FILES, $mobile);

        if ($id > 0) {
            redirect('admin/shop_admins');
        } else {
            redirect('admin/shop_admin/');
        }
    }

    function shop_admin_view()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_SHOP_ADMIN_DETAILS] = $this->AdminModels->get_single_shop_admin($id);
        $content['content'] = $this->load->view('admin/shop_admin/shop_admin_view', $data, TRUE);
        $this->load->view('admin/shop_admin/index', $content);
    }

    function shop_admin_edit()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_SHOP_ADMIN_DETAILS] = $this->AdminModels->get_single_shop_admin($id);
        $content['content'] = $this->load->view('admin/shop_admin/shop_admin_edit', $data, TRUE);
        $this->load->view('admin/shop_admin/index', $content);
    }

    function update_shop_admin()
    {
        $res = $this->AdminModels->update_shop_admin($_POST, $_FILES);

        if ($res) {
            redirect('admin/shop_admins');
        } else {
            redirect('admin/shop_admin_view/' . $_POST[TAG_USER_ID]);
        }
    }

    function order_shipping_list()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_ORDER_SHIPPING] = $this->AdminModels->get_all_shipping_details($id);
        $content['content'] = $this->load->view('admin/order_shipment/order_shipping_list', $data, TRUE);
        $this->load->view('admin/order_shipment/index', $content);
    }

    function add_shipping()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data["data"] = null;
        $content['content'] = $this->load->view('admin/order_shipment/add_order_shipping', $data, TRUE);
        $this->load->view('admin/order_shipment/index', $content);
    }


    function complete_order()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_ORDER_SHIPPING] = $this->AdminModels->complete_single_order($id);
        $content['content'] = $this->load->view('admin/order_shipment/order_shipping_list', $data, TRUE);
        $this->load->view('admin/order_shipment/index', $content);
    }

    function insert_shipping_details()
    {
        $id = $this->AdminModels->insert_shipping_details($_POST);

        if ($id > 0) {
            redirect('admin/get_orders/');
        } else {
            redirect('admin/order_shipping_list/' . $_POST['orderId']);
        }
    }

    function order_shippment_edit()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_ORDER_SHIPPING] = $this->AdminModels->get_single_order_shippment($id);
        $content['content'] = $this->load->view('admin/order_shipment/order_shippment_edit', $data, TRUE);
        $this->load->view('admin/order_shipment/index', $content);
    }

    function update_order_shipment()
    {
        $res = $this->AdminModels->update_order_shipment($_POST);

        if ($res) {
            redirect('admin/order_shippment_edit/' . $_POST['id']);
        } else {
            redirect('admin/order_shipping_list/' . $_POST['orderId']);
        }
    }

    function delete_order_shippment()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->delete_single_order_shippment($_POST['id']);

        echo $result;
    }

    function cancel_order()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->cancel_single_order($_POST['id']);

        echo $result;
    }

    function cancel_assigned_order()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->cancel_single_assigned_order($_POST['id']);

        echo $result;
    }


    function demo_users()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data[TAGS_LIST] = $this->AdminModels->demo_user();
        $content['content'] = $this->load->view('admin/demo_user/demo_user_list', $data, TRUE);
        $this->load->view('admin/demo_user/index', $content);
    }

    function add_demo_users()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('admin/demo_user/add_demo_user', $data, TRUE);
        $this->load->view('admin/demo_user/index', $content);
    }

    function insert_demo_user()
    {
        $id = $this->AdminModels->insert_demo_user($_POST, $_FILES);
        if ($id) {
            redirect('admin/demo_user/' . $id);
        } else {
            redirect('admin/demo_users');
        }
    }

    function demo_user_view()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_DEMO_USER_DETAILS] = $this->AdminModels->get_single_demo_user($id);
        $content['content'] = $this->load->view('admin/demo_user/demo_user_view', $data, TRUE);
        $this->load->view('admin/demo_user/index', $content);
    }

    function demo_user_edit()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $id = $this->uri->segment(3);
        $data[TAG_DEMO_USER_DETAILS] = $this->AdminModels->get_single_demo_user($id);
        $content['content'] = $this->load->view('admin/demo_user/demo_user_edit', $data, TRUE);
        $this->load->view('admin/demo_user/index', $content);
    }

    function update_demo_user()
    {
        $res = $this->AdminModels->update_demo_user($_POST);

        if ($res) {
            redirect('admin/demo_user_view/' . $_POST[TAG_DEMO_ID]);
        } else {
            redirect('admin/demo_users');
        }
    }

    function demo_user_mobile_exist()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $result = $this->AdminModels->demo_user_mobile_exist($_POST['mobile']);
        echo $result;
    }

    function shop_admin_emailId_already()
    {

        if (array_key_exists('emailId', $_POST)) {
            $result = $this->AdminModels->validate_emailId($_POST['emailId'], 'ShopAdmin', "user_info");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }

    function shop_admin_phone_already()
    {

        if (array_key_exists('mobile', $_POST)) {
            $result = $this->AdminModels->phone_already($_POST['mobile'], 'ShopAdmin', "user_info");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }



    function shop_admin_emailId_update_already()
    {
        if (array_key_exists('emailId', $_POST)) {
            $result = $this->AdminModels->validate_update_emailId($_POST['emailId'], 'ShopAdmin', $_POST['userId'], "user_info");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }


    function shop_admin_phone_update_already()
    {

        if (array_key_exists('mobile', $_POST)) {
            $result = $this->AdminModels->phone_update_already($_POST['mobile'], 'ShopAdmin', $_POST['userId'], "user_info");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }

    function delivery_boy_emailId_already()
    {

        if (array_key_exists('emailId', $_POST)) {
            $result = $this->AdminModels->validate_emailId($_POST['emailId'], 'SuperAdmin', "delivery_boy");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }


    function delivery_boy_phone_already()
    {

        if (array_key_exists('mobile', $_POST)) {
            $result = $this->AdminModels->phone_already($_POST['mobile'], 'SuperAdmin', "delivery_boy");
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }



    function delivery_boy_emailId_update_already()
    {
        if (array_key_exists('editEmailId', $_POST)) {
            $result = $this->AdminModels->delivery_boy_validate_update_emailId($_POST['editEmailId'], $_POST['deliveryBoyId']);
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }



    function delivery_boy_phone_update_already()
    {
        if (array_key_exists('editMobile', $_POST)) {
            $result = $this->AdminModels->delivery_boy_phone_update_already($_POST['editMobile'], $_POST['deliveryBoyId']);
            if ($result > 0) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }




    function send_by_token_notification($user_token, $arrNotification, $device_type)
    {


        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($device_type == "Android") {

            $fields = array(
                'notification' => $arrNotification,
                'to' => $user_token,
                //'data' => $notification,
            );
        } else {
            $fields = array(
                'to' => $user_token,
                'notification' => $arrNotification,
            );
        }
        // Firebase API Key
        $headers = array('Authorization:key=AAAAojWxlb8:APA91bFGBHmK6X4h6W9ZUOqn3u2qU7nZUr0CHGfaFxZD3b6GtPssrUP0QDQCFDfycGf8XoFmxkx01QgYKIEzZqn1xuaQH5M8BHdPG743V4c3-0k_COmQZBYdGsF0z858v7kEZBAIe-v-', 'Content-Type:application/json');
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
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    function shop_category()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data[TAGS_LIST] = $this->AdminModels->get_shop_category();

        $content['content'] = $this->load->view('admin/shop_category/shop_category_list', $data, TRUE);
        $this->load->view('admin/shop_category/index', $content);
    }
    function add_shop_category()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data["priority"] = $this->AdminModels->get_shop_category_priority();
        $content['content'] = $this->load->view('admin/shop_category/add_shop_category', $data, TRUE);
        $this->load->view('admin/shop_category/index', $content);
    }

    function insert_shop_category()
    {
        $id = $this->AdminModels->insert_shop_category($_POST, $_FILES);
        if ($id > 0) {
            redirect('admin/shop_category_view/' . $id);
        } else {
            redirect('admin/shop_category');
        }
    }
    function shop_category_view($id)
    {

        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data['shop_category'] = $this->AdminModels->get_shop_category_details($id);

        $content['content'] = $this->load->view('admin/shop_category/view_shop_category', $data, TRUE);
        $this->load->view('admin/shop_category/index', $content);
    }
    function shop_category_edit($id)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $data['shop_category'] = $this->AdminModels->get_shop_category_details($id);

        $content['content'] = $this->load->view('admin/shop_category/edit_shop_category', $data, TRUE);
        $this->load->view('admin/shop_category/index', $content);
    }
    function update_shop_category()
    {
        $res = $this->AdminModels->update_shop_category($_POST, $_FILES);


        if ($res) {
            redirect('admin/shop_category_view/' . $_POST[TAG_BANNER_ID]);
        } else {
            redirect('admin/shop_category');
        }
    }

    function payment_pending_orders()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data = $this->AdminModels->get_payment_pending_orders();
        $data["type"] = "superAdmin";
        $data['selected_menu'] = 'PAYMENT_PENDING_ORDERS';
        $content['content'] = $this->load->view('admin/delivery_boy_admin/payment_pending_orders', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }
    function d_boy_paid_orders()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data = $this->AdminModels->d_boy_paid_orders();
        $data["type"] = "superAdmin";
        $data['selected_menu'] = 'PAID_ORDERS';
        $content['content'] = $this->load->view('admin/delivery_boy_admin/paid_orders', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function update_d_boy_payment_status()
    {
        $dbPaymentId = $_POST['dbPaymentId'];
        $status = $_POST['status'];

        $data = $this->AdminModels->update_d_boy_payment_status($dbPaymentId, $status);
        echo $data;
    }

    function payment_pending_delivery_boys()
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data = $this->AdminModels->payment_pending_delivery_boys();
        $data["type"] = "superAdmin";
        $data['selected_menu'] = 'PAYMENT_PENDING_DELIVERY_BOYS';
        $content['content'] = $this->load->view('admin/delivery_boy_admin/payment_pending_delivery_boys', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }
    function payment_pending_d_boy_order_list($deliveryBoyId)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }

        $data = $this->AdminModels->payment_pending_d_boy_order_list($deliveryBoyId);
        $data["type"] = "superAdmin";
        $data['selected_menu'] = 'PAYMENT_PENDING_DELIVERY_BOYS';
        $content['content'] = $this->load->view('admin/delivery_boy_admin/payment_pending_d_boy_order_list', $data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function pending_payment_order_full_view($orderId)
    {
        if (!$this->AdminModels->validate_login_session()) {
            redirect('admin/login');
        }
        $where_data[TAG_ORDER_ID] = $orderId;
        $output_data[TAG_ORDER_ID] = $orderId;
        $output_data['output'] = $this->AdminModels->get_order_full_view($where_data);
        $output_data['selected_menu'] = 'PAYMENT_PENDING_DELIVERY_BOYS';

        $content['content'] = $this->load->view('admin/delivery_boy_admin/payment_pending_order_full_view', $output_data, TRUE);
        $this->load->view('admin/delivery_boy_admin/index', $content);
    }

    function send_notification()
    {
        $to = 'cyO3o36bQY2p_FqItKsScR:APA91bGudbHhkLqrF9KVNjm5QLghO6WmD6hSCrEqzwCnhihviSrgRaWKZBEAe7IIxxbN4Rp0F3w1h4FZ6v_UJGWwdgZmPoQcaMD-2cIDDtEmxEIK9gWxfegg0EFFwA8fzDAzBLfNf481';
        $data = array(TAG_BODY => 'ADMIN BODY 2', TAG_TITLE => 'ADMIN TITILE 2', TAG_IMAGE => 'https://www.gstatic.com/mobilesdk/160503_mobilesdk/logo/2x/firebase_28dp.png',);
        $resp = $this->UtilityModels->shopAdminDeviceTokenNotification($data, $to);
        print_r($resp);
    }

    function test_notification()
    {
        $data = array(
            TAG_TITLE => 'TAG_TITLE',
            TAG_BODY => 'TAG_BODY',
            TAG_IMAGE => base_url('offer.jpg')
        );
        $this->UtilityModels->userSendGeneralNotification("isGeneralNotification", "userGlobalNotification", $data);
    }
}
