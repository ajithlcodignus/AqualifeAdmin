<?php

require APPPATH . 'libraries/REST_Controller.php';

class MobileController extends REST_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("DatabaseModels");
        $this->load->model("UtilityModels");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */

    public function index_get()
    {
        $this->load->view('welcome_message');
    }
    public function index_post()
    {
        $this->load->view('welcome_message');
    }

    public function login_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $response = $this->DatabaseModels->login($data[TAG_MOBILE], $data[TAG_PASSWORD], $data[TAG_PLATFORM_TYPE]);
        // $response = $this->DatabaseModels->androidLogin($data[TAG_MOBILE], $data[TAG_PASSWORD],$pla);
        $this->response($response, REST_Controller::HTTP_OK);
    }
    public function androidLogin_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->androidLogin($data[TAG_MOBILE], $data[TAG_PASSWORD]);

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function login_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->login($input[TAG_MOBILE], $input[TAG_PASSWORD]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function androidLogin_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->androidLogin($input[TAG_MOBILE], $input[TAG_PASSWORD]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function item_get()
    {
        $input = $this->get();
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $where_data[TAG_ITEM_ID] = $input[TAG_ITEM_ID];
        $output = $this->DatabaseModels->item_details($where_data);
        if ($output != null) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response[TAG_ITEM] = $output;
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    public function mobileNumberValidation_get()
    {
        $input = $this->get();
        $where_data[TAG_MOBILE] = $input[TAG_MOBILE];
        $response = $this->DatabaseModels->mobileNumberValidation($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function registration_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->registration($data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartIncrement_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $insert_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $insert_data[TAG_SHOP_ID] = $data[TAG_SHOP_ID];
        $insert_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];
        $insert_data[TAG_QUANTITY] = $data[TAG_QUANTITY];
        $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $insert_data[TAG_CART_GST] = $data[TAG_CART_GST];
        $response = $this->DatabaseModels->cartIncrement($insert_data, $data[TAG_CURRENT_SHOP_GST]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartDeleteAndAdd_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $insert_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $insert_data[TAG_SHOP_ID] = $data[TAG_SHOP_ID];
        $insert_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];
        $insert_data[TAG_QUANTITY] = $data[TAG_QUANTITY];
        $insert_data[TAG_CART_GST] = $data[TAG_CART_GST];
        $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->cartDeleteAndAdd($insert_data, $data[TAG_CURRENT_SHOP_GST]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartIncrementFromCart_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->cartIncrementFromCart($data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartDelete_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $response = $this->DatabaseModels->cartDelete($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartDecrement_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->cartDecrement($data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartDeleteInactiveItem_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->cartDeleteInactiveItem($data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cart_get()
    {
        $input = $this->get();
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        $response = $this->DatabaseModels->getCart($input[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function favourites_get()
    {
        $input = $this->get();
        $response = $this->DatabaseModels->getFavourites($input[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function favourites_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        if ($data[TAG_FAVOURITEFLAG] == 1) {
            $insert_data[TAG_USER_ID] = $data[TAG_USER_ID];
            $insert_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];
            $insert_data[TAG_FAVOURITEFLAG] = $data[TAG_FAVOURITEFLAG];
            $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');

            $response = $this->DatabaseModels->insertFavorites($insert_data);
        } else {
            $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
            $where_data[TAG_ITEM_ID] = $data[TAG_ITEM_ID];
            $response = $this->DatabaseModels->removeFavorites($where_data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function placeOrder_post()
    {


        $input = $this->post();
        $data = json_decode(($input[0]), true);


        $input_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $input_data[TAG_TOTAL_AMOUNT] = $data[TAG_TOTAL_AMOUNT];
        $input_data[TAG_PAYMENT_AMOUNT] = $data[TAG_PAYMENT_AMOUNT];
        $input_data[TAG_DISCOUNT_AMOUNT] = $data[TAG_DISCOUNT_AMOUNT];
        $input_data[TAG_DELIVERY_FEE] = $data[TAG_DELIVERY_FEE];
        $input_data[TAG_PACKING_CHARGE] = $data[TAG_PACKING_CHARGE];
        $input_data[TAG_PAYMENT_MODE] = $data[TAG_PAYMENT_MODE];
        $input_data[TAG_TRANSACTION_ID] = $data[TAG_TRANSACTION_ID];
        $input_data[TAG_GST] = $data[TAG_GST];
        $input_data[TAG_SHOP_ID] = $data[TAG_SHOP_ID];
        $input_data[TAG_SHOP_NAME] = $data[TAG_SHOP_NAME];
        $input_data[TAG_ADDRESS_ID] = $data[TAG_ADDRESS_ID];
        $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $input_data[TAG_ORDER_DATE] = date('Y-m-d');
        $response = $this->DatabaseModels->placeOrder($input_data, $data["platformType"]);
        log_message('error', 'order response' . print_r($response, true));
        $this->response($response, REST_Controller::HTTP_OK);
    }




    public function addAddress_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $input_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $input_data[TAG_FULL_ADDRESS] = $data[TAG_FULL_ADDRESS];
        $input_data[TAG_HOUSE_NAME] = $data[TAG_HOUSE_NAME];
        $input_data[TAG_ADDRESS_TYPE] = $data[TAG_ADDRESS_TYPE];
        $input_data[TAG_PIN_CODE] = $data[TAG_PIN_CODE];
        $input_data[TAG_LANDMARK] = $data[TAG_LANDMARK];
        $input_data[TAG_LATITUDE] = $data[TAG_LATITUDE];
        $input_data[TAG_LONGITUDE] = $data[TAG_LONGITUDE];
        $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->addAddress($input_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function editAddress_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $where_data[TAG_ADDRESS_ID] = $data[TAG_ADDRESS_ID];

        $update_data[TAG_FULL_ADDRESS] = $data[TAG_FULL_ADDRESS];
        $update_data[TAG_HOUSE_NAME] = $data[TAG_HOUSE_NAME];
        $update_data[TAG_ADDRESS_TYPE] = $data[TAG_ADDRESS_TYPE];
        $update_data[TAG_PIN_CODE] = $data[TAG_PIN_CODE];
        $update_data[TAG_LANDMARK] = $data[TAG_LANDMARK];
        $update_data[TAG_LATITUDE] = $data[TAG_LATITUDE];
        $update_data[TAG_LONGITUDE] = $data[TAG_LONGITUDE];
        $response = $this->DatabaseModels->editAddress($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function deleteAddress_post()
    {
        $input = $this->post();

        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $where_data[TAG_ADDRESS_ID] = $data[TAG_ADDRESS_ID];

        $response = $this->DatabaseModels->deleteAddress($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function changeAddressLatLng_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_ADDRESS_ID] = $data[TAG_ADDRESS_ID];
        $update_data[TAG_LATITUDE] = $data[TAG_LATITUDE];
        $update_data[TAG_LONGITUDE] = $data[TAG_LONGITUDE];
        $response = $this->DatabaseModels->editAddress($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function orderHistory_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->getOrderHistory($data[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function profileEdit_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $update_data[TAG_NAME] = $data[TAG_NAME];
        $update_data[TAG_EMAIL_ID] = $data[TAG_EMAIL_ID];
        //$update_data[TAG_PASSWORD] = $data[TAG_PASSWORD];

        $response = $this->DatabaseModels->editProfile($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getAddress_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $response = $this->DatabaseModels->getAddress($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getSpecificShopItems_get()
    {
        $input = $this->get();
        $response = $this->DatabaseModels->get_specific_shop_items($input[TAG_USER_ID], $input[TAG_SHOP_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function forgotPasswordSendOtp_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_MOBILE] = $data[TAG_MOBILE];
        $where_data[TAG_EMAIL_ID] = $data[TAG_EMAIL_ID];
        $response = $this->DatabaseModels->forgotPasswordSendOtp($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function forgotPasswordSubmitOtp_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $where_data[TAG_OTP] = $data[TAG_OTP];
        $response = $this->DatabaseModels->forgotPasswordSubmitOtp($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function resetPasswordSubmit_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $update_data[TAG_PASSWORD] = $data[TAG_PASSWORD];

        $response = $this->DatabaseModels->resetPasswordSubmit($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getCurrentOrderStatus_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];
        $response = $this->DatabaseModels->getCurrentOrderStatus($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getCurrentOrderDetails_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $data[TAG_USER_ID];

        $response = $this->DatabaseModels->getCurrentOrderDetails($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function orderCancel_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_ORDER_ID] = $data[TAG_ORDER_ID];
        $update_data[TAG_USER_REMARK] = $data[TAG_REMARK];
        $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_CANCELLED;

        $response = $this->DatabaseModels->updateOrderStatus($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function androidGetSyncData_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $response = $this->DatabaseModels->androidGetSyncData($data[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDbVersion_post()
    {
        $response = $this->DatabaseModels->getDbVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getAppVersion_post()
    {
        $response = $this->DatabaseModels->getAppVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function androidGetAppVersion_post()
    {
        $response = $this->DatabaseModels->getAndroidAppVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDbVersionAndSyncData_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $response = $this->DatabaseModels->getDbVersionAndSyncData($data[TAG_USER_ID], $data[TAG_LOCAL_DB_VERSION_CODE]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function androidGetDbVersionAndSyncData_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $response = $this->DatabaseModels->androidGetDbVersionAndSyncData($data[TAG_USER_ID], $data[TAG_LOCAL_DB_VERSION_CODE]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function calculateDeliveryAmount_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $shopId = $data[TAG_SHOP_ID];
        $latitude = $data[TAG_LATITUDE]; //"11.7014";
        $longitude = $data[TAG_LONGITUDE]; //"76.1044";

        $response = $this->DatabaseModels->calculateDeliveryAmount($shopId, $latitude, $longitude);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getAndroidAppVersion_get()
    {
        $res = $this->DatabaseModels->getAndroidAppVersion();

        echo json_encode($res);
    }



    /*-----------------------------------------------DELIVERY BOY APIS----------------------------------*/

    public function deliveryBoyLogin_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        log_message('error', 'input firebase_toke---' . print_r($data, true));

        $response = $this->DatabaseModels->deliveryBoylogin($data[TAG_MOBILE], $data[TAG_PASSWORD], $data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function orderComplete_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_ORDER_ID] = $data[TAG_ORDER_ID];
        $update_data[TAG_REMARK] = $data[TAG_REMARK];
        $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_DELIVERED;

        $response = $this->DatabaseModels->orderComplete($where_data, $update_data, $data[TAG_DELIVERY_BOY_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDeliveryBoyOrderDetails_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_DELIVERY_BOY_ID] = $data[TAG_DELIVERY_BOY_ID];
        $where_data[TAG_ORDER_STATUS] = $data[TAG_ORDER_STATUS];
        $response = $this->DatabaseModels->getDeliveryBoyOrderDetails($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function deliveryBoyProfileEdit_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);

        $where_data[TAG_DELIVERY_BOY_ID] = $data[TAG_DELIVERY_BOY_ID];
        $update_data[TAG_DELIVERY_BOY_NAME] = $data[TAG_DELIVERY_BOY_NAME];
        $update_data[TAG_EMAIL_ID] = $data[TAG_EMAIL_ID];
        //$update_data[TAG_PASSWORD] = $data[TAG_PASSWORD];

        $response = $this->DatabaseModels->deliveryBoyProfileEdit($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function deliveryBoyRefreshPage_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->getDeliveryBoyOrdersDetails($data[TAG_DELIVERY_BOY_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }



    //DEMO DELIVERY BOY GET METHODS
    public function deliveryBoyLogin_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->deliveryBoylogin($input[TAG_MOBILE], $input[TAG_PASSWORD]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function orderComplete_get()
    {
        $input = $this->get();
        $where_data[TAG_ORDER_ID] = $input[TAG_ORDER_ID];
        $update_data[TAG_REMARK] = $input[TAG_REMARK];
        $update_data[TAG_ORDER_STATUS] = TAG_ORDER_STATUS_DELIVERED;

        $response = $this->DatabaseModels->orderComplete($where_data, $update_data, $input[TAG_DELIVERY_BOY_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDeliveryBoyOrderDetails_get()
    {
        $input = $this->get();


        $where_data[TAG_DELIVERY_BOY_ID] = $input[TAG_DELIVERY_BOY_ID];
        $where_data[TAG_ORDER_STATUS] = $input[TAG_ORDER_STATUS];
        $response = $this->DatabaseModels->getDeliveryBoyOrderDetails($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function deliveryBoyProfileEdit_get()
    {
        $input = $this->get();


        $where_data[TAG_DELIVERY_BOY_ID] = $input[TAG_DELIVERY_BOY_ID];
        $update_data[TAG_DELIVERY_BOY_NAME] = $input[TAG_DELIVERY_BOY_NAME];
        $update_data[TAG_EMAIL_ID] = $input[TAG_EMAIL_ID];
        //$update_data[TAG_PASSWORD] = $data[TAG_PASSWORD];

        $response = $this->DatabaseModels->deliveryBoyProfileEdit($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function deliveryBoyRefreshPage_get()
    {
        $input = $this->get();
        $response = $this->DatabaseModels->getDeliveryBoyOrdersDetails($input[TAG_DELIVERY_BOY_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }



    function getSyncData_get()
    {
        $input = $this->get();

        $response = $this->DatabaseModels->getSyncData($input[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDbVersion_get()
    {
        $response = $this->DatabaseModels->getDbVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getAppVersion_get()
    {
        $response = $this->DatabaseModels->getAppVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function androidGetAppVersion_get()
    {
        $response = $this->DatabaseModels->getAndroidAppVersion();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function updateVersionCde_get()
    {
        $response = $this->DatabaseModels->updateVersionCde();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDbVersionAndSyncData_get()
    {
        $input = $this->get();

        $response = $this->DatabaseModels->getDbVersionAndSyncData($input[TAG_USER_ID], $input[TAG_LOCAL_DB_VERSION_CODE]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function androidGetDbVersionAndSyncData_get()
    {
        $input = $this->get();

        $response = $this->DatabaseModels->androidGetDbVersionAndSyncData($input[TAG_USER_ID], $input[TAG_LOCAL_DB_VERSION_CODE]);
        $this->response($response, REST_Controller::HTTP_OK);
    }



    /*-----------------------------------------------DELIVERY BOY APIS----------------------------------*/


    /*-----------------------------------------------ADMIN  APIS----------------------------------*/

    /*-----------------------------------------------ADMIN  APIS----------------------------------*/



    //DEMO GET FUNCTIONS--------------------------------------------------------
    public function androidRegistration_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        $input[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->androidRegistration($input);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function registration_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        $input[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->registration($input);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function favourites1_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);
        if ($input[TAG_FAVOURITEFLAG] == 1) {
            $insert_data[TAG_USER_ID] = $input[TAG_USER_ID];
            $insert_data[TAG_ITEM_ID] = $input[TAG_ITEM_ID];
            $insert_data[TAG_FAVOURITEFLAG] = $input[TAG_FAVOURITEFLAG];
            $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');

            $response = $this->DatabaseModels->insertFavorites($insert_data);
        } else {
            $where_data[TAG_USER_ID] = $input[TAG_USER_ID];
            $where_data[TAG_ITEM_ID] = $input[TAG_ITEM_ID];
            $response = $this->DatabaseModels->removeFavorites($where_data);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function placeOrder_get()
    {
        $input = $this->get();



        $input_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $input_data[TAG_TOTAL_AMOUNT] = $input[TAG_TOTAL_AMOUNT];
        $input_data[TAG_PAYMENT_AMOUNT] = $input[TAG_PAYMENT_AMOUNT];
        $input_data[TAG_DISCOUNT_AMOUNT] = $input[TAG_DISCOUNT_AMOUNT];
        $input_data[TAG_DELIVERY_FEE] = $input[TAG_DELIVERY_FEE];
        $input_data[TAG_PACKING_CHARGE] = $input[TAG_PACKING_CHARGE];
        $input_data[TAG_PAYMENT_MODE] = $input[TAG_PAYMENT_MODE];
        $input_data[TAG_TRANSACTION_ID] = $input[TAG_TRANSACTION_ID];
        $input_data[TAG_GST] = $input[TAG_GST];
        $input_data[TAG_SHOP_ID] = $input[TAG_SHOP_ID];
        $input_data[TAG_SHOP_NAME] = $input[TAG_SHOP_NAME];
        $input_data[TAG_ADDRESS_ID] = $input[TAG_ADDRESS_ID];
        $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $input_data[TAG_ORDER_DATE] = date('Y-m-d');

        $response = $this->DatabaseModels->placeOrder($input_data, $input["platformType"]);
        $this->response($response, REST_Controller::HTTP_OK);
    }
    public function test_get()
    {
        sleep(200);
    }

    public function getAddress_get()
    {
        $input = $this->get();

        $where_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $response = $this->DatabaseModels->getAddress($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function addAddress_get()
    {
        $input = $this->get();


        $input_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $input_data[TAG_FULL_ADDRESS] = $input[TAG_FULL_ADDRESS];
        $input_data[TAG_HOUSE_NAME] = $input[TAG_HOUSE_NAME];
        $input_data[TAG_ADDRESS_TYPE] = $input[TAG_ADDRESS_TYPE];
        $input_data[TAG_PIN_CODE] = $input[TAG_PIN_CODE];
        //$input_data[TAG_LANDMARK] = $input[TAG_LANDMARK];
        $input_data[TAG_LATITUDE] = $input[TAG_LATITUDE];
        $input_data[TAG_LONGITUDE] = $input[TAG_LONGITUDE];
        $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $response = $this->DatabaseModels->addAddress($input_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function orderHistory_get()
    {
        $input = $this->get();
        $response = $this->DatabaseModels->getOrderHistory($input[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function forgotPasswordSendOtp_get()
    {
        $input = $this->get();


        $where_data[TAG_MOBILE] = $input[TAG_MOBILE];
        $where_data[TAG_EMAIL_ID] = $input[TAG_EMAIL_ID];
        $response = $this->DatabaseModels->forgotPasswordSendOtp($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function forgotPasswordSubmitOtp_get()
    {
        $input = $this->get();

        $where_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $where_data[TAG_OTP] = $input[TAG_OTP];
        $response = $this->DatabaseModels->forgotPasswordSubmitOtp($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function resetPasswordSubmit_get()
    {
        $input = $this->get();

        $where_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $update_data[TAG_PASSWORD] = $input[TAG_PASSWORD];

        $response = $this->DatabaseModels->resetPasswordSubmit($where_data, $update_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getCurrentOrderStatus_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $input[TAG_USER_ID];

        $response = $this->DatabaseModels->getCurrentOrderStatus($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getCurrentOrderDetails_get()
    {
        $input = $this->get();
        //$data = json_decode(($input[0]), true);

        $where_data[TAG_USER_ID] = $input[TAG_USER_ID];

        $response = $this->DatabaseModels->getCurrentOrderDetails($where_data);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function cartIncrement_get()
    {
        $input = $this->get();
        $insert_data[TAG_USER_ID] = $input[TAG_USER_ID];
        $insert_data[TAG_SHOP_ID] = $input[TAG_SHOP_ID];
        $insert_data[TAG_ITEM_ID] = $input[TAG_ITEM_ID];
        $insert_data[TAG_QUANTITY] = $input[TAG_QUANTITY];
        $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
        $insert_data[TAG_CART_GST] = $input[TAG_CART_GST];
        $response = $this->DatabaseModels->cartIncrement($insert_data, $input[TAG_CURRENT_SHOP_GST]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getAdminReceivedOrders_get()
    {
        $response = $this->DatabaseModels->getAdminReceivedOrders();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function calculateDeliveryAmount_get()
    {
        $input = $this->get();
        $shopId = $input[TAG_SHOP_ID];
        $latitude = $input[TAG_LATITUDE]; //"11.7014";
        $longitude = $input[TAG_LONGITUDE]; //"76.1044";

        $response = $this->DatabaseModels->calculateDeliveryAmount($shopId, $latitude, $longitude);
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function demo_email_get()
    {

        $email_id = "order@ebaazaarweb.com";

        $subject = "Order Received";
        $message = "You have new Order received, please check admin panel";

        $this->UtilityModels->sendMail($email_id, $message, $subject);
    }






    function send_otp_login_post()
    {
        $input = $this->post();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;

            $response['data'] = $this->DatabaseModels->insert_login_otp($input[TAG_MOBILE]);
        }
        $response['otp'] =
            $this->response($response, REST_Controller::HTTP_OK);
    }

    function send_otp_login_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;

            $response['data'] = $this->DatabaseModels->insert_login_otp($input[TAG_MOBILE]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }


    function reset_login_otp_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE], $input[TAG_OTP])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;

            $response['data'] = $this->DatabaseModels->reset_login_otp($input[TAG_MOBILE], $input[TAG_OTP]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    function login_home_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;

            $response['data'] = $this->DatabaseModels->login_home($input[TAG_MOBILE]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }


    function validate_coupon_code_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_SHOP_ID]) && isset($input[TAG_COUPON_CODE]) && isset($input[TAG_TOTAL_AMOUNT]) && isset($input[TAG_USER_ID])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;

            $response['data'] = $this->DatabaseModels->validate_coupon_code($input);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function login_with_number_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->login_with_number($input[TAG_MOBILE]);
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    function login_with_number_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_MOBILE])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->login_with_number($data[TAG_MOBILE]);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }



    function validate_otp_and_mobile_get()
    {
        $input = $this->get();
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($input[TAG_MOBILE]) && isset($input[TAG_OTP])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->validate_otp_and_mobile($input[TAG_MOBILE], $input[TAG_OTP], false);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function validate_otp_and_mobile_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_MOBILE]) && isset($data[TAG_OTP])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->validate_otp_and_mobile($data[TAG_MOBILE], $data[TAG_OTP], false);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }
    function android_validate_otp_and_mobile_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_MOBILE]) && isset($data[TAG_OTP])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->validate_otp_and_mobile($data[TAG_MOBILE], $data[TAG_OTP], true);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function fullHomeData_get()
    {

        $response['status'] = HTTP_FAILURE_RESPONSE;
        $input = $this->get();
        if (isset($input['platform_type'])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->fetch_all_home_data(1);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function fullHomeData_post()
    {

        $response['status'] = HTTP_FAILURE_RESPONSE;
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        if (isset($data['platform_type'])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->fetch_all_home_data(1);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function outerSpecificShopItems_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->outer_get_specific_shop_items($data[TAG_SHOP_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function outerSpecificShopItems_get()
    {
        $input = $this->post();
        $data = $this->get();
        $response = $this->DatabaseModels->outer_get_specific_shop_items($data[TAG_SHOP_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getSyncData_post()
    {

        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response = $this->DatabaseModels->getSyncData($data[TAG_USER_ID]);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function getDistanceGet_get()
    {
        $latitude = '11.2722';
        $longitude = '75.8372';
        $query_result = $this->db->query("select IFNULL((6371 * acos (cos ( radians($latitude) )* cos( radians( latitude ) )* cos( radians( longitude ) - radians($longitude) )+ sin ( radians($latitude) )* sin( radians( latitude ) ))),0) AS Distance FROM `start_point` ORDER BY Distance");
        $response = $query_result->row();
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function tokenValidation_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->all_data_with_token($data[TAG_TOKEN], false);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }



    function tokenValidation_get()
    {
        $data = $this->get();
        // $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->all_data_with_token($data[TAG_TOKEN], false);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function androidTokenValidation_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_TOKEN])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->all_data_with_token($data[TAG_TOKEN], true);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function editUserProfile_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response['status'] = HTTP_FAILURE_RESPONSE;
        if (isset($data[TAG_TOKEN]) && isset($data[TAG_NAME])) {
            $response['status'] = HTTP_SUCCESS_RESPONSE;
            $response['data'] = $this->DatabaseModels->edit_user_profile($data[TAG_TOKEN], $data[TAG_NAME], true);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function language_post()
    {
        $response = $this->DatabaseModels->get_language();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function deliveryBoyTokenLogin_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        if (array_key_exists(TAG_TOKEN, $data) && array_key_exists(TAG_FIREBASE_TOKEN, $data)) {
            $response[TAG_RESPONSE_STATUS] = HTTP_SUCCESS_RESPONSE;
            $response = $this->DatabaseModels->deliveryBoyTokenLogin($data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function deliveryBoySignUp_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
	$response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
	log_message('error',print_r($data,true));
        if (array_key_exists(TAG_MOBILE, $data) && array_key_exists(TAG_PASSWORD, $data)) {
            $response = $this->DatabaseModels->deliverySignUp($data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }




    function deliveryBoyForgetPass_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        if (array_key_exists(TAG_MOBILE, $data) && array_key_exists(TAG_EMAIL_ID, $data)) {
            $response = $this->DatabaseModels->deliveryBoyForgetPass($data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function deliveryBoyPasswordResetOtpSubmit_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        if (array_key_exists(TAG_TOKEN, $data) && array_key_exists(TAG_OTP, $data)) {
            log_message('error', '-------ajith' . print_r($this->db->last_query(), true));

            $response = $this->DatabaseModels->deliveryBoyPasswordResetOtpSubmit($data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }

    function deliveryBoySubmitNewPassword_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $response[TAG_RESPONSE_STATUS] = HTTP_FAILURE_RESPONSE;
        if (array_key_exists(TAG_PASSWORD, $data) && array_key_exists(TAG_TOKEN, $data)) {
            $response = $this->DatabaseModels->deliveryBoySubmitNewPassword($data);
        }
        $this->response($response, REST_Controller::HTTP_OK);
    }


    function insert_notification_token_post()
    {
        $input = $this->post();
        $data = json_decode(($input[0]), true);
        $insert_data['token'] = $data[TAG_TOKEN];
        $this->db->insert('notificationToken', $insert_data);
    }
    function adminTopicNotification_get()
    {
        $super_admin_notification_data = array(
            TAG_TITLE => "New Order Received",
            TAG_BODY => "You have new Order received, please check admin panel",
            TAG_IMAGE => "",

        );

        $otp = $this->UtilityModels->adminTopicNotification("adminNotification", "adminGlobalNotification", $super_admin_notification_data);
    }

    function test_query_get()
    {
        $orderId = 1;
        $response =  $this->DatabaseModels->getShopAdminDataForOrder($orderId);
        $this->response($response, REST_Controller::HTTP_OK);
    }
}
