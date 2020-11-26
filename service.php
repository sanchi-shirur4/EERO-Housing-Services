<?php
  include_once 'session.php';
  if(isset($_SESSION['user_email'])){
    $current_userr = getUser($_SESSION['user_email']);
    if($current_userr){
        include 'inc/header_new.php';
    }
    else{
        header('Location: login.php');
    };
  }
  else{
    header('Location: login.php');
  };

//Getting service Data
require('config.php');
//Getting ID
$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = 'SELECT service_name, main_photo from services where service_id='.$id;

$query2 = "SELECT plan_id, plan_name, plan_photo, description, price, services.service_name as service_name
from service_plans
INNER JOIN services on service_plans.service_id = services.service_id
WHERE services.service_id= ".$id;

$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);

$plans = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$service = mysqli_fetch_assoc($result);

//inquiry form
if(isset($_POST['form-submit'])){
    $plan_id = mysqli_real_escape_string($conn,$_POST['plan']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    $urgency= mysqli_real_escape_string($conn,$_POST['urgency']);
    $bul=false;
    $sql = "INSERT INTO service_enquiry(enquiry_id , plan_id, user_id, message, urgency, date) VALUES (NULL,?,?,?,?,CURRENT_DATE())";
    if($query = $conn->prepare($sql)) {
        $query->bind_param("iiss",$plan_id, $user_id, $message, $urgency);
        $query->execute();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error;
    }
        if($query){
        require './PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();                                      
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;                       
            $mail->SMTPSecure = 'tls'; 
            $mail->Username = 'eerohousing@gmail.com';                 
            $mail->Password = 'testPassword123'; 
            $mail->addAddress($user_email);
            $mail->setFrom('eerohousing@gmail.com', 'Housing Services');
            $mail->Subject = 'Service booking request' ;                                  
            $mail->isHTML(true);                                  
            $mail->Body = "<p>Request Sent By: ".$user_email."</p><br/><h3>Message</h3>".$message."<br/><h3>Urgency</h3>".$urgency.". ";

        if(!$mail->send()) {
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Message could not be sent.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // echo '<p style="color:green;">Message has been sent</p>';
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your Query has been Sent!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    else{
        // header('location:profile.php');
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Something Went Wrong...</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
    }
?>

<section id="showcase-innerService" style="margin-bottom:-125px">
<?php 
$service_head = strtolower($service['service_name']);
include "inc/".$service_head.".php";
?>
</section>

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="services.php">Services</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $service['service_name'];?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listing -->
<section id="listing" class="py-4">
    <div class="container">
        <a href="services.php" class="btn btn-light mb-4">Back To Services</a>
        <div class="row">
            <div class="col-md-9">
                <?php foreach($plans as $plan) : ?>
                <div class="card w-100">                
                    <div class="card-body row">                    
                        <div class="col-md-9">
                            <h5 class="card-title"><?php echo $plan['plan_name'] ?></h5>
                            <p class="card-text"><?php echo $plan['description'] ?></p>
                            <!-- <a href="#" class="btn btn-primary">Button</a> -->
                            <button type="button" class="btn btn-success disabled">
                            ₹ <?php echo $plan['price']?>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <img class="card-img-top" src="./assets/img/services/<?php echo strtolower($plan['service_name']) ?>/<?php echo strtolower($plan['plan_photo']) ?>"/>
                        </div>
                    </div>
                </div>
                <br/>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">                    
                    <div class="card-body">
                        <h5 class="card-title">Additionals:</h5>
                        <h6 class="text-secondary">Visiting Charge</h6>
                        <h6 class="text-secondary">Installation Charge</h6>
                        <h6 class="text-secondary">Monitoring App Charge</h6>
                    </div>
                </div>
                <button class="btn-primary btn-block btn-lg" data-toggle="modal" data-target="#inquiryModal">
                    Book
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inquiryModalLabel">Book Your Service</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="enquiry_form" method="POST" role='form' action="<?php $_SERVER['PHP_SELF'];?>">
                    <div class="form-group">
                        <label for="plan" class="col-form-label">Choose a Plan</label>
                        <select name="plan" id="plan" class="form-control" required>
                            <?php foreach($plans as $plan) : ?>
                                <option value="<?php echo $plan['plan_id']?>">
                                    <?php echo $plan['plan_name']?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="urgency" class="col-form-label">Urgency</label>
                        <select name="urgency" id="urgency" class="form-control" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <hr>
                    <input type="submit" value="Book" id="form-submit" name="form-submit"
                        class="btn btn-block btn-secondary">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php include 'inc/footer.php';?>