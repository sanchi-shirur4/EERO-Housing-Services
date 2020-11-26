<?php
  include_once 'session.php';
  if(isset($_SESSION['user_email'])){
    $current_userr = getUser($_SESSION['user_email']);
    if($current_userr){
        header('Location: listings.php');
        exit();
    }
    else{
        include 'inc/header.php';
    };
  }
  else{
    include 'inc/header.php';
  };
?>

<section id="registers" class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-user-plus"></i> Register
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" id='register-form'>
                            <div id="alert" style="color:red ;background-color:#fce5e3;margin: 50">
                                <h6 id="result">
                                    <!-- Success / Error Message -->
                                </h6>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="rfirst_name" id='first_name' class="form-control" required
                                    minlength="3">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="rlast_name" id='last_name' class="form-control" required
                                    minlength="3">
                            </div>
                            <div class="form-group">
                                <label for="last_name">City Name</label>
                                <input type="text" name="city" id="city" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id='phone' class="form-control" required
                                    minlength="10" maxlength="10">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="remail" id="email" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label for="rpasswords">Password</label>
                                <input type="password" id='passwords' name="passwords" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"
                                    required>
                            </div>

                            <div class=" custom-control custom-checkbox ">
                                <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2"
                                    required>
                                <label for="customCheck2" class="custom custom-control-label">I agree to terms &
                                    conditions</label>
                            </div>
                            <br />

                            <input type="submit" value="Register" id="register" class="btn btn-secondary btn-block">

                            <br />
                            <p class="text-center">Already a User? <a href="login.php" id="login-btn"> Login
                                    Here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<!-- -->
<!-- scripts -->
<script src="assets/js/jquery-3.3.1.min.js "></script>
<script src="assets/js/bootstrap.bundle.min.js "></script>
<script src="assets/js/main.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function() {

    $("#register-form").validate({
        rules: {
            confirmpassword: {
                equalTo: "#passwords",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $(form).serialize() + '&action=register',
                success: function(response) {                    
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#result').html(response);
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});
</script>
</body>
</html>