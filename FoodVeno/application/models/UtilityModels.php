<?php

/*


 echo "@ copyright 2015 " .DOMAIN_NAME;


 */

class UtilityModels extends CI_Model
{

    /*------------------------ID Generator----------------*/
    function get_id($table_name, $column_name)
    {
        $temp_id = "";
        do {
            $temp_id = $this->id_generator();
        } while (!($this->validate_id($temp_id, $table_name, $column_name)));

        return $temp_id;
    }

    function validate_id($temp_id, $table_name, $column_name)
    {
        log_message('debug', "field_id" . $temp_id);
        $result = $this->db->get_where($table_name, array($column_name => $temp_id));
        if ($result->num_rows()) {
            log_message('debug', "field_exist" . $temp_id);
            return false;
        } else {
            log_message('debug', "field_not_exist" . $temp_id);
            return true;
        }
    }

    function id_generator()
    {
        $characters = random_string('alpha', 4);

        $numbers = random_string('numeric', 6);
        $temp_id = $characters . $numbers;

        log_message('debug', "generated" . $temp_id);

        return $temp_id;
    }
    /*------------------------ID Generator----------------*/

    function sendMail($email_id, $message, $sub)
    {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.ebaazaarweb.com',
            'smtp_port' => 465,
            'smtp_user' => 'order@ebaazaarweb.com',
            'smtp_pass' => 'shamsi@4321',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->email->initialize($config);
        //$this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //$sub = "OTP";

        $subject = substr($sub, 0, 30);

        log_message("debug", "HAI called");

        $this->email->to($email_id);
        $this->email->from('order@ebaazaarweb.com', 'Message from '.TAG_APP_NAME);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send email
        $ff = $this->email->send();
        log_message("debug", "HAI called--" . print_r($ff, true));
    }

    public function sendToTopic($notificationType)
    {

        //echo $notificationType;
        //isAppVersionChanged,isDbVersionChanged,

        $to = 'global';
        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';
        $res['data']['notificationType'] = $notificationType;
        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => 'New Order Received', 'title' => 'New Order Received', 'image' => 'https://ebaazaarweb.com/images/grecery_banner1.jpg'),
            'to' => '/topics/' . $to,
            'data' => $res,
        );
        return $this->sendPushNotification($fields);
    }

   
    

    public function sendGeneralNotification($notificationType, $notification_data)
    {

        $body = $notification_data[TAG_BODY];
        $title = $notification_data[TAG_TITLE];
        $image = "";

        $to = 'global';
        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';
        $res['data']['notificationType'] = $notificationType;
        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => '/topics/' . $to,
            'data' => $res,
        );
        return $this->sendPushNotification($fields);
    }
    public function adminTopicNotification($notificationType,$notificationTopic, $notification_data)
    {
       
        $body = $notification_data[TAG_BODY];
        $title = $notification_data[TAG_TITLE];
        $image = $notification_data[TAG_IMAGE];

        $to = $notificationTopic;
        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';
        $res['data']['notificationType'] = $notificationType;
        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => '/topics/' . $to,
            'data' => $res,
        );
        return $this->shopAdminSendPushNotification($fields);
    }


    

    
    public function deviceTokenNotification($notification_data, $to)
    {

        $body = $notification_data[TAG_BODY];
        $title = $notification_data[TAG_TITLE];
        $image = $notification_data[TAG_IMAGE];


        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';

        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => $to,
            'data' => $notification_data,
        );
        return $this->sendPushNotification($fields);
    }



    public function deliveryBoyDeviceTokenNotification($notification_data, $to)
    {

        $body = $notification_data[TAG_BODY];
        $title = $notification_data[TAG_TITLE];
        $image = $notification_data[TAG_IMAGE];


        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';

        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => $to,
            'data' => $notification_data,
        );
        return $this->sendPushNotification($fields);
    }


    function sendPushNotification($fields)
    {

        $firebase_key = "AAAAojWxlb8:APA91bFGBHmK6X4h6W9ZUOqn3u2qU7nZUr0CHGfaFxZD3b6GtPssrUP0QDQCFDfycGf8XoFmxkx01QgYKIEzZqn1xuaQH5M8BHdPG743V4c3-0k_COmQZBYdGsF0z858v7kEZBAIe-v-";

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $firebase_key,
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


    /*  ============= shop admin firebase notification  starts =============== */


    public function shopAdminDeviceTokenNotification($notification_data, $to)
    {

        $body = $notification_data[TAG_BODY];
        $title = $notification_data[TAG_TITLE];
        $image = $notification_data[TAG_IMAGE];


        $res = array();
        $res['data']['title'] = "";
        $res['data']['is_background'] = 1;
        // $res['data']['notificationType'] = 'isDbVersionChanged';

        $res['data']['message'] = "";
        $res['data']['image'] = "";
        $res['data']['payload'] = "";
        $res['data']['timestamp'] = date('Y-m-d G:i:s');

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => $to,
            'data' => $notification_data,
        );
        return $this->shopAdminSendPushNotification($fields);
    }

    function shopAdminSendPushNotification($fields)
    {

        $firebase_key = "AAAA8n6A3PM:APA91bGPiaV9SSFV0-uO8i6a56IJb0wwUUE_UjZb6rrmMpG_0x3fxnHj9g53nLrTUzWv9K_0DPvX5wbUYGQK-GyEgvSkjS3AwUHtroXGgHZ0pMfUtN6_njUrxd-J3cNkm-POhHBr-6gn";

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $firebase_key,
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
        $response = true;
      
        if ($result === FALSE) {
            $response = false;
            //  die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        return $response;
    }

    /*  ============= shop admin firebase notification  ends =============== */



    function generateNumericOTP($n)
    {

        $generator = "1357902468";

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result 
        return $result;
    }


    function sendOtpToMail($otp, $email_id)
    {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.yesvalue.in',
            'smtp_port' => 465,
            'smtp_user' => 'sales@yesvalue.in',
            'smtp_pass' => 'appu@1724',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );


        $this->email->initialize($config);
        //$this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $sub = "OTP";

        $subject = substr($sub, 0, 30);

        log_message("debug", "HAI called");

        $messag = "Your OTP is $otp. Do not share to anyone";

        $this->email->to($email_id);
        $this->email->from('sales@yesvalue.in', 'Message from Yesvalue');
        $this->email->subject($subject);
        $this->email->message($messag);

        //Send email
        $ff = $this->email->send();

        log_message("debug", "HAI called--" . print_r($ff, true));
    }


    function login_sent_otp($otp,$mobile)
    {
	   
	   $url="https://m1.sarv.com/api/v2.0/sms_campaign.php?token=15704280695fdc497e3a5c07.01477836&user_id=60544143&route=TR&template_id=4217&sender_id=YESVAL&language=EN&template=Dear+Client%2C+%0D%0AYour+OTP+is+".$otp.".+DO+NOT+DISCLOSE+THIS+TO+ANYONE+BY+ANY+MEANS.+%0D%0AThanks.%0D%0AYesVle&contact_numbers=".$mobile;
       
        
        function httpGet($url)
        {
            $ch = curl_init();  
         
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            
            $output=curl_exec($ch);
         
            curl_close($ch);
            return $output;
        }
         
         $send_respo=httpGet($url);
        return 1;
    }

    function isDbValueIsNull($table_value){
       return (!empty($table_value)&&$table_value!='');
    }


    function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateOrderHashRandomString($length = 50) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

     function generateRandomOtp($length = 6, $otpString = '0123456789')
    {

        $charactersLength = strlen($otpString);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $otpString[rand(0, $charactersLength - 1)];
        }
        return ($randomString);
    }

    function generateToken($plainTxt)
    {
        $secret = 'FoodVeno@p443$19';
        $key = hash('sha256', $secret, true);
        $iv = openssl_random_pseudo_bytes(16);
        $ciphertext = openssl_encrypt($plainTxt, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext, $key, true);
        return base64_encode($iv . $hash . $ciphertext);
    }

    function decodeToken($base64IVcipherText)
    {
        $ivHashCiphertext = base64_decode($base64IVcipherText);
        $secret = 'FoodVeno@p443$19';
        $iv = substr($ivHashCiphertext, 0, 16);
        $hash = substr($ivHashCiphertext, 16, 32);
        $ciphertext = substr($ivHashCiphertext, 48);
        $key = hash('sha256', $secret, true);
        if (hash_hmac('sha256', $ciphertext, $key, true) !== $hash)
            return null;
        return openssl_decrypt($ciphertext, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
    }

}
