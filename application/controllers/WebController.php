<?php
defined('BASEPATH') or exit('No direct script access allowed');


class WebController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("DatabaseModels");
        $this->load->model("UtilityModels");
    }


    public function _remap($method)
    {
    $segment_2 = $this->uri->segment(2);
    
        if (method_exists($this, $method)) {
            if($method=='index'){
               $this->index();
            }
            
            elseif ($method == 'cart_increment') {
                if(isset($_POST['t_d'])){
                
                $this->cart_increment();
                }
            } elseif ($method == 'delete_cart_item') {
                if(isset($_POST['c_d'])){
                
                $this->delete_cart_item();
                }
            } 
            elseif ($method == 'cart_decrement') {
                if(isset($_POST['t_d'])){
                $this->cart_decrement();
                }
            } 
            elseif ($method == 'search_product') {
                if(isset($_POST['keyword'])){
                $this->search_product();
                }
            } 
            elseif ($method == 'register') {
                if(isset($_POST[TAG_MOBILE])){
                $this->register();
                }
            } 
            elseif ($method == 'get_login') {
                if(isset($_POST[TAG_MOBILE])){
                $this->get_login();
                }
            }
            elseif ($method == 'load_more_products') {
       

                if(isset($_POST['last_id'])){
                $this->load_more_products();
                }
            }
            elseif ($method == 'search_result') {
                $this->search_result($segment_2);
            }elseif ($method == 'search_results') {
                $this->search_results();
            }
            elseif ($method == 'orders') {
                
                $this->orders();
                
            }
            elseif ($method == 'category_items') {
                
                $this->category_items($segment_2);
                
            }elseif ($method == 'load_more_category') {
              
                $this->load_more_category($segment_2);
                
            }
            elseif ($method == 'delete_address') {
                $this->delete_address();
            }elseif ($method == 'add_address') {
                $this->add_address();
            
            }elseif ($method == 'edit_address') {
                $this->edit_address();
            
            }elseif ($method == 'cancel_order') {
                $this->cancel_order();
            
            }
            elseif ($method == 'place_order') {
                $this->place_order();
            }
            elseif ($method == 'profile') {
                $this->profile();
            }
            elseif ($method == 'checkout') {
                $this->checkout();
            }
            elseif ($method == 'logout') {
                $this->logout();
            }
            elseif ($method == 'profile_bkp') {
                $this->profile_bkp();
            } elseif ($method == 'full_view') {

                $this->full_view($segment_2);
            }
          
          else{
              echo "Sorry not allowed";
          }

        
	}
    }
    

   
    function index()
    {
        

        if ($this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
            $data['cart_data'] = $this->DatabaseModels->cart_details();
            $data['item_data'] = $this->DatabaseModels->item_details(32);
            $data['category_data']=$this->DatabaseModels->get_category();
            $content['content'] = $this->load->view('web/home', $data);
        } else {
            $data['item_data'] = $this->DatabaseModels->item_details(32);
            $data['category_data']=$this->DatabaseModels->get_category();
            $content['content'] = $this->load->view('web/home', $data);
        }
    }

    function profile()
    {
        if (!$this->DatabaseModels->validate_login_session()) {
            redirect('/');
        }
        if($this->DatabaseModels->get_address()){
        $view_data['address_data']=$this->DatabaseModels->get_address();
        }
        $view_data[TAG_USER_DETAILS] = $this->DatabaseModels->get_user_details();
        $view_data['cart_count']=$this->DatabaseModels->cart_count();
        $this->load->view('web/profile', $view_data);
    }
    function profile_bkp()
    {
        if (!$this->DatabaseModels->validate_login_session()) {
            redirect('/');
        }

        
        $data[TAG_USER_DETAILS] = $this->DatabaseModels->get_user_details();
        $this->load->view('web/profile_bkp', $data);
    }




    public function register()
    {
       
        if($this->DatabaseModels->validate_emailId($_POST[TAG_EMAIL_ID])){
        $response[TAG_RESPONSE_STATUS]=0;
        $response['error']='email id already exist';
        }
       else if($this->DatabaseModels->validate_mobile($_POST[TAG_MOBILE])){
            $response[TAG_RESPONSE_STATUS]=0;
            $response['error']='mobile number already exist';
            }
        else{
            $response[TAG_RESPONSE_STATUS]= $this->DatabaseModels->user_registration($_POST);
      
        }

      echo json_encode($response);
    }



    public function get_login()
    {

        $result = $this->DatabaseModels->get_user_details_for_login($_POST);

        if ($result['flag']) {
            $this->DatabaseModels->get_user_login_session($result['data'][0]->userId,$result['data'][0]->name,$result['data'][0]->token);
            echo '1';
        } else {
            echo 'Invalid mobile or password';
        }
    }

    function update_profile()
    {
        

        $data[TAG_USER_DETAILS] = $this->DatabaseModels->update_user_details($_POST);
      //  echo json_encode($response);
        
    }

    public function logout()
    {
        $this->DatabaseModels->get_logout();
        redirect('/');
    }

    function update_password()
    {
       

        $data = $this->DatabaseModels->change_password($_POST);
        if ($data) {
            echo $data;
            redirect('profile');
        }
    }

    function insert_address()
    {
       

        $this->DatabaseModels->add_address($_POST);
        redirect('profile');
    }

    function add_item_to_cart()
    {
        $itemId = $this->uri->segment(2);
        $this->DatabaseModels->cart_increment($itemId);
        redirect('index');
    }


    public function cart_increment()
    {
       
        $data = $this->input->post();
            $insert_data[TAG_USER_ID] = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $insert_data[TAG_SHOP_ID] = $data['h_p'];
            $insert_data[TAG_ITEM_ID] = $data['t_d'];

            $data['q_y']++;

            $insert_data[TAG_QUANTITY] = $data['q_y'];
	    $insert_data[TAG_AMOUNT] = $data['itemPrice'];
	    $insert_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
            $insert_data[TAG_CART_GST] = $data['s_t'];

            $response = $this->DatabaseModels->cartIncrement($insert_data, $data['c_s_g']);
            $response['status'] = 1;

            $view_data['itemId'] = $data['t_d'];
            $view_data['shopId'] =  $data['h_p'];
            $view_data['quantity'] = $data['q_y'];
            $view_data['shopGst'] = $data['s_t'];
            $view_data['itemImage'] = $data['itemImage'];
            $view_data['itemName'] = $data['itemName'];
            $view_data['itemPrice'] = $data['itemPrice'];
            if ($data['q_y'] == 1) {
                $view_data['cartId'] = $response['cart_id'];
            }
            
            $data['cart_view_data'] = $view_data;
            $response['cart_html'] = $this->load->view('cart_elements/cart_element', $data, true);
            $response['cart_total'] = $this->DatabaseModels->cart_total();
            $response['html'] = $this->load->view('web/common/cart_two_way', $view_data, true);

            echo json_encode($response);
    }


    public function cart_decrement()
    {
        
        $data = $this->input->post();
        $model_data[TAG_SHOP_ID] = $data['h_p'];
        $model_data[TAG_ITEM_ID] = $data['t_d'];
        $model_data[TAG_USER_ID] = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
        $data['q_y']--;
        $model_data[TAG_QUANTITY] = $data['q_y'];

            $response['status'] = 1;
            $response = $this->DatabaseModels->cartDecrement($model_data);
            $view_data['itemId'] = $data['t_d'];
            $view_data['shopId'] =  $data['h_p'];
            $view_data['quantity'] = $data['q_y'];
            $view_data['shopGst'] = $data['s_t'];
            $view_data['itemImage'] = $data['itemImage'];
            $view_data['itemName'] = $data['itemName'];
            $view_data['itemPrice'] = $data['itemPrice'];
            $view_data['cartId'] = $data['c_d'];
            $response['cart_total'] = $this->DatabaseModels->cart_total();
            
            $response['html'] = $this->load->view('web/common/cart_increment', $view_data, true);
            echo json_encode($response);
    }

    function delete_cart_item()
    {
        
        $data = $this->input->post();
        $input_data['cart_id'] = $data['c_d'];

            $input_data['itemId'] = $data['t_d'];
            $input_data['shopId'] =  $data['h_p'];
            $input_data['quantity'] = $data['q_y'];
            $input_data['shopGst'] = $data['s_t'];
            $input_data['itemImage'] = $data['itemImage'];
            $input_data['itemName'] = $data['itemName'];
            $input_data['itemPrice'] = $data['itemPrice'];
            
            $response = $this->DatabaseModels->deleteCartItem($input_data);
            $response['cart_total'] = $this->DatabaseModels->cart_total();
            $response['html'] = $this->load->view('web/common/cart_increment', $input_data, true);
        echo json_encode($response);
    }


    function add_address()
    {
      

        $response['status'] = 0;
        
            $input_data[TAG_USER_ID] = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $input_data[TAG_FULL_ADDRESS] = $this->input->post(TAG_FULL_ADDRESS);
            $input_data[TAG_HOUSE_NAME] = $this->input->post(TAG_HOUSE_NAME);
            $input_data[TAG_ADDRESS_TYPE] = 'Home';
            $input_data[TAG_PINCODE] = $this->input->post(TAG_PINCODE);
            $input_data[TAG_LANDMARK] = $this->input->post(TAG_LANDMARK);
            $input_data[TAG_LATITUDE] = $this->input->post(TAG_LATITUDE);
            $input_data[TAG_LONGITUDE] = $this->input->post(TAG_LONGITUDE);
            $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
            $response = $this->DatabaseModels->addAddress($input_data);
        echo json_encode($response);
    }
    function edit_address()
    {

        $response['status'] = 0;
            $data = $this->input->post();
            $where_data[TAG_USER_ID] = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
            $update_data[TAG_FULL_ADDRESS] = $data[TAG_FULL_ADDRESS];
            $update_data[TAG_HOUSE_NAME] = $data[TAG_HOUSE_NAME];
            $update_data[TAG_ADDRESS_TYPE] = 'Home';
            $update_data[TAG_PINCODE] = $data[TAG_PINCODE];
            $update_data[TAG_LANDMARK] = $data[TAG_LANDMARK];
            $update_data[TAG_LATITUDE] = $data[TAG_LATITUDE];
            $update_data[TAG_LONGITUDE] = $data[TAG_LONGITUDE];
            $response = $this->DatabaseModels->editAddress($where_data, $update_data);
        echo json_encode($response);
    }
    function place_order()
    {
        $response['status'] = 0;
        $response['demo_error_string'] ="Please add delivery address";
            $address=$this->DatabaseModels->get_address();
            
            if($address){

                if($this->DatabaseModels->haveActiveOrder()){
               
                $input_data[TAG_USER_ID] = $this->session->userdata[TAG_FOODVENO_LOGIN_SESSION][TAG_SESSION_ACTIVE_USER_ID];
                $cart_calcu_data = $this->DatabaseModels->cartCalculation();
                $input_data[TAG_TOTAL_AMOUNT] = $cart_calcu_data[TAG_TOTAL_AMOUNT];

                $input_data[TAG_PAYMENT_AMOUNT] = $cart_calcu_data[TAG_PAYMENT_AMOUNT];
                $input_data[TAG_DISCOUNT_AMOUNT] = 0.0;
                $input_data[TAG_DELIVERY_FEE] = $cart_calcu_data[TAG_DELIVERY_FEE];
                $input_data[TAG_PACKING_CHARGE] = $cart_calcu_data[TAG_PACKING_CHARGE];
                $input_data[TAG_PAYMENT_MODE] = 'COD';
                $input_data[TAG_TRANSACTION_ID] = 'COD_TRANSACTION';
                $input_data[TAG_GST] = $cart_calcu_data[TAG_SHOP_GST];
                $input_data[TAG_SHOP_ID] = $cart_calcu_data[TAG_SHOP_ID];
                $input_data[TAG_SHOP_NAME] = $cart_calcu_data[TAG_SHOP_NAME];
                $input_data[TAG_ADDRESS_ID] = $address->addressId;
                $input_data[TAG_ENTRY_DATE] = date('Y-m-d H:i:s');
                $input_data[TAG_ORDER_DATE] = date('Y-m-d');
               
                $response = $this->DatabaseModels->placeOrder($input_data, "ANDROID");
                }else{
                    $response['demo_error_string'] ="You have an active order please wait to complete";
                }
            }
           
        echo json_encode($response);
    }

    function checkout(){
        if (!$this->DatabaseModels->validate_login_session()) {
            redirect('/');
        }
        if(count($this->DatabaseModels->cart_details())==0){
            redirect('orders');
        }
        $view_data['address_data']=null;
        $view_data['cart_data'] = $this->DatabaseModels->cart_details();
        $view_data['cart_calc_data']= $this->DatabaseModels->cartCalculation();
	    if($this->DatabaseModels->get_address()){
           $view_data['address_data']=$this->DatabaseModels->get_address();
           
        }
        $this->load->view('checkout',$view_data);
    }

    function orders(){
        if (!$this->DatabaseModels->validate_login_session()) {
            redirect('/');
        }
        
        $view_data = $this->DatabaseModels->order_details();
        $view_data['cart_count']=$this->DatabaseModels->cart_count();
	   
        $this->load->view('all_orders',$view_data);
    }

    function delete_address(){
        $response['status']=0;
        $response['demo_error_string']="Address haven\'t Deleted";
        if($this->DatabaseModels->haveActiveOrder()){
            
            if ($this->DatabaseModels->validate_login_session()) {
                if($this->DatabaseModels->delete_address()){
                    $response['status']=1;
                }
            }
        }else{
            $response['demo_error_string'] = "You have an active order please wait to complete";
        }
        echo json_encode($response);
    }

     function cancel_order(){
       
       
        $response=$this->DatabaseModels->cancel_order();
       
        echo json_encode($response);
     }


    function load_more_products(){
        $last_id=$_POST['last_id'];
        $response['status']=0;
        $view_data=$this->DatabaseModels->load_more_products($last_id,32);
        if($view_data['status']==1){
            $response['status']=1;
            $response['html']=$this->load->view('web/common/product_cards',$view_data,true);
        }
        log_message('error','html - '.print_r($response,true));
            
        echo json_encode($response);
    }

    function category_items($post_data){
       
        if($this->UtilityModels->check_post_data($post_data)){
            $data['item_data'] = $this->DatabaseModels->category_item_details(32,$post_data);
            $data['category_data']=$this->DatabaseModels->get_category();
             $data['is_category']=true;
             $data['category_id']=$post_data;
            if ($this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
                $data['cart_data'] = $this->DatabaseModels->cart_details();
            } 
            $content['content'] = $this->load->view('web/home', $data);

        }else{
            echo 'Sorry access denied';
        }
     
    }
    function load_more_category($category_id){
         
        $response['status']=0;
        if(isset($_POST['last_id'])){
            if($this->UtilityModels->check_post_data($_POST['last_id'])){
              $last_id=$_POST['last_id'];
           
              $view_data=$this->DatabaseModels->load_more_category_products($last_id,32,$category_id);
              if($view_data['status']==1){
                $response['status']=1;
                $response['html']=$this->load->view('web/common/product_cards',$view_data,true);
               }
       
          }
        }
        log_message('error','error-- '.print_r($response,true));
        echo json_encode($response);
    }
    function search_result($itemId){
        if($this->UtilityModels->check_post_data($itemId)){
            $data['is_search_result']=true;
            $data['item_data'] = $this->DatabaseModels->search_result($itemId);
            $data['category_data']=$this->DatabaseModels->get_category();
            if ($this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
                $data['cart_data'] = $this->DatabaseModels->cart_details();
               
                 $this->load->view('web/home', $data);
            } else {
               
                 $this->load->view('web/home', $data);
               
            }
        }
    }

    
    public function search_product()
    {
        
        $result = $this->input->post('keyword');
        $response['status']=0;  
        if(strlen($result)>1){
            
            $view_data = $this->DatabaseModels->search_product($result);
                $response['status']=1;
                $response['html']=$this->load->view('web/common/search_suggestion',$view_data,true);
            
        }
        log_message('error','html - '.print_r($response,true));
        echo json_encode($response);
    }

    function cart_item_delete(){
        $data=$_POST;
        $response['status']=0;  
        if($this->UtilityModels->check_post_data($data['t_d'])){
              if($this->DatabaseModels->cart_item_delete($data['t_d'])){
                $input_data['itemId'] = $data['t_d'];
                $input_data['shopId'] =  $data['h_p'];
                $input_data['quantity'] = $data['q_y'];
                $input_data['shopGst'] = $data['s_t'];
                $input_data['itemImage'] = $data['itemImage'];
                $input_data['itemName'] = $data['itemName'];
                $input_data['itemPrice'] = $data['itemPrice'];
                $input_data['cartId'] = $data['c_d'];
                $response['cart_total'] = $this->DatabaseModels->cart_total();
                $response['html'] = $this->load->view('web/common/cart_increment', $input_data, true);
                $response['status']=1;  
              }
        }
        
        echo json_encode($response);
    }


    function search_results(){
        $response['status']=0;
        $keyword=$_POST['keyword'];
        if($this->UtilityModels->check_string_post_data($keyword)){
            
            $view_data = $this->DatabaseModels->item_search_results($keyword);
           
           
                $response['status']=1;
                $response['html']='<div class="col-12 col-md-12 p-3"><span class="price"> '.count($view_data['item_data']).'</span><span> - '.((count($view_data['item_data'])>1)?' Products ':' Product ').'found'."</span></div>";
                $response['html'].=$this->load->view('web/common/product_cards',$view_data,true);
                log_message('error','html - '.print_r($response,true));
        }
        echo json_encode($response);
    }

     function edit_profile(){
        $data = $this->DatabaseModels->update_profile($_POST);
        if ($data) {
            echo $data;
            redirect('profile');
        }
     }

     function full_view($post_data)
    {
        $itemId = $this->uri->segment(2);
        $data['single_data'] = $this->DatabaseModels->single_item_details($itemId);
        $c_id =  $this->DatabaseModels->item_category($itemId);
        $categoryId = $c_id->categoryId;
        $data['item_data'] = $this->DatabaseModels->category_items_data(8, $categoryId);
        $data['is_category'] = true;
        $data['category_id'] = $post_data;
        if ($this->session->userdata(TAG_FOODVENO_LOGIN_SESSION)) {
            $data['cart_data'] = $this->DatabaseModels->cart_details();
        }
        $this->load->view('web/product_full_view', $data);
    }
}
