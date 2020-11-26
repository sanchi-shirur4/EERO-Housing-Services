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
?>

<section class="bg-light py-5"
 style="background-image: url(./assets/img/building.jpg); background-size: cover 
 width:100%;
 ">
 <div style="height: 100%"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto m-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-user"></i> User Profile
                        </h4>
                    </div>
                    <div class="card-body py-3 m-3" style="line-height:18px; font-size:20px">
                        <p>
                            First Name: <?php echo $user_first_name; ?>
                        </p>
                        <p>
                            Last Name: <?php echo $user_last_name; ?>
                        </p>
                        <p>
                            Email Id: <?php echo $user_email; ?>
                        </p>
                        <p>
                            City: <?php echo $user_city; ?>
                        </p>
                        <p>
                            Phone Number: <?php echo $user_phone; ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Footer -->
<?php include 'inc/footer.php';?>