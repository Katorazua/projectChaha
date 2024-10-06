<?php
require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $user_result =  mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($user_result);  
    
}
  
  ?>

<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Chaha Eye Hospital | AHMS</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../assets/img/favicon.jpg" rel="icon">
  <link href="../assets/img/ceh-logo.jpg" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=ROOT_URL?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File --> 
  <link href="<?=ROOT_URL?>assets/css/main.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/css/modifile.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
          <i class="bi bi-clock me-1"></i> Monday - Saturday, 8AM to 10PM
        </div>
        <div class="d-none d-md-flex align-items-center">
           <p>Chaha Eye Hospital</p>
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-phone me-1"></i><a href="tel:09047978009" class="text-white mb-0">Call us now +234 9047 94 8009</a> 
          
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
          <img src="assets/img/ceh-logo.jpg" alt="">
          <!-- Uncomment the line below if you also wish to use a text logo -->
          <!-- <h1 class="sitename">CEH</h1>  -->
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="pricing.php">Pricing</a></li>
            <li class="dropdown"><a href="#" class="active"><span>More</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="events.php">Events</a></li>
                <li><a href="pricing.php">Pricing</a></li>

                <!-- Uncomment the line below if you also wish to use a Deep Dropdown -->

                <!-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                  </ul>
                </li> -->
                <li><a href="#tabs">Departments</a></li>
                <li><a href="#doctors">Doctors</a></li>
                <li><a href="signup.php">SignUp</a></li>
                <li><a href="logout.php">LogOut</a></li>
              </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(isset($_SESSION['user-id'])) : ?>
              <li class="nav_profile">
                <div class="avater">
                  <a href="<?=ROOT_URL?>profile-logic.php">
                    <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>"  style=" width: 3.5rem; aspect-ratio: 1/1; border-radius: 50%; border: 0.3rem solid rgb(0, 128, 85) ">
                  </a>
                </div>                            
              </li> 
            <?php else : ?>       
                <li><a href="<?=ROOT_URL?>signin.php" target="_blank">Signin</a></li>       
            <?php endif ?> 
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <?php if (isset($_SESSION['user-id'])) :?>
          <a class="cta-btn" href="<?=ROOT_URL?>appointment.php">Make an Appointment</a>
        <?php else :?>
          <a class="cta-btn" href="<?=ROOT_URL?>signin.php">Make an Appointment</a>
        <?php endif ?>
        

      </div>

    </div>

  </header>