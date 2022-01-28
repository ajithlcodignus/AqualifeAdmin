<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ShopAdminController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("ShopAdminModels");
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
            }else {
                $this->{$method}();
            }
        }
    }
    public function index(){
        if (!$this->AdminModels->validate_login_session()) {
            redirect('shopAdmin/login');
        }


        if (($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION][TAG_SESSION_USER_ROLE] == TAG_USER_ROLE_SHOP_ADMIN)) {
            $result = $this->AdminModels->get_dashboard_details_for_super_admin();
            $this->load->view('partner/home', $result, false);
        } 
    }

    public function login()
    {
      
    }
}
