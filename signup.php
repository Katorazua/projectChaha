<?php 
require 'config/database.php';
//get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$userfield = $_SESSION['signup-data']['userfield'] ?? null;
$phone = $_SESSION['signup-data']['phone'] ?? null;
$createpass = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up-Chaha Eye Hospitals</title>
    <meta content="Chaha Hospitals" name="keywords">
    <meta content="Chaha Eye Hospital" name="description">
    <!-- custom links -->
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/vendor/bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/css/style.css">
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/css/modifile.css">

</head>
<body>
    
    <!--================Signup_part Area =================-->
    
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="signup_part_text text-center">
                    <div class="signup_part_text_iner">
                        <h2>Got Account already?</h2>
                        <p>I am pretty sure you don't want to miss out on the next big deal...</p>
                        <a href="<?=ROOT_URL?>signin.php" class="btn_3">continue with login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <section id="msg" class="form signup">
                    <div class="signup_part_form_iner">
                        <h3>Welcome! <br>
                        Get an Account right away...</h3>
                        <?php if(isset($_SESSION['signup'])) : ?>
                            <div class="alert_message error">
                                <p>
                                    <?=  $_SESSION['signup'];
                                    unset($_SESSION['signup']);
                                    ?>
                                </p>
                            </div>
                        <?php endif ?>
                    
                        <form action="<?=ROOT_URL?>signup-logic.php" method="POST" enctype="multipart/form-data">
                            <div class="name-details">
                                <div class="field input">
                                    <label for="name">First Name</label>
                                    <input type="text" placeholder="first name" name="firstname" value="<?=$firstname?>">
                                </div>
                                <div class="field input">
                                    <label for="name">Last Name</label>
                                    <input type="text" placeholder="last name" name="lastname" value="<?=$lastname?>">
                                </div>
                            </div>
                            <div class="name-details">    
                                <div class="field input">
                                    <label for="name">User Name</label>
                                    <input type="text" placeholder="username" name="username" value="<?=$username?>">
                                </div>                               
                                <div class="field input">
                                    <label for="name">Your email</label>
                                    <input type="email" placeholder="example@yourMail.com" name="email" value="<?=$email?>">
                                </div>                               
                            </div>
                            
                            <div class="name-details">
                                <div class="field input">
                                    <label for="name">Gender</label>
                                    <select name="gender" id="gender" style="height: 40px; width: 220px; font-size: 16px; padding: 0 10px; border: 1px solid #ccc; border-radius: 5px;">
                                        <option>--select--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="field input">
                                    <label for="name">User field</label>
                                    <input type="text" placeholder="job (occupation)" name="userfield" value="<?=$userfield?>">
                                </div>                                                                                    
                            </div>

                            <div class="name-details">
                                <div class="field input">
                                    <label for="name">Password</label>
                                    <input type="password" placeholder="create password" name="createpassword" value="<?=$createpass?>">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                <div class="field input">
                                    <label for="name">Phone</label>
                                    <input type="text" placeholder="(+234)" name="phone" value="<?=$phone?>">
                                </div>
                            </div>   

                            <div class="name-details">
                                <div class="field input">
                                    <label for="name">Confirm password</label>
                                    <input type="text" placeholder="Re-type" name="confirmpassword" value="<?=$confirmpassword?>">
                                </div>
                                <div class="field input">
                                    <label for="name">User avatar</label>
                                    <input type="file" name="avatar" id="avatar" class="file">
                                </div>
                                <div class="field input" style="display: none;">
                                    <label for="role">User role</label>
                                    <input type="text" name="role" value="Bronze" id="role" class="file">
                                </div>
                            </div>                        
                            
                            <div class="right">
                                <input name="terms" type="checkbox" class="file"> I agree and accept to the <a href="<?=ROOT_URL?>terms.php">terms &amp; conditions</a>
                            </div>
                            <div class="field button">
                                <input type="submit" name="submit" value="signup">
                            </div>
                        </form>
                                            
                    </div>
                </section>
            </div>
            
        </div>
    </div>
     <!--================Signup_part end =================-->

     <script src="assets/js/pass-shwo-hide.js"></script>
     <!-- <script src="assets/js/signup.js"></script> -->

</body>
</html>
