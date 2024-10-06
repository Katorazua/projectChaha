<?php 
include '../partials/usersheader.php';
$user_id = $_SESSION['user-id'];
$user_query = "SELECT * FROM users WHERE id=$user_id";
$user_result = mysqli_query($connection, $user_query);
$user = mysqli_fetch_assoc($user_result);
?>

  <!-- ======= Sidebar ======= -->
<?php include 'sidebar.php'; ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Visit Any Chaha Eye Hospital</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Claim Membership Card</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">


            <!-- Sales Card -->
            <?php if(isset($_SESSION['user_is_silver'])) :?>
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Monthly</a></li>
                    <li><a class="dropdown-item" href="#">1 Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Silver <span>| <?="{$user['firstname']} {$user['lastname']}"?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ps-3">
                    <h5>No Card Number Yet</h5>
                      <span class="text-success small pt-1 fw-bold">&copy;</span> <span class="text-muted small pt-2 ps-1">Chaha Eye Hospital</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
            <?php endif ?>

            <!-- Revenue Card -->
            <?php if(isset($_SESSION['user_is_diamond'])) :?>
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Monthly</a></li>
                    <li><a class="dropdown-item" href="#">1 Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Diamond <span>| <?="{$user['firstname']} {$user['lastname']}"?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-diamond-half"></i>
                    </div>
                    <div class="ps-3">
                      <h5>No Card Number Yet</h5>
                      <span class="text-success small pt-1 fw-bold">&copy;</span> <span class="text-muted small pt-2 ps-1">Chaha Eye Hospital</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <?php endif ?>

            <!-- Customers Card -->
            <?php if(isset($_SESSION['user_is_gold'])) :?>
            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Monthly</a></li>
                    <li><a class="dropdown-item" href="#">1 Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Gold <span>| <?="{$user['firstname']} {$user['lastname']}"?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-circle-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h5>No Card Number Yet</h5>
                      <span class="text-success small pt-1 fw-bold">&copy;</span> <span class="text-muted small pt-2 ps-1">Chaha Eye Hospital</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <?php endif ?>

      </div><!-- End Right side columns -->
    </section>

  </main><!-- End #main -->
<?php include '../partials/dashboardfooter.php'; ?>