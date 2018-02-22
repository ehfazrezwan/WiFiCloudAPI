<?php 

    class DBConfig{

        protected $radConn, $cloudConn;

        function __construct(){
            $host = 'localhost';
            $user = 'ehfaz';
            $pass = 'anl123';

            $this->cloudConn = mysqli_connect($host, $user, $pass, 'WiFiCloud');
            $this->radConn = mysqli_connect($host, $user, $pass, 'radius');                  

        }

    }

?>