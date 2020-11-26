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

    // Filter
    $query = 'SELECT room_id, size, bedrooms, floor, price, is_published, building.name, building.city, building.pin, building.building_photo, building.description
    FROM rooms
    INNER JOIN building ON rooms.building_id = building.building_id
    WHERE is_published=1';
    $filtered_item=0;
    if(isset($_GET['bedrooms']) && ($_GET['bedrooms'])!=''){
        $bedrooms = mysqli_real_escape_string($conn, $_GET['bedrooms']);
        $q1 = ' AND bedrooms= '.$bedrooms.' ';
        $query .= $q1;
        ++$filtered_item;
    }
    if(isset($_GET['price']) && ($_GET['price'])!=''){
        $max_price = mysqli_real_escape_string($conn, $_GET['price']);
        $q2 = " AND price<= ".$max_price;
        $query .= $q2;
        ++$filtered_item;
    }
    if(isset($_GET['keywords']) && ($_GET['keywords'])!=''){
        $keywords = mysqli_real_escape_string($conn, $_GET['keywords']);
        $q3 = " AND LOWER(building.description) LIKE '%".$keywords."%'";
        $query .= $q3;
        ++$filtered_item;
    }
    if(isset($_GET['city']) && ($_GET['city'])!=''){
        $city = mysqli_real_escape_string($conn, $_GET['city']);
        $q4 = " AND LOWER(building.city) LIKE '%".$city."%'";
        $query .= $q4;
        ++$filtered_item;
    }
    $result = mysqli_query($conn, $query);

    if($filtered_item>0){
        $listings = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    require('currency.php');
?>

<div style="height: 100%"> 
<section id="showcase-inner" class="py-5" 
    style="
        background-color: #E3F0F4;
        -webkit-box-shadow: 0px 19px 43px 3px #AEB8C0; 
        box-shadow: 0px 19px 43px 3px #AEB8C0;
        height: 200px;
    "
>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="display-4">Search Results</h1>                
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<br/><br/>
<section id="bc" class="mt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">
                        <i class="fas fa-home"></i>Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="listings.php">Browse Listings</a>
                </li>
                <li class="breadcrumb-item active"> Search Results</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listings -->
<section id="listings" class="py-4">
    <div class="container">
        <div class="row">
        <?php if($filtered_item>0) : ?>
        <?php foreach($listings as $listing) : ?>
            <!-- Listing 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card listing-preview">
                    <img
                        class="card-img-top" 
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
                                <i class="fas fa-building"></i> Floor: <?php echo $listing['floor']?>
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
            <?php endforeach; ?>
            <?php else : ?>
                <div class="col-md-12 col-lg-8 mb-8">
                    <h4 class="display-4">
                        No results Found
                    </h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</div>
<!-- Footer -->
<?php include 'inc/footer.php';?>