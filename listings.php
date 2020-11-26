<?php
  include_once 'session.php';
  if(isset($_SESSION['user_email'])){
    $current_userr = getUser($_SESSION['user_email']);
    if($current_userr){
        include 'inc/header_new.php';
    }
    else{
        header('Location: login.php');
        exit();
    };
  }
  else{
    header('Location: login.php');
    exit();
  };
    require('config.php');
    $query = 'SELECT room_id, size, bedrooms, floor, price, is_published, building.name, building.city, building.pin, building.building_photo
    FROM rooms
    INNER JOIN building ON rooms.building_id = building.building_id;
    ';
    $result = mysqli_query($conn, $query);
    $all_listings = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    $listings = array();
    foreach($all_listings as $all_listing)
    {
        if(($all_listing['is_published']) == 1)
        {
            $listings[] = $all_listing;
        }
    }
    require('currency.php');
?>

<section id="showcase-inner" class="py-5" 
    style="
        background-color: #E3F0F4;
        -webkit-box-shadow: 0px 19px 43px 3px #AEB8C0; 
        box-shadow: 0px 19px 43px 3px #AEB8C0;
        height: 385px;
    "
>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="display-4">Browse Our Properties</h1>
                <br/>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <form action="search.php">
                    <!-- Form Row 1 -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="sr-only">Keywords</label>
                            <input type="text" name="keywords" class="form-control"
                                placeholder="Keyword (Search Description)">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="sr-only">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City">
                        </div>
                    </div>
                    <!-- Form Row 2 -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="sr-only">Bedrooms</label>
                            <select name="bedrooms" class="form-control">
                                <option selected="true" disabled="disabled">Bedrooms (Any)</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select name="price" class="form-control">
                                <option selected="true" disabled="disabled">Max Price (All)</option>
                                <option value="1000000">₹10,00,000</option>
                                <option value="2000000">₹20,00,000</option>
                                <option value="3000000">₹30,00,000</option>
                                <option value="4000000">₹40,00,000</option>
                                <option value="5000000">₹50,00,000</option>
                                <option value="6000000">₹60,00,000</option>
                                <option value="7000000">₹70,00,000</option>
                                <option value="8000000">₹80,00,000</option>
                                <option value="9000000">₹90,00,000</option>
                                <option value="10000000">₹1 Cr</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <input type="submit" value="Search" id="form-submit" name="form-submit"
                        class="btn btn-block btn-secondary">
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
    <br/>
    <br/>
    <br/>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">
                        <i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active">Listings</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listings -->
<section id="listings" class="py-4">
    <div class="container">
        <div class="row">
            <?php  foreach($listings as $listing) : ?>
            <!-- Listing 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img
                        class="card-img-top" 
                        height=225
                        src="assets/img/homes/<?php echo $listing['building_photo'];?>" 
                        alt=""
                    >
                    <div class="card-img-overlay">
                        <h2>
                            <span class="badge badge-secondary text-white">
                                ₹<?php echo moneyFormatIndia($listing['price']);?>
                            </span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="listing-heading text-center">
                            <h4 class="text-primary"><?php echo $listing['name'];?></h4>
                            <p>
                                <i class="fas fa-map-marker text-secondary"></i>
                                <?php 
                                    echo $listing['city'].', '.$listing['pin'];
                                ?>
                            </p>
                        </div>
                        <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-th-large"></i> Sqft: <?php echo $listing['size']?>
                            </div>
                            <div class="col-6">
                                <i class="fas fa-car"></i> Floor: <?php echo $listing['floor']?>
                            </div>
                        </div>
                        <div class="row py-2 text-secondary">
                            <div class="col-6">
                                <i class="fas fa-bed"></i> Bedrooms: <?php echo $listing['bedrooms']?>
                            </div>
                            <!-- <div class="col-6">
                                <i class="fas fa-bath"></i> Bathrooms: 2
                            </div> -->
                        </div>
                        <!-- <hr>
                        <div class="row py-2 text-secondary">
                            <div class="col-12">
                            <i class="fas fa-user"></i> Kyle Brown</div>
                        </div>
                        <div class="row text-secondary pb-2">
                            <div class="col-6">
                            <i class="fas fa-clock"></i> 2 days ago</div>
                        </div> -->
                        <hr>
                        <a href="listing.php?id=<?php echo $listing['room_id'] ?>" class="btn btn-primary btn-block">More Info</a>
                    </div>
                </div>
            </div>
            <?php  endforeach; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>