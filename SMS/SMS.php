<?php 

    class SMS{

        function __construct(){

        }

        public function sendPass($user, $pass){
            
	    $final_user = "";
	    if(strlen($user)==11)
		$final_user = $user;
	    else if(strlen($user)==13)
		$final_user = substr($user,2);
	    else if(strlen($user)==14)
		$final_user = substr($user,3);
	    

	    
	    $sms_text = "Your password is ".$pass." for WiFi username ".$final_user;
            $sms_recipient = $final_user;

            $sms_data = array(
                'text' => $sms_text,
                'mobileNumber' => $sms_recipient
            );


	    $ch = curl_init();
    	    $url = "http://smsportal.bangladeshinfo.com/api/send/AAMRA/5dee47d364a7d71e727a6db7eb8d2522/";
    	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    	        	    

            $query = http_build_query($sms_data);
            curl_setopt($ch, CURLOPT_URL, "$url?$query");
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            $errno = curl_errno($ch);
            $err = curl_error($ch);

            curl_close($ch);

    	    if ($err) {
        	echo "cURL Error #:" . $err . "and info: " . $info;
    	    } else {
        	echo $response;
    	    }

	                    
        }

    }

?>