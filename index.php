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

<section>
    <div class="container text-center" style="color:#000; margin-top:25px;">
        <?php include "inc/buildings.php";?>
    </div>
    <div class="container text-center" style="color:#000; margin-top:50px;">
        <h4 class="display-4">
            <b>EERO</b> : One Stop for all your housing needs.
        </h4>
    </div>
    
</section>
<br />
<br />
<section id="showcase-inner" class="py-5"  style=
"background-color: #E3F0F4;
-webkit-box-shadow: 0px 19px 43px 3px #AEB8C0; 
box-shadow: 0px 19px 43px 3px #AEB8C0;
margin: 80px 0px 90px 0px;
padding: 150px"
>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-home fa-4x mr-4"></i>
                <hr>
                <h3>Buying and Renting</h3>
                <p>At Eero you can Buy and Rent Properties tension free and at pocket-friendly prices. All our
                    properties are verified so do not miss on the best deals!</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-briefcase fa-4x mr-4"></i>
                <hr>
                <h3>Allied Services</h3>
                <p>Avail the best services including CCTV Services, Plumbing Services and Electrical Services all at
                    your door step!</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-paint-brush fa-4x mr-4"></i>
                <hr>
                <h3>Interior Designing</h3>
                <p>Furnish your Home with the best furnitures and designs. Hire the best Interior Designers who will
                    craft your home in the way u desire?</p>
            </div>
        </div>
    </div>
</section>

<br />
<br />
<br />
<section>
    <div class="container " style="color:#000">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <h2>Things you Can Do with an EERO Account</h2>
                <ul style='line-height: 2; font-size: 18px' class="py-1">
                    <li>Post Properties for FREE (T&C Apply) </li>
                    <li>Get accessed by over thousands of Buyers</li>
                    <li>Showcase your property as Rental or for Sale </li>
                    <li>Get instant queries over Phone, Email and SMS</li>
                    <li>Add detailed property information & multiple photos per listing</li>
                    <li>Contacts to the best Interior Designers in Town</li>
                    <li>Filter Listing as per Choice and Budget</li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-12">
                <img src="./assets/img/key.jpeg" alt="EERO Housing Services">
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>