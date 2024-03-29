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

<!-- Showcase -->
<section id="showcase">
    <div class="container text-center">
        <div class="home-search p-5">
            <div class="overlay p-5">
                <h1 class="display-4 mb-4">
                    Property Searching Just Got So Easy
                </h1>
                <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae quas, asperiores
                    eveniet vel nostrum magnam
                    voluptatum tempore! Consectetur, id commodi!</p>
                <div class="search">
                    <form action="search.php">
                        <!-- Form Row 1 -->
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="sr-only">Keywords</label>
                                <input type="text" name="keywords" class="form-control"
                                    placeholder="Keyword (Pool, Garage, etc)">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="sr-only">City</label>
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="sr-only">State</label>
                                <select name="state" class="form-control">
                                    <option selected="true" disabled="disabled">State (All)</option>
                                    <option value="AN">Andaman and Nicobar Islands</option>
                                    <option value="AP">Andhra Pradesh</option>
                                    <option value="AR">Arunachal Pradesh</option>
                                    <option value="AS">Assam</option>
                                    <option value="BR">Bihar</option>
                                    <option value="CH">Chandigarh</option>
                                    <option value="CT">Chhattisgarh</option>
                                    <option value="DN">Dadra and Nagar Haveli </option>
                                    <option value="DD">Daman and Diu</option>
                                    <option value="DL">Delhi</option>
                                    <option value="GA">Goa</option>
                                    <option value="GJ">Gujarat</option>
                                    <option value="HR">Haryana</option>
                                    <option value="HP">Himachal Pradesh</option>
                                    <option value="JK">Jammu and Kashmir</option>
                                    <option value="JH">Jharkhand</option>
                                    <option value="KA">Karnataka</option>
                                    <option value="KL">Kerala</option>
                                    <option value="LD">Lakshadweep</option>
                                    <option value="MP">Madhya Pradesh</option>
                                    <option value="MH">Maharashtra</option>
                                    <option value="MN">Manipur</option>
                                    <option value="ML">Meghalaya</option>
                                    <option value="MZ">Mizoram</option>
                                    <option value="NL">Nagaland</option>
                                    <option value="OR">Odisha</option>
                                    <option value="PY">Puducherry</option>
                                    <option value="PB">Punjab</option>
                                    <option value="RJ">Rajasthan</option>
                                    <option value="SK">Sikkim</option>
                                    <option value="TN">Tamil Nadu</option>
                                    <option value="TG">Telengana</option>
                                    <option value="TR">Tripura</option>
                                    <option value="UP">Uttar Pradesh</option>
                                    <option value="UT">Uttarakhand</option>
                                    <option value="WB">West Bengal</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form Row 2 -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="sr-only">Bedrooms</label>
                                <select name="bedrooms" class="form-control">
                                    <option selected="true" disabled="disabled">Bedrooms (All)</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="price" class="form-control" id="type">
                                    <option selected="true" disabled="disabled">Max Price (Any)</option>
                                    <option value="100000">₹100,000</option>
                                    <option value="200000">₹200,000</option>
                                    <option value="300000">₹300,000</option>
                                    <option value="400000">₹400,000</option>
                                    <option value="500000">₹500,000</option>
                                    <option value="600000">₹600,000</option>
                                    <option value="700000">₹700,000</option>
                                    <option value="800000">₹800,000</option>
                                    <option value="900000">₹900,000</option>
                                    <option value="1000000">₹1M+</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form Row 3 -->
                        <div class="form-row">
                            <div class="col-md-2 mb-1">
                                RENT <input type="checkbox">
                                BUY <input type="checkbox">
                            </div>
                        </div>
                        <button class="btn btn-secondary btn-block mt-4" type="submit">Submit form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Listings -->
<section id="listings" class="py-5">
    <div class="container">
        <h3 class="text-center mb-3">Latest Listings</h3>
        <div class="row">
            <!-- Listing 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/homes/home-1.jpg" alt="">
                    <div class="card-img-overlay">
                        <h2>
                            <span class="badge badge-secondary text-white">$490,000</span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary">45 Drivewood Circle</h4>
                            <p>
                                <i class="fas fa-map-marker text-secondary"></i> Norwood MA, 02062
                            </p>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-th-large"></i> Sqft: 2500
                            </div>
                            <div class="col-6">
                                <i class="fas fa-car"></i> Garage: 2
                            </div>
                        </div>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-bed"></i> Bedrooms: 3
                            </div>
                            <div class="col-6">
                                <i class="fas fa-bath"></i> Bathrooms: 2
                            </div>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-user"></i> Kyle Brown
                            </div>
                        </div>
                        <div class="row text-secondary pb-2">
                            <div class="col-6">
                                <i class="fas fa-clock"></i> 5 days ago
                            </div>
                        </div>
                        <hr>
                        <a href="listing.php" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>

            <!-- Listing 2 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/homes/home-2.jpg" alt="">
                    <div class="card-img-overlay">
                        <h2>
                            <span class="badge badge-secondary text-white">$550,000</span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary">18 Jefferson Lane</h4>
                            <p>
                                <i class="fas fa-map-marker text-secondary"></i> Woburn MA, 01801
                            </p>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-th-large"></i> Sqft: 3200
                            </div>
                            <div class="col-6">
                                <i class="fas fa-car"></i> Garage: 1
                            </div>
                        </div>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-bed"></i> Bedrooms: 4
                            </div>
                            <div class="col-6">
                                <i class="fas fa-bath"></i> Bathrooms: 2.5
                            </div>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-user"></i> Mark Hudson
                            </div>
                        </div>
                        <div class="row text-secondary pb-2">
                            <div class="col-6">
                                <i class="fas fa-clock"></i> 5 days ago
                            </div>
                        </div>
                        <hr>
                        <a href="listing.php" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>

            <!-- Listing 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img class="card-img-top" src="assets/img/homes/home-3.jpg" alt="">
                    <div class="card-img-overlay">
                        <h2>
                            <span class="badge badge-secondary text-white">$580,000</span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary">187 Woodrow Street</h4>
                            <p>
                                <i class="fas fa-map-marker text-secondary"></i> Salem MA, 01915
                            </p>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-th-large"></i> Sqft: 3107
                            </div>
                            <div class="col-6">
                                <i class="fas fa-car"></i> Garage: 0
                            </div>
                        </div>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-bed"></i> Bedrooms: 4
                            </div>
                            <div class="col-6">
                                <i class="fas fa-bath"></i> Bathrooms: 3
                            </div>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-user"></i> Mark Hudson
                            </div>
                        </div>
                        <div class="row text-secondary pb-2">
                            <div class="col-6">
                                <i class="fas fa-clock"></i> 5 days ago
                            </div>
                        </div>
                        <hr>
                        <a href="listing.php" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="services" class="py-5 bg-secondary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-comment fa-4x mr-4"></i>
                <hr>
                <h3>Consulting Services</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae,
                    provident iste consequatur
                    hic dignissimos ratione ea quae.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-home fa-4x mr-4"></i>
                <hr>
                <h3>Propery Management</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae,
                    provident iste consequatur
                    hic dignissimos ratione ea quae.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-suitcase fa-4x mr-4"></i>
                <hr>
                <h3>Renting & Selling</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae,
                    provident iste consequatur
                    hic dignissimos ratione ea quae.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>