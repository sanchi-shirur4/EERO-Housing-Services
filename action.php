<?php
ob_start();
require 'config.php';

//registration
if(isset($_POST['action']) && $_POST['action']=='register'){
    $user_first_name=check_input($_POST['rfirst_name']);
    $user_last_name=check_input($_POST['rlast_name']);
    $user_city=check_input($_POST['city']);
    $user_phone=check_input($_POST['phone']);
    $user_email=check_input($_POST['remail']);
    $user_pswd=check_input($_POST['passwords']);
    $confirmpassword=check_input($_POST['confirmpassword']);
    $hashedpass=sha1($user_pswd);
    $created=date('y-m-d');

    if($user_pswd!=$confirmpassword && $user_pswd!="" && $confirmpassword!=""){
        echo 'Passwords did not match';
        exit();
    }            
     else{           
            $find_query = "SELECT user_id FROM user WHERE phone='$user_phone' OR email='$user_email'";
            $result = mysqli_query($conn, $find_query);
            $existing_user = mysqli_fetch_assoc($result);
            if($existing_user!=''){
                echo 'Account already exists. Please Login';
            }
            else{
                $stmt = "INSERT INTO user (first_name, last_name, city, phone, email, password) 
                VALUES ('$user_first_name', '$user_last_name', '$user_city' ,'$user_phone','$user_email','$hashedpass')";

                if ($conn->query($stmt) === TRUE) {
                    echo "You have been Registered Successfully! | Redirecting...";
                    echo "<script>window.location.href='login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
    }      
};

//login
if(isset($_POST['action']) && $_POST['action']=='login'){
    session_start();
    $user_email=check_input($_POST['email']);
    $user_password=check_input($_POST['password']);
    $hashedpass=sha1($user_password);

    $stmt_l = $conn->prepare('SELECT * FROM user WHERE email LIKE ? AND password LIKE ?');
    $stmt_l->bind_param("ss",$user_email,$hashedpass);
    $stmt_l->execute();
    $user=$stmt_l->fetch();
    $stmt_l->close();
       
   if($user!=null){
        $_SESSION['user_email']=$user_email;
        echo 'success';
        if(!empty($_POST['rem'])){
        //creating token
        $token="qwrtyuiopasdfghjklzxcvbnm1234567890";
        $token=str_shuffle($token);
        $token=substr($token,0,15);    
        $stmt_o = $conn->prepare('UPDATE user SET token=?,tokenExpire=DATE_ADD(NOW() , INTERVAL 1 DAY ) WHERE email=?');
        $stmt_o->bind_param("ss",$token,$user_email);
        $stmt_o->execute();
        $res=$stmt_o->get_result();
        setcookie('token',$token,time() + (86400 * 30), "/");
            if(!isset($_COOKIE["token"])) {
                $varname = $_COOKIE["token"];
            }
        }
    else{
        if(isset($_COOKIE[$user_email]) && isset($_COOKIE[$hashedpass])){
            setcookie('token',$token ,"", "/");
        }
    }
   }
   else{
       echo 'Incorrect Email / Password';
      } 
};

//Forgot Password
if(isset($_POST['action']) && $_POST['action']=='forgot'){
    $user_fmail=$_POST['fmail'];
    $stmt_f = $conn->prepare('SELECT user_id FROM user WHERE email=?');
    $stmt_f->bind_param("s",$user_fmail);
    $stmt_f->execute();
    $res=$stmt_f->get_result();

    if($res->num_rows>0){

        //creating token
        $token="qwrtyuiopasdfghjklzxcvbnm1234567890";
        $token=str_shuffle($token);
        $token=substr($token,0,15);

        $stmt_i = $conn->prepare("UPDATE user SET token=?,tokenExpire=DATE_ADD(NOW() , INTERVAL 5 MINUTE ) WHERE email=?");
        $stmt_i->bind_param("ss",$token,$user_fmail);
        $stmt_i->execute();
        $res=$stmt_i->get_result();

        //sending reset link
            require './PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;

            $mail->isSMTP();                                      
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;                       
            $mail->SMTPSecure = 'tls'; 
       
            $mail->Username = 'eerohousing@gmail.com';                 
            $mail->Password = 'testPassword123';
     
            $mail->addAddress($user_fmail);
            $mail->setFrom('eerohousing@gmail.comm', 'Housing Services');
            $mail->Subject = 'Reset Password';                                  
            $mail->isHTML(true);                                  

            $mail->Body = "<h3>Click The Link to Resest Your Password</h3><br>
            <a href='http://localhost/WDPro/reset.php?email=$user_fmail&token=$token'>
            http://localhost/WDPro/reset.php?email=$user_fmail&token=$token
            </a><br>Regards<br> - Housing Services";


        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}

//Clean data
function check_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

ob_end_flush();
?>