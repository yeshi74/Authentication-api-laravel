<?php 
$fcmToken = "ctuRWX5qTa6NSH1JuwWPY7:APA91bGv5_xlV5-KjoOFOlOiyg0hc2IpEpKg06hVHgpcB49Heg1AzqHK9hoI8JmpClBfLlGMk0bYAvFoV3RZFM9Zfidzb0E6oVoW9jslIckkUHF0B-PxT81V0MMnOKss8M5jnpYaVsi_";
$serverKey = "AAAAWSYkIa8:APA91bGSZBAO2ifSJDEvZl1gInMY-yBHBco88jwxHPcNyhysnv_CxYurTQJAhvUN1wAbpnj6Ym0fQpmmB1dNE5OABY84haSgmX2Ii_1WBLH_Mjw-t1BBxQ4MvWSc3Ag0uMq9ZLrxluuK";
//$fcm_token = "foi7h222TKSGnpPYKbcluW:APA91bFElfjODrd4JCWxtkJh0FFaRS120jJc2isRi9U4aGVPa4Iuid28Ugs_0WEGsxa9NdELe39Q1NxS9sd5WVZOuhkrBEqAovKQpbkLTZTzPtNk7h0owhZp540GIaixVQ9u7YZ-aov_";
$title="Message from App";
$message="This is the message from the app";
$id = null;  
    echo $fcmToken;

        $url = "https://fcm.googleapis.com/fcm/send";            
        $header = [
        'authorization: key=' . $serverKey,
            'content-type: application/json'
        ];    
    
        $postdata = '{
            "to" : "' . $fcmToken . '",
                "notification" : {
                    "title":"' . $title . '",
                    "text" : "' . $message . '"
                },
            "data" : {
                "id" : "'.$id.'",
                "title":"' . $title . '",
                "description" : "' . $message . '",
                "text" : "' . $message . '",
                "is_read": 0
                }
        }';
    print_r($postdata);
    echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo "1";
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        echo "2";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
echo "3";
        $result = curl_exec($ch);    
        curl_close($ch);
echo "here.....";
echo $result;
        print_r($result);
?>