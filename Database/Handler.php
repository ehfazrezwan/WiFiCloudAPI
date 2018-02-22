<?php 

    require_once("DBConfig.php");

    class Handler extends DBConfig{

        function __construct(){
            parent::__construct();
        }

        //Function to generate 4 digit passcode
        public function genPass($len = 4) {
            $charPool = "0123456789";
            $pass = array();
            $length = strlen($charPool) - 1;
            for ($i = 0; $i < $len; $i++) {
                $n = rand(0, $length);
                $pass[] = $charPool[$n];
            }
            return implode($pass);
        }
        

        //Function to delete previous user data from radcheck
        public function deleteFromRadius($username){

            $query = $this->radConn->prepare("DELETE FROM radcheck WHERE username = ? ");
            $query->bind_param("s", $username);
            $result = $query->execute();

            if($result){

                $response = array(
                    'success' => 1,
                    'data' => array(
                        'message' => 'Successfully deleted user data'
                    )
                );

            }else{
                $response = array(
                    'success' => 0,
                    'data' => array(
                        'message' => 'Failed to delete previous user data'
                    )
                );
            }

            return $response;
        }

        //Function to add user data to radcheck
        public function addToRadius($username){

            $password = $this->genPass();

            $query = $this->radConn->prepare("INSERT INTO radcheck (username, attribute, op, value) VALUES(?, ?, ?, ?) ");
            $query->bind_param("ssss", $username, $a = "Cleartext-Password", $b = ":=", $password);
            $result = $query->execute();

            if($result){
                $response = array(
                    'success' => 1,
                    'data' => array(
                        'message' => 'Successfully inserted data',
                        'username' => $username,
                        'password' => $password
                    )
                );
            }else{
                $response = array(
                    'success' => 0,
                    'data' => array(
                        'message' => 'Failed to insert user data'
                    )
                );                
            }

            return $response;
        }

        //Function to add user data to WiFiUsers table
        public function addUserData($data){

            $name = $data['gpname'];
            $email = $data['useremail'];
            $phone = $data['gpnumber'];
            $ssid = $data['SSID'];
            $category = $data['category'];
            $deviceType = $data['deviceType'];
            $ipAddress = $data['ipaddress'];
            $macAddress = $data['macaddress'];
            $userAgent = $data['browserName'];
            $temp = $data['temp'];
            $apname = $data['apname'];
            $apmac = $data['apmac'];

            $query = $this->cloudConn->prepare("INSERT INTO wifiusers (name, email, phone, ssid, category, deviceType, ipAddress, macAddress, userAgent, temp, apname, apmac) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            $query->bind_param("ssssssssssss", $name, $email, $phone, $ssid, $category, $deviceType, $ipAddress, $macAddress, $userAgent, $temp, $apname, $apmac);
            $result = $query->execute();

            if($result){
                $response = array(
                    'success' => 1,
                    'data' => array(
                        'message' => 'Successfully inserted WiFi user data'
                    )
                );
            }else{
                $response = array(
                    'success' => 0,
                    'data' => array(
                        'message' => 'Failed to insert WiFi user data'
                    )
                );                                
            }

            return $response;
            
        }

    }
?>