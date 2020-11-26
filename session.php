<?php
session_start();

function getUser($current_user)
{
    if(isset($current_user)){
        require 'config.php';
        $user = $current_user;
        $stmt = $conn->prepare('SELECT * FROM user WHERE email=?');
        $stmt->bind_param('s',$user);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_array(MYSQLI_ASSOC);
        // var_dump($row);
        //Global variables
        $GLOBALS['user_email']=$row['email'];
        $GLOBALS['user_first_name']=$row['first_name'];  
        $GLOBALS['user_last_name']=$row['last_name'];
        $GLOBALS['user_id']=$row['user_id'];
        $GLOBALS['user_city']=$row['city'];
        $GLOBALS['user_phone']=$row['phone'];
        if(isset($result)){
            // var_dump($_SESSION['user_email']);
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
?>