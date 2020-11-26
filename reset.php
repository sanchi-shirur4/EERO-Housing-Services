<?php
require 'config.php';
$verification=0;
$message='';
if(isset($_GET['email']) && isset($_GET['token'])){
    $email=$_GET['email'];
    $token=$_GET['token'];
    $stmt=$conn->prepare('SELECT user_id FROM user WHERE email = ? AND token=? AND tokenExpire<NOW()');
    $stmt->bind_param('ss',$email, $token);
    $stmt->execute();
    $result= $stmt->get_result();
    if(isset($result) && $result->num_rows>0){
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $verification = 1;    
    }
    if(isset($_POST['forgot']) && $verification==1){
        $newpass = sha1($_POST['pass']);
        $cnewpass = sha1($_POST['cpass']);

        if($newpass == $cnewpass){
            $stmt_u=$conn->prepare('UPDATE user SET token= "", password=? WHERE email=? ');
            $stmt_u->bind_param('ss',$newpass, $email);
            $stmt_u->execute();        
            $message = "Password Changed Successfully<br><a href='login.php'>Login Here</a> ";            
        }
        else{
            echo "Password did not match";
        }
    }
}
include 'inc/header.php';
?>

<?php if($verification==1) : ?>
<section id="forgot-password" class="bg-light py-5" style="height:100%">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-key"></i> Reset password
                        </h4>
                    </div>
                    <div style="margin-left : 10px">
                        <?php echo($message)?>
                    </div>
                    <div class="card-body">
                        <h6 id="result" style="color:red ;background-color:#fce5e3;"></h6>
                        <form action="" method="POST" role='form' id="reset-form">
                            <div class="form-group">
                                <label for="pass">New Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cpass">Confirm New Password</label>
                                <input type="password" name="cpass" id="cpass" class="form-control" required>
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
<?php else : ?>
<section id="forgot-password" class="bg-light py-5" style="height:100%">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-key"></i> Reset password
                        </h4>
                    </div>
                    <div class="card-body">
                        <h6 id="result" style="color:red ;background-color:#fce5e3;">
                            Invalid Request or Link Expired.
                        </h6>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<script src="assets/js/jquery-3.3.1.min.js "></script>
<script src="assets/js/bootstrap.bundle.min.js "></script>
<script src="assets/js/main.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>

<script>
$(document).ready(function() {

    $("forgot").validate({
        rules: {
            cpass: {
                equalTo: "#pass",
            }

        },
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "resetPassword.php",
                data: $(form).serialize(),
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