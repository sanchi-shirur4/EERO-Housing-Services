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

  <section id="showcase-inner" class="py-5 text-white" style="background-color:#29AB88">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h1 class="display-4">Contact Us</h1>
          <br/>
          <p class="lead">Cecilia Chapman
            711-2880 Nulla St.
            Mankato Mississippi 96522
            (257) 563-7401<br/>
            Mobile: 8169722543 / 7506565995
            </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section id="team" class="py-5">
    <div class="container">
      <h2 class="text-center">Our Team</h2>
      <br/>
      <br/>
      <div class="row text-center">
      <div class="col-md-4">
          <img src="assets/img/realtors/kyle.jpg" alt="" class="rounded-circle mb-3">
          <h4>Nikola Tesla</h4>
          <p class="text-success">Realtor</p>
          <hr>
          <p>
            <i class="fas fa-phone"></i> (444)-444-4444</p>
          <p>
            <i class="fas fa-envelope-open"></i> nikola@realestate.com</p>
        </div>

        <div class="col-md-4">
          <img src="assets/img/realtors/mark.jpg" alt="" class="rounded-circle mb-3">
          <h4>Andre Terstegen</h4>
          <p class="text-success">Realtor</p>
          <hr>
          <p>
            <i class="fas fa-phone"></i> (444)-444-4444</p>
          <p>
            <i class="fas fa-envelope-open"></i> mats@realestate.com</p>
        </div>

        <div class="col-md-4">
          <img src="assets/img/realtors/jenny.jpg" alt="" class="rounded-circle mb-3">
          <h4>Marie Curie</h4>
          <p class="text-success">Realtor</p>
          <hr>
          <p>
            <i class="fas fa-phone"></i> (333)-333-3333</p>
          <p>
            <i class="fas fa-envelope-open"></i> marie@realestate.com</p>
        </div>
      </div>
    </div>
  </section>

  <section>
    <h2 class="text-center">Our Location</h2>
    <div class="d-flex align-items-center justify-content-center" style="height: 550px">
        <div class="p-2 bd-highlight col-example">
        <iframe width="600" height="450" frameborder="0" style="border:0" 
        src="https://www.google.com/maps/embed/v1/view?zoom=10&center=19.0760%2C72.8777&key=AIzaSyDB3x6fcj0zNPLITM_ZN-AGbLXSkHJ6kWI" allowfullscreen>
        </iframe>
        </div>
    </div>
</section>

  <!-- Footer -->
  <?php include 'inc/footer.php';?>