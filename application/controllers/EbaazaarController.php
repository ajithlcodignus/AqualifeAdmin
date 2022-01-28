<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EbaazaarController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("EbaazaarModels");
        $this->load->model("UtilityModels");
        $this->load->helper('FirebaseNotification.php');
    }



    public function _remap($method) {
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
                $segment_4 = $this->uri->segment(4);
                $this->shop_select($segment_3, $segment_4);
            } else if ($segment_2 == 'get_orders') {
                $segment_3 = $this->uri->segment(3);
                $segment_4 = $this->uri->segment(4);
                $this->get_orders($segment_3,$segment_4);
            } else if ($segment_2 == 'category_view') {
                $segment_3 = $this->uri->segment(3);
                $this->category_view($segment_3);
            } else if ($segment_2 == 'category_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->category_edit($segment_3);
            } else if ($segment_2 == 'shop_category_view') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_category_view($segment_3);
            } else if ($segment_2 == 'shop_view') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_view($segment_3);
            } else if ($segment_2 == 'shop_edit') {
                $segment_3 = $this->uri->segment(3);
                $this->shop_edit($segment_3);
            }
            else {
                $this->{$method}();
            }
        }
    }

    function index() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $result = $this->EbaazaarModels->get_dashboard_details_for_super_admin();
        $this->load->view('ebaazaar/home',$result,false);
        /*if(($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SUPER_ADMIN) || ($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_ADMIN))
        {
            $result = $this->EbaazaarModels->get_dashboard_details_for_super_admin();
            $this->load->view('ebaazaar/home',$result,false);
        }
        else
        {
            $result = $this->EbaazaarModels->get_dashboard_details_for_shop_admin();
            $this->load->view('ebaazaar/shop_dashboard',$result,false);
        }*/
    }

    function shop_select($shop_id, $shop_name)
    {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID] = $shop_id;
        $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_NAME] = $shop_name;
        redirect( base_url().'ebadmin/shop_index');

    }
    function shop_index()
    {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $result = $this->EbaazaarModels->get_dashboard_details_for_shop_admin();
        $this->load->view('ebaazaar/shop_dashboard',$result,false);
    }

    function delivery_boy() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOYS_LIST] = $this->EbaazaarModels->get_delivery_boys();
        $data["type"] = "admin";
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/delivery_boy_list', $data, TRUE);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function delivery_boy_admin() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOYS_LIST] = $this->EbaazaarModels->get_delivery_boys_for_admin();
        $data["type"] = "superAdmin";
        $content['content'] = $this->load->view('ebaazaar/delivery_boy_admin/delivery_boy_list', $data, TRUE);
        $this->load->view('ebaazaar/delivery_boy_admin/index', $content);
    }


    function delete_delivery_boy() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $result = $this->EbaazaarModels->delete_single_delivery_boy($_POST['id']);
        echo $result;
    }

    function delivery_boy_edit($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->EbaazaarModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/delivery_boy_edit', $data, TRUE);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function add_delivery_boy_from_list()
    {
        if (!$this->EbaazaarModels->validate_login_session())
        {
            redirect('ebadmin/login');
        }

        $where_data[TAG_ACTIVE] = 1;
        //$where_data[TAG_SHOP_ID] = 0;

        $output = $this->EbaazaarModels->get_delivery_boys_list_for_add_to_shop($where_data);
        $output[TAG_TYPE] = "add";
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/list_for_assign_order', $output, TRUE);
        //print_r($content);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function update_delivery_boy() {
        $res = $this->EbaazaarModels->update_delivery_boy_deatils($_POST);
        if ($res) {
            redirect('ebadmin/item_view/' . $_POST[TAG_DELIVERY_BOY_ID]);
        } else {
            redirect('ebadmin/item_edit');
        }
    }

    function add_shop_delivery_boy() {
        $where_data[TAG_DELIVERY_BOY_ID] = $this->input->get(TAG_DELIVERY_BOY_ID);
        $res = $this->EbaazaarModels->add_shop_delivery_boy($where_data);
        if ($res) {
            redirect('ebadmin/delivery_boy');
        } else {
            redirect('ebadmin/delivery_boy');
        }
    }

    function delivery_boy_view($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->EbaazaarModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/delivery_boy_view', $data, TRUE);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function delivery_boy_view_admin($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->EbaazaarModels->get_single_delivery_boy_details($id);
        $content['content'] = $this->load->view('ebaazaar/delivery_boy_admin/delivery_boy_view', $data, TRUE);
        $this->load->view('ebaazaar/delivery_boy_admin/index', $content);
    }

    function add_delivery_boy() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/delivery_boy_add',$data, TRUE);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function add_delivery_boy_for_admin() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/delivery_boy_add',$data, TRUE);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }

    function insert_delivery_boy() {
        $id = $this->EbaazaarModels->insert_delivery_boy($_POST);
        if ($id > 0) {
            redirect('ebadmin/delivery_boy_view/' . $id);
        } else {
            redirect('ebadmin/delivery_boy');
        }
    }

    function item_categories() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAGS_LIST] = $this->EbaazaarModels->get_item_categories();
        $content['content'] = $this->load->view('ebaazaar/item_category/category_list', $data, TRUE);
        $this->load->view('ebaazaar/item_category/index', $content);
    }

    function add_item_category() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('ebaazaar/item_category/category_add',$data, TRUE);
        $this->load->view('ebaazaar/item_category/index', $content);
    }

    function insert_item_category() {

        $id = $this->EbaazaarModels->insert_item_category($_POST,$_FILES);
        if ($id > 0) {
            redirect('ebadmin/category_view/' . $id);
        } else {
            redirect('ebadmin/item_categories');
        }
    }

    function category_view($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_DELIVERY_BOY_DETAILS] = $this->EbaazaarModels->get_single_category_details($id);
        $content['content'] = $this->load->view('ebaazaar/item_category/category_view', $data, TRUE);
        $this->load->view('ebaazaar/item_category/index', $content);
    }

    function category_edit($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_CATEGORY_DETAILS] = $this->EbaazaarModels->get_single_category_details($id);
        $content['content'] = $this->load->view('ebaazaar/item_category/category_edit', $data, TRUE);
        $this->load->view('ebaazaar/item_category/index', $content);
    }



    function shop_categories() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAGS_LIST] = $this->EbaazaarModels->get_shop_categories();
        $content['content'] = $this->load->view('ebaazaar/shop_category/shop_category_list', $data, TRUE);
        $this->load->view('ebaazaar/shop_category/index', $content);
    }

    function shop_category_view($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_CATEGORY_DETAILS] = $this->EbaazaarModels->get_single_shop_category_details($id);
        $content['content'] = $this->load->view('ebaazaar/shop_category/shop_category_view', $data, TRUE);
        $this->load->view('ebaazaar/shop_category/index', $content);
    }

    function add_shop_category() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $data["data"] = null;
        $content['content'] = $this->load->view('ebaazaar/shop_category/add_shop_category',$data, TRUE);
        $this->load->view('ebaazaar/shop_category/index', $content);
    }


    function insert_shop_category() {


        $id = $this->EbaazaarModels->insert_shop_category($_POST,$_FILES);
        if ($id > 0) {
            redirect('ebadmin/shop_category_view/' . $id);
        } else {
            redirect('ebadmin/shop_categories');
        }
    }

    function shops() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAGS_LIST] = $this->EbaazaarModels->get_shops();
        $content['content'] = $this->load->view('ebaazaar/shop/shop_list', $data, TRUE);
        $this->load->view('ebaazaar/shop/index', $content);

        //print_r(json_encode($data));
    }

    function shop_view($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_SHOP_DETAILS] = $this->EbaazaarModels->get_single_shop_details($id);
        $data["shop_item_count"] = $this->EbaazaarModels->check_shop_items($id);
        $content['content'] = $this->load->view('ebaazaar/shop/shop_view', $data, TRUE);
        $this->load->view('ebaazaar/shop/index', $content);

    }

    function add_shop() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }

        $data["data"] = null;
        $data['shop_category'] = $this->EbaazaarModels->get_all_shop_categories();
        $content['content'] = $this->load->view('ebaazaar/shop/add_shop',$data, TRUE);
        $this->load->view('ebaazaar/shop/index', $content);
    }

    function shop_edit($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data[TAG_SHOP_DETAILS] = $this->EbaazaarModels->get_single_shop_details($id);
        $data['shop_category'] = $this->EbaazaarModels->get_all_shop_categories();
        $content['content'] = $this->load->view('ebaazaar/shop/shop_edit', $data, TRUE);
        $this->load->view('ebaazaar/shop/index', $content);

    }



    function insert_shop() {
        $id = $this->EbaazaarModels->insert_shop($_POST,$_FILES);
        if ($id > 0) {
            redirect('ebadmin/shop_view/' . $id);
        } else {
            redirect('ebadmin/shops');
        }
    }

     function update_shop() {
        $res = $this->EbaazaarModels->update_shop($_POST, $_FILES);
        if ($res) {
            redirect('ebadmin/shop_view/' . $_POST[TAG_SHOP_ID]);
        } else {
            redirect('ebadmin/shops');
        }
    }

    function update_item_category() {

        $res = $this->EbaazaarModels->update_item_category($_POST, $_FILES);
        if ($res) {
            redirect('ebadmin/category_view/' . $_POST[TAG_CATEGORY_ID]);
        } else {
            redirect('ebadmin/item_categories');
        }
    }





    function delivery_boy_list_order_assign()
    {
        if (!$this->EbaazaarModels->validate_login_session())
        {
            redirect('ebadmin/login');
        }

        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];

        $output = $this->EbaazaarModels->get_delivery_boys_list($where_data);
        $output[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output[TAG_TYPE] = "assign";
        $content['content'] = $this->load->view('ebaazaar/delivery_boy/list_for_assign_order', $output, TRUE);
        //print_r($content);
        $this->load->view('ebaazaar/delivery_boy/index', $content);
    }



    function get_orders($status, $shop_id)
    {
        if (!$this->EbaazaarModels->validate_login_session())
        {
            redirect('ebadmin/login');
        }

        if(!empty($shop_id))
        {
            $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID] = $shop_id;
        }


        $where_data[TAG_SHOP_ID] = $this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID];
        $where_data[TAG_ORDER_STATUS] = $status;
        $output = $this->EbaazaarModels->orders_list($where_data);
        //print_r($output);
        $this->load->view('ebaazaar/orders/order_list',$output);
    }



    function assign_order()
    {
        if (!$this->EbaazaarModels->validate_login_session())
        {
            redirect('ebadmin/login');
        }
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);

        $update_data[TAG_DELIVERY_BOY_ID] = $this->input->get(TAG_DELIVERY_BOY_ID);
        $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_ASSIGNED;

        $this->EbaazaarModels->assign_order($where_data,$update_data);
        redirect( base_url().'ebadmin/index');
    }

    function login($response = '') {
        if ($this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/index');
        }

        $data['login_response'] = $response;
        $this->load->view('ebaazaar/login/index', $data);
    }

    function get_login() {
        $result = $this->EbaazaarModels->get_user_details_for_login($_POST);
        if ($result == '') {
            redirect('admin/login/invalid');
        } else {
            $this->EbaazaarModels->get_user_login_session($result);
            redirect('ebadmin/index');
        }
    }

    function logout() {
        $this->EbaazaarModels->get_logout();
        redirect('ebadmin/login');
    }

    function check_session() {
        echo $this->EbaazaarModels->validate_login_session();
    }

    function item() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data['item'] = $this->EbaazaarModels->get_all_item_details();
        $content['content'] = $this->load->view('ebaazaar/item/item_table', $data, TRUE);
        $this->load->view('ebaazaar/item/index', $content);
    }

    function add_items() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data['shop'] = $this->EbaazaarModels->get_all_shop_details();
        //$data['category'] = $this->EbaazaarModels->get_all_category_details();
        $data['category'] = $this->EbaazaarModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        $content['content'] = $this->load->view('ebaazaar/item/add_items', $data, TRUE);
        $this->load->view('ebaazaar/item/index', $content);
    }

    function item_edit($id) {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data['item'] = $this->EbaazaarModels->get_single_item_details($id);
        $data['shop'] = $this->EbaazaarModels->get_all_shop_details();
        $data['category'] = $this->EbaazaarModels->get_all_item_category_for_shop($this->session->userdata[TAG_E_B_TEMP_LOGIN_SESSION][TAG_E_B_TEMP_SESSION_ACTIVE_SHOP_ID]);
        //$data['sub_category'] = $this->EbaazaarModels->get_all_item_sub_category_details($data['item'][0]->categoryId);
        $content['content'] = $this->load->view('ebaazaar/item/item_edit', $data, TRUE);
        $this->load->view('ebaazaar/item/index', $content);
    }


    function load_sub_category() {
        $data['sub_category'] = $this->EbaazaarModels->get_all_item_sub_category_details($_POST['cat_id']);
        $content = $this->load->view('ebaazaar/item/load_sub_category_list', $data, TRUE);
        echo $content;
    }

    function insert_item() {
        $id = $this->EbaazaarModels->insert_item_deatils($_POST,$_FILES);
        if ($id) {
            redirect('ebadmin/item_view/' . $id);
        } else {
            redirect('ebadmin/add_items');
        }
    }

    function item_view($id, $response = '') {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data['item_response'] = $response;
        $data['item'] = $this->EbaazaarModels->get_single_item_details($id);
        $content['content'] = $this->load->view('ebaazaar/item/item_single_view', $data, TRUE);
        $this->load->view('ebaazaar/item/index', $content);

        //print_r($data);
    }

    function delete_item() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $result = $this->EbaazaarModels->delete_single_item($_POST['id']);
        echo $result;
    }

    function publish_shop() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $result = $this->EbaazaarModels->publish_shop($_POST['id']);
        echo $result;
    }


    function update_item() {
        $up = $this->EbaazaarModels->update_item_deatils($_POST, $_FILES);
        if ($up) {
            redirect('ebadmin/item_view/' . $_POST['itemId']);
        } else {
            redirect('ebadmin/item_edit');
        }
    }

    function import_item() {
        echo $this->load->view('ebaazaar/item/import_item', '', TRUE);
    }

    function insert_import_item() {
        $response = $this->EbaazaarModels->insert_import_item($_FILES);
        echo json_encode(array('count' => count($response), 'response' => $response));
    }

    function import_result() {
        $data['response'] = $_POST['response'];
        echo $this->load->view('ebaazaar/item/import_item_result', $data, TRUE);
    }

// REPORT
    function order_report() {
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $data['status'] = $this->EbaazaarModels->get_enum_values('order_summary', 'orderStatus');
        $content['content'] = $this->load->view('ebaazaar/report/order', $data, TRUE);
        $this->load->view('ebaazaar/report/index', $content);
    }

    function order_report_details() {
        $data['result'] = $this->EbaazaarModels->get_order_details($_POST);
        $content = $this->load->view('ebaazaar/report/order_view', $data, TRUE);
        $res = array(
            'result' => 1,
            'search_data' => $content,
        );
        if (isset($_POST['type']) && $_POST['type'] == 1) {
            pdf_create($content, 'order_report');
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
        if (!$this->EbaazaarModels->validate_login_session()) {
            redirect('ebadmin/login');
        }
        $where_data[TAG_ORDER_ID] = $this->input->get(TAG_ORDER_ID);
        $output = $this->EbaazaarModels->get_order_full_view($where_data);

        $content['content'] = $this->load->view('ebaazaar/orders/order_full_view', $output, TRUE);
        $this->load->view('ebaazaar/orders/index', $content);

    }

}
