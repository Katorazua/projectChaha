<?php
 require '../config/database.php';
 $doc_number = $_SESSION['signin-data']['doc_number'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaha-Alpha|HMS Nigeria</title>
    <meta content="Alpha Hospital Management System" name="keywords">
    <meta content="Alpha Hospital Management System" name="description">

    <!-- custom links -->
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/vendor/bootstrap/css/bootstrap.min.css">    
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/css/style.css">
    <link rel="stylesheet" href="<?=ROOT_URL?>assets/css/modifile.css">

</head>
<body>
    <!--================login_part Area =================-->
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Site?</h2>
                            <p>There are advances being made in science and <br> technology
                                everyday, and a good example of this is the Networking</p>

                            <a href="<?=ROOT_URL?>signin.php" class="btn_3"><i class="bi bi-arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <section id="msg" class="form login">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                            Please Sign in now</h3>
                            <?php if (isset($_SESSION['signup-success'])) : ?>
                                <div class="alert_message success">
                                    <p>
                                        <?=  $_SESSION['signup-success'];
                                        unset($_SESSION['signup-success']);
                                        ?>
                                        </p>
                                </div>
                                <?php elseif (isset($_SESSION['signin'])) : ?>
                                <div class="alert_message error">
                                    <p>
                                        <?=  $_SESSION['signin'];
                                        unset($_SESSION['signin']);
                                        ?>
                                        </p>
                                </div>
                            <?php endif ?>
                        
                            <form action="doc_login-logic.php" method="POST" novalidate="novalidate">
                                <div class="field input">
                                    <label for="name">Doctor's Number</label>
                                    <input type="text" name="doc_number" value="<?= $doc_number ?>"
                                        placeholder="Doctors ID" required>
                                </div>
                                <div class="field input">
                                    <label for="name">password</label>
                                    <input type="password" name="password" value="<?= $password ?>"
                                        placeholder="Password" required>
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                <div class="field button">
                                    <input type="submit" name="submit" value="Login">
                                </div>
                            </form>
                            <a class="lost_pass" href="forgot-password.php">forgot password?</a>                                                
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->
    
    <script src="<?=ROOT_URL?>assets/js/pass-shwo-hide.js"></script>

</body>
</html>
