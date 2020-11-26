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

//Getting Listing Data
require('config.php');

//Getting ID
$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = 'SELECT room_id, size, bedrooms, floor, price, is_published, date_listed, 
building.name, building.address, building.city, building.pin, building.state, building.building_photo, building.pool, building.description,
realtor.name as realtor_name, realtor.photo, realtor.phone as realtor_phone, realtor.email as realtor_email
FROM 
((rooms INNER JOIN building ON rooms.building_id = building.building_id)
INNER JOIN realtor ON realtor.realtor_id = rooms.realtor_id)
WHERE room_id= '.$id;

$query2 = 'SELECT * FROM room_photos WHERE room_id= '.$id;

$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
$photos = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$listing = mysqli_fetch_assoc($result);
mysqli_free_result($result);
require('currency.php');

//inquiry form
if(isset($_POST['form-submit'])){
    $room_id = mysqli_real_escape_string($conn,(int)($listing['room_id']));
    $interest = mysqli_real_escape_string($conn,$_POST['interest']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    $urgency= mysqli_real_escape_string($conn,$_POST['urgency']);
    $bul=false;
    $sql = "INSERT INTO room_enquiry(enquiry_id , room_id, user_id, interest, message, urgency, date) VALUES (NULL,?,?,?,?,?,CURRENT_DATE())";
    if($query = $conn->prepare($sql)) {
        $query->bind_param("iisss",$room_id, $user_id, $interest, $message, $urgency);
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
            $mail->addAddress($listing['realtor_email']);
            $mail->setFrom('eerohousing@gmail.com', 'Housing Services');
            $mail->Subject = 'Query from new user' ;                                  
            $mail->isHTML(true);                                  
            $mail->Body = "<p>Request Sent By: ".$user_email."</p><br/><h3>Message</h3>".$message."<br/><h3>Urgency</h3>".$urgency."<br/><h3>Interest</h3>".$interest."<br/><h3>Room</h3>".$listing['id'].", ".$listing['name'].". ";

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

<section id="showcase-inner" class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="display-4">
                    <?php echo $listing['name'];?>
                </h1>
                <p class="lead">
                    <i class="fas fa-map-marker"></i>
                    <?php echo ' '.$listing['city'].', '.$listing['pin'];?>
                </p>
            </div>
        </div>
    </div>
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
                    <a href="listings.php">Houses</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $listing['name'];?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listing -->
<section id="listing" class="py-4">
    <div class="container">
        <a href="listings.php" class="btn btn-light mb-4">Back To Listings</a>
        <div class="row">
            <div class="col-md-9">
                <!-- Home Main Image -->
                <img src="assets/img/homes/<?php echo $listing['building_photo']?>" 
                alt="" class="img-main img-fluid mb-3">
                <br/>
                <!-- Thumbnails -->
                <div class="row mb-5 thumbs">
                    <?php  foreach($photos as $photo) : ?>
                    <div class="col-md-2" style="
                        width: 150px;
                        height: 75px;
                        overflow: hidden;">                        
                        <a href="assets/img/homes/<?php echo $id ?>/<?php echo $photo['photo'] ?>" data-lightbox="home-images">
                            <img src="assets/img/homes/<?php echo $id ?>/<?php echo $photo['photo'] ?>" 
                            height=75
                            alt="" 
                            class="img-fluid">
                        </a>
                    </div>
                    <?php  endforeach; ?>
                </div>
                <!-- Fields -->
                <div class="row mb-5 fields">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-money-bill-alt"></i> Asking Price:
                                <span class="float-right">
                                    ₹<?php echo moneyFormatIndia($listing['price']);?>
                                </span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-th-large"></i> Square Feet:
                                <span class="float-right">
                                    <?php echo $listing['size']?>
                                </span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-bed"></i> Realtor:
                                <span class="float-right">Kyle Brown
                                </span>
                            </li>    
                            <li class="list-group-item text-secondary">
                            </li>                        
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">                           
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-bed"></i> Bedrooms:
                                <span class="float-right">
                                    <?php echo $listing['bedrooms']?>
                                </span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-square"></i> Swimming Pool:
                                <span class="float-right">
                                    <?php echo (boolval($listing['pool']) ? 'Yes' : 'No')?>
                                </span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-calendar"></i> Listing Date:
                                <span class="float-right">
                                    <?php echo $listing['date_listed']?>
                                </span>
                            </li>
                            <li class="list-group-item text-secondary">
                            </li>
                        </ul>
                    </div> 
                    <div>
                        <ul>
                            <li class="list-group-item text-secondary">
                            <span class="fload-left">
                                    Full Address: <br/>
                                    <?php echo $listing['address'].', '.$listing['name']."<br>".$listing['city'].', '.$listing['state'].'<br>'.$listing['pin'] ?>
                            </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-5">
                <h5>About the Premises:</h5>
                    <div class="col-md-12" style='text-align: justify;margin-top: 5;'>
                        <?php echo$listing['description']?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <img class="card-img-top" src="assets/img/realtors/<?php echo $listing['photo'] ?>" alt="Seller of the month">
                    <div class="card-body">
                        <h5 class="card-title">Property Realtor</h5>
                        <h6 class="text-secondary">
                            <?php echo $listing['realtor_name'] ?>
                        </h6>
                        <h6 class="text-secondary">
                            Contact: <?php echo $listing['realtor_phone'] ?>
                        </h6>
                    </div>
                </div>
                <button class="btn-primary btn-block btn-lg" data-toggle="modal" data-target="#inquiryModal">Make An
                    Inquiry</button>
            </div>
        </div>
    </div>
</section>

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inquiryModalLabel">Make An Inquiry</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="enquiry_form" method="POST" role='form' action="<?php $_SERVER['PHP_SELF'];?>">
                    <div class="form-group">
                        <label for="interest" class="col-form-label">Interest in</label>
                        <select name="interest" id="interest" class="form-control" required>
                            <option value="Buying">Buying</option>
                            <option value="Renting">Renting</option>
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
                    <input type="submit" value="Send" id="form-submit" name="form-submit"
                        class="btn btn-block btn-secondary">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php include 'inc/footer.php';?>