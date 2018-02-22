<?php 

    include "../Database/Handler.php";
    include "../SMS/SMS.php";

    $handler = new Handler();
    $sms = new SMS();

    $data = $_POST;

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


?>