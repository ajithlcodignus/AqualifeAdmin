<?php
function sentNotification(){
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

function sentNotification_bkp(){
   // define('API_ACCESS_KEY','AAAA5rZollY:APA91bESpSk9s1oL4_13Q6l0IUBW3bNgaFVDGv9Hey6k2EOq99jJbp27f8KESXsJkqkHw5Sq4hQ7NNBvJHVD0bV_HBdc0ztD2RkUumYOgkPWMoC0SZsBpQb2XolTjruPNSnuXu7Ha95w');
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