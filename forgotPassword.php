<?php
  include_once 'session.php';
  if(isset($_SESSION['user_email'])){
    $current_userr = getUser($_SESSION['user_email']);
    if($current_userr){
        header('Location: listings.php');
    }
    else{
        include 'inc/header.php';
    };
  }
  else{
    include 'inc/header.php';
  };
?>

<section id="forgot-password" class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-key"></i> Forgot password
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">To reset your password enter your email</h6>
                        <h6 id="result" style="color:red ;background-color:#fce5e3;"></h6>
                        <form action="" method="POST" role='form' id="forgot-form">
                            <div class="form-group">
                                <label for="fmail">Email</label>
                                <input type="email" name="fmail" id="fmail" class="form-control" required>
                            </div>

                            <input type="submit" value="Reset" id="forgot" name="forgot"
                                class="btn btn-secondary btn-block">
                            <br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'inc/footer.php';?>


<script src="assets/js/jquery-3.3.1.min.js "></script>
<script src="assets/js/bootstrap.bundle.min.js "></script>
<script src="assets/js/main.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>

<script>
$(document).ready(function() {

    $("form").validate({

        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "action.php",
                data: $(form).serialize() + '&action=forgot',
                success: function(response) {
                    $('#result').html(response);
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
})
</script>
</body>

</html>