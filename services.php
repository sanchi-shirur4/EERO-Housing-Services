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

  require('config.php');
    $query = 'SELECT service_id, service_name, main_photo FROM services';
    $result = mysqli_query($conn, $query);
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<section id="showcase-inner" class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="display-4">Quality home services, on demand</h1>
                <p class="lead">Experienced, hand-picked Professionals to serve you at your doorstep</p>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">
                        <i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active"> Browse Services</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listings -->
<section id="listings" class="py-4">
    <div class="container">
        <div class="row">        
            <?php  foreach($services as $service) : ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/services/<?php echo $service['main_photo'] ?>" alt="">
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary"> <?php echo $service['service_name']?> </h4>
                        </div>
                        <hr>
                        <a href="service.php?id=<?php echo $service['service_id'] ?>" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>
            <?php  endforeach; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>