<?php 

    include "../Database/Handler.php";
    include "../SMS/SMS.php";

    $handler = new Handler();
    $sms = new SMS();

    $data = $_POST;

    if(validateNumber($data['gpnumber'])){
        $handler->deleteFromRadius($data['gpnumber']);
        $returnData = $handler->addToRadius($data['gpnumber']);
    
        if($returnData['success']){
            $username = $returnData['data']['username'];
            $password = $returnData['data']['password'];
    
            $returnData = $handler->addUserData($data);
    
            if($returnData['success']){
    
                $sms->sendPass($username, $password);
    
            }else{
                die($returnData['data']['message']);        
            }
        }else{
            die($returnData['data']['message']);
        }    
    }else{
        $message = array(
            'success' => 0,
            'data' => array(
                'message' => 'Invalid mobile number!'
            )
        );
    }

    function validateNumber($phoneNumber){

        if(strlen($phoneNumber) == 11){
            return preg_match('(01)[156789][0-9]{8}', $phoneNumber);
        }else{
            return false;
        }

    }


?>