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

<section id="login" class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-sign-in-alt"></i> Login
                        </h4>
                    </div>
                    <div class="card-body">
                        <h6 id="result" style="color:red ;background-color:#fce5e3;"></h6>
                        <form action="" method=" POST" role='form' id="login-form">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password2">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class=" custom-control custom-checkbox ">
                                <input type="checkbox" name="rem" class="custom-control-input" id="customCheck"
                                    <?php if(isset($_COOKIE['user_email'])) { ?> checked <?php } ?>>
                               
                                <a href="forgotPassword.php" id="forgot-btn" class="float-right">Forgot
                                    password?</a>
                            </div>
                            <br />

                            <input type="submit" value="Login" id="login" name="login"
                                class="btn btn-secondary btn-block">
                            <br />

                            <p class="text-center">New User? <a href="register.php" id="register-btn">
                                    Register
                                    Here</a> </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/jquery-3.3.1.min.js "></script>
<script src="assets/js/bootstrap.bundle.min.js "></script>
<script src="assets/js/main.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $("#login-form").validate({
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $(form).serialize() + '&action=login',
                success: function(response) {
                    if (response === 'success') {
                        window.location = 'profile.php';
                    } else {
                        $('#result').html(response);
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
})
</script>
</body>

</html>