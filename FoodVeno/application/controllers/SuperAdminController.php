<?php

require APPPATH . 'libraries/REST_Controller.php';

class SuperAdminController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("SuperAdminModels");
        $this->load->model("UtilityModels");
    }

    public function index_get()
    {
        $this->load->view('welcome_message');
    }
    public function index_post()
    {
        $this->load->view('welcome_message');
    }


    function itemAvailability_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_ITEM_ID]) && isset($data[TAG_AVAILABILITY_STATUS])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->SuperAdminModels->editItemAvailability($data[TAG_ITEM_ID], $data[TAG_AVAILABILITY_STATUS], true);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function fullHomeData_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_ADMIN_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->SuperAdminModels->getFullHomeData($data[TAG_ADMIN_TOKEN]);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    

    public function superAdminLogin_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_MOBILE]) && isset($data[TAG_PASSWORD])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            log_message('error','----------ajith'.print_r($data,true));
	    $response['data']  = $this->SuperAdminModels->superAdminLogin($data[TAG_MOBILE], $data[TAG_PASSWORD],$data[TAG_FIREBASE_TOKEN]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }



    public function normalUserDetails_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;

        if (isset($data[TAG_ADMIN_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->SuperAdminModels->getNormalUserDetails();
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    public function getDataWithToken_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data']  = $this->SuperAdminModels->getDataWithToken($data[TAG_TOKEN],$data[TAG_FIREBASE_TOKEN]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function superAdminSignUp_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        log_message('error','getDataWithToken---model'.print_r( $data,true));

        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (array_key_exists(TAG_MOBILE, $data) && array_key_exists(TAG_OTP, $data) && array_key_exists(TAG_PASSWORD, $data)) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data']  = $this->SuperAdminModels->superAdminSignUp($data[TAG_MOBILE],$data[TAG_OTP],$data[TAG_PASSWORD],$data[TAG_FIREBASE_TOKEN]);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }
}
