<?php
    $dbname = 'housing';
    $host = 'localhost';
    $username = 'root';
    $password = '123456';
     
    $conn = new mysqli($host, $username, $password, $dbname);
    if($conn->connect_error){
       echo "Could Not Connect".$conn->connect_error;
    }
?>