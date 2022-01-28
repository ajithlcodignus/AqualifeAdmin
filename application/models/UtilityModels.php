<?php

/*


 echo "@ copyright 2015 " .DOMAIN_NAME;


 */

class UtilityModels extends CI_Model
{

    function sendMail($password, $email_id)
    {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.ebaazaarweb.com',
            'smtp_port' => 465,
            'smtp_user' => 'otp@ebaazaarweb.com',
            'smtp_pass' => 'shamsi@4321',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );


        $this->email->initialize($config);
        //$this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $sub = "OTP";

        $subject = substr($sub, 0, 30);



        $messag = "Your Password is $password. Do not share to anyone";

        $this->email->to($email_id);
        $this->email->from('otp@ebaazaarweb.com', 'Message from Ebaazaar');
        $this->email->subject($subject);
        $this->email->message($messag);

        //Send email
        $ff = $this->email->send();

        log_message("debug", "HAI called--" . print_r($ff, true));
    }

    function generate_password()
    {
        $password = 123456;
        return $password;
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
            'notification' => array('body' => 'Notification from PHP', 'title' => 'Title', 'image' => 'https://ebaazaarweb.com/images/grecery_banner1.jpg'),
            'to' => '/topics/' . $to,
            'data' => $res,
        );
        return $this->sendPushNotification($fields);
    }



    public function userSendGeneralNotification($notificationType, $notificationTopic, $notification_data)
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
        return $this->userSendPushNotification($fields);
    }

    function userSendPushNotification($fields)
    {

        $firebase_key = "AAAA5_ev6Xw:APA91bH6emHbh-jI-NXzxA1tlWpqy0d7KP8o8egBZGauD-4uh9ZpnaCwyhE7W6zKGDZWlfuOEKAGzzJrRfTco1MBnkdmaacBGgSc5cBPZBbypeA3qfFGD63UjTPrCklcjpp-Tb_rysA7";

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


    public function sendGeneralNotification($notificationType, $notificationTopic, $notification_data)
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

        $fields = array(
            'notification' => array('body' => $body, 'title' => $title, 'image' => $image),
            'to' => '/topics/' . $to,
            'data' => $res,
        );
        return $this->sendPushNotification($fields);
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


    function sendPushNotification($fields)
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
        return $response;
        // Close connection
        curl_close($ch);
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



    function html_to_pdf($html, $file_name = 'order')
    {

        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        // $customPaper = array(0,0,366.00,164.41066);
        // $this->dompdf->setPaper($customPaper,'landscape');
       
        $this->dompdf->render();
        $this->dompdf->stream($file_name . ".pdf", array("Attachment" => 0));
    }

    function html_to_thermal_pdf($html, $page_height = 366.00, $page_width = 164.41066, $file_name = 'order')
    {

        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $customPaper = array(0, 0, $page_height, $page_width);
        $this->dompdf->setPaper($customPaper, 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream($file_name . ".pdf", array("Attachment" => 0));
    }

    function generateRandomString($length = 50)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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

    function check_post_data($post_data)
    {
        return (is_numeric($post_data) !== false) ? true : false;
    }

    function check_string_post_data()
    {
        return true;
    }

    function send_admin_otp($otp, $mobile)
    {

        $url = "https://m1.sarv.com/api/v2.0/sms_campaign.php?token=15704280695fdc497e3a5c07.01477836&user_id=60544143&route=TR&template_id=4217&sender_id=YESVAL&language=EN&template=Dear+Client%2C+%0D%0AYour+OTP+is+" . $otp . ".+DO+NOT+DISCLOSE+THIS+TO+ANYONE+BY+ANY+MEANS.+%0D%0AThanks.%0D%0AYesVle&contact_numbers=" . $mobile;


        function httpGet($url)
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($ch);

            curl_close($ch);
            return $output;
        }

        $send_respo = httpGet($url);
        return 1;
    }

    function generateNumericOTP($n)
    {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }
}
