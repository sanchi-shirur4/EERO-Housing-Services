<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <!-- Lightbox -->
  <link href="assets/css/lightbox.min.css" rel="stylesheet">
  <!-- Custom -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/houses.css">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
  <style>
    .HeroB {
      width: 100%;
      text-align: center;
    }

    .Buildings {
      max-width: 800px;
      visibility: hidden;
      overflow: visible;
    }
  </style>
  <title>Eero Housing</title>
</head>

<body>
  <!-- Top Bar -->
  <section id="top-bar" class="p-3">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <i class="fas fa-phone"></i> (022)-555-5555
        </div>
        <div class="col-md-4">
          <i class="fas fa-envelope-open"></i> contact@eero.co
        </div>
        <div class="col-md-4">
          <div class="social text-right">
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fab fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Navbar Logged-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/img/logo.png" class="logo" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
          <li 
          class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/index.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>"
          >
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li 
          class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/about.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>"
          >
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li 
          class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/listings.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>"
          >
            <a class="nav-link" href="listings.php">Listings</a>
          </li>        
          <li 
          class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/services.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>"
          >
            <a class="nav-link" href="services.php">Services</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li>
              <a class="nav-link" href="profile.php">
                Hello <?php echo $user_first_name ?>
              </a>
          </li>
          <li>
            <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-in-alt"></i>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--  -->
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" class="logo" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li
                        class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/index.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li
                        class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/about.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li
                        class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/contact.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>">
                        <a class="nav-link" href="contactUs.php">Contact</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li
                        class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/register.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>">
                        <a class="nav-link" href="register.php">
                            <i class="fas fa-user-plus"></i> Register</a>
                    </li>
                    <li
                        class="<?php echo ($_SERVER['PHP_SELF'] == "/WDPro/login.php" ? "nav-item active mr-3 " : "nav-item mr-3");?>">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->