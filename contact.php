<?php
include 'partials/header.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];    
    $subject = $_POST['subject'];
    $hps = "CEH";

    if (!$name){
        $_SESSION['signup'] = "please enter your full name";
    } if (!$email) {
        $_SESSION['signup'] = "please enter a valied email";
    } if (!$subject) {
        $_SESSION['signup'] = "please enter your subject";
    } if (!$message) {
        $_SESSION['signup'] = "please type a message";
    }

        $user_query = " INSERT INTO contact (hps, fullname, email, subject, message) VALUES('$hps', '$name', '$email', '$subject', '$message')";
        $user_result = mysqli_query($connection, $user_query);

    if (!mysqli_errno($connection)) {
        // echo "Message sent successfully!";
        $_SESSION['add-user-success'] = "Message sent successfully!";
    } else {
        echo "Error sending message.";
        $_SESSION['add-user'] = "Error sending message.";
    }
}
?>


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Contact Us</h1>
                <a href="<?=ROOT_URL?>index.php" class="h4">Home</a>
                <span class="h4 text-white">/</span>
                <a href="#" class="h4 text-white">Contact &amp; Feedback</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase">Contact Us</h5>
                            <h1 class="display-6 mb-4">Feel Free To Contact Us &amp; Send Feedback</h1>
                            <p >Help us give the best helth care services by sending in feedback</p>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Our Office</h5>
                                <span>123 Street, Maurdi, Nigeria</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Email Us</h5>
                                <span>info@example.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Call Us</h5>
                                <span>+012 345 6789</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <?php if(isset($_SESSION['add-user-success'])) :  // show if add-user is successful ?>
                        <div class="alert_message success text-center container">
                            <p>
                            <?=  $_SESSION['add-user-success'];
                            unset($_SESSION['add-user-success']);
                            ?>
                            </p>
                        </div>
                    <?php elseif(isset($_SESSION['add-user'])) :  // show if add-user was NOT successful ?>
                        <div class="alert_message error container">
                            <p>
                            <?=  $_SESSION['add-user'];
                            unset($_SESSION['add-user']);
                            ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <form method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" name="name" class="form-control border-0 bg-light px-4" placeholder="Your Full Name" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control border-0 bg-light px-4" placeholder="Subject" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control border-0 bg-light px-4 py-3" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="submit" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    
    <?php include 'partials/footer.php'; ?>