<?php
  include_once 'session.php';
  if(isset($_SESSION['user_email'])){
    $current_userr = getUser($_SESSION['user_email']);
    if($current_userr){
        include 'inc/header_new.php';
    }
    else{
        include 'inc/header.php';
    };
  }
  else{
    include 'inc/header.php';
};
?>

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">
                        <i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active"> About</li>
            </ol>
        </nav>
    </div>
</section>

<section id="about" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>We Search For The Perfect Home</h2>
                <p class="lead">Pick From The Top-Notch Properties in Town</p>
                <img src="assets/img/about.jpg" alt="">
                <p class="mt-4" style="font-size:20px">We at <b>Eero</b> Offer you with the most effortless way to Buy
                    and Rent Properties at
                    the most pocket-friendly prices.<br />
                    We've got you covered! We provide you with all the necessities that come your way while purchasing
                    or renting a new property.<br />
                    We have Clean paper work for each property verified by legal bodies and offcourse free from
                    litigations.

                </p>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h2 style="padding:10px" class="text-center">Our Team</h2>
                    <div class="card-body">
                        <h6 class="text-secondary">Kyle Brown</h6>
                        <p class="card-text">
                            A high-touch realtor known for his extensive market knowledge and his unmatched devotion to
                            clients, his success is based almost exclusively on positive referrals.
                        </p>
                    </div>
                    <div class="card-body">
                        <h6 class="text-secondary">Floyd Flukerson</h6>
                        <p class="card-text">
                            Missy has been consistently in the top 10 of San Antonio’s real estate teams and number 1
                            agent for Coldwell Banker D’Ann Harper, Realtors her 17 years there.
                        </p>
                    </div>
                    <div class="card-body">
                        <h6 class="text-secondary">Zoya Ranch</h6>
                        <p class="card-text">
                            Her business is based on more than 80 percent referrals from satisfied clients.She has been
                            the tin the Top Realtors for the 5th time in a row.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Work -->
<section id="work" class="bg-dark text-white text-center">
    <h2 class="display-4">We Work For You</h2>
    <h4>Ypu are just a click away from finding your Dream Home!</h4>
    <br/>
    <br/>
    <br/>
    <a href="listings.php" class="btn btn-secondary text-white btn-lg">View Our Featured Listings</a>
</section>

<!--Services -->
<!-- Listings -->
<section id="listings" class="py-4">
    <div class="container">
        <h2 class="text-center">We Offer</h2>
        <div class="row">

            <!-- Listing 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/we Offer/Houses.jpeg" alt="">
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary">Property</h4>
                        </div>
                        <hr>
                        <a href="listings.php" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>

            
            <!-- Listing 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/we Offer/Service Consultant.jpeg" alt="">
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary">Services</h4>
                            <!-- <p>
                                <i class="fas fa-map-marker text-secondary"></i> Consultancy
                            </p> -->
                        </div>
                        <hr>
                        <a href="services.php" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>