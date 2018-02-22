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

	    $sms_text = "Your WiFi password is ".$pass. " for username ".$final_user;
            $sms_recipient = '88'.$final_user;

            $sms_url = 'http://sms.sslwireless.com/pushapi/aamra_networks/server.php';
            $sms_data = array( 
                'user' => 'aamra_networks@44com', 
                'pass' => 'aamra_networks@l44_20141027',
                'sid' => 'aamra_networks', 
                'sms[0][0]' => $sms_recipient, 
                'sms[0][1]' => $sms_text);  
            $sms_options = array (  
                        'http' => array(
                        'method' => 'POST',
                        'content' => http_build_query($sms_data),
                        ),     
                    );
            $sms_context = stream_context_create($sms_options);
            $sms_result = file_get_contents($sms_url, false, $sms_context);
            echo $sms_result;                
        }

    }

?>