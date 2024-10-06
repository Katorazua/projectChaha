<?php
require '../config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM doctors WHERE id=$id";
    $user_result =  mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($user_result);  
    
  }else{
    header('location:'.ROOT_URL. 'signin.php');
      die();
  }
  
  ?>

<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Chaha - Alpha|HMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.jpg" rel="icon">
  <link href="../assets/img/ceh-logo.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=ROOT_URL?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=ROOT_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
  <!-- <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet"> -->
  <!-- <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <!-- <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet"> -->
  <link href="<?=ROOT_URL?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=ROOT_URL?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <link rel="stylesheet" href="<?=ROOT_URL?>alphacss/btn.css">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=ROOT_URL?>index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Alpha</span>
        <img src="<?=ROOT_URL?>img/logo-dark.png" alt="">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="P#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> -->
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="<?=ROOT_URL?>index.php">
            <i class="bi bi-house"></i>
          </a>
        </li>
        <!-- End home Icon-->
        
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <!-- <span class="badge bg-primary badge-number">4</span> -->
          </a>
          <!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              New notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <!-- <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div> -->
              <div><p>No notification found</p></div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul>
          <!-- End Notification Dropdown Items -->

        </li>
        <!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <!-- <span class="badge bg-success badge-number">3</span> -->
          </a><!-- End Messages Icon -->

          <?php
            $users_post = "SELECT * FROM contact  WHERE hps = 'CEH' OR hps = 'AHMS' ORDER BY RAND() LIMIT 3";
            $posts = mysqli_query($connection, $users_post);
          ?>          
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <?php if (mysqli_num_rows($posts) > 0 && isset($_SESSION['user_is_admim'])) :?>
            <li class="dropdown-header">
              You have new messages
              <a href="messages.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="view-messages.php?id=<?= $post['id']?>">
                <div>
                  <h4><?= $post['fullname']?></h4>
                  <p><?= $post['message']?></p>
                  <p><?= $post['date_time']?></p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php endwhile ?>
           
            <li class="dropdown-footer">
              <a href="messages.php">Show all messages</a>
            </li>
          <?php else :?>
            <p class="dropdown-header">
              No message found
          </p>
          <?php endif ?>
          </ul><!-- End Messages Dropdown Items -->
          
        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= ROOT_URL . 'images/' . $user['avatar'] ?>" alt="Profile" class="rounded-circle" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden;">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?="{$user['firstname']} {$user['lastname']}"?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $user['job'] ?></h6>
              <span><?= $user['department'] ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=ROOT_URL?>logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
