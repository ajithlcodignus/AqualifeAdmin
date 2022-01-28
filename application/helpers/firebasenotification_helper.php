<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_notification'))
{
    function send_notification($device_ids, $message)
    {
        define('API_ACCESS_KEY','AAAA5rZollY:APA91bESpSk9s1oL4_13Q6l0IUBW3bNgaFVDGv9Hey6k2EOq99jJbp27f8KESXsJkqkHw5Sq4hQ7NNBvJHVD0bV_HBdc0ztD2RkUumYOgkPWMoC0SZsBpQb2XolTjruPNSnuXu7Ha95w');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token='990902785622';

        $notification = [
            'title' =>'title',
            'body' => 'body of message.',
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;

    }

    function send_notification_bkp_pk($device_ids, $message)
    {
        log_message('debug',"noti-dev_id".print_r($device_ids,true));
        log_message('debug',"noti-MSG-ID".print_r($message,true));
        $fields = array( 'registration_ids' => $device_ids,
            'data'=> $message);

        $headers = array(
            // Acoount dmtestlabs@gmail.com
            //'Authorization:key=AAAAu193wUk:APA91bHxn4UVEX4OZXEceTiDsADoM2L9JhTFGlzq3h-d9bKNxGYOM3yUQ5JNcAoi6yzpsDIQ5DoHrJD8kN2DmA8qSugAp5sxOEMOPY0L7atobzv0Y-OLdkj0Vy4LedKUenu-GKUw6CdX',
            //'Authorization:key=AAAAsuESMVQ:APA91bHZLhaA4aj5Yx4t7avx2QiynbjdrIswDhU5gOh4gjMxiMDq9FUesYxj5FLdh4xs-pZ3id_vFxUgtgfSYN_Pzdiu_003acHTqEVzfZe1KvMPhnRZsezWvoNqoOSM46D80ME77R7M',
            // FIREBASE_SERVER_KEY
            // Acoount dutymates@gmail.com
            'Authorization: key=AAAA5rZollY:APA91bESpSk9s1oL4_13Q6l0IUBW3bNgaFVDGv9Hey6k2EOq99jJbp27f8KESXsJkqkHw5Sq4hQ7NNBvJHVD0bV_HBdc0ztD2RkUumYOgkPWMoC0SZsBpQb2XolTjruPNSnuXu7Ha95w',
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        // Disabling SSL Certificate support temporarly
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        // Execute post
        $result = curl_exec($ch );

        log_message('debug',"RESULT".print_r($result,true));
        //var_dump($result);
        if($result === false){
            log_message('debug',"FAil".print_r($message,true));
            die('Curl failed:' .curl_errno($ch));

        }else{
            log_message('debug',"Sucess".print_r($message,true));
        }
        // Close connection
        curl_close( $ch );
        return $result;

    }
}
?>
