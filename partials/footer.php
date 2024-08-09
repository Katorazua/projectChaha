<?php
// get suscribe form data if suscribe button was clicked
if (isset($_POST['send'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    // User validate input value
   if (!$email) {
        $_SESSION['suscribe'] = "please enter a valied email";
    } else {
        // check if user name or email already exist in datagase
        $user_check_query = "SELECT email FROM suscribe WHERE email = '$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['suscribe'] = "User already suscribed!";
        } 
    }  
    
    // insert new user into suscribe table
    $user_query = " INSERT INTO suscribe (email) VALUES('$email')";
    $user_result = mysqli_query($connection, $user_query);
    if (!mysqli_errno($connection)) {
        // redirect to login page with success message
        $_SESSION['suscribe-success'] = "You have suscribe to our News Letters successfully.";
    }

} 

?>

<!-- Newsletter Start -->
    <div class="container-fluid position-relative pt-5 wow fadeInUp" data-wow-delay="0.1s" style="z-index: 1;">
        <div class="container">
        <?php if (isset($_SESSION['suscribe-success'])) : ?>
            <div class="alert_message success container text-center">
                <p>
                    <?=  $_SESSION['suscribe-success'];
                    unset($_SESSION['suscribe-success']);
                    ?>
                    </p>
            </div>
        <?php elseif (isset($_SESSION['suscribe'])) : ?>
            <div class="alert_message error container text-center">
                <p>
                    <?=  $_SESSION['suscribe'];
                    unset($_SESSION['suscribe']);
                    ?>
                    </p>
            </div>
        <?php endif ?> 
            <div class="bg-primary p-5">
                <form  method="post" class="mx-auto" style="max-width: 600px;">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control border-white p-3" placeholder="Your Email Address...">
                        <button type="submit" name="send" class="btn btn-dark px-4"><i class="bi bi-bell-fill"></i>Suscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->
    

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light py-5 wow fadeInUp" data-wow-delay="0.3s" style="margin-top: -75px;">
        <div class="container pt-5">
            <div class="row g-5 pt-4">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="<?=ROOT_URL?>appointment.php"><i class="bi bi-arrow-right text-primary me-2"></i>Make Apointment</a>
                        <a class="text-light mb-2" href="<?=ROOT_URL?>moreinfo.php"><i class="bi bi-arrow-right text-primary me-2"></i>More Info.</a>
                        <a class="text-light mb-2" href="<?=ROOT_URL?>contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Feedback</a>
                        <a class="text-light mb-2" target="_blank" href="<?=ROOT_URL?>signup.php"><i class="bi bi-arrow-right text-primary me-2"></i>Signup</a>
                        <a class="text-light" href="<?=ROOT_URL?>logout.php"><i class="bi bi-arrow-right text-primary me-2"></i>Logout</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="<?=ROOT_URL?>index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="<?=ROOT_URL?>about.php"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="<?=ROOT_URL?>service.php"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="<?=ROOT_URL?>event-field.php"><i class="bi bi-arrow-right text-primary me-2"></i>Events</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Download App</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>123 Street, Nigeria</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="bi bi-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="bi bi-facebook fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="bi bi-linkedin fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" href="#"><i class="bi bi-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-light py-4" style="background:  #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="#">Chaha Hospitals</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white border-bottom" href="https://">Alpha|Services (ACI)</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?=ROOT_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/aos/aos.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/swiper/swiper-bundle.min.js.map"></script>
    <script src="<?=ROOT_URL?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?=ROOT_URL?>assets/vendor/php-email-form/validate.js"></script>

    <!-- custom Javascript -->
    <script src="<?=ROOT_URL?>assets/js/main.js"></script>
  
</body>

</html>