<?php 
 //echo 'started' ;
        $token =  urlencode("15704280695fdc497e3a5c07.01477836");
        $user_id =  urlencode("60544143");
        $route =  urlencode("TR");
        $template_id =  urlencode("3625");
        $sender_id  =  urlencode("YESVAL");
        $language =  "EN";
        $template =  urlencode("Hello AJITH Do not share this OTP with anyone. Please use this OTP 123456 to log in to your account. Thanks YVS");
        $contact_numbers = urlencode("8943421724");
         
        
       // $url = "http://m1.sarv.com/api/v2.0/sms_campaign.php?token=".$token."&user_id=".$user_id."&route=".$route."&template_id=".$template_id."&sender_id=".$sender_id."&language=".$language."&template=".$template."&contact_numbers=".$contact_numbers;
        $url="http://m1.sarv.com/api/v2.0/sms_campaign.php?token=15704280695fdc497e3a5c07.01477836&user_id=60544143&route=TR&template_id=3625&sender_id=YESVAL&language=EN&template=Hello+AJITH%2C+Do+not+share+this+OTP+with+anyone.+Please+use+this+OTP+123456+to+log+in+to+your+account.+Thanks+YVS&contact_numbers=7736151724";
       
        
        function httpGet($url)
        {
            $ch = curl_init();  
         
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            
            $output=curl_exec($ch);
         
            curl_close($ch);
            return $output;
        }
         
        echo httpGet($url);
        
        
        
      

        ?>
